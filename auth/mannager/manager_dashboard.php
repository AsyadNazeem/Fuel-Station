<?php session_start(); ?>
<?php
include '../../config/conn.php';
require_once '../../res/link.php';
require_once '../../res/add-ons.php';
include '../../res/function.php';
?>
<?php
if(!isset($_SESSION['user_id'])){
    header('Location: ../../login.php');
}
if($_SESSION['userType'] != 'MANAGER'){
    header('Location: ../../login.php');
}

?>

<?php
$SQL= "SELECT * FROM fuel_station WHERE manager_id = '{$_SESSION['user_id']}'";
$result = mysqli_query($connection, $SQL);
if(!(mysqli_num_rows($result) > 0)){
    header('Location: ../../login.php?fuel_station=not_found');
}




?>



<?php
$msg='';
$msg1='';

$manager_id = $_SESSION['user_id'];
$sql="SELECT fuel_station.manager_id, fuel_station.station_id,fuel_stock.fuel_id,fuel_stock.stock,fuel_stock.update_time FROM fuel_station INNER JOIN fuel_stock ON fuel_station.station_id=fuel_stock.station_id WHERE fuel_station.manager_id='{$manager_id}' AND fuel_stock.fuel_id=1";
$sql1="SELECT fuel_station.manager_id, fuel_station.station_id,fuel_stock.fuel_id,fuel_stock.stock,fuel_stock.update_time FROM fuel_station INNER JOIN fuel_stock ON fuel_station.station_id=fuel_stock.station_id WHERE fuel_station.manager_id='{$manager_id}' AND fuel_stock.fuel_id=2";
$sql2="SELECT fuel_station.manager_id, fuel_station.station_id,fuel_stock.fuel_id,fuel_stock.stock,fuel_stock.update_time FROM fuel_station INNER JOIN fuel_stock ON fuel_station.station_id=fuel_stock.station_id WHERE fuel_station.manager_id='{$manager_id}' AND fuel_stock.fuel_id=3";
$sql3="SELECT fuel_station.manager_id, fuel_station.station_id,fuel_stock.fuel_id,fuel_stock.stock,fuel_stock.update_time FROM fuel_station INNER JOIN fuel_stock ON fuel_station.station_id=fuel_stock.station_id WHERE fuel_station.manager_id='{$manager_id}' AND fuel_stock.fuel_id=4";
$sql4="SELECT fuel_station.manager_id, fuel_station.station_id,fuel_stock.fuel_id,fuel_stock.stock,fuel_stock.update_time FROM fuel_station INNER JOIN fuel_stock ON fuel_station.station_id=fuel_stock.station_id WHERE fuel_station.manager_id='{$manager_id}' AND fuel_stock.fuel_id=5";

$result = mysqli_query($connection,$sql);
$result1 = mysqli_query($connection,$sql1);
$result2 = mysqli_query($connection,$sql2);
$result3 = mysqli_query($connection,$sql3);
$result4 = mysqli_query($connection,$sql4);

$data=mysqli_fetch_array($result);
$data1=mysqli_fetch_array($result1);
$data2=mysqli_fetch_array($result2);
$data3=mysqli_fetch_array($result3);
$data4=mysqli_fetch_array($result4);

$petrol92= $data['stock'];
$petrol95= $data1['stock'];
$diesel= $data2['stock'];
$Kerosene= $data3['stock'];
$superDiesel= $data4['stock'];

if($petrol92<10 or $petrol95<10 or $diesel<10 or $Kerosene<10 or $superDiesel<10) {
    $msg = "Fuel Stock is Low";

}else{
    $msg1 = "Everything is Up to Date";
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />




  <title>Fual Station Mannagement</title>

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
              <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>



              <div class="row">
                  <div class="col-xl-6 col-xxl-5 d-flex">
                      <div class="w-100">
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="row">
                                              <div class="col mt-0">
                                                  <h5 class="card-title">Sales</h5>
                                              </div>

                                              <div class="col-auto">
                                                  <div class="stat text-primary">
                                                      <i
                                                              class="align-middle"
                                                              data-feather="truck"
                                                      ></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <h1 class="mt-1 mb-3" id="total-Sales">0</h1>
                                          <div class="mb-0">
                            <span class="text-danger">
                              <i class="mdi mdi-arrow-bottom-right"></i>
                            </span>
                                              <span class="text-muted"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="row">
                                              <div class="col mt-0">
                                                  <h5 class="card-title">Vehicles</h5>
                                              </div>

                                              <div class="col-auto">
                                                  <div class="stat text-primary">
                                                      <i
                                                              class="align-middle"
                                                              data-feather="users"
                                                      ></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <h1 class="mt-1 mb-3" id="vehicle-count"></h1>
                                          <div class="mb-0">
                            <span class="text-success">
                              <i class="mdi mdi-arrow-bottom-right"></i>
                            </span>
                                              <span class="text-muted"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="row">
                                              <div class="col mt-0">
                                                  <h5 class="card-title">Users</h5>
                                              </div>

                                              <div class="col-auto">
                                                  <div class="stat text-primary">
                                                      <i
                                                              class="align-middle"
                                                              data-feather="dollar-sign"
                                                      ></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <h1 class="mt-1 mb-3" id="pumper-count"></h1>
                                          <div class="mb-0">
                            <span class="text-success">
                              <i class="mdi mdi-arrow-bottom-right"></i>
                            </span>
                                              <span class="text-muted"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="row">
                                              <div class="col mt-0">
                                                  <h5 class="card-title">Avilble Fuel pump</h5>
                                              </div>

                                              <div class="col-auto">
                                                  <div class="stat text-primary">
                                                      <i
                                                              class="align-middle"
                                                              data-feather="shopping-cart"
                                                      ></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <h1 class="mt-1 mb-3" id="">5</h1>
                                          <div class="mb-0">
                            <span class="text-danger">
                              <i class="mdi mdi-arrow-bottom-right"></i>
                            </span>
                                              <span class="text-muted"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-xl-6 col-xxl-7">
                      <div class="card flex-fill w-100">
                          <div class="card-header">
                              <h5 class="card-title mb-0">Fuel stock</h5>
                              <?php
                              if (!empty($msg)) {
                                  echo "<script>swal('Error!', '$msg', 'error');</script>";
                              } elseif (!empty($msg1)) {
                                  echo "<script>swal('Success!', '$msg1', 'success');</script>";
                              }
                              ?>
                          </div>
                          <div class="card-body py-3">
                              <div class="chart chart-sm">
                                  <canvas id="chartjs-pie"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-12 col-md-6 col-xxl-6 d-flex order-2 order-xxl-3">
                      <div class="card flex-fill w-100">
                          <div class="card-header">
                              <h5 class="card-title mb-0">Fuel Usage</h5>
                          </div>
                          <div class="card-body d-flex">
                              <div class="align-self-center w-100">
                                  <div class="py-3">
                                      <div class="chart chart-xs">
                                          <canvas id="chartjs-dashboard-pie"></canvas>
                                      </div>
                                  </div>

                                  <table class="table mb-0">
                                      <tbody>
                                      <tr>
                                          <td>Chrome</td>
                                          <td class="text-end">430</td>
                                      </tr>
                                      <tr>
                                          <td>Firefox</td>
                                          <td class="text-end">3801</td>
                                      </tr>
                                      <tr>
                                          <td>IE</td>
                                          <td class="text-end">1689</td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-12 col-md-3 col-xxl-6 d-flex order-1 order-xxl-1">
                      <div class="card flex-fill">
                          <div class="card-header">
                              <h5 class="card-title mb-0">Calendar</h5>
                          </div>
                          <div class="card-body d-flex">
                              <div class="align-self-center w-100">
                                  <div class="chart">
                                      <div id="datetimepicker-dashboard"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <script type="text/javascript">
              function loadDoc() {


              setInterval(function(){

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
              document.getElementById("total-Sales").innerHTML = this.responseText;
              }
              };
              xhttp.open("GET", "../../code/sales.php", true);
              xhttp.send();

              },1000);


                  setInterval(function(){

                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {
                              document.getElementById("vehicle-count").innerHTML = this.responseText;
                          }
                      };
                      xhttp.open("GET", "../../code/Vehicle.php", true);
                      xhttp.send();

                  },1000);


                  setInterval(function(){

                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {
                              document.getElementById("pumper-count").innerHTML = this.responseText;
                          }
                      };
                      xhttp.open("GET", "../../code/pumperCount.php", true);
                      xhttp.send();

                  },1000);

              }
              loadDoc();
          </script>

          <script>
              document.addEventListener("DOMContentLoaded", function () {
                  new Chart(document.getElementById("chartjs-pie"), {
                      type: "pie",
                      data: {
                          labels: ["octane-92 Petrol", "octane-95 Petrol", "Diesel", "Super-Diesel","kerosene"],
                          datasets: [{
                              data: [<?php echo $petrol92; ?>,<?php echo $petrol95; ?>,<?php echo $diesel; ?>,<?php echo $superDiesel; ?>,<?php echo $Kerosene ;  ?>],
                              backgroundColor: [
                                  window.theme.primary,
                                  window.theme.success,
                                  window.theme.warning,
                                    window.theme.danger,
                                  "#dee2e6"
                              ],
                              borderColor: "transparent"
                          }]
                      },
                      options: {
                          maintainAspectRatio: false,
                          cutoutPercentage: 0,
                      }
                  });
              });
          </script>
          <script>
              document.addEventListener("DOMContentLoaded", function () {
                  // Pie chart
                  new Chart(document.getElementById("chartjs-dashboard-pie"), {
                      type: "pie",
                      data: {
                          labels: ["Chrome", "Firefox", "IE", "Firefox", "IE"],
                          datasets: [
                              {
                                  data: [4306, 3801, 1689,3801, 1689],
                                  backgroundColor: [
                                      window.theme.primary,
                                      window.theme.success,
                                      window.theme.warning,
                                      window.theme.danger,
                                      "#dee2e6"
                                  ],
                                  borderWidth: 5,
                              },
                          ],
                      },
                      options: {
                          responsive: !window.MSInputMethodContext,
                          maintainAspectRatio: false,
                          legend: {
                              display: false,
                          },
                          cutoutPercentage: 75,
                      },
                  });
              });
          </script>


          <script>
              document.addEventListener("DOMContentLoaded", function () {
                  var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
                  var defaultDate =
                      date.getUTCFullYear() +
                      "-" +
                      (date.getUTCMonth() + 1) +
                      "-" +
                      date.getUTCDate();
                  document.getElementById("datetimepicker-dashboard").flatpickr({
                      inline: true,
                      prevArrow: '<span title="Previous month">&laquo;</span>',
                      nextArrow: '<span title="Next month">&raquo;</span>',
                      defaultDate: defaultDate,
                  });
              });
          </script>
      </main>
      <!-- End Main Content -->

      <!-- Footer -->
      <footer class="footer"></footer>
      <!--End Footer -->
    </div>
  </div>
</body>

</html>