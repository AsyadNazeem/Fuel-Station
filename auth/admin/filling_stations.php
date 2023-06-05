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


if (isset($_POST['btn-RegStation'])) {

    //Assigning empty variables
    $msg = "";
    $msg1 = "";
    $fuelStation_ID = "";
    $manager_ID = "";
    $fuelStationName = "";
    $zipCode = "";

    //sanitizing the input and assigning it to variables
    $fuelStation_ID = input_varify($_POST['fuelStation_ID']);
    $manager_ID = input_varify($_POST['manager_ID']);
    $fuelStationName = input_varify($_POST['fuelStationName']);
    $zipCode = input_varify($_POST['zipCode']);


    //checking if the fields are empty
    if (check_empty($fuelStation_ID, $manager_ID, $fuelStationName, $zipCode)) {
        $msg = "Please fill all the fields";
        // echo $msg;
    } else {
        //  $msg= "All fields are filled";
        // echo $msg;
        //check fuel station id is already in the database
        $query = "SELECT * FROM fuel_station WHERE station_id = '{$fuelStation_ID}' LIMIT 1";
        $ShowResult = mysqli_query($connection, $query);
        // echo "<br>";
        //echo mysqli_num_rows($ShowResult);
        //check valid manager id
        $query1 = "SELECT * FROM user WHERE user_id = '{$manager_ID}' AND roleid=1 LIMIT 1";
        $ShowResult1 = mysqli_query($connection, $query1);
        //  echo "<br>";
        //  echo mysqli_num_rows($ShowResult1);


        //check result
        if ($ShowResult) {
            if (mysqli_num_rows($ShowResult) == 1) {
                $msg = "Fuel station ID already exists";
                //   echo $msg;
            } elseif (mysqli_num_rows($ShowResult1) == 1) {
                //inserting data into the database
                $query2 = "INSERT INTO fuel_station (station_id,manager_id, station_name,station_zip) VALUES ('{$fuelStation_ID}','{$manager_ID}','{$fuelStationName}','{$zipCode}')";
                $ShowResult2 = mysqli_query($connection, $query2);
                if ($ShowResult2) {
                    //Fuel station status is set to active
                    $query3 = "INSERT INTO station_status (station_id, status) VALUES ('{$fuelStation_ID}', 'active')";
                    $ShowResult3 = mysqli_query($connection, $query3);
                    $query4 = "INSERT INTO fuel_stock (station_id,fuel_id,stock)
VALUES 
    ('{$fuelStation_ID}',1,0),('{$fuelStation_ID}',2,0),('{$fuelStation_ID}',3,0),('{$fuelStation_ID}',4,0),('{$fuelStation_ID}',5,0)";
                    $ShowResult4 = mysqli_query($connection, $query4);
                    $msg1 = "Fuel station added successfully";
                    // echo $msg;
                } else {
                    $msg = "Fuel station not added";
                    //   echo $msg;
                }
            } else {
                $msg = "Invalid manager ID";
                // echo $msg;
            }

        } else {
            $msg = "Database query failed";
            // echo $msg;
        }


    }


}

function input_varify($data)
{
    //Remove empty spece from user input
    $data = trim($data); //Remove back slash from user input
    $data = stripslashes($data); //conver special chars to html entities
    $data = htmlspecialchars($data);
    return $data;
}

function check_empty($fuelStation_ID, $manager_ID, $fuelStationName, $zipCode)
{
    if (empty($fuelStation_ID) || empty($manager_ID) || empty($fuelStationName) || empty($zipCode)) {
        return true;
    } else {
        return false;
    }
}


?>

<?php
//user list query
$fuelStationList = '';
$query = "select fuel_station.station_id,fuel_station.station_name,fuel_station.station_zip,user.email,station_status.status from fuel_station inner join user on fuel_station.manager_id=user.user_id inner join station_status on fuel_station.station_id=station_status.station_id";
$ListOfStation = mysqli_query($connection, $query);

if ($ListOfStation) {
    while ($row = mysqli_fetch_assoc($ListOfStation)) {

        $fuelStationList .= "<tr>";
        $fuelStationList .= "<td>{$row['station_id']}</td>";
        $fuelStationList .= "<td>{$row['station_name']}</td>";
        $fuelStationList .= "<td>{$row['station_zip']}</td>";
        $fuelStationList .= "<td>{$row['email']}</td>";
        $fuelStationList .= "<td> <span class='badge bg-warning'>{$row['status']}</span></td>";
        $fuelStationList .= "<td><a href='edit_fuel_station.php?station_id={$row['station_id']}' class='btn btn-primary btn-sm'>Delete</a></td>";
        $fuelStationList .= "</tr>";
    }
} else {
    echo "Database query failed";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
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

                <div class="row">

                    <div class="container-fluid p-0">

                        <h1 class="h3 mb-3">Fuel</h1>

                        <div class="row">
                            <div class="col-md-3 col-xl-2">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Options</h5>
                                    </div>

                                    <div class="list-group list-group-flush" role="tablist">
                                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                           href="#account" role="tab" aria-selected="true">
                                            Filling Stations
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                           href="#password" role="tab" aria-selected="false" tabindex="-1">
                                            Register Filling Station
                                        </a>

                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Email notifications
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Massage notifications
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Widgets
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Your data
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Delete account
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 col-xl-10">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h5 class="card-title mb-0">Filling station</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#ID</th>
                                                        <th>Name</th>
                                                        <th>Zip</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $fuelStationList; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Register New Filling Station</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="filling_stations.php" method="POST">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label"
                                                                       for="inputFirstName">Fuel station ID</label>
                                                                <input type="text" class="form-control"
                                                                       id="inputFirstName" placeholder="Fuel station ID"
                                                                       name="fuelStation_ID">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label"
                                                                       for="inputFirstName">Manager ID</label>
                                                                <input type="text" class="form-control"
                                                                       id="inputFirstName" placeholder="Manager ID"
                                                                       name="manager_ID">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputLastName">Filling
                                                                    Staion Name</label>
                                                                <input type="text" class="form-control"
                                                                       id="inputLastName"
                                                                       placeholder="Filling station name"
                                                                       name="fuelStationName">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputAddress">Zip</label>
                                                            <input type="text" class="form-control" id="inputAddress"
                                                                   placeholder="1234 Main St" name="zipCode">
                                                        </div>

                                                        <div class="mb-3">

                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label" for="inputState">State</label>
                                                                <select id="inputState" class="form-control">
                                                                    <option selected=" ">Colombo</option>
                                                                    <option>Gampaha</option>
                                                                    <option>Kaluthara</option>
                                                                    <option>Monaragama</option>
                                                                    <option>Rathnapura</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <button type="submit" class="btn btn-primary"
                                                                name="btn-RegStation">Save changes
                                                        </button>
                                                        <?php if (!empty($msg)) {
                                                            echo "<script>swal('Error!', '$msg', 'error');</script>";
                                                        } elseif (!empty($msg1)) {
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