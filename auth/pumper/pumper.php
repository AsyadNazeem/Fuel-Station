<?php session_start(); ?>
<?php
include '../../config/conn.php';
require_once '../../res/link.php';
require_once '../../res/add-ons.php';
include '../../res/function.php';
?>
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}
if ($_SESSION['userType'] != 'PUMPER') {
    header('Location: ../../login.php');
}

?>
<?php

$user_id = $_SESSION['user_id'];
$sql="SELECT * FROM pumper_station WHERE user_id='{$user_id}'";
$result=mysqli_query($connection,$sql);
if ($result){
    $row=mysqli_fetch_assoc($result);
    $station_id=$row['station_id'];

    $sql1="SELECT * FROM Fuel_station WHERE station_id='{$station_id}'";
    $result1=mysqli_query($connection,$sql1);
    if ($result1){
        $row1=mysqli_fetch_assoc($result1);
        $station_name=$row1['station_name'];
        $station_zip=$row1['station_zip'];

    }
}else{
    die("Database query failed");
}

?>


<?php
if (isset($_POST['btn-billCal'])){
//assign the empty string to the variable
    $fuelAmount = 0;
    $fuelPrice = 0;
    $fuel_total = 0;
    $fuel_id='';
    $fuelTotal = 0;
    $invoice_id=0;
    $fuelAmount = $_POST['fuelAmount'];
    $fuelType = $_POST['fuelType'];

    $selectFuelId="select fuel_type.fuel_type,fuel_type.fuel_id,fuel_price.price,fuel_price.update_time from fuel_type inner join fuel_price on fuel_type.fuel_id=fuel_price.fuel_id where fuel_type.fuel_type='{$fuelType}'";
    $resultFuelId=mysqli_query($connection,$selectFuelId);
if ($resultFuelId){
        $rowFuelId=mysqli_fetch_assoc($resultFuelId);
        $fuelPrice=$rowFuelId['price'];
        $fuel_id=$rowFuelId['fuel_id'];


       $generateInvoice="insert into invoice(station_id,pumper_id, fuel_id, price, quantity, total, invoice_date)
VALUES ('{$station_id}',$user_id,'{$fuel_id}','{$fuelPrice}','{$fuelAmount}',price*quantity,now())";
        $resultInvoice=mysqli_query($connection,$generateInvoice);

        $InvoiceId="select invoice_id from invoice where invoice_date=now()";
        $resultInvoiceId=mysqli_query($connection,$InvoiceId);

        if ($resultInvoiceId){
            $rowInvoiceId=mysqli_fetch_assoc($resultInvoiceId);
            $invoice_id=$rowInvoiceId['invoice_id'];
            echo $invoice_id;
            $_SESSION['invoice_id']=$invoice_id;

        }

        $updateStock="update fuel_stock as fs inner join fuel_type as ft on fs.fuel_id=ft.fuel_id set fs.stock=fs.stock-$fuelAmount,fs.update_time=now() where ft.fuel_type='{$fuelType}' and fs.station_id='{$station_id}'";
        $resultUpdate=mysqli_query($connection,$updateStock);

        if ($invoice_id!=0){
            header("Location: invoice.php");
        }else{
            echo "Invoice not generated";
        }



      //  $resultInvoice=mysqli_query($connection,$generateInvoice);




    }else{
        die("Database query failed");
    }












}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Bootstrap demo</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" rel="stylesheet">
    <link href="../../css/pumper.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="/search-filter.css" rel="stylesheet">
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

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
                <a class="nav-link active" aria-current="page" href="../../logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="fuel-station-heading">
    <h1 class="fuel-station-name"><?php echo$station_name; ?> </h1>
    <h4 class="address"> <?php echo$station_zip; ?> </h4>
</div>

<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-8">
            <div class="card-body">
                <form action="pumper.php" method="Post">
                    <div class="clsss1">
                        <label>Fuel Amount - </label>
                        <label for="Fuel-amount"></label><input class="liters" id="Fuel-amount" placeholder="Liters" type="number" name="fuelAmount" required>
                    </div>

                    <div class="box2">
                        <label class="Fuel-Price ">Price - </label>
                        <label for="Fuel-pricet"></label><input class="price" id="Fuel-pricet" placeholder="Rs" type="number" name="fuelPrice" DISABLED>
                    </div>


                    <div class = "fuel_type">
                        <label class="type"> Select the fuel type  </label>
                        <br>
                        <div class ="drop">
                            <select class="form-select" name="fuelType" aria-label="Default select example">
                                <option >92petrol</option>
                                <option>95petrol</option>
                                <option >diesel</option>
                                <option >kerosene</option>
                                <option>super-diesel</option>
                            </select>
                        </div>
                        <br>

                        <!--                        <div class = type>-->

                        <!--                        <button id="Petrol 92">PETROL 92</button>-->
                        <!--                        <button id="Petrol 95">PETROL 95</button>-->
                        <!--                        <button id="Diesel">DIESEL</button>-->
                        <!--                        <button id="Super Diesel">SUPER DIESEL</button>-->
                        <!--                        <button id="Kerosene">KEROSENE</button>-->

                        <!--                        </div>-->
                    </div>



                    <div class = "submit">

                        <button id="submit1" name="btn-billCal"> Calculate Bill</button>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<script>

    const btn = document.getElementById('Petrol 92');

    btn.addEventListener('click', function onClick() {
        btn.style.backgroundColor = 'salmon';
        btn.style.color = 'white';

    });

    const btn1 = document.getElementById('Petrol 95');

    btn1.addEventListener('click', function onClick() {
        btn1.style.backgroundColor = 'salmon';
        btn1.style.color = 'white';
    });

    const btn3 = document.getElementById('Diesel');

    btn3.addEventListener('click', function onClick() {
        btn3.style.backgroundColor = 'salmon';
        btn3.style.color = 'white';
    });

    const btn4 = document.getElementById('Super Diesel');

    btn4.addEventListener('click', function onClick() {
        btn4.style.backgroundColor = 'salmon';
        btn4.style.color = 'white';
    });

    const btn5 = document.getElementById('Kerosene');

    btn5.addEventListener('click', function onClick() {
        btn5.style.backgroundColor = 'salmon';
        btn5.style.color = 'white';
    });

</script>

</body>
</html>