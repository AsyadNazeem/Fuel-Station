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
    $sql = "SELECT * FROM USER WHERE user_id='{$user_id}' AND username is null";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) == 1){
        echo "<script>alert('Please complete your profile first!');</script>";
        $msg2='Please complete your profile first!';


        header('Location: ../../auth/mannager/profileUpdate.php');
        echo "<script>swal('Error!', '$msg2', 'error');</script>";
    }else{

        echo "<script>swal('Success!', 'Profile completed!', 'success');</script>";

    }
?>


<?php
$sql = "
select user.email,user.username,userInfo.fname,userInfo.lname,userInfo.zip,userInfo.phone from user inner join userinfo on user.user_id=userinfo.user_id where user.user_id='{$user_id}'";
$result = mysqli_query($connection, $sql);
if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $zip = $row['zip'];
    $phone = $row['phone'];
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
                                            Account
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
                                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                                        <div class="card">
                                            <div class="card-header">

                                                <h5 class="card-title mb-0">Public info</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="profile.php" method="post">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                       for="inputUsername">User ID</label>
                                                                <input type="text" class="form-control" id="user_id" value="<?php echo $_SESSION['user_id']; ?>" disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                       for="inputUsername">Username</label>
                                                                <input type="text" class="form-control"
                                                                       id="inputUsername" placeholder="Username" name="username" value="<?php echo $username ?>" disabled>
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



                                                </form>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">

                                                <h5 class="card-title mb-0">Private info</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="profile.php" method="post">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="inputFirstName">First
                                                                name</label>
                                                            <input type="text" class="form-control" id="inputFirstName"
                                                                   placeholder="First name" name="fname" value="<?php echo $fname ?>" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="inputLastName">Last
                                                                name</label>
                                                            <input type="text" class="form-control" id="inputLastName"
                                                                   placeholder="Last name" name="lname" value="<?php echo $lname ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4"
                                                               placeholder="Email" name="email" value="<?php echo $email ?>"  disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputAddress">Mobile Number</label>
                                                        <input type="text" class="form-control" name="phone" id="inputAddress"
                                                               placeholder="+94....." value="<?php echo $zip ?>" disabled>
                                                    </div>

                                                    <div class="row">


                                                        <div class="mb-3 col-md-2">
                                                            <label class="form-label" for="inputZip">Zip</label>
                                                            <input type="text" class="form-control" name="zip" id="inputZip" value="<?php echo $username ?>" disabled>
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

</html>