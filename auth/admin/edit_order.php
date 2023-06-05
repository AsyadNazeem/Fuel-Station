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

if(!isset($_GET['order_id'])){
    header('Location: Orders.php?oder_not_selected');
}
$msg = '';
$msg1 = '';

$sql="select * from fuel_order where order_id={$_GET['order_id']}";
$result=mysqli_query($connection,$sql);
if(mysqli_num_rows($result)==1){
    while($row=mysqli_fetch_assoc($result)){
        $order_id=$row['order_id'];
        $station_id=$row['station_id'];
        $order_status=$row['order_status'];



    }
}




?>

<?php
if(isset($_POST['btn-update'])){

    $order_status='';

    $order_status=$_POST['status'];

    $sql="update fuel_order set order_status='{$order_status}' where order_id={$_GET['order_id']}";
    $result=mysqli_query($connection,$sql);
    if($result){
        $msg1="Order Updated Successfully";
    }else{
        $msg="Order Update Failed";
    }
}

?>


<?php
if(isset($_POST['btn-delete'])){

    $sql="delete from fuel_order where order_id={$_GET['order_id']}";
    $result=mysqli_query($connection,$sql);
    if($result){
        $msg1="Order Deleted Successfully";
        header('Location: Orders.php?order_deleted');
    }else{
        $msg="Order Delete Failed";
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Fuel Price  </h5>
                    </div>
                    <form action="edit_order.php?order_id=<?php echo $order_id; ?>" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label"
                                       for="inputStock">Order ID </label>
                                <input type="number" class="form-control"
                                       id="inputStock" placeholder="#" value="<?php echo $order_id; ?>" name="Order_id" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"
                                       for="inputStock">Station ID </label>
                                <input type="text" class="form-control"
                                       id="inputStock" placeholder="#" value="<?php echo $station_id;?>"  name="station_id" disabled>
                            </div>



                            <div class="mb-3">
                                <label class="form-label"
                                       for="inputUsername">Status </label>

                                <select class="form-select" aria-label="Default select example" selected="<?php echo $order_status; ?>" name="status"

                                        >
                                    <option value="COMPLETE" <?php if($order_status=='COMPLETE'){echo "COMPLETE";} ?>COMPLETE</option>
                                    <option value="PENDING">PENDING</option>
                                    <option value="COMPLETE">COMPLETE</option>
                                    <option value="READY">READY</option>
                                    <option value="APPROVED">APPROVED</option>
                                    <option value="REJECTED">REJECTED</option>
                                </select>
                            </div>

                            <div class="d-grid gap-4 d-md-block">
                                <button type="submit" class="btn btn-primary" name="btn-update" type="button">Update</button>
                                <button type="submit" class="btn btn-primary" name="btn-delete" type="button">Delete</button>
                                <?php if (!empty($msg)) {
                                    echo "<script>swal('Error!', '$msg', 'error');</script>";
                                } elseif (!empty($msg1)) {
                                    echo "<script>swal('Success!', '$msg1', 'success');</script>";
                                } ?>
                            </div>


                    </form>
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