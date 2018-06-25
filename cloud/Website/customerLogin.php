<?php   

//check the phone number and the password of the customer
//if the customer exists and the password is correct, create corresponding Session variables which could be called in all files in the back-end

	$mobilenumber=$_POST["mobilenumber"];
	$password=$_POST["password"];
	
	$sqlservername = "localhost";
	$sqlusername = "root";
	$sqlpassword = "password";
	$sqldbname = "minigrid_db";

	
	$conn = new mysqli($sqlservername, $sqlusername, $sqlpassword, $sqldbname);
	
	if (!$conn) {  
		die('Failed connection to Database!'.$mysql_error());  
	}  
	
	$dbusername=null;  
	$dbpassword=null;
	$dbhouseid=null;  
	$result=mysqli_query($conn,"select * from customer where Phone = '{$mobilenumber}'");
	while ($row=mysqli_fetch_array($result)) {  
		$dbmobilenumber=$row["Phone"];  
		$dbpassword=$row["Password"];
		$dbhouseid=$row["HouseID"]; 
		$dbname=$row["Name"];
		$dbcompanyname=$row["CompanyName"];
		$dbopendate = $row["OpenDate"];
	}  
	if (is_null($dbmobilenumber)) {
?>  
<script type="text/javascript">  
	alert("User does not exist!");  
	window.location.href="index.html#page1";  
</script>  
<?php   
	}  
	else {  
		if ($dbpassword!=$password){
?>  
<script type="text/javascript">  
	alert("Wrong Password!");  
	window.location.href="index.html#page1";  
</script>  
<?php   
		}  
		else {
			session_start();   
			$_SESSION["code"]=mt_rand(0, 100000);
			$_SESSION["houseid"]=$dbhouseid;
			$_SESSION["openDate"]=$dbopendate;
			$_SESSION["LoginUser"]=$dbname."——From 【".$dbcompanyname."】";
			?> 
			<script type="text/javascript">  
				window.location.href="verify.php";  
			</script>  
<?php   
		}  
	}  
mysqli_close($conn); 
?>  