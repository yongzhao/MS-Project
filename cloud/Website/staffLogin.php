<?php   

//check the workID and password of the staff

	$workname=$_REQUEST["worknumber"];
	$wpassword=$_REQUEST["wpassword"];
	
	$sqlservername = "localhost";
	$sqlusername = "root";
	$sqlpassword = "password";
	$sqldbname = "minigrid_db";

	
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	
	if (!$conn) {  
		die('Failed connection to Database!'.$mysql_error());  
	}  
	
	$dbworknumber=null;  
	$dbwpassword=null;


	$result=mysqli_query($conn,"select * from staff where StaffID = '{$workname}'");
	while ($row=mysqli_fetch_array($result)) {  
		$dbstaffid=$row["StaffID"];  
		$dbwpassword=$row["Password"];
	}  
	if (is_null($dbstaffid)) {
?>  
<script type="text/javascript">  
	alert("Wrong Worker ID");  
	window.location.href="index.html";  
</script>  
<?php   
	}  
	else {  
		if ($dbwpassword!=$wpassword){
?>  
<script type="text/javascript">  
	alert("Wrong Password!");  
	window.location.href="index.html";  
</script>  
<?php   
		}  
		else {  
?>  
<script type ="text/javascript">
	window.location.href = "StaffBackEnd.html";
</script>
<?php   
		}  
	}  
mysql_close($con); 
?>  