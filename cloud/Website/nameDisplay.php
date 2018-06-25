<?php

//show the name of customer and its supplier's name in customer.html

session_start();
$response = $_SESSION["LoginUser"];
echo $response;
?>