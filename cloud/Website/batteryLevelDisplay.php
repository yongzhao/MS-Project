<?php

//get the value of the critical battery level and make a table to show in CurrentBattLvl.html

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";
$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
while ($row=mysqli_fetch_array($result)) {  
	$criticalBL = $row["CriticalBL"];
}
mysqli_close($conn);

#make a table
$datadisplay_string = "<table border = 10>";;
$datadisplay_string .="<tr><td><strong> Current Critical Battery Level (%):</strong></td><td>$criticalBL</td></tr>";

echo $datadisplay_string;
?>