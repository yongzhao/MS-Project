<?php 

//update the status of the battery switch in the database

session_start(); 
$houseid = $_SESSION["houseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";

if(isset($_POST['myonoffswitch'])) {
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	mysqli_query($conn,"UPDATE customer SET IfModify = '1', Bstatus = '1' WHERE HouseID = '{$houseid}'");
	mysqli_close($conn);
?>
<script type="text/javascript">
alert("ON");
window.location.href="Settings.html";
</script>
<?php
	} else { 
		$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
		mysqli_query($conn,"UPDATE customer SET IfModify = '1', Bstatus = '0' WHERE HouseID = '{$houseid}'");
		mysqli_close($conn);
?>
<script type="text/javascript">
alert("OFF");
window.location.href="Settings.html";
</script>
<?php

	}
?>
