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
if (!isset($_SESSION['invoice_id'])){
    header('Location: ../../login.php');
}

?>

<?php

$invoice_id=$_SESSION['invoice_id'];
//echo $invoice_id;
$getInvoiceDetails="select * from invoice where invoice_id='{$invoice_id}'";
$resultInvoiceDetails=mysqli_query($connection,$getInvoiceDetails);
if ($resultInvoiceDetails) {
    $rowInvoiceDetails = mysqli_fetch_assoc($resultInvoiceDetails);

    $sql="select * from fuel_type where fuel_id='{$rowInvoiceDetails['fuel_id']}'";
    $result=mysqli_query($connection,$sql);

    $row=mysqli_fetch_assoc($result);
    $fuel_type=$row['fuel_type'];

    $invoice_id = $rowInvoiceDetails['invoice_id'];
$invoice_date = $rowInvoiceDetails['invoice_date'];
$fuel_amount = $rowInvoiceDetails['quantity'];
$fuel_id = $rowInvoiceDetails['fuel_id'];
$invoice_total = $rowInvoiceDetails['total'];
$price = $rowInvoiceDetails['price'];






}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <title>Fual Station Mannagement</title>

    <?php
    require_once('../../res/link.php');

    ?>

</head>

<body>
<div class="wrapper">
    <!-- Sidenav -->



    <!-- END Sidenav -->

    <!-- Top nav -->
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">


        </nav>
        <!-- End Navbar -->

        <!-- Main Content -->
        <main class="content">

<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Invoice</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-sm-3 m-md-5">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-muted">Payment No.</div>
                            <strong><?php echo $invoice_id; ?></strong>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="text-muted">Payment Date</div>
                            <strong><?php echo $invoice_date ?></strong>
                        </div>
                    </div>

                    <hr class="my-4">



                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Description</th>

                            <th>Quantity</th>
                            <th class="text-end">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?PHP echo $fuel_type ?></td>
                            <td><?PHP echo $fuel_amount ?> Liters</td>
                            <td class="text-end">LKR <?PHP echo $invoice_total ?> .00</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end"></td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Subtotal </th>
                            <th class="text-end">LKR <?php  echo $invoice_total ?> .00</th>
                        </tr>

                        <tr>
                            <th>&nbsp;</th>
                            <th>Discount </th>
                            <th class="text-end">0%</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Total </th>
                            <th class="text-end">LKR <?php  echo $invoice_total ?> .00</th>
                        </tr>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <p class="text-sm">
                            <strong>Extra note:</strong>
                            Please send all items at the same time to the shipping address.
                            Thanks in advance.
                        </p>

                        <a href="#" class="btn btn-primary">
                            Print this receipt
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="./pumper.php" class="btn  btn-primary">
        Back
    </a>
</div>
        </main>
    </div>
</div>
</body>
</html>

