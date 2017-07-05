<?php
//This file get data from url to send database.
// Setting variable with datas from url
$mac = $_GET['mac'];
$name = $_GET['name'];
$username =  $_GET['username'];
$time =  $_GET['time'];
$status =  $_GET['status'];
$download =  $_GET['download'];
// include file (functions.php) which has all functions created to manipulate data from database for this system 
include 'functions.php';
//Calling function update_db which will update database.
echo update_db($mac, $name, $username, $time, $status, $download);
?>
