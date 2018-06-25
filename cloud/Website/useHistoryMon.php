<?php

//show the customer history usage by month

session_start();
$id=$_SESSION['houseid'];
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "minigrid_db";
$startMon = $_POST['startMon'];
$endMon = $_POST['endMon'];

$syear = (int)substr($startMon,0,4);
$smon = (int)substr($startMon,5,7);

$eyear = (int)substr($endMon,0,4);
$emon = (int)substr($endMon,5,7);

$oyear = (int)substr($_SESSION["openDate"], 0,4);
$omon = (int)substr($_SESSION["openDate"],5,7);
//echo $syear.$smon.$eyear.$emon.$oyear.$omon.$_SESSION["openDate"];
$month_data_display = "<table border = 1 width = 30%>";
$month_data_display.= "<tr><td>Year</td><td>Month</td><td>Buy-in Electricity(kWh)</td><td>Sell-out Electricity(kWh)</td><td>Electricity Fee(AUD)</td><td>Saved Money(AUD)</td></tr>";

if (($syear > $eyear) || ($syear == $eyear && $emon < $smon)){
?>
	<script>
	alert("please enter end month after the start month");
	window.history.back(-1);
	</script>
<?php
} elseif (($syear < $oyear) || ($syear == $oyear && $smon < $omon)) {
?>

	<script>
	alert("please enter start month after the open date");
	window.history.back(-1);
	</script>
<?php
} elseif ($eyear == (int)date('Y') && $emon >= (int)date('m')) {
?>
	<script>
	alert("please enter end month after this month");
	window.history.back(-1);
	</script>
<?php
} elseif ($eyear == $syear) {
	//echo "this year";
	$contmon = $smon;
	while ($contmon <= $emon) {
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "SELECT * FROM monthlyusage WHERE HouseID = $id and Year = $syear and Month = $contmon";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$year = $row["Year"];
		$month = $row["Month"];
		$usage = $row["UsagePerMonth"];
		$sell = $row["SelloutPerMonth"];
		$fee = $row["FeePerMonth"];
		$saved = $row["SavedMoney"];
		$month_data_display.= "<tr><td>$year</td><td>$month</td><td>$usage</td><td>$sell</td><td>$fee</td><td>$saved</td></tr>";
		$contmon = $contmon +1;
		mysqli_close($conn); 
	}
	$month_data_display.= "</table>";
	echo $month_data_display;
} else {
	$contmon = $smon;
	while ($contmon <= 12) {
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "SELECT * FROM monthlyusage WHERE HouseID = $id and Year = $syear and Month = $contmon";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$year = $row["Year"];
		$month = $row["Month"];
		$usage = $row["UsagePerMonth"];
		$sell = $row["SelloutPerMonth"];
		$fee = $row["FeePerMonth"];
		$saved = $row["SavedMoney"];
		$month_data_display.= "<tr><td>$year</td><td>$month</td><td>$usage</td><td>$sell</td><td>$fee</td><td>$saved</td></tr>";
		$contmon = $contmon + 1;
		mysqli_close($conn); 
	}

	if (($eyear - $syear) > 1){
		$contyear = $syear + 1;
		while ($contyear < $eyear){
			$contmon = 1;
			while ($contmon <= 12) {
			$conn = new mysqli($servername, $username, $password, $dbname);
			$sql = "SELECT * FROM monthlyusage WHERE HouseID = $id and Year = $contyear and Month = $contmon";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$year = $row["Year"];
			$month = $row["Month"];
			$usage = $row["UsagePerMonth"];
			$sell = $row["SelloutPerMonth"];
			$fee = $row["FeePerMonth"];
			$saved = $row["SavedMoney"];
			$month_data_display.= "<tr><td>$year</td><td>$month</td><td>$usage</td><td>$sell</td><td>$fee</td><td>$saved</td></tr>";
			$contmon = $contmon + 1;
			mysqli_close($conn); 
			}	

		$contyear = $contyear + 1;
		}
	}

	$contmon = 1;
	while ($contmon <= $emon) {
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "SELECT * FROM monthlyusage WHERE HouseID = $id and Year = $eyear and Month = $contmon";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$year = $row["Year"];
		$month = $row["Month"];
		$usage = $row["UsagePerMonth"];
		$sell = $row["SelloutPerMonth"];
		$fee = $row["FeePerMonth"];
		$saved = $row["SavedMoney"];
		$month_data_display.= "<tr><td>$year</td><td>$month</td><td>$usage</td><td>$sell</td><td>$fee</td><td>$saved</td></tr>";
		$contmon = $contmon + 1;
		mysqli_close($conn); 
	}
	$month_data_display.= "</table>";
	echo $month_data_display;
}

?>

<a href = "Usage.html">BACK</a>


