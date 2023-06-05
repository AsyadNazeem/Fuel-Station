<?php session_start(); ?>

<?php
include '../config/conn.php';
require_once '../res/link.php';
require_once '../res/add-ons.php';
include '../res/function.php';
?>

<?php

$user_id = $_SESSION['user_id'];

$sql="SELECT * FROM Fuel_station WHERE manager_id='{$user_id}'";
$result=mysqli_query($connection,$sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $station_id = $row['station_id'];

    $sql="select sum(total)  from invoice where station_id='{$station_id}'";
    $result=mysqli_query($connection,$sql);
    if($result){
        $row=mysqli_fetch_assoc($result);
        $total=$row['sum(total)'];
        echo "LKR ".$total.".00";
    }else{
        die("Database query 1 failed");
    }





}else{
    die("Database query 2 failed");
}



?>


