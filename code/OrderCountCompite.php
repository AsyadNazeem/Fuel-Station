<?php
include '../config/conn.php';
require_once '../res/link.php';
require_once '../res/add-ons.php';
include '../res/function.php';
?>

<?php

$sql="select * from fuel_order where order_status='COMPLETE'";
$result=mysqli_query($connection,$sql);

if($result){
    $count=mysqli_num_rows($result);

    


    echo $count;
}else{
    echo "0";
}
?>


