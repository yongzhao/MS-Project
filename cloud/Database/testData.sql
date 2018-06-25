use minigrid_db;
/*insert the information of two customer: Alan and Bob*/
insert into customer values ('1','minigrid1','Alan','101/1 Swanston st','0412345678',20160101,'0','0',5.95,19.7,'128.250.130.181','AGL',1,75.5,4,15,1,40,0,0,30,4,15,1,5800,2,2500,2,460,200,'1','1','1','1','0',25);
insert into customer values ('2','minigrid2','Bob','102/1 Swanston st','0481234567',20160101,'0','0',6.05,19.7,'128.250.130.188','EnergyAustralia',2,84.5,3,15,1,40,0,0,50,5,15,2,4800,2,2400,3,450,300,'1','1','1','1','0',40);
/*insert three staffs*/
insert into staff values ('719430','passwordlhh');
insert into staff values ('744830','passwordcyz');
insert into staff values ('719849','passwordzyx');
/*insert nine suppliers*/
insert into company values ('AGL','1',11.3,25.3,25.3,25.3,25.3,25.3,25.3,25.3,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,39.6,39.6,39.6,39.6,39.6,39.6,33.0,25.3,25.3,25.3,25.3,25.3,25.3,25.3,25.3,25.3,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,25.3,25.3);
insert into company values ('EnergyAustralia','2',12.2,22.781,22.781,22.781,22.781,22.781,22.781,22.781,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,40.953,40.953,40.953,40.953,40.953,40.953,33.0,22.781,22.781,22.781,22.781,22.781,22.781,22.781,22.781,22.781,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,33.0,22.781,22.781);
insert into company values ('Alinta','3',11.3,25.179,25.179,25.179,25.179,25.179,25.179,25.179,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,42.955,42.955,42.955,42.955,42.955,42.955,35.057,25.179,25.179,25.179,25.179,25.179,25.179,25.179,25.179,25.179,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,35.057,25.179,25.179);
insert into company values ('Dodo','4',11.6,21.329,21.329,21.329,21.329,21.329,21.329,21.329,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,42.064,42.064,42.064,42.064,42.064,42.064,32.263,21.329,21.329,21.329,21.329,21.329,21.329,21.329,21.329,21.329,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,32.263,21.329,21.329);
insert into company values ('MomentumEnergy','5',11.3,13.508,13.508,13.508,13.508,13.508,13.508,13.508,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,29.337,29.337,29.337,29.337,29.337,29.337,26.081,13.508,13.508,13.508,13.508,13.508,13.508,13.508,13.508,13.508,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,26.081,13.508,13.508);
insert into company values ('Origin','6',11.3,24.112,24.112,24.112,24.112,24.112,24.112,24.112,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,47.223,47.223,47.223,47.223,47.223,47.223,36.894,24.112,24.112,24.112,24.112,24.112,24.112,24.112,24.112,24.112,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,36.894,24.112,24.112);
insert into company values ('PowerDirect','7',5.0,24.2,24.2,24.2,24.2,24.2,24.2,24.2,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,38.5,38.5,38.5,38.5,38.5,38.5,34.1,24.2,24.2,24.2,24.2,24.2,24.2,24.2,24.2,24.2,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,34.1,24.2,24.2);
insert into company values ('PowerShop','8',11.8,19.06,19.06,19.06,19.06,19.06,19.06,19.06,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,33.9,33.9,33.9,33.9,33.9,33.9,29.95,19.06,19.06,19.06,19.06,19.06,19.06,19.06,19.06,19.06,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,29.95,19.06,19.06);
insert into company values ('Sumo','9',11.3,17.533,17.533,17.533,17.533,17.533,17.533,17.533,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,28.940,28.940,28.940,28.940,28.940,28.940,24.901,17.533,17.533,17.533,17.533,17.533,17.533,17.533,17.533,17.533,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,24.901,17.533,17.533);
/*insert test data for the Alan in monthlyusage table*/
insert into monthlyusage values ('1',2016,1,271.65,0,90.27,10.4);
insert into monthlyusage values ('1',2016,2,241.65,7.8,79.55,10.1);
insert into monthlyusage values ('1',2016,3,230.44,5.5,70.44,12.2);
insert into monthlyusage values ('1',2016,4,220.45,4.3,69.56,15.5);
insert into monthlyusage values ('1',2016,5,258.12,11.0,80.24,7.9);
insert into monthlyusage values ('1',2016,6,265.47,2.4,88.57,9.8);
insert into monthlyusage values ('1',2016,7,259.86,8.5,85.21,11.2);
insert into monthlyusage values ('1',2016,8,255.53,6.6,78.26,12.5);
insert into monthlyusage values ('1',2016,9,200.33,4.5,61.11,18.5);
insert into monthlyusage values ('1',2016,10,204.48,3.1,63.32,17.7);
insert into monthlyusage values ('1',2016,11,265.66,8.4,89.57,16.3);
insert into monthlyusage values ('1',2016,12,270.47,4.3,90.17,8.6);
insert into monthlyusage values ('1',2017,1,271.65,1.5,90.27,11.2);
insert into monthlyusage values ('1',2017,2,241.65,0,79.55,14.3);
insert into monthlyusage values ('1',2017,3,230.44,3.7,70.44,12.2);
insert into monthlyusage values ('1',2017,4,220.45,8.5,69.56,9.8);
insert into monthlyusage values ('1',2017,5,258.12,6.4,80.24,7.7);
insert into monthlyusage values ('1',2017,6,265.47,4.1,88.57,6.7);
insert into monthlyusage values ('1',2017,7,259.86,3.9,85.21,9.9);
insert into monthlyusage values ('1',2017,8,255.53,11.2,78.26,14.2);
insert into monthlyusage values ('1',2017,9,200.33,2.4,61.11,12.2);
insert into monthlyusage values ('1',2017,10,204.48,3.5,63.32,10);
insert into monthlyusage values ('1',2017,11,265.66,8.4,89.57,7.7);
insert into monthlyusage values ('1',2017,12,270.47,6.7,90.17,8.9);
insert into monthlyusage values ('1',2018,1,271.65,2.4,90.27,9.6);
insert into monthlyusage values ('1',2018,2,241.65,3.1,79.55,7.8);
insert into monthlyusage values ('1',2018,3,230.44,5.4,70.44,7.9);
/*set all usage information in detailusage table of customer Alan to 0*/
drop procedure if exists ini1;
delimiter //
create procedure ini1()
begin
declare i int;
set i = 0;
while i < 366*720 do
insert into detailusage1 (TimePointNumber,PowerBuy,PowerSell,BatteryLevel,ElectricityFee,SavedMoney) values (i,0.0,0.0,0.0,0.0,0.0);
set i=i+1;
end while;
end //
delimiter ;
call ini1();
/*set all usage information in detailusage table of customer Bob to 0*/
drop procedure if exists ini2;
delimiter //
create procedure ini2()
begin
declare i int;
set i = 0;
while i < 366*720 do
insert into detailusage2 (TimePointNumber,PowerBuy,PowerSell,BatteryLevel,ElectricityFee,SavedMoney) values (i,0.0,0.0,0.0,0.0,0.0);
set i=i+1;
end while;
end //
delimiter ;
call ini2();