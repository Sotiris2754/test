<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "v-corfu";


$conn = new mysqli($servername,$username,$password,$database);

if(!$conn){
	echo "Connection Failed";
}

 ?>