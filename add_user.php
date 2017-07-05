<?php
$mac = $_GET['mac'];
$name = $_GET['name'];
$username =  $_GET['username'];
$time =  $_GET['time'];
$status =  $_GET['status'];
$download =  $_GET['download'];
//echo $mac, $name, $username, $time, $status 
include 'functions.php';
echo update_db($mac, $name, $username, $time, $status, $download);
?>
