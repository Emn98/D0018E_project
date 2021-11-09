<?php

$host = "localhost";
$username = "phpmyadmin";
$password = "Offbrand123$";
$database = "Website";

global $conn;
$conn; = new mysqli($host,$username,$password, $database);

// error check for connection
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

?>