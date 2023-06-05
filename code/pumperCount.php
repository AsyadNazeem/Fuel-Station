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

    $sql="select *  from pumper_station where station_id='{$station_id}'";
    $result=mysqli_query($connection,$sql);
    if($result){
        $count=mysqli_num_rows($result);
        echo $count;
    }else{
        die("Database query 1 failed");
    }





}else{
    die("Database query 2 failed");
}



?>


