<?php session_start(); ?>
<?php
//links to the connection file
include '../../config/conn.php';
require_once '../../res/link.php';
require_once '../../res/add-ons.php';
include '../../res/function.php';
?>

<?php

$lowList='';
$fuelLevel="select * from fuel_stock where station_id='GC007' and (stock<10)";
$fuelLevelResult=mysqli_query($connection,$fuelLevel);
if(mysqli_num_rows($fuelLevelResult)>0){

    $alarm=$_SESSION['is_low'];


}else{
    $alarm=$_SESSION['is_low'];
}





?>
