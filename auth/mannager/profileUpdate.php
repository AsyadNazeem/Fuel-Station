<?php session_start(); ?>
<?php include_once '../../config/conn.php'; ?>
<?php include_once '../../res/add-ons.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}
if ($_SESSION['userType'] != 'MANAGER') {
    header('Location: ../../login.php');

}

?>

<?php
$msg2='Please complete your profile first!';

echo "<script>swal('Error!', '$msg2', 'error');</script>";

?>


<?php

if (isset($_POST['btn-updateProfile'])) {
    $user_id = $_SESSION['user_id'];
    //assigning variables and assign empty values

    $msg1 = '';
    $msg = '';
    $username = ' ';
    $msg = '';
    $fname = '';
    $lname = '';
    $email = '';
    $phone = '';

    //sanitize input
    $email = input_varify($_POST['email']);
    $username = input_varify($_POST['username']);
    $phone = input_varify($_POST['phone']);
    $fname = input_varify($_POST['fname']);
    $lname = input_varify($_POST['lname']);
    $zip = input_varify($_POST['zip']);

   // $sql= "UPDATE user SET username = '$username'and email = '$email' WHERE user_id = '$user_id'";
    $sql="update user set username='{$username}',email='{$email}' where user_id='{$user_id}'";
    $result = mysqli_query($connection, $sql);
    $sql1="SELECT * FROM userInfo WHERE user_id = '$user_id'";
    $result1 = mysqli_query($connection, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        $sql2 = "UPDATE userInfo SET fname = '$fname', lname = '$lname', phone = '$phone', zip = '$zip' WHERE user_id = '$user_id'";
        $result2 = mysqli_query($connection, $sql2);
    } else {
        $sql3 = "INSERT INTO userInfo (user_id, fname, lname, phone, zip) VALUES ('$user_id', '$fname', '$lname', '$phone', '$zip')";
        $result3 = mysqli_query($connection, $sql3);
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

                    <div class="col-md-9 col-xl-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="account" role="tabpanel">
                                <form action="profileUpdate.php" method="post">
                                    <div class="card">
                                        <div class="card-header">

                                            <h5 class="card-title mb-0">Complete your profile</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="inputUsername">User ID</label>
                                                        <input type="text" class="form-control" id="user_id"
                                                               value="<?php echo $_SESSION['user_id']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="inputUsername">Username</label>
                                                        <input type="text" class="form-control"
                                                               id="inputUsername" placeholder="Username" name="username"
                                                               value="" ">
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="text-center">
                                                        <img alt="Charles Hall" src="../img/avatars/avatar.jpg"
                                                             class="rounded-circle img-responsive mt-2"
                                                             width="128" height="128">
                                                        <div class="mt-2">
                                                                    <span class="btn btn-primary"><i
                                                                                class="fas fa-upload"></i> Upload</span>
                                                        </div>
                                                        <small>For best results, use an image at least 128px by
                                                            128px in .jpg format</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">

                                            <h5 class="card-title mb-0">Private info</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="inputFirstName">First
                                                        name</label>
                                                    <input type="text" class="form-control" id="inputFirstName"
                                                           placeholder="First name" name="fname">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="inputLastName">Last
                                                        name</label>
                                                    <input type="text" class="form-control" id="inputLastName"
                                                           placeholder="Last name" name="lname">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="inputEmail4">Email</label>
                                                <input type="email" class="form-control" id="inputEmail4"
                                                       placeholder="Email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="inputAddress">Mobile Number</label>
                                                <input type="text" class="form-control" name="phone" id="inputAddress"
                                                       placeholder="+94....." ">
                                            </div>

                                            <div class="row">


                                                <div class="mb-3 col-md-2">
                                                    <label class="form-label" for="inputZip">Zip</label>
                                                    <input type="text" class="form-control" name="zip" id="inputZip" ">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="btn-updateProfile">Save
                                                changes
                                            </button>
                                            <?php if (!empty($msg1)) {
                                                echo "<script>swal('success', '$msg1', 'success');</script>";
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

</html>