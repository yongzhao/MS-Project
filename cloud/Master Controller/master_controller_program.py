import socket
import threading
import json
import time
import MySQLdb
import types
from datetime import datetime as d



def link_handler(link, client):     
    print("sever received the request of [%s:%s]...." % (client[0], client[1]))
    while True:
        #database connection
        db = MySQLdb.connect("localhost","root","password","minigrid_db" )
        cursor = db.cursor()
        cursor.execute("select IfSell,IfModify,PrimaryLoad,BatteryCapacity,CompanyName,HouseID,Lv2status,Lv3status,Bstatus,Gstatus,CriticalBL,OpenDate,Alls,Name from customer where IP = '%s' " %client[0])
        #customer data fetch
        data = cursor.fetchone()
        ifsell = data[0]
        ifmodify = data[1]
        mode = "normal"#which is defined by the server and is used to describe the operation mode of the whole system
        havepower = "1"#which is defined by the server and is used to describe whether the house can receive the power from outside 
        primaryload = data[2]
        batterycapacity = data [3]
        companyname = data[4]
        houseid = data[5]
        lv2s = data[6]
        lv3s = data[7]
        bs = data[8]
        gs = data[9]
        criticalbl = data[10]
        opendate = data[11]
        masterswitch = data[12]
        name = data[13]
        statusOfSystem = (ifmodify,mode,havepower)#this tuple discribes the status of the environment
        loadAndCapacity = (primaryload,batterycapacity)#this tuple contains the total popwer of the appliances in level 1 and capacitity of the battery
        customerSetting = (ifsell,lv2s,lv3s,bs,gs,criticalbl,masterswitch)#this tuple includes all customer settings
        link.send(json.dumps(statusOfSystem))
        print("%s:command receiving")%(time.ctime())
        #commond from the slave controller
        client_data = link.recv(1024)

        #case 1: slave controller needs data to update/initial
        if client_data == "1":
            print("%s:%s need update data")%(time.ctime(),client[0])
            cursor = db.cursor()
            cursor.execute("select SellFee,F0,F1,F2,F3,F4,F5,F6,F7,F8,F9,F10,F11,F12,F13,F14,F15,F16,F17,F18,F19,F20,F21,F22,F23,T0,T1,T2,T3,T4,T5,T6,T7,T8,T9,T10,T11,T12,T13,T14,T15,T16,T17,T18,T19,T20,T21,T22,T23 from company where CompanyName = '%s'" %companyname)
            data = cursor.fetchone()
            link.send(json.dumps(loadAndCapacity+data+customerSetting))#2+49+7=58 send a tuple which includes total 58 variables
            print("%s:initial data sending")%(time.ctime())
            cursor = db.cursor()
            cursor.execute("update customer set IfModify = '0' where IP = '%s'" %client[0])#after sending, update the attribute, 'IfModify', to '0', which shows that all updates have already sent to the slave controller 
            db.commit()#make sure the update will be made to the database
            db.close()
            print("***********************************************************************************************************************")
            client_data = 0
            continue

        #case 2: data collection every 2 min
        elif client_data == "2":
            print("%s:%s uploads data to server" % (time.ctime(),client[0]))
            instantdata = json.loads(link.recv(1024))#data received from the slave controller
            TPM = [1,22321,43201,63521,87121,109441,131041,153361,175681,197281,219601,241201]#each number indicates the first second of the first day of each month
            tablename = 'detailusage'+houseid
            insPB = float(instantdata[1])
            insPS = float(instantdata[2])
            insBL = float(instantdata[3])
            insEF = float(instantdata[4])
            insSM = float(instantdata[5])
            insTPN = int(instantdata[0])
            print("%s:This %s 's usage information.")%(time.ctime(),name)
            print("%s:Customer has bought %f kWh electricity from the grid.")%(time.ctime(),insPB)
            print("%s:Customer has sold %f kWh electricity to the grid.")%(time.ctime(),insPS)
            print("%s:The current battery level is %f.")%(time.ctime(),insBL)
            print("%s:The accumulated electricity cost is %f.")%(time.ctime(),insEF)
            print("%s:The accumulated saved money is %f.")%(time.ctime(),insSM)
            #update slave controller's own detail usage table
            cursor = db.cursor()
            cursor.execute("update %s set PowerBuy = %s,PowerSell = %s,BatteryLevel = %s,ElectricityFee = %s,SavedMoney = %s where TimePointNumber = %s" %(tablename,insPB,insPS,insBL,insEF,insSM,insTPN))
            db.commit()
            #judge whether the time is the first second of a month
            #if it is, update the monthly usage table
            i = 0
            while i < 12:
                if insTPN == TPM[i] or insTPN == TPM[i]+1:
                    if i == 0:
                        if (opendate.year  < d.totay.year - 1) and (opendate.year  == d.totay.year - 1 and opendate.month < 12):
                            cursor = db.cursor()
                            cursor.execute("select PowerBuy,PowerSell,ElectricityFee,SavedMoney from %s where TimePointNumber = 241200" %tablename)
                            data = cursor.fetchone()
                            upPB = insPB - data[0]
                            upPS = insPS - data[1]
                            upEF = insEF - data[2]
                            upSM = insSM - data[3]
                            cursor = db.cursor()
                            cursor.execute("insert into monthlyusage values ('%s',%s,%s,%s,%s,%s,%s)"%(houseid,d.totay.year-1,12,upPB,upPS,upEF,upSM))
                            db.commit()
                        else:
                            cursor = db.cursor()
                            cursor.execute("insert into monthlyusage values ('%s',%s,%s,%s,%s,%s,%s)"%(houseid,d.totay.year-1,12,insPB,insPS,insEF,insSM))
                            db.commit()
                    else:
                        if (opendate.year  < d.totay.year - 1) and (opendate.year  == d.totay.year and opendate.month < d.today.month - 1):
                            cursor = db.cursor()
                            cursor.execute("select PowerBuy,PowerSell,ElectricityFee,SavedMoney from %s where TimePointNumber = %s" %(tablename,TPM[i-1]-1))
                            upPB = insPB - data[0]
                            upPS = insPS - data[1]
                            upEF = insEF - data[2]
                            upSM = insSM - data[3]
                            cursor = db.cursor()
                            cursor.execute("insert into monthlyusage values ('%s',%s,%s,%s,%s,%s,%s)"%(houseid,d.totay.year,d.today.month-1,upPB,upPS,upEF,upSM))
                            db.commit()
                        else:
                            cursor = db.cursor()
                            cursor.execute("insert into monthlyusage values ('%s',%s,%s,%s,%s,%s,%s)"%(houseid,d.totay.year,d.today.month-1,upPB,upPS,upEF,upSM))
                            db.commit()
                i = i + 1
            db.close()
            print("Update is finished. Wating for the next time.")
            print("***********************************************************************************************************************")
            time.sleep(120)#118
            client_data = 0
            continue

        #case 3: set data of 29th February to 0 when in common year 
        elif client_data == "3":
            i = 417600
            tablename = 'detailusage'+houseid
            while (i <= 418319):
                cursor = db.cursor()
                cursor.execute("update %s set PowerBuy = 0.0,PowerSell = 0.0,BatteryLevel = 0.0,ElectricityFee = 0.0 where TimePointNumber = %s" %(tablename,i))
                db.commit()
                db.close()
                i=i+1
            client_data = 0
            continue
        if client_data == "exit":
            print("stop communication with [%s:%s]..." % (client[0], client[1]))
            client_data = 0
            continue
    link.close()


#socket connection
ip_port = ('43.240.97.37', 8888)
sk = socket.socket()            
sk.bind(ip_port)              
sk.listen(200)         

print('start socket, waiting...')

while True:     
    conn, address = sk.accept() 
    t = threading.Thread(target=link_handler, args=(conn, address))
    t.start()

