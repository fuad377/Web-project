<?php
require "rb-mysql.php";
R::setup( 'mysql:host=127.0.0.1;dbname=ems', 'root', '' );;

$con=mysqli_connect("127.0.0.1", "root", "", "ems");

if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

