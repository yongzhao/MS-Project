<?php

//get all customer settings and make a table to illustrate in staffSetting.html

session_start();  
$houseid = $_SESSION["houseidforstaff"];
$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";

$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
while ($row=mysqli_fetch_array($result)) {   
	$password=$row["Password"];
	$name=$row["Name"];
	$address=$row["Address"];
	$mobilenumber=$row["Phone"]; 
	$opendate=$row["OpenDate"];
	$ifsell_switch=$row["IfSell"];
	$batterycapacity=$row["BatteryCapacity"];
	$ip=$row["IP"];
	$companyname=$row["CompanyName"];
	//level1 is applicants
	$refrig_level1_N = $row["Lv1rifq"];  
	$refrig_level1_P = $row["Lv1rifp"];
	$bulb_level1_N = $row["Lv1bulbq"];
	$bulb_level1_P = $row["Lv1bulbp"];
	$phone_level1_N = $row["Lv1phoneq"];
	$phone_level1_P = $row["Lv1phonep"];
	$medical_devices_level1_N = $row["Lv1mdq"];
	$medical_devices_level1_P = $row["Lv1mdp"];
	$others_level1_P = $row["Lv1otherp"];
	//level2 is applicants
	$bulb_level2_N = $row["Lv2bulbq"];
	$bulb_level2_P = $row["Lv2bulbp"];
	$airconditioner_level2_N = $row["Lv2acq"];
	$airconditioner_level2_P = $row["Lv2acp"];
	$heater_level2_N = $row["Lv2heaterq"];
	$heater_level2_P = $row["Lv2heaterp"];
	$pc_level2_N = $row["Lv2pcq"];
	$pc_level2_P = $row["Lv2pcp"];
	$others_level2_P = $row["Lv2otherp"];
	//level2 switch status
	$level2_state = $row["Lv2status"];
	//level3 switch status
	$level3_state = $row["Lv3status"];
	//critical battery level set by customer
	$criticalBL = $row["CriticalBL"];
	//battery switch status
	$battery_switch = $row["Bstatus"];
	//grid switch status
	$grid_switch = $row["Gstatus"];
	//sell-out switch status
	$ifsell_switch = $row["IfSell"];
	//master switch status
	$master_switch = $row["Alls"];
	}
mysqli_close($conn);
if ($level2_state == "0"){
	$level2_state = "OFF";
} elseif ($level2_state == "1"){
	$level2_state = "ON";
}
if ($level3_state == "0"){
	$level3_state = "OFF";
} elseif ($level3_state == "1"){
	$level3_state = "ON";
}
if ($battery_switch == "0"){
	$battery_switch = "OFF";
} elseif ($battery_switch == "1"){
	$battery_switch = "ON";
}
if ($grid_switch == "0"){
	$grid_switch = "OFF";
} elseif ($grid_switch == "1"){
	$grid_switch = "ON";
}
if ($ifsell_switch == "0") {
	$ifsell_switch = "No";
} elseif ($ifsell_switch == "1") {
	$ifsell_switch = "Yes";
}
if ($master_switch == "0"){
	$master_switch = "OFF";
} elseif ($master_switch == "1"){
	$master_switch = "ON";
}


#make a table
$datadisplay_string = "<table border = 10>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";
$datadisplay_string .="<tr><td><strong>USER INFORMATION</strong></td></th>";
$datadisplay_string .="<tr><td><strong>HouseID</strong></td><td>$houseid</td><td><strong>Name</strong></td><td>$name</td></tr>";
$datadisplay_string .="<tr><td><strong>Mobile Phone</strong></td><td>$mobilenumber</td><td><strong>Password</strong></td><td>$password</td></tr>";
$datadisplay_string .="<tr><td><strong>Address</strong></td><td>$address</td><td><strong>Open Date</strong></td><td>$opendate</td></tr>";
$datadisplay_string .="<tr><td><strong>Battery Capacity</strong></td><td>$batterycapacity</td><td><strong>IP</strong></td><td>$ip</td></tr>";
$datadisplay_string .="<tr><td><strong>Electricity Supplier</strong></td><td>$companyname</td><td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="<tr><td><strong>APPLIANCES CATEGORY</strong></td></th>";
$datadisplay_string .="<tr><td><strong>Level</strong></td><td><strong>Appliances</strong></td><td><strong>Quantity</strong></td><td><strong>Power</strong></td></tr>";
$datadisplay_string .="<tr><td>Level1</td><td>Refrigerator</td><td>$refrig_level1_N</td><td>$refrig_level1_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Bulb</td><td>$bulb_level1_N</td><td>$bulb_level1_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Phone</td><td>$phone_level1_N</td><td>$phone_level1_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Medical Device</td><td>$medical_devices_level1_N</td><td>$medical_devices_level1_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Others</td><td>N/A</td><td>$others_level1_P</td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="<tr><td><strong>Level</strong></td><td><strong>Appliances</strong></td><td><strong>Quantity</strong></td><td><strong>Power</strong></td></tr>";
$datadisplay_string .="<tr><td>Level2</td><td>Bulb</td><td>$bulb_level2_N</td><td>$bulb_level2_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Air Conditioner</td><td>$airconditioner_level2_N</td><td>$airconditioner_level2_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Heater</td><td>$heater_level2_N</td><td>$heater_level2_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>PC</td><td>$pc_level2_N</td><td>$pc_level2_P</td></tr>";
$datadisplay_string .="<tr><td></td><td>Others</td><td>N/A</td><td>$others_level2_P</td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="<tr><td><strong>APPLIANCES SWITCHES</strong></td></th>";
$datadisplay_string .="<tr><td><strong>Level</strong></td><td><strong>Status</strong></td></tr>";
$datadisplay_string .="<tr><td>LEVEL2</td><td>$level2_state</td></tr>";
$datadisplay_string .="<tr><td>LEVEL3</td><td>$level3_state</td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="<tr><td><strong>SOURCE SETTINGS</strong></td></th>";
$datadisplay_string .="<tr><td><strong>Source</strong></td><td><strong>Status</strong></td><td><strong>Critical Battery Level</strong></td></tr>";
$datadisplay_string .="<tr><td>Battery</td><td>$battery_switch</td><td>$criticalBL</td></tr>";
$datadisplay_string .="<tr><td>Grid</td><td>$grid_switch</td><td>N/A</td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="<tr><td><strong>FEED-IN</strong></td></th>";
$datadisplay_string .="<tr><td><strong>Function</strong></td><td><strong>Status</strong></td></tr>";
$datadisplay_string .="<tr><td>Willing To Sell</td><td>$ifsell_switch</td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="<tr><td><strong>MASTER SWITCH</strong></td></th>";
$datadisplay_string .="<tr><td><strong>Function</strong></td><td><strong>Status</strong></td></tr>";
$datadisplay_string .="<tr><td>Cut-off All</td><td>$master_switch</td></tr>";
$datadisplay_string .="<tr><td>-------------------------------------</td><td>-----------------------------</td><td>-------------------------------------</td><td>----------------------</td></tr>";

$datadisplay_string .="</table>";

echo $datadisplay_string;
?>