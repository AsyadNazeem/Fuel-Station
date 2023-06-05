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
$station_id='';
$userId = $_SESSION['user_id'];

$StationId = "select station_id from fuel_station where manager_id = '{$userId}'";
$StationIdResult = mysqli_query($connection, $StationId);
if ($StationIdResult) {
    while ($row = mysqli_fetch_assoc($StationIdResult)) {
        $station_id = $row['station_id'];
        //echo $station_id;

        $OrderList='';

        $sql = "SELECT * FROM fuel_order WHERE station_id ='{$station_id}' ORDER BY order_id DESC";
        $ListOfOrders = mysqli_query($connection, $sql);
        if(mysqli_num_rows($ListOfOrders) > 0){
            while ($row = mysqli_fetch_assoc($ListOfOrders)){
                $OrderList.="<tr>";
                $OrderList.="<td>{$row['order_id']}</td>";
                $OrderList.="<td>{$row['fuel_id']}</td>";
                $OrderList.="<td>{$row['order_qty']}</td>";
                $OrderList.="<td>{$row['order_status']}</td>";
                $OrderList.="<td>{$row['order_time']}</td>";
                $OrderList .= "<td><a href='edit.php?user_id=" . $row['order_id'] . "' class='btn btn-primary btn-sm'>Select</a></td>";
                $OrderList.="</tr>";
            }
        }



    }
}else {
     $warning = "No data found";
     echo "<script type='text/javascript'>alert('$warning');</script>";
     header('Location: ../../auth/mannager/manager_dashboard.php?error=F404&NoFuelStationFoundPleaseContactAdmin');
}













?>




<?php
// add button click event
if (isset($_POST['btn-fuelOrderAdd'])) {
    //assigning empty values to variables.
    $msg1='';
    $msg='';
    $fuel_id = '';
    $order_qty = '';
    $order_status = '';
    $order_time = '';
    //assigning post values to variables.

    $fuel_id = $_POST['fuel_type'];
    $order_qty = $_POST['order_qty'];
   // $order_status = $_POST['order_status'];
   // echo $station_id;
   // echo "<br>";
   // echo $fuel_id;
   // echo "<br>";
  //  echo $order_qty;

    //inserting data into database.
    $sql = "insert into fuel_order (station_id, fuel_id, order_qty,order_status, order_time) VALUES ('{$station_id}',$fuel_id, $order_qty,'PENDING', now())";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $msg1 = "Fuel Order Added Successfully";
       // echo "<script type='text/javascript'>alert('$success');</script>";
       // header('Location: fuelOrder.php?success=F200');
    } else {
        $msg1 = "Fuel Order Adding Failed";
       // echo "<script type='text/javascript'>alert('$warning');</script>";
       // header('Location: fuelOrder.php?error=F404');
    }


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

                      <h1 class="h3 mb-3">Settings</h1>

                      <div class="row">
                          <div class="col-md-3 col-xl-2">

                              <div class="card">
                                  <div class="card-header">
                                      <h5 class="card-title mb-0">Fuel Order</h5>
                                  </div>

                                  <div class="list-group list-group-flush" role="tablist">

                                      <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                         href="#account" role="tab" aria-selected="true">
                                          Place Order
                                      </a>
                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#stock"
                                         role="tab" aria-selected="false" tabindex="-1">
                                          Order History
                                      </a>

                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                         role="tab" aria-selected="false" tabindex="-1">
                                            Order Status
                                      </a>
                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                         role="tab" aria-selected="false" tabindex="-1">
                                          Massage notifications
                                      </a>

                                      <!-- <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                          role="tab" aria-selected="false" tabindex="-1">
                                           Your data
                                       </a>-->
                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                         role="tab" aria-selected="false" tabindex="-1">
                                          Delete Station
                                      </a>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-9 col-xl-10">
                              <div class="tab-content">
                                  <div class="tab-pane fade show active" id="account" role="tabpanel">

                                      <div class="card">
                                          <div class="card-header">

                                              <h5 class="card-title mb-0">Public info</h5>
                                          </div>
                                          <div class="card-body">
                                              <form action="fuelOrder.php" method="post">
                                                  <div class="row">
                                                      <div class="col-md-8">
                                                          <div class="mb-3">
                                                              <h1>
                                                                  <small class="text-muted">Place Order
                                                                  </small>
                                                              </h1>
                                                          </div>
                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputUsername">Fuel Type</label>

                                                              <select class="form-select" aria-label="Default select example" name="fuel_type" required>
                                                                  <option value="1">92petrol</option>
                                                                  <option value="2">95petrol</option>
                                                                  <option value="3" >diesel</option>
                                                                  <option value="4">kerosene</option>
                                                                  <option value="5">super-diesel</option>
                                                              </select>
                                                          </div>

                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputStock">Enter Stock</label>
                                                              <input type="number" class="form-control"
                                                                     id="inputStock" placeholder="L" name="order_qty" required>
                                                          </div>
                                                          <div class="mb-3">

                                                              <input class="btn btn-primary" type="submit" name="btn-fuelOrderAdd" value="ADD">
                                                              <?php if (!empty($msg)) {
                                                                  echo "<script>swal('Error!', '$msg', 'error');</script>";
                                                              }elseif (!empty($msg1)){
                                                                  echo "<script>swal('Success!', '$msg1', 'success');</script>";
                                                              } ?>
                                                          </div>

                                                      </div>
                                                      <div class="col-md-4">
                                                          <div class="text-center">
                                                              <img alt="Charles Hall" src="../../img/logo/ceypetco.png"
                                                                   class="rounded-circle img-responsive mt-2"
                                                                   width="128" height="128">
                                                              <div class="mt-2">
                                                                  <p class="h1"> <B>CEYPETCO</B></p>
                                                              </div>

                                                          </div>
                                                      </div>
                                                  </div>




                                              </form>

                                          </div>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade show " id="stock" role="tabpanel">

                                      <div class="card">
                                          <div class="card-header pb-0">
                                              <h5 class="card-title mb-0">Filling station</h5>
                                          </div>
                                          <div class="card-body">
                                              <table class="table table-striped" style="width:100%">
                                                  <thead>
                                                  <tr>
                                                      <th>#Order ID</th>
                                                      <th>Fuel Type</th>
                                                      <th>Amount</th>
                                                      <th>Status</th>
                                                      <th>Date</th>
                                                      <th>Action</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                  <?php echo $OrderList ?>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="password" role="tabpanel">
                                      <div class="card">
                                          <div class="card-body">
                                              <h5 class="card-title">Password</h5>

                                              <form>
                                                  <div class="mb-3">
                                                      <label class="form-label" for="inputPasswordCurrent">Current
                                                          password</label>
                                                      <input type="password" class="form-control"
                                                             id="inputPasswordCurrent">
                                                      <small><a href="#">Forgot your password?</a></small>
                                                  </div>
                                                  <div class="mb-3">
                                                      <label class="form-label" for="inputPasswordNew">New
                                                          password</label>
                                                      <input type="password" class="form-control"
                                                             id="inputPasswordNew">
                                                  </div>
                                                  <div class="mb-3">
                                                      <label class="form-label" for="inputPasswordNew2">Verify
                                                          password</label>
                                                      <input type="password" class="form-control"
                                                             id="inputPasswordNew2">
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Save changes</button>
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