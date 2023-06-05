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
$fuelOrderList='';
$orders="SELECT * FROM fuel_order";
$result=mysqli_query($connection,$orders);
if ($result) {
    while ($row=mysqli_fetch_assoc($result)) {
        $fuelOrderList.= "<tr>";
        $fuelOrderList.= "<td>".$row['order_id']."</td>";
        $fuelOrderList.= "<td>".$row['station_id']."</td>";
        $fuelOrderList.= "<td>".$row['fuel_id']."</td>";
        $fuelOrderList.= "<td>".$row['order_qty']."</td>";
        $fuelOrderList.= "<td>".$row['order_time']."</td>";
        $fuelOrderList.= "<td>".$row['order_status']."</td>";
        $fuelOrderList.="<td><a href='edit_order.php?order_id={$row['order_id']}' class='btn btn-primary btn-sm'>Select</a></td>";
        $fuelOrderList.= "</tr>";
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

                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Fuel Orders</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Fuel Station ID</th>
                                    <th>Fuel ID</th>
                                    <th>Quantity</th>
                                    <th>date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php echo $fuelOrderList; ?>
                                </tbody>
                            </table>
                        </div>
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