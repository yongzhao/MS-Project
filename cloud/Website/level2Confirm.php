<?php

//update the rated power and number of appliances in level 2 in the database

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";
$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
mysqli_query($conn,"UPDATE customer SET IfModify = '1', Lv2bulbq = ".(int)$_COOKIE['bulb2q'].", Lv2bulbp = ".(float)$_COOKIE['bulb2p'].", Lv2acq = ".(int)$_COOKIE['aircq'].", Lv2acp = ".(float)$_COOKIE['aircp'].", Lv2heaterq = ".(int)$_COOKIE['heaterq'].", Lv2heaterp = ".(float)$_COOKIE['heaterp'].", Lv2pcq = ".(int)$_COOKIE['pcq'].", Lv2pcp = ".(float)$_COOKIE['pcp'].", Lv2otherp = ".(float)$_COOKIE['other2p']." WHERE HouseID = '{$houseid}'");
mysqli_close($conn);
header ("Location: Settings.html");
?>