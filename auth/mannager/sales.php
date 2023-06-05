<?php session_start(); ?>
<?php include_once '../../config/conn.php'; ?>
<?php include_once '../../res/add-ons.php'; ?>
<?php
if(!isset($_SESSION['user_id'])){
    header('Location: ../../login.php');
}
if($_SESSION['userType'] != 'MANAGER'){
    header('Location: ../../login.php');
}

?>

<?php


$user_id = $_SESSION['user_id'];

$sql="SELECT * FROM Fuel_station WHERE manager_id='{$user_id}'";
$result=mysqli_query($connection,$sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $station_id = $row['station_id'];




    $SalesRecodeList ='';
    $sql="SELECT * from invoice where station_id='{$station_id}' ORDER BY invoice_date DESC";
    $result=mysqli_query($connection,$sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $SalesRecodeList .= "<tr>";
            $SalesRecodeList .= "<td>{$row['invoice_id']}</td>";
            $SalesRecodeList .= "<td>{$row['pumper_id']}</td>";
            $SalesRecodeList .= "<td>{$row['fuel_id']}</td>";
            $SalesRecodeList .= "<td>{$row['quantity']}</td>";
            $SalesRecodeList .= "<td>{$row['total']}</td>";
            $SalesRecodeList .= "<td>{$row['invoice_date']}</td>";
            $SalesRecodeList .= "</tr>";
        }


    }

}else{
    die("Database query failed");
}





?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />



    <title>Fual Station Mannagement</title>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
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
    require_once('../mannager/res/sideNav_mannager.php');
    ?>

    <!-- END Sidenav -->

    <!-- Top nav -->
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <?php
            require_once('../mannager/res/TopNav.php');
            ?>

        </nav>
        <!-- End Navbar -->

        <!-- Main Content -->
        <main class="content">
            <div class="container-fluid p-0">
                <div class="row">

                    <div class="container-fluid p-0">

                        <h1 class="h3 mb-3">Pumpers</h1>

                        <div class="row">
                            <div class="col-md-3 col-xl-2">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Options</h5>
                                    </div>

                                    <div class="list-group list-group-flush" role="tablist">
                                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                           href="#account" role="tab" aria-selected="true">
                                            Sales recodes
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                           href="#password" role="tab" aria-selected="false" tabindex="-1">
                                            Generate sales report
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                           href="#" role="tab" aria-selected="false" tabindex="-1">
                                            Sales history
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-9 col-xl-10">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h5 class="card-title mb-0">Sales Recode</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#Invoice ID </th>
                                                        <th>Pumper ID</th>
                                                        <th>Fuel ID</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>invoice_date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $SalesRecodeList; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Generate sales report </h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="report.php"  method="post">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputLastName">Select Date</label>
                                                                <input type="datetime-local" class="form-control" name="start_date"  required>

                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputFirstName">
                                                                    Name</label>
                                                                <input type="datetime-local" class="form-control" name="end_date"  required>
                                                            </div>
                                                        </div>


                                                </div>

                                                <div class="d-grid gap-2 col-8 mx-auto">
                                                    <button class="btn btn-primary" name="btn-DateBetweenSales" type="submit" href="report.xlsx" download>Generate & Download</button>

                                                </div>

                                                <?php if (!empty($msg)) {
                                                    echo "<script>swal('Error!', '$msg', 'error');</script>";
                                                }elseif (!empty($msg1)){
                                                    echo "<script>swal('Success!', '$msg1', 'success');</script>";
                                                } ?>
                                                </form>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script>

</script>
</html>