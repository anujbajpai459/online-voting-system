<?php
$servername="localhost";
$username="root";
$password="";
$database="voting";
$port=3307;
$conn=mysqli_connect($servername,$username,$password,$database,$port);
if(!$conn){
  die("connection failed");
}
echo"connection was successfull with database";
?>