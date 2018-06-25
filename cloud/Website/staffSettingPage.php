<?php
$changehouseid = $_POST["changehouseid"];

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";

$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);

if (!$conn) {  
	die('Failed connection to Database!'.$mysql_error());  
}  

$result=mysqli_query($conn,"select * from customer where HouseID = '{$changehouseid}'");
$row=mysqli_fetch_array($result);

if (is_null($row["HouseID"])) {
	mysqli_close($conn); 
?>
<script type="text/javascript">  
	alert("User does not exist!");  
	window.location.href="StaffBackEnd.html";  
</script>  
<?php
}
else{
	session_start();  
	$_SESSION["houseidforstaff"]=$row["HouseID"]; 
	$_SESSION["houseid"]=$row["HouseID"];
	$_SESSION["LoginUser"]=$row["Name"]."——From 【".$row["CompanyName"]."】";
	mysqli_close($conn); 
?> 
<script type="text/javascript">  
	window.location.href="staffSetting.html";  
</script>  
<?php   
}
?>