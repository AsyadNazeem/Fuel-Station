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




//retrieve data from fuel_station table
$sql="select fuel_station.station_id,fuel_station.station_name,fuel_station.station_zip,userinfo.fname,userinfo.lname,station_status.status from fuel_station inner join userinfo on fuel_station.manager_id=userinfo.user_id inner join station_status on fuel_station.station_id=station_status.station_id where fuel_station.manager_id='{$_SESSION['user_id']}'";

$result = mysqli_query($connection,$sql);
if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
}
else {
    $warning = "No data found";
    echo "<script type='text/javascript'>alert('$warning');</script>";
    header('Location: ../../auth/mannager/manager_dashboard.php?error=F404&NoFuelStationFoundPleaseContactAdmin');
}

?>




<?php
// add button click event
if (isset($_POST['btn-fuelAdd'])) {
$station_id = $data['station_id'];
//assigning empty value  to variables
    $msg="";
    $msg1="";
    $fuel_type="";
    $fuel_id="";
    $stock="";

    //assigning values to variables
    $fuel_type = $_POST['fuel_type'];
    $stock = $_POST['stock'];

    //get fuel id form fuel_type table and update input field
    $sql1 = "select fuel_id from fuel_type where fuel_type='$fuel_type'";
    $result1 = mysqli_query($connection,$sql1);
    if ($result1) {
        $data1 = mysqli_fetch_assoc($result1);
        $fuel_id = $data1['fuel_id'];
    }else{
        $msg1 = "Error in getting fuel id";
    }


   $fuel_id = $data1['fuel_id'];
    //update fuel_stock table
    $sql2 = "update fuel_stock set stock=stock+'$stock',update_time=now() where fuel_id='$fuel_id' and station_id='{$data['station_id']}'";
    $result2 = mysqli_query($connection,$sql2);
    if ($result2) {

        $msg1 = "Fuel stock update successfully";
    }else{
        $msg = "Error in updating fuel stock";
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
                                      <h5 class="card-title mb-0">Profile Settings</h5>
                                  </div>

                                  <div class="list-group list-group-flush" role="tablist">

                                      <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                         href="#account" role="tab" aria-selected="true">
                                          Fuel Station
                                      </a>
                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#stock"
                                         role="tab" aria-selected="false" tabindex="-1">
                                          Stock
                                      </a>
                                    <!--  <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                         href="#password" role="tab" aria-selected="false" tabindex="-1">
                                          Password
                                      </a>
                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                         role="tab" aria-selected="false" tabindex="-1">
                                          Privacy and safety
                                      </a>-->
                                      <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                         role="tab" aria-selected="false" tabindex="-1">
                                          Email notifications
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
                                              <form action="" method="post">
                                                  <div class="row">
                                                      <div class="col-md-8">
                                                          <div class="mb-3">
                                                              <h1>
                                                                  <small class="text-muted"><?php echo $data['station_name'];?>- Ceypetco Filling Station
                                                                  </small>
                                                              </h1>
                                                          </div>
                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputUsername">Fuel station ID</label>
                                                              <input type="text" class="form-control" id="station_id" value="<?php echo $data['station_id'];?>" disabled>
                                                          </div>
                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputUsername">Name</label>
                                                              <input type="text" class="form-control"
                                                                     id="inputUsername" placeholder="Fuel Station name" name="stationName" value="<?php echo $data['station_name'];?>"disabled>
                                                          </div>
                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputUsername">Manager Name</label>
                                                              <input type="text" class="form-control"
                                                                     id="inputUsername" placeholder="Manager name" name="mngName" value="<?php echo $data['fname']," ",$data['lname'] ?>"disabled>
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
                                          <div class="card-header">

                                              <h5 class="card-title mb-0">Public info</h5>
                                          </div>
                                          <div class="card-body">
                                              <form action="fuel_station.php" method="post">
                                                  <div class="row">
                                                      <div class="col-md-8">
                                                          <div class="mb-3">
                                                              <h1>
                                                                  <small class="text-muted">Add Fuel Stock
                                                                  </small>
                                                              </h1>
                                                          </div>
                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputUsername">Fuel Type</label>

                                                              <select class="form-select" aria-label="Default select example" name="fuel_type" required>
                                                                  <option >92petrol</option>
                                                                  <option>95petrol</option>
                                                                  <option >diesel</option>
                                                                  <option >kerosene</option>
                                                                  <option>super-diesel</option>
                                                              </select>
                                                          </div>

                                                          <div class="mb-3">
                                                              <label class="form-label"
                                                                     for="inputStock">Enter Stock</label>
                                                              <input type="number" class="form-control"
                                                                     id="inputStock" placeholder="L" name="stock" required>
                                                          </div>
                                                          <div class="mb-3">

                                                              <input class="btn btn-primary" type="submit" name="btn-fuelAdd" value="ADD">
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