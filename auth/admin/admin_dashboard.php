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
if ($_SESSION['userType'] != 'ADMIN') {
    header('Location: ../../login.php');
}
?>
<?php

$fuelOrderList = '';
$orders = "SELECT fuel_order.order_id,fuel_order.fuel_id,fuel_order.order_status,fuel_order.order_qty,fuel_order.station_id,fuel_order.order_time,fuel_station.station_name from fuel_order inner join fuel_station on fuel_order.station_id=fuel_station.station_id where fuel_order.order_status='PENDING' ORDER BY order_time DESC;";
$result = mysqli_query($connection, $orders);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fuelOrderList .= "<tr>";
        $fuelOrderList .= "<td>" . $row['order_id'] . "</td>";
        $fuelOrderList .= "<td>" . $row['station_id'] . "</td>";
        $fuelOrderList .= "<td>" . $row['station_name'] . "</td>";
        $fuelOrderList .= "<td>" . $row['fuel_id'] . "</td>";
        $fuelOrderList .= "<td>" . $row['order_qty'] . "</td>";
        $fuelOrderList .= "<td>" . $row['order_time'] . "</td>";

        $fuelOrderList .= "</tr>";
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
                                                    <h5 class="card-title">Total Stations</h5>
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
                                            <h1 class="mt-1 mb-3" id="station-count">0</h1>
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
                                                    <h5 class="card-title">Orders</h5>
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
                                            <h1 class="mt-1 mb-3" id="Order-count">0</h1>
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
                                                    <h5 class="card-title">Total Users</h5>
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
                                            <h1 class="mt-1 mb-3" id="user-count">0</h1>
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
                                                    <h5 class="card-title">Complite Orders</h5>
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
                                            <h1 class="mt-1 mb-3" id="Order-compite">0</h1>
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
                                <h5 class="card-title mb-0">Recent Movement</h5>
                            </div>
                            <div class="card-body py-3">
                                <div class="chart chart-sm">
                                    <canvas id="chartjs-dashboard-line"></canvas>
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
                    <div
                            class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2"
                    >

                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h5 class="card-title mb-0"> Latest Pending Orders </h5>
                            </div>
                            <table class="table table-hover my-0">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th class="d-none d-xl-table-cell">Station ID</th>
                                    <th class="d-none d-xl-table-cell">Station name</th>
                                    <th>Fuel ID</th>
                                    <th class="d-none d-md-table-cell">Quantity</th>
                                    <th class="d-none d-md-table-cell">Date</th>
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
            <script type="text/javascript">
                function loadDoc() {


                    setInterval(function(){

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("user-count").innerHTML = this.responseText;
                            }
                        };
                        xhttp.open("GET", "../../code/userCount.php", true);
                        xhttp.send();

                    },1000);

                    setInterval(function(){

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("station-count").innerHTML = this.responseText;
                            }
                        };
                        xhttp.open("GET", "../../code/StationCount.php", true);
                        xhttp.send();

                    },1000);

                    setInterval(function(){

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("Order-count").innerHTML = this.responseText;
                            }
                        };
                        xhttp.open("GET", "../../code/OrderCount", true);
                        xhttp.send();

                    },1000);

                    setInterval(function(){

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("Order-compite").innerHTML = this.responseText;
                            }
                        };
                        xhttp.open("GET", "../../code/OrderCountCompite", true);
                        xhttp.send();

                    },1000);


                }
                loadDoc();
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var ctx = document
                        .getElementById("chartjs-dashboard-line")
                        .getContext("2d");
                    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
                    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
                    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
                    // Line chart
                    new Chart(document.getElementById("chartjs-dashboard-line"), {
                        type: "line",
                        data: {
                            labels: [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                            ],
                            datasets: [
                                {
                                    label: "Sales ($)",
                                    fill: true,
                                    backgroundColor: gradient,
                                    borderColor: window.theme.primary,
                                    data: [
                                        2115, 1562, 1584, 1892, 1587, 1923, 2566, 2448, 2805, 3438,
                                        2917, 3327,
                                    ],
                                },
                            ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                            tooltips: {
                                intersect: false,
                            },
                            hover: {
                                intersect: true,
                            },
                            plugins: {
                                filler: {
                                    propagate: false,
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        reverse: true,
                                        gridLines: {
                                            color: "rgba(0,0,0,0.0)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        ticks: {
                                            stepSize: 1000,
                                        },
                                        display: true,
                                        borderDash: [3, 3],
                                        gridLines: {
                                            color: "rgba(0,0,0,0.0)",
                                        },
                                    },
                                ],
                            },
                        },
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Pie chart
                    new Chart(document.getElementById("chartjs-dashboard-pie"), {
                        type: "pie",
                        data: {
                            labels: ["Chrome", "Firefox", "IE"],
                            datasets: [
                                {
                                    data: [4306, 3801, 1689],
                                    backgroundColor: [
                                        window.theme.primary,
                                        window.theme.warning,
                                        window.theme.danger,
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
                    // Bar chart
                    new Chart(document.getElementById("chartjs-dashboard-bar"), {
                        type: "bar",
                        data: {
                            labels: [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                            ],
                            datasets: [
                                {
                                    label: "This year",
                                    backgroundColor: window.theme.primary,
                                    borderColor: window.theme.primary,
                                    hoverBackgroundColor: window.theme.primary,
                                    hoverBorderColor: window.theme.primary,
                                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                                    barPercentage: 0.75,
                                    categoryPercentage: 0.5,
                                },
                            ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [
                                    {
                                        gridLines: {
                                            display: false,
                                        },
                                        stacked: false,
                                        ticks: {
                                            stepSize: 20,
                                        },
                                    },
                                ],
                                xAxes: [
                                    {
                                        stacked: false,
                                        gridLines: {
                                            color: "transparent",
                                        },
                                    },
                                ],
                            },
                        },
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var markers = [
                        {
                            coords: [31.230391, 121.473701],
                            name: "Shanghai",
                        },
                        {
                            coords: [28.70406, 77.102493],
                            name: "Delhi",
                        },
                        {
                            coords: [6.524379, 3.379206],
                            name: "Lagos",
                        },
                        {
                            coords: [35.689487, 139.691711],
                            name: "Tokyo",
                        },
                        {
                            coords: [23.12911, 113.264381],
                            name: "Guangzhou",
                        },
                        {
                            coords: [40.7127837, -74.0059413],
                            name: "New York",
                        },
                        {
                            coords: [34.052235, -118.243683],
                            name: "Los Angeles",
                        },
                        {
                            coords: [41.878113, -87.629799],
                            name: "Chicago",
                        },
                        {
                            coords: [51.507351, -0.127758],
                            name: "London",
                        },
                        {
                            coords: [40.416775, -3.70379],
                            name: "Madrid ",
                        },
                    ];
                    var map = new jsVectorMap({
                        map: "world",
                        selector: "#world_map",
                        zoomButtons: true,
                        markers: markers,
                        markerStyle: {
                            initial: {
                                r: 9,
                                strokeWidth: 7,
                                stokeOpacity: 0.4,
                                fill: window.theme.primary,
                            },
                            hover: {
                                fill: window.theme.primary,
                                stroke: window.theme.primary,
                            },
                        },
                        zoomOnScroll: false,
                    });
                    window.addEventListener("resize", () => {
                        map.updateSize();
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