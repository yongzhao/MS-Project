<?php

//show the total number of customers in the system in staffRegister.html

$sqlservername = "localhost";
$sqlusername = "root";
$sqlpassword = "password";
$sqldbname = "minigrid_db";


$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);

if (!$conn) {  
	die('Failed connection to Database!'.$mysql_error());  
}  

$result=mysqli_query($conn,"select count(*) from customer");
while ($row=mysqli_fetch_array($result)) {  
		$cusNum=$row["count(*)"];  

}  
echo $cusNum;
mysqli_close($conn); 
?>