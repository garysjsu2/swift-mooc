<?php

$hostname = "localhost";
$username = "youthcyb_160s4g3";
$password = "Tailors$160";
$dbname = "youthcyb_cs160s4g3";


$conn = new mysqli($hostname, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
?>
