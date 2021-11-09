<?php
$con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","Website");
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>