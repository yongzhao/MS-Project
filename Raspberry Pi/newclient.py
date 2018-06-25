#!/usr/bin/env python
# -*- coding:utf-8 -*-

import socket
import time
import json
import types

import working as wk
import mult_read as mr
import time_read as t
import pow_flow as pf

from datetime import datetime as d


ip_port = ('43.240.97.37', 8888)
#socket creating and connection
s = socket.socket()     
s.connect(ip_port)      

ini_data = 0
last_meter = 0
curr_meter = 0
last_sell = 0
curr_sell = 0
last_day = 0
curr_day = 0
last_mon = 0
curr_mon = 0
fee = 0
flag = 0
save_mon = 0


while True:     
    last_sell = curr_sell
    last_meter = curr_meter
    last_mon = curr_mon
    last_day = curr_day
    val_read = wk.valueRead()
    #print(val_read)
    curr_meter = val_read[2]
    curr_sell = val_read[4]
    curr_day = d.today().day
    curr_mon = d.today().month
    power_con = curr_meter - last_meter
    power_sell = curr_sell - last_sell

    ser_comm = s.recv(1024) # [ifmodify,mode,anyonesellpower]
    ser_comm = json.loads(ser_comm)
    #print ser_comm
    if ser_comm[0] == "1":
    	s.send("1")
    	print "%s: Data changing..." %time.ctime()
        # [primary load,batcompacity,sellfee,48xbuyfee,ifsell,lv2status,lv3status,batstatus,gridstatus,criticalBL]
    	ini_data = list(json.loads(s.recv(1024)))
    	ini_data = [float(i) for i in ini_data]
    	#print(ini_data)
    	#continue
    elif ser_comm[0] == "0":
    	if ini_data == 0:
    		s.send("1")
    		print "%s: Data initialling..." %time.ctime()
    		ini_data = list(json.loads(s.recv(1024)))
    		ini_data = [float(i) for i in ini_data]
    		#print(ini_data)
    		#continue
    	else:
    		s.send("2")
    		print "%s: Data sending..." %time.ctime()
    		ins_data = json.dumps([t.moment(),curr_meter,curr_sell,val_read[3],fee,save_mon])
    		s.send(ins_data) #[moment,powerin,powerout,batlevel,fee]
    		#continue
    if int(curr_mon) == 3 and int(curr_day) == 1 and int(last_mon) == 2 and int(last_day)==29:
        s.send("3")
        print "%s: This year is leap year" %time.ctime()
    fee = fee + power_con*mr.CurrentPrice(ini_data) #fee calculation during last 2 mins    
    save_mon = save_mon + ini_data[2]*power_sell

    
    wk.working(flag,ini_data,ser_comm,val_read)
    if ini_data[57] == 0:
        pf.all_off()
    print("***************************************************")
s.close()       # 关闭连接
