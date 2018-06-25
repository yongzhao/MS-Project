<?php

//get all values of appliances in level 2 and make a table to show in Level2Detail.html

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";
$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
while ($row=mysqli_fetch_array($result)) { 
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
	}
mysqli_close($conn);

#make a table
$datadisplay_string = "<table border = 10>";

$datadisplay_string .="<tr><td>--------------------</td><td>-------------</td><td>-------------</td><td>----------</td><td>----------------</td></tr>";

$datadisplay_string .="<tr><td><strong>Appliances</strong></td><td></td><td><strong>Quantity</strong></td><td></td><td><strong>Power (W)</strong></td></tr>";


$datadisplay_string .="<tr><td>Bulb</td><td></td><td>$bulb_level2_N</td><td></td><td>$bulb_level2_P</td></tr>";
$datadisplay_string .="<tr><td>Air Conditioner</td><td></td><td>$airconditioner_level2_N</td><td></td><td>$airconditioner_level2_P</td></tr>";
$datadisplay_string .="<tr><td>Heater</td><td></td><td>$heater_level2_N</td><td></td><td>$heater_level2_P</td></tr>";
$datadisplay_string .="<tr><td>PC</td><td></td><td>$pc_level2_N</td><td></td><td>$pc_level2_P</td></tr>";
$datadisplay_string .="<tr><td>Others</td><td></td><td>N/A</td><td></td><td>$others_level2_P</td></tr>";
$datadisplay_string .="<tr><td>--------------------</td><td>-------------</td><td>-------------</td><td>----------</td><td>----------------</td></tr>";
$datadisplay_string .="</table>";

echo $datadisplay_string;
?>