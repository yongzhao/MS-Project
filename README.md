# Mini Grid System Architecture and Hardware

I. Introduction
This project dissertates a 200-home mini-grid system model design. Nectar cloud, database, Raspberry Pi 3b and some RS-485 controlled devises are used as master controller, data storage system, slave controller and actuators and data extractors. Applying this system, an optimization strategy will be executed to switch power sources between battery, PV panels and power grid automatically. In addition, customers have the authority to control the system by switching the status of all devices. For a 2-people house, customers are expected to save 1,000 dollars annually by using this system. In the future, implementation under specific industry environment, a global optimization design for the whole mini-grid system, a back-up communication method, security solution and a better user-friendly customer interface are recommended.

II. Functions
1. Using this system, customers can reduce the electricity bills.
2. This system will buy electricity during off-peak time to charge the battery and use it during peak time. 
3. This system can maintain the necessary appliances working for 24 hours when there occurs an emergency cut-off of the grid.
4. Customers can switch some of their home appliances on/off.
5. Customers have the options about the electricity selling.
6. Customers have the authority to switch the power source on/off.
7. There is a master switch for customers to turn all the sources and appliances on/off.
8. This system will store the recent 1 year usage data for each customer, the data will be recorded every 2 minutes. 

III. Hardware
1. Slave Controller - Raspberry Pi 3b
Raspberry Pi is used as the slave controller to control the statues of power sources and home appliances by RS485 relays. It is also used to communicate with the master controller - cloud. 

2. Actuator and Data Extractor
To simplify the demo, I used several LEDs controlled by RS485 relays to represent status of power sources and home appliances. Two RS485 temperature sensors are used to represent the three-phase power metre and battery. 

IV. Network
1. Master controller
Nectar cloud is chosen as the master controller to control each nano-grid (every single house with one raspberry pi). Also, the database will be stored on the cloud for data storage. The customer interface, web, is also built on the cloud. 

2. Database
There are mainly 5 tables in database which contains Customer_information, Monthly_usage, Anual_usage, Staff_information and Supplier_Electricity_Price. 

V. Software Design
1. Rules
1.1 Rule1: PV panels are only connected to charge the battery, which means the power sources in each nano-grid are battery and power grid.
This rule is designed because of the unstable output of the PV panels. If the PV panels are connected to home appliances directly, the unstability of output may damage the appliances. 

1.2 Rule2: Treat the battery as the primary power supply.
The electricity stored in the battery is either from PV pannels or off-peak electricity which has the lowest cost. Therefore, it is effecient that use the battery first. 

1.3 Rule3: Charge the battery during the lowest price period, off-peak.
Charge the battery during off-peak and use that during peak time. 

1.4 Rule4: All home appliances are classified into three levels by their essentiality.
Appliances are classified into 
a.Must Open level
Appliances in this level will be treated to has the highest essentiality. It may contains some medical devices, emergency lights, fridge etc. The status cannot be switched off by neither the Raspberry Pi nor customer. 
b.Second level 
This level may contain some appliances that customer usually use during the daily time, like Network, computor, air conditioner etc. Customers can control this level appliances in any time.
c.Third level
This level has the lowest essentiality and it cannot be switched on during emergency power cut-off.

1.5 Rule5: The battery will never discharge below the critical battery level unless when the emergency grid power is cut-off.
To maintain the Must Open Level appliances working for 24 hours during the emergency power cut-off, a critical baterry level is set for each nano-grid. It can be calculated by (comsumption of MustOpenApp during 24 hours)/(Total Batery Capacity). 

1.6 Rule6: The nano-system will sell the electricity only when the battery is fully charged and the generated electricity by PV panels are enough for appliances’ usage.
According to the suppliers' prices, the sell-out price is much lower than buy-in prices. Therefore, it is more efficient that use the electricity rather than sell them back to the grid. 

2. Slave Controller - Raspberry Pi
2.1 Set up
For Raspberry Pi3B, to enable the GPIO, the bluetooth occupied port ttyAMA0 needs to be disabled. Also, a static IP address needs to be set and map it to a public IP. 

2.2 Working Strategy
The working codes are programmed based on the rules desinged in last section. There are four dimentions for the system to decide which mode it should be. 
a. Electricity price
b. Battery level
c. Mini-grid connections
d. Customer settings
There are four modes for the system:
a. Normal mode
All power sources are connected normally and customers are able to control status of all devices.
b. Mini-grid mode
In this mode, traditional grid is disconncted to all clients which means the emergency power cut-off occurs. For each clients, there will be 2 situations: 1.if there are some customers selling their electricity into the grid, other clients will transfer to Normal mode. 2.if no one sell electricity, all clients will transfer to nano-grid mode.
c. Nano-grid mode
During this mode, each client is disconnected to the grid and it can be seen as an island. Customer cannot open the third level appliances. 

3. Customer Interface - Website
The website is built on the cloud. APACHE is used as the HTTP server, PHP is used to program the back-end and MySQL is stalled to use the database. 

VI. Estimated saving cost
There are two ways to save the cost. 
1. Power generated by PV panels.
2. Buy off-peak electricity and use that during peak/shoulder time.
According to the average usage in AUSGRID, it can save about 1000AUD/year for a 2-people house with applying this system. 




