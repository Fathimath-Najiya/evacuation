<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName ="evacuation";
$conn = mysqli_connect("$hostName","$dbUser","$dbPassword","$dbName");
if(!$conn){
    die("something went wrong");
}
?>