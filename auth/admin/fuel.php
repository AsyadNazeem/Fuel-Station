<?php session_start(); ?>
<?php
//links to the connection file
include '../../config/conn.php';
require_once '../../res/link.php';
require_once '../../res/add-ons.php';
include '../../res/function.php';
?>
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');

}

if ($_SESSION['userType'] != 'ADMIN') {
    header('Location: ../../login.php');
}


?>

<?php
$fuelPriceList = '';
$sql = "select fuel_type.fuel_type,fuel_price.price,fuel_price.update_time from fuel_type inner join fuel_price on fuel_type.fuel_id=fuel_price.fuel_id";
$fuelPrice = mysqli_query($connection, $sql);
if ($fuelPrice) {
    while ($row = mysqli_fetch_assoc($fuelPrice)) {

        $fuelPriceList .= "<tr>";
        $fuelPriceList .= "<td>" . $row['fuel_type'] . "</td>";
        $fuelPriceList .= "<td>" . "LKR " . $row['price'] . "</td>";
        $fuelPriceList .= "<td>" . $row['update_time'] . "</td>";
        $fuelPriceList .= "</tr>";

    }
}


?>

<?php

if (isset($_POST['btn-updatePrice'])) {

    $msg = '';
    $msg1 = '';
    $updatePrice = '';
    $fuelType = '';

    $fuelType = $_POST['fuelType'];
    $updatePrice = $_POST['updatePrice'];

    $sql1 = "update fuel_price as fp inner join fuel_type as ft on fp.fuel_id=ft.fuel_id set fp.price='{$updatePrice}',fp.update_time=now() where ft.fuel_type='{$fuelType}'";
    $updatePrice = mysqli_query($connection, $sql1);
    if ($updatePrice) {
        $msg1 = "Price Updated Successfully";
    } else {
        $msg = "Price Update Failed";
    }


}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>


    <title>Fual Station Mannagement</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <?php
    require_once('../../res/link.php');

    ?>

</head>

<body>
<div class="wrapper">
    <!-- Sidenav -->

    <?php
    require_once('../admin/res/sideNav_admin.php');
    ?>

    <!-- END Sidenav -->

    <!-- Top nav -->
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <?php
            require_once('../admin/res/TopNav.php');
            ?>

        </nav>
        <!-- End Navbar -->

        <!-- Main Content -->
        <main class="content">
            <div class="container-fluid p-0">

                <h1 class="h3 mb-3">Current Fuel Price</h1>

                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <table class="table table-success table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Fuel Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Last Update</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php echo $fuelPriceList; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Update Fuel Price</h5>
                            </div>
                            <form action="fuel.php" method="post">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="inputUsername">Fuel Type</label>

                                        <select class="form-select" aria-label="Default select example" name="fuelType"
                                                required>
                                            <option>92petrol</option>
                                            <option>95petrol</option>
                                            <option>diesel</option>
                                            <option>kerosene</option>
                                            <option>super-diesel</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="inputStock">Price</label>
                                        <input type="number" class="form-control"
                                               id="inputStock" placeholder="LKR" name="updatePrice" required>
                                    </div>
                                    <div class="mb-3">

                                        <input class="btn btn-primary" type="submit" name="btn-updatePrice"
                                               value="Update">
                                        <?php if (!empty($msg)) {
                                            echo "<script>swal('Error!', '$msg', 'error');</script>";
                                        } elseif (!empty($msg1)) {
                                            echo "<script>swal('Success!', '$msg1', 'success');</script>";
                                        } ?>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>


        </main>
        <!-- End Main Content -->

        <!-- Footer -->
        <footer class="footer"></footer>
        <!--End Footer -->
    </div>
</div>
</body>

</html>