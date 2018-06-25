<?php

//get all values of appliances in level 1 and make a table to show in Level1Detail.html

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";
$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
while ($row=mysqli_fetch_array($result)) {  
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
}
mysqli_close($conn);

#make a table
$datadisplay_string = "<table border = 10>";
$datadisplay_string .="<tr><td>--------------------</td><td>-------------</td><td>-------------</td><td>----------</td><td>----------------</td></tr>";
$datadisplay_string .="<tr><td><strong>Appliances</strong></td><td></td><td><strong>Quantity</strong></td><td></td><td><strong>Power (W)</strong></td></tr>";
$datadisplay_string .="<tr><td>Refrigerator</td><td></td><td>$refrig_level1_N</td><td></td><td>$refrig_level1_P</td></tr>";
$datadisplay_string .="<tr><td>Bulb</td><td></td><td>$bulb_level1_N</td><td></td><td>$bulb_level1_P</td></tr>";
$datadisplay_string .="<tr><td>Phone</td><td></td><td>$phone_level1_N</td><td></td><td>$phone_level1_P</td></tr>";
$datadisplay_string .="<tr><td>Medical Device</td><td></td><td>$medical_devices_level1_N</td><td></td><td>$medical_devices_level1_P</td></tr>";
$datadisplay_string .="<tr><td>Others</td><td></td><td>N/A</td><td></td><td>$others_level1_P</td></tr>";
$datadisplay_string .="<tr><td>--------------------</td><td>-------------</td><td>-------------</td><td>----------</td><td>----------------</td></tr>";
$datadisplay_string .="</table>";

echo $datadisplay_string;
?>