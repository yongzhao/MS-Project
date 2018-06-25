from datetime import datetime as d
import time

#read the hour
def hour_read():
    h = float(d.now().strftime("%H"))
    return h

#read the minute
def min_read():
    m = float(d.now().strftime("%M"))
    return m

#read the second
def sec_read():
    s = float(d.now().strftime("%S"))
    return s

#time slot judgement
def time_judge():
    hour = hour_read()
    if 14 <= hour <= 19:
        print '%s: Peak Time now!' %time.ctime()
        return 'peak'
        
    elif 7 <= hour <=13 or 20 <= hour <= 21:
        print '%s: Shoulder Time now!' %time.ctime()
        return 'shoulder'
        
    else:
        print '%s: Off-peak Time now!' %time.ctime()
        return 'off-peak'
        

#moment calculation
def moment():
    #month calculation
    monthday = [31,29,31,30,31,30,31,31,30,31,30,31]
    i = 0
    moment = 0
    while (i < d.today().month-1):
        moment = moment + 24*30*monthday[i]
        i = i+1
    #day/hour/min calculation
    moment = moment + 24*30*(d.today().day - 1) + 30*(d.today().hour) + int(d.today().minute/2) #moment start from 0
    return moment
 
