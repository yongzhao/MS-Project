import time
import serial
import binascii
import datetime
import time_read as r
from datetime import datetime as d

ser=serial.Serial('/dev/ttyAMA0',9600)
#use temperature sensor as our RSA485 Multimeter
#temperature read order
#mult_ord = serial.to_bytes([0x01,0x03,0x00,0x00,0x00,0x01,0x84,0x0a])
#bat_lev_ord = serial.to_bytes([0x02,0x03,0x00,0x00,0x00,0x01,0x84,0x39])

def pow_read():
    #ser.write(mult_ord)
    #ser.flush()
    #x = ser.readline(7)
    #x = binascii.hexlify(x)
    pow_con = 0.003 + float(d.today().year)*0.00001 + float(d.today().month)*0.0001 + float(d.today().day)*0.0001+float(r.hour_read())*0.001+float(r.min_read())*0.001
    print "%s: Power consumption: %f" %(time.ctime(),pow_con)
    return pow_con

def powout_read():
    #ser.write(mult_ord)
    #ser.flush()
    #x = ser.readline(7)
    #x = binascii.hexlify(x)
    pow_con = 0.003 + float(d.today().year)*0.000001 + float(d.today().month)*0.00001 + float(d.today().day)*0.00001+float(r.hour_read())*0.00001+float(r.min_read())*0.000008
    print "%s: Power sell: %f" %(time.ctime(),pow_con)
    return pow_con

def bat_read():
    #ser.write(bat_lev_ord)
    #ser.flush()
    #x = ser.readline(7)
    #x = binascii.hexlify(x)
    #bat_lev = float(int(x[6:10],16))/300
    bat_lev = r.hour_read()*4.1666/100
    print "%s: Current battery level: %f%%" %(time.ctime(),bat_lev*100)
    return bat_lev

def CurrentPrice(IniData):
    d = datetime.datetime.today().weekday()
    h = r.hour_read()
    
    #weekdays
    if d < 5:
        h = int(h + 3)
        inPrice = float(IniData[h])
        
    #weekends
    else:
        h = int(h + 3 + 24)
        inPrice = float(IniData[h])
    print "%s: Current electricity fee: %f" %(time.ctime(),inPrice)
    return inPrice
