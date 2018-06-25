import mult_read as meter
import time_read as timeRead
import pow_flow as powFlow
import time
#############################################################################
def GridBatMode(flag,PreEle,BatCap,TimeSlot,meterRead1,meterRead2,batLev,criBL):
    #The minimum critical baterry level for supply the
    #premium home appliances for 1 day
    if criBL == 0:
        BLCriMin = PreEle*24/BatCap       
    else:
        BLCriMin = criBL/100
    print "%s: Current critical batLevel: %f%%" %(time.ctime(),BLCriMin*100)
    #The supply critical baterry level is a 5% tolerance
    #to prevent the electricity switching from different sources too frequently
    BLCriTo = BLCriMin + 0.05
 
    if TimeSlot == 'peak' or TimeSlot == 'shoulder': 
        if batLev <= BLCriMin:
            powFlow.batpv_on()
            powFlow.batg_on()
            powFlow.grid_on()
            powFlow.bat_off()
            mode = 1
            flag = mode
        elif batLev >= BLCriTo:
            powFlow.batpv_on()
            powFlow.batg_off()
            powFlow.bat_on()
            powFlow.grid_off()
            mode = 3
            flag = mode
        else:
            mode = 2
            if flag == 3:
                powFlow.batpv_on()
                powFlow.batg_off()
                powFlow.bat_on()
                powFlow.grid_off()  
            else: 
                powFlow.batpv_on()
                powFlow.batg_off()
                powFlow.grid_on()
                powFlow.bat_off()

    if TimeSlot == 'off-peak':
        #batLev = 0.35
        #the total battery charging time is 4 hour, it takes 4*0.65=2.6 hours from 35% to 100% of battery level.
        #Battery start charging from grid since 4:24am during off-peak
        hour = timeRead.hour_read()
        minute = timeRead.min_read()
        if (batLev!=1 and ((hour == 4 and minute >= 24) or (hour >= 5 and hour <= 7))) or batLev <= BLCriMin:
            powFlow.batg_on()
            powFlow.batpv_on()
            powFlow.grid_on()
            powFlow.bat_off()             
        else :            
            if batLev <= BLCriMin:
                powFlow.batg_on()
                powFlow.batpv_on()
                powFlow.grid_on()
                powFlow.bat_off()
            else :
                powFlow.batg_off()
                powFlow.batpv_on()
                powFlow.bat_on()
                powFlow.grid_off()   
#############################################################################
def BatMode(PreEle,BatCap,batLev,criBL):
    if criBL == 0:
        BLCriMin = PreEle*24/BatCap       
    else:
        BLCriMin = criBL/100
    #The supply critical baterry level is a 5% tolerance
    #to prevent the electricity switching from different sources too frequently
    BLCriTo = BLCriMin + 0.05
    powFlow.batg_off()
    powFlow.batpv_on()
    powFlow.bat_on()
    powFlow.grid_off() 

#############################################################################
def GridMode(PreEle,BatCap,batLev,criBL):
    if criBL == 0:
        BLCriMin = PreEle*24/BatCap       
    else:
        BLCriMin = criBL/100
    #The supply critical baterry level is a 5% tolerance
    #to prevent the electricity switching from different sources too frequently
    BLCriTo = BLCriMin + 0.05
    if batLev <= BLCriMin:
        powFlow.batg_on()
        powFlow.batpv_on()
        powFlow.bat_off()
        powFlow.grid_on() 
    else:
        powFlow.batg_off()
        powFlow.batpv_on()
        powFlow.bat_off()
        powFlow.grid_on()    
