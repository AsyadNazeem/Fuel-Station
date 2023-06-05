<?php
//databse connection
$connection = mysqli_connect(
    'localhost',
    'root',
    '',
    'fuel_management'
);
//mysqli_connect_errno();
//mysqli_connect_error();
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
   //echo "connected";


   
}
