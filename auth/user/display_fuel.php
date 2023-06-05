<?php session_start(); ?>
<?php
//links to the connection file
include '../../config/conn.php';
require_once '../../res/link.php';
require_once '../../res/add-ons.php';
include '../../res/function.php';
?>

<?php
if (!isset($_SESSION['station_id'])) {
    header('Location: ../../index.php');
}


?>


<?php

$station_id = $_SESSION['station_id'];
$station_name= $_SESSION['station_name'];
$stock92petrol = "select * from fuel_stock where station_id='{$station_id}' and fuel_id=1";
$stock95petrol = "select * from fuel_stock where station_id='{$station_id}' and fuel_id=2";
$stockDiesel = "select * from fuel_stock where station_id='{$station_id}' and fuel_id=3";
$stockKerosene = "select * from fuel_stock where station_id='{$station_id}' and fuel_id=4";
$stockSuperDiesel = "select * from fuel_stock where station_id='{$station_id}' and fuel_id=5";
$stock_result92petrol = mysqli_query($connection, $stock92petrol);
$stock_result95petrol = mysqli_query($connection, $stock95petrol);
$stock_resultDiesel = mysqli_query($connection, $stockDiesel);
$stock_resultKerosene = mysqli_query($connection, $stockKerosene);
$stock_resultSuperDiesel = mysqli_query($connection, $stockSuperDiesel);

$data = mysqli_fetch_assoc($stock_result92petrol);
$data2 = mysqli_fetch_assoc($stock_result95petrol);
$data3 = mysqli_fetch_assoc($stock_resultDiesel);
$data4 = mysqli_fetch_assoc($stock_resultKerosene);
$data5 = mysqli_fetch_assoc($stock_resultSuperDiesel);


$stock92petrolLiters = ($data['stock']);
$stock95petrolLiters = ($data2['stock']);
$stockDieselLiters = ($data3['stock']);
$stockKeroseneLiters = ($data4['stock']);
$stockSuperDieselLiters = ($data5['stock']);


$stock92petrol = ($data['stock']*100)/10000;
$stock95petrol = ($data2['stock']*100)/10000;
$stockDiesel = ($data3['stock']*100)/10000;
$stockKerosene = ($data4['stock']*100)/10000;
$stockSuperDiesel = ($data5['stock']*100)/10000;


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="../../css/style.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Fuel Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
            </div>
        </div>
    </div>
</nav>


<h1 class="fuel-station-name"> <?php echo $station_name;?> </h1>
<h6 class="address"> </h6>


<div class="tot">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="../../img/images/Layer%201.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">PETROL 92</h5>
                    <div class="progress">

                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Segment three"
                             style="width:<?php echo $stock92petrol; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="card-text">Stock Available <br><?php echo $stock92petrolLiters. " "; ?>Liters</p>

                    <p class="card-text"> Rs. 450.00</p>
                    <img src="../../img/images/car.png" class="img-fluid1 rounded-start" alt="...">
                    <img src="../../img/images/ricksaw.png" class="img-fluid1 rounded-start" alt="...">
                    <img src="../../img/images/motorbike.png" class="img-fluid1 rounded-start" alt="...">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="../../img/images/Layer 1.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">PETROL 95</h5>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" aria-label="Segment three"
                             style="width:<?php echo $stock95petrol; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <p class="card-text">Stock Available<br><?php echo $stock95petrolLiters. " "; ?>Liters</p>
                <p class="card-text"> Rs. 540.00</p>
                <img src="../../img/images/car.png" class="img-fluid1 rounded-start" alt="...">
                <img src="../../img/images/ricksaw.png" class="img-fluid1 rounded-start" alt="...">
                <img src="../../img/images/motorbike.png" class="img-fluid1 rounded-start" alt="...">

            </div>
        </div>
    </div>
</div>

<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="../../img/images/Layer%201.png" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">DIESEL</h5>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" aria-label="Segment three"
                         style="width:<?php echo $stockDiesel; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <p class="card-text">Stock Available <br> <?php echo $stockDieselLiters. " "; ?>Liters</p>
            <p class="card-text"> Rs. 430.00</p>
            <img src="../../img/images/lorry.png" class="img-fluid1 rounded-start" alt="...">
            <img src="../../img/images/van.png" class="img-fluid1 rounded-start" alt="...">
        </div>
    </div>
</div>
</div>

<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="../../img/images/Layer 1.png" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">SUPER DIESEL</h5>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" aria-label="Segment three"
                         style="width:<?php echo $stockSuperDiesel  ; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <p class="card-text">Stock Available <br><?php echo $stockSuperDieselLiters. " "; ?> Liters</p>
            <p class="card-text"> Rs. 510.00</p>
            <img src="../../img/images/lorry.png" class="img-fluid1 rounded-start" alt="...">
            <img src="../../img/images/van.png" class="img-fluid1 rounded-start" alt="...">
        </div>
    </div>
</div>
</div>
<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="../../img/images/Layer 1.png" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">KEROSENE</h5>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" aria-label="Segment three"
                         style="width:<?php echo $stockKerosene; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <p class="card-text">Stock Available <br> <?php echo $stockKeroseneLiters. " "; ?>Liters</p>
            <p class="card-text1"> Rs. 340.00</p>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>

<script src="js/front.js"></script>

</body>
</html>