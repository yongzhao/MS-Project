<?php

//update the personal information of the customer to the database

session_start();
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";

$mobilephone = $_POST["phone"];
$password = $_POST["password"];
$name = $_POST["name"];
$batterycapacity = $_POST["batterycapacity"];
$ip = $_POST["ip"];
$companyname = $_POST["companyname"];


if($_POST["phone"] != null) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET Phone = '{$mobilephone}' WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
}
if($_POST["password"] != null) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET Password = '{$password}' WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
}
if($_POST["name"] != null) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET Name = '{$name}' WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
}
if($_POST["batterycapacity"] != null) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET IfModify = '1', BatteryCapacity = ".(float)$batterycapacity." WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
}
if($_POST["ip"] != null) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET IP = '{$ip}' WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
}
if($_POST["companyname"] != null) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET IfModify = '1', CompanyName = '{$companynam}' WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
}
header("Location: staffSetting.html");s
?>