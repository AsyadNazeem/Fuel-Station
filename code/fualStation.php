<?php session_start(); ?>
<?php
include '../config/conn.php';
require_once '../res/link.php';
require_once '../res/add-ons.php';


?>

<?php

if (isset($_GET['btn-search'])){

    $station_name = $_GET['stationName'];
    $sql = "SELECT * FROM fuel_station WHERE station_name LIKE '%$station_name%'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $station_id = $row['station_id'];
        $station_name = $row['station_name'];
        $_SESSION['station_id'] = $station_id;
        $_SESSION['station_name'] = $station_name;

        if(isset($_SESSION['station_id'])){



            header("Location: ../auth/user/display_fuel.php?station_id=$station_id");














        }





    } else{
       header("Location: ../index.php?search=notfound");
    }

}

?>
