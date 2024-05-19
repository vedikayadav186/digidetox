<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "e-waste";
$conn = mysqli_connect($hostname,$dbUser,$dbPassword,$dbName);
if(!$conn){
    die("something went wrong;");
}
?>