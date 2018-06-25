<?php

//update the rated power and number of appliances in level 1 in the database
//if entered number does not satisfies the requirement, reset all cookies which are related to appliances in level 1 

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";

$new_total_level1power = (float)$_COOKIE['refrip'] * (int)$_COOKIE['refriq'] + (float)$_COOKIE['bulbp'] * (int)$_COOKIE['bulbq'] + (float)$_COOKIE['phonep'] * (int)$_COOKIE['phoneq'] + (float)$_COOKIE['mdp'] * (int)$_COOKIE['mdq'] + (float)$_COOKIE['otherp'];
$new_total_level1power_kw = $new_total_level1power  / 1000;

$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
while ($row=mysqli_fetch_array($result)) {  
	$batterycapacity = (float)$row["BatteryCapacity"];
}
if (($new_total_level1power_kw * 24) <= $batterycapacity){
	mysqli_query($conn,"UPDATE customer SET IfModify = '1', PrimaryLoad = ".$new_total_level1power_kw.", Lv1rifq = ".(int)$_COOKIE['refriq'].", Lv1rifp = ".(float)$_COOKIE['refrip'].", Lv1bulbq = ".(int)$_COOKIE['bulbq'].", Lv1bulbp = ".(float)$_COOKIE['bulbp'].", Lv1phoneq = ".(int)$_COOKIE['phoneq'].", Lv1phonep = ".(float)$_COOKIE['phonep'].", Lv1mdq = ".(int)$_COOKIE['mdq'].", Lv1mdp = ".(float)$_COOKIE['mdp'].", Lv1otherp = ".(float)$_COOKIE['otherp']." WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
	header ("Location: Settings.html");
}else{
	setcookie('refriq','');
	setcookie('refrip','');
	setcookie('bulbq','');
	setcookie('bulbp','');
	setcookie('phoneq','');
	setcookie('phonep','');
	setcookie('mdq','');
	setcookie('mdp','');
	setcookie('otherp','');
	$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
	while ($row=mysqli_fetch_array($result)) {
	//cookie for lv1
		setcookie('refriq',$row["Lv1rifq"],time()+7200,'/');
		setcookie('refrip',$row["Lv1rifp"],time()+7200,'/');
		setcookie('bulbq',$row["Lv1bulbq"],time()+7200,'/');
		setcookie('bulbp',$row["Lv1bulbp"],time()+7200,'/');
		setcookie('phoneq',$row["Lv1phoneq"],time()+7200,'/');
		setcookie('phonep',$row["Lv1phonep"],time()+7200,'/');
		setcookie('mdq',$row["Lv1mdq"],time()+7200,'/');
		setcookie('mdp',$row["Lv1mdp"],time()+7200,'/');
		setcookie('otherp',$row["Lv1otherp"],time()+7200,'/');
	}
	mysqli_close($conn);
?>
<script type="text/javascript">
alert("The entered total power of Level1 is too large. Please reduce the power.");
window.location.href="Level1Detail.html";
</script>
<?php
}
?>
