import time_read as read
import mult_read as mult
import pow_flow as pf
#import current_price as cp
import mode
import time


def valueRead():
    TimeSlot = read.time_judge()
    #meter difference
    meterRead1 = mult.pow_read()
    time.sleep(2)
    meterRead2 = mult.pow_read()
    #battery level read
    batLev = mult.bat_read()
    #power sell read
    powout = mult.powout_read()
    return [TimeSlot,meterRead1,meterRead2,batLev,powout]

def working(flag,IniData,ServerIni,valRead):
    #working modes
    ifSell = IniData[51]
    lv2S = IniData[52]
    lv3S = IniData[53]
    batS = IniData[54]
    gS = IniData[55]
    criBL = IniData[56]
    mS = IniData[57]
    TS = valRead[0]
    MR1 = valRead[1]
    MR2 = valRead[2]
    BL = valRead[3]
    PO = valRead[4]
    PreEle = IniData[0]
    BatCap = IniData[1]
    M = ServerIni[1]
    PowBool = ServerIni[2]
    
    #load status
    if lv2S == 1:
        pf.lv2load_on()
    if lv2S == 0:
        pf.lv2load_off()
    if lv3S == 1:
        pf.lv3load_on()
    if lv3S == 0:
        pf.lv3load_off()
    #source status
    if batS == 0 and gS == 0:
        pf.all_off()

    #pv always on
    pf.pv_on()
    pf.batpv_on()
    #sell power 
    if ifSell == 1 and (meterRead1 == meterRead2) and BL == 1:
        pf.sell_on()
    else:
        pf.sell_off()
    #different mode
    #normal mode
    if M == "normal":
        print "%s: Normal mode now" %time.ctime()
        if gS == 1 and batS == 1:
            print "%s: Grid and battery switched on" %time.ctime()
            mode.GridBatMode(flag,PreEle,BatCap,TS,MR1,MR2,BL,criBL)
        elif gS == 1 and batS == 0:
            print "%s: Grid on while battery off" %time.ctime()
            mode.GridMode(PreEle,BatCap,BL,criBL)
        elif gS == 0 and batS == 1:
            print "%s: Grid off while battery off" %time.ctime()
            mode.BatMode(PreEle,BatCap,BL,criBL)
    #mini mode
    elif M == "mini":
        print "%s: Mini-grid mode now" %time.ctime()
        if PowBool == 1:
            if gS == 1 and batS == 1:
                mode.GridBatMode(flag,PreEle,BatCap,TS,MR1,MR2,BL,criBL)
            elif gS == 1 and batS == 0:
                mode.GridMode(PreEle,BatCap,BL,criBL)
            elif gS == 0 and batS == 1:
                mode.BatMode(PreEle,BatCap,BL,criBL)
        if PowBool == 0:
            if batS == 1:
                mode.BatMode(PreEle,BatCap,BL,criBL)
            else:
                pf.all_off()
                pf.pv_on()
                pf.batpv_on()        
    #nano mode   
    elif M == "nano":
        print "%s: Nano-grid mode now" %time.ctime()
        if batS == 1:
            mode.BatMode(PreEle,BatCap,BL,criBL)
        else:
            pf.all_off()
            pf.pv_on()
            pf.batpv_on()
 

