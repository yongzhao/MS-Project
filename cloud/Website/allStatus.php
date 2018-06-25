<?php   

//get the status of the master switch

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";
$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
while ($row=mysqli_fetch_array($result)) { 
	//master switch status
	$all_switch = $row["Alls"]; 
}
	echo (int)$all_switch;
?>