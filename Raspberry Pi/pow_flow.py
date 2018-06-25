
import time
import serial
import binascii

ser=serial.Serial('/dev/ttyAMA0',9600)
#Switch 1
bat_gin_on = serial.to_bytes([0x01,0x05,0x00,0x00,0xFF,0x00,0x8C,0x3A])
bat_gin_off = serial.to_bytes([0x01,0x05,0x00,0x00,0x00,0x00,0xCD,0xCA])
#Switch 7
bat_pvin_on = serial.to_bytes([0x01,0x05,0x00,0x01,0xFF,0x00,0xDD,0xFA])
bat_pvin_off = serial.to_bytes([0x01,0x05,0x00,0x01,0x00,0x00,0x9C,0x0A])
#Switch 2
bat_out_on = serial.to_bytes([0x01,0x05,0x00,0x02,0xFF,0x00,0x2D,0xFA])
bat_out_off = begin=serial.to_bytes([0x01,0x05,0x00,0x02,0x00,0x00,0x6C,0x0A])
#Switch 3/4
grid_out_on = serial.to_bytes([0x01,0x05,0x00,0x03,0xFF,0x00,0x7C,0x3A])
grid_out_off = serial.to_bytes([0x01,0x05,0x00,0x03,0x00,0x00,0x3D,0xCA])

grid_in_on = serial.to_bytes([0x02,0x05,0x00,0x00,0xFF,0x00,0x8C,0x09])
grid_in_off = serial.to_bytes([0x02,0x05,0x00,0x00,0x00,0x00,0xCD,0xF9])
#Switch 5
pv_out_on = serial.to_bytes([0x02,0x05,0x00,0x01,0xFF,0x00,0xDD,0xC9])
pv_out_off = serial.to_bytes([0x02,0x05,0x00,0x01,0x00,0x00,0x9C,0x39])
#Switch 6
load_in_on = serial.to_bytes([0x02,0x05,0x00,0x02,0xFF,0x00,0x2D,0xC9])
load_in_off = serial.to_bytes([0x02,0x05,0x00,0x02,0x00,0x00,0x6C,0x39])
#Switch 8
priload_in_on = serial.to_bytes([0x02,0x05,0x00,0x03,0xFF,0x00,0x7C,0x09])
priload_in_off = serial.to_bytes([0x02,0x05,0x00,0x03,0x00,0x00,0x3D,0xF9])

def all_off():
    ser.write(load_in_off)
    ser.flush()
    ser.write(pv_out_off)
    ser.flush()
    ser.write(grid_out_off)
    ser.flush()
    ser.write(grid_in_off)
    ser.flush()
    ser.write(bat_out_off)
    ser.flush()
    ser.write(bat_gin_off)
    ser.flush()
    ser.write(bat_pvin_off)
    ser.flush()
    ser.write(priload_in_off)
    ser.flush()
    
#Level2 Load working
def lv2load_on():
    ser.write(priload_in_on)
    ser.flush()   
    #time.sleep(1)
    print "%s: Lv2 applicants on" %time.ctime()

#Level2 Load off
def lv2load_off():
    ser.write(priload_in_off)
    ser.flush()
    #time.sleep(1)
    print "%s: Lv2 applicants off" %time.ctime()

#Level3 Load working
def lv3load_on():
    ser.write(load_in_on)
    ser.flush()
    #time.sleep(1)
    print "%s: Lv3 applicants on" %time.ctime()

#Level3 Load off
def lv3load_off():
    ser.write(load_in_off)
    ser.flush()
    #time.sleep(1)
    print "%s: Lv3 applicants off" %time.ctime()

#Battery charging by the grid on!!!
def batg_on():
    ser.write(bat_out_off)
    ser.flush()
    ser.write(grid_in_off)
    ser.flush()

    ser.write(grid_out_on)
    ser.flush() 
    ser.write(bat_gin_on)    
    ser.flush()
    #time.sleep(1)
    print "%s: Battery is charging by grid" %time.ctime()

#Battery charging by the grid off!!!
def batg_off():
    ser.write(bat_gin_off)    
    ser.flush()
    #time.sleep(1)
    
#Battery charging by the pv on!!!
def batpv_on():
    ser.write(bat_pvin_on)    
    ser.flush()

    #time.sleep(1)
    print "%s: Battery is charging by PV" %time.ctime()

#Battery charging by the pv off!!!
def batpv_off():
    ser.write(bat_pvin_off)    
    ser.flush()
    #time.sleep(1)   

#Battery supplying!!!
def bat_on():
    ser.write(bat_out_on)
    ser.flush()
    ser.write(grid_out_off)
    ser.flush()
    ser.write(grid_in_off)
    ser.flush()   
    ser.write(bat_gin_off)
    ser.flush()
    #time.sleep(1)
    print "%s: Battery is supplying " %time.ctime()

#Battery off!!!
def bat_off():
    ser.write(bat_out_off)
    ser.flush()

#Buying electricity!!!
def grid_on():
    ser.write(bat_out_off)
    ser.flush()
    ser.write(grid_out_on)
    ser.flush() 
    #time.sleep(1)
    print "%s: You are buying electricity from the grid " %time.ctime()


def grid_off():
    ser.write(grid_out_off)
    ser.flush() 
    #time.sleep(1)

#Selling electricity!!!
def sell_on():
    ser.write(bat_gin_off)
    ser.flush()
    ser.write(grid_out_off)
    ser.flush()
    ser.write(bat_out_on)
    ser.flush()
    ser.write(grid_in_on)
    ser.flush()
    #time.sleep(1)
    print "%s: You are selling electricity to the grid " %time.ctime() 

def sell_off():
    ser.write(grid_in_off)
    ser.flush()

#PV is generating!!
def pv_on():
    ser.write(pv_out_on)
    ser.flush()

    #time.sleep(1)
    print "%s: PV is generating power " %time.ctime()
    
#PV off
def pv_off():
    ser.write(pv_out_off)
    ser.flush()

    #time.sleep(1)
    print "%s: Solor is not enough for PV generating " %time.ctime()


#if _name_ == '_main_':



