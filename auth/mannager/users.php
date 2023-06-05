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

if ($_SESSION['userType'] != 'MANAGER') {
    header('Location: ../../login.php');
}
?>

<?php

$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM fuel_station WHERE manager_id='$user_id'";
$selectResult=mysqli_query($connection,$sql);
if($selectResult){
    if(mysqli_num_rows($selectResult)==1){
        $data=mysqli_fetch_assoc($selectResult);
        $station_id=$data['station_id'];
        //echo "$station_id";
    }
}else{
    die("Database query failed");
}


?>



<?php

$PumperList='';
//$sql = "select user.user_id,user.email,User_status.status from user inner join User_status on user.user_id=User_status.user_id where roleid=2";
$sql = "select user.user_id,user.email,User_status.status from user inner join User_status on user.user_id=User_status.user_id  cross join fuel_management.pumper_station lr on user.user_id = lr.user_id where station_id='{$station_id}' and roleid=2";
$ListOfPumper = mysqli_query($connection, $sql);
if (mysqli_num_rows($ListOfPumper) > 0) {
    while ($row = mysqli_fetch_assoc($ListOfPumper)) {
        $PumperList .= "<tr>";
        $PumperList .= "<td>" . $row['user_id'] . "</td>";
        $PumperList .= "<td>" . $row['email'] . "</td>";
        $PumperList .= "<td> <span class='badge bg-warning'>" . $row['status'] . "</span></td>";
        $PumperList .= "<td><a href='edit.php?user_id=" . $row['user_id'] . "' class='btn btn-primary btn-sm'>Select</a></td>";
        $PumperList .= "</tr>";
    }
}


?>









<?php

if (isset($_POST['btn-addPumper'])) {

    $msg="";
    $msg1="";
    $user_idPupm = '';
    $username ='';
    $phone = '';
    $email = '';
    $fname = '';
    $password = '';
    $cpassword = '';


    $username=input_varify($_POST['username']);
    $user_idPupm=input_varify($_POST['user_idPump']);
    $phone=input_varify($_POST['phone']);
    $email=input_varify($_POST['email']);
    $fname=input_varify($_POST['fname']);
    $password=input_varify($_POST['password']);
    $cpassword=input_varify($_POST['cpassword']);




    //check if the username is already taken
    $query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
    $result = mysqli_query($connection, $query);
   // echo ('email row '.mysqli_num_rows($result));
  //  echo "<br>";
    $query1 = "SELECT * FROM userinfo WHERE phone = '{$phone}' LIMIT 1";
    $result1 = mysqli_query($connection, $query1);
   // echo ('phone row '.mysqli_num_rows($result1));
  //  echo "<br>";
    $query2 = "SELECT * FROM user WHERE user_id = '{$user_idPupm}' LIMIT 1";
    $result2 = mysqli_query($connection, $query2);
  //  echo ('user_id row '.mysqli_num_rows($result2));
  //  echo "<br>";
//check if the email is already taken
    if(mysqli_num_rows($result) > 0){
        $msg = "Email already taken";
      //  echo $msg;
    }elseif (mysqli_num_rows($result1) > 0) {
        $msg = "Phone number already taken";
       // echo $msg;
    }elseif (mysqli_num_rows($result2) > 0) {
        $msg = "User ID already taken";
     //   echo $msg;
    }else{
//check if the password and confirm password match
        if($password == $cpassword){
            //insert the user into the database
            $query3 = "INSERT INTO user (user_id, username, email, pwd, roleid,reg_time) VALUES ('{$user_idPupm}','{$username}','{$email}','{$password}','2',now())";
            $result3 = mysqli_query($connection, $query3);
            $query4 = "INSERT INTO userinfo (user_id, fname, phone) VALUES ('{$user_idPupm}', '{$fname}', '{$phone}')";
            $result4 = mysqli_query($connection, $query4);
            $query5 = "INSERT INTO pumper_station (user_id, station_id) VALUES ('{$user_idPupm}', '{$station_id}')";
            $result5 = mysqli_query($connection, $query5);
            if($result3){
                $query3="INSERT INTO user_status (user_id,Status) VALUES ('{$user_idPupm}','Active')";
                $ShowResult = mysqli_query($connection, $query3);
                $msg1 = "User added successfully";
               // echo $msg;
        }else{
            $msg = "Password does not match";
         //   echo $msg;
        }

    }







}}

function input_varify($data)
{
    //Remove empty spece from user input
    $data = trim($data); //Remove back slash from user input
    $data = stripslashes($data); //conver special chars to html entities
    $data = htmlspecialchars($data);
    return $data;
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
                                            Pumpers
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                           href="#password" role="tab" aria-selected="false" tabindex="-1">
                                            Add new Pumper
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
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $PumperList ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Register New pumper</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="users.php"  method="post">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputLastName">User ID</label>
                                                                <input type="text" class="form-control" name="user_idPump"
                                                                       id="inputLastName"
                                                                       placeholder="User ID">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="inputFirstName">
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="fname"
                                                                       id="inputFirstName" placeholder="First name">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                   for="inputUserName">Username</label>
                                                            <input type="text" class="form-control" name="username"
                                                                   id="inputUserName" placeholder="Username">

                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputMobileNumber">Mobile
                                                                Number</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                   id="inputMobileNumber"
                                                                   placeholder="07****">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputEmail">Email</label>
                                                            <input type="email" class="form-control" name="email"
                                                                   id="inputEmail"
                                                                   placeholder="Email">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                   for="inputPassword">Password</label>
                                                            <input type="text" class="form-control" name="password"
                                                                   id="inputPassword"
                                                                   placeholder="Password">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputCPassword">Confirm
                                                                Password</label>
                                                            <input type="text" class="form-control" name="cpassword"
                                                                   id="inputCPassword"
                                                                   placeholder="Confirm Password">
                                                        </div>

                                                </div>
                                                <button type="submit" name="btn-addPumper" class="btn btn-primary">Add Pumper
                                                </button>
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