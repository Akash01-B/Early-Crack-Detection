<?php
$servername = "localhost";

$dbname = "crack_detection";
$username = "root";
$password = "";
 

 $conn=mysqli_connect($servername,$username,$password,$dbname);

 if($conn) {
//  	echo "Connnected Successfully";
 } else {
// 	echo "not Connected";
 }

