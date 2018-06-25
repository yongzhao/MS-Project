<?php

//update the value of the critical battery level in the database

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";

$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
if ((float)$_COOKIE['batterylevel'] <= 100 && (float)$_COOKIE['batterylevel'] >= 0){
	mysqli_query($conn,"UPDATE customer SET IfModify = '1', CriticalBL = ".(float)$_COOKIE['batterylevel']." WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
	header ("Location: Settings.html");
}else{
	setcookie('batterylevel','');#reset the cookie of critical battery level
	$result=mysqli_query($conn,"select * from customer where HouseID = '{$houseid}'");
	while ($row=mysqli_fetch_array($result)) {
		setcookie('batterylevel',$row["CriticalBL"],time()+7200,'/');
	}
	mysqli_close($conn);
?>
<script type="text/javascript">
alert("The entered critical battery level should be in the range [0,100]!");
window.location.href="CurrentBattLvl.html";
</script>
<?php
}
?>