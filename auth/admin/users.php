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
$UserList='';
$sql = "select user.user_id,user.email,User_status.status from user inner join User_status on user.user_id=User_status.user_id where roleid!=3";
$ListOfUsers = mysqli_query($connection, $sql);
if (mysqli_num_rows($ListOfUsers) > 0) {
    while ($row = mysqli_fetch_assoc($ListOfUsers)) {
        $UserList .= "<tr>";
        $UserList .= "<td>" . $row['user_id'] . "</td>";
        $UserList .= "<td>" . $row['email'] . "</td>";
        $UserList .= "<td><span class='badge bg-warning'>" . $row['status'] . "</span></td>";
        $UserList .= "<td><a href='edit.php?user_id=" . $row['user_id'] . "' class='btn btn-primary btn-sm'>Select</a></td>";
        $UserList .= "</tr>";
    }
} else {
    $UserList = "<tr><td colspan='3'>No Users</td></tr>";
}


?>




<?php

if (isset($_POST['btn-addUser'])) {


    $user_id = '';
    $email = '';
    $password = '';
    $userType = '';
    $roleid = '';
    $msg = '';
    $msg1 = '';


    //verify the input
    $user_id = input_varify($_POST['userid']);
    $email = input_varify($_POST['email']);
    $password = input_varify($_POST['password']);
    $userType = input_varify($_POST['userType']);
   // echo $userType;
//echo "<br>";

    switch ($userType) {
        case 'Manager':
            $roleid = 1;
            break;
        case 'Pumper':
            $roleid = 2;
            break;

    }
//echo $roleid;
   // echo "<br>";
    //check if the email is already in the database

    $query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
    $ShowResult = mysqli_query($connection, $query);
   // echo mysqli_num_rows($ShowResult);
    $data = mysqli_fetch_array($ShowResult);
    $query2 = "SELECT * FROM user WHERE user_id = '{$user_id}' LIMIT 1";
    $ShowResult2 = mysqli_query($connection, $query2);
    $data = mysqli_fetch_array($ShowResult2);
    //echo "<br>";
   // echo mysqli_num_rows($ShowResult);
    if ($ShowResult2){
        if (mysqli_num_rows($ShowResult2) == 1) {
            $msg .= 'User already exist';
        }
    elseif ($ShowResult) {
        if (mysqli_num_rows($ShowResult) == 1) {
            $msg .= 'Email already exist ';
        } else {


            $query = "INSERT INTO user (user_id,email,pwd,roleid) VALUES ('{$user_id}','{$email}','{$password}','{$roleid}')";
            $query2 = "INSERT INTO login_record (user_id,NotificationMessage) VALUES ('{$user_id}','Welcome to the system')";
            $ShowResult = mysqli_query($connection, $query2);
            $ShowResult = mysqli_query($connection, $query);
            if ($ShowResult) {
              //  $Query = "INSERT INTO userinfo (phone,user_id,fname,lname,zip,longitude,latitude) VALUES ('{$email}','{$user_id}')";
              //  $ShowResult = mysqli_query($connection, $Query);
                $query3="INSERT INTO user_status (user_id,Status) VALUES ('{$user_id}','Active')";
                $ShowResult = mysqli_query($connection, $query3);

                $msg1 .= 'User added successfully';

                //echo $msg;
            } else {
                $msg .= 'User not added';
                //  echo $msg;
            }

        }

    }
    else {
        $msg .= 'Database query failed';
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
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
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

                        <h1 class="h3 mb-3">Settings</h1>

                        <div class="row">
                            <div class="col-md-3 col-xl-2">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Profile Settings</h5>
                                    </div>

                                    <div class="list-group list-group-flush" role="tablist">
                                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                           href="#Users" role="tab" aria-selected="true">
                                            Users
                                        </a>
                                        <a class="list-group-item list-group-item-action " data-bs-toggle="list"
                                           href="#account" role="tab" aria-selected="true">
                                            Add Users
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                           href="#password" role="tab" aria-selected="false" tabindex="-1">
                                            Password
                                        </a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                           role="tab" aria-selected="false" tabindex="-1">
                                            Privacy and safety
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
                                    <div class="tab-pane fade show active" id="Users" role="tabpanel">


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
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $UserList; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade show" id="account" role="tabpanel">


                                        <div class="card">
                                            <div class="card-header">

                                                <h5 class="card-title mb-0">Add new user</h5>
                                                <?php // echo $msg ?>
                                            </div>
                                            <div class="card-body">
                                                <form action="users.php" method="POST">
                                                    <div class="row">
                                                        <div class="mb-3 ">
                                                            <label class="form-label" for="inputUserid">User id</label>
                                                            <input type="text" class="form-control" name="userid"
                                                                   id="inputUserid" placeholder="user id" required>
                                                        </div>

                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                               id="inputEmail4" placeholder="Email" required>
                                                    </div>
                                                    <div class="mb-3">

                                                        <label for="inputUserType" class="form-label">User Type</label>
                                                        <select class="form-select" name="userType" id="inputUserType"
                                                                required>
                                                            <option>Manager</option>
                                                            <option>Pumper</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputPassword">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                               id="inputPassword" placeholder="Password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="inputconfirmPassword">Re-Password</label>
                                                        <input type="password" class="form-control"
                                                               name="confirmPassword" id="inputconfirmPassword"
                                                               placeholder="Password" required>
                                                    </div>
                                                    <button type="submit" name="btn-addUser" class="btn btn-primary">Add
                                                        User
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
                                                    <button type="submit" name="" class="btn btn-primary">Save changes
                                                    </button>
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

</html>