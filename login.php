<?php session_start(); ?>
<?php include './config/conn.php'; ?>
<?php include './res/function.php'; ?>





<?php
if (isset($_POST['btn-login'])) {
    //Declaring variables and assign empty values
    $email = '';
    $password = '';
    $msg = '';
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $msg .= 'All field to be requred';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg .= 'Invalid email address';
    } else {
        $email = input_varify($_POST['email']);
        $password = input_varify($_POST['password']);
        $query1 = "SELECT * FROM user WHERE email = '{$email}' AND  pwd = '{$password}' LIMIT 1";

        $ShowResult = mysqli_query($connection, $query1);
        $data = mysqli_fetch_array($ShowResult);
        // $user_id=$data['user_id'];
        //echo $user_id;


        if ($ShowResult) {
            if (mysqli_num_rows($ShowResult) == 1) {
                $user_id = $data['user_id'];
                $_SESSION['id'] = $user_id;

                $query2 = "SELECT user.user_id,permission.roletype FROM user INNER JOIN permission ON user.roleid=permission.roleid where user_id='{$user_id}'";

                $data = mysqli_fetch_assoc(mysqli_query($connection, $query2));
                $userType = $data['roletype'];

                //update last login record
                $query3 = "UPDATE  login_record SET last_login = now() WHERE user_id = '{$user_id}' LIMIT 1";
                $ShowResult = mysqli_query($connection, $query3);
                if (!$ShowResult) {
                    die($mag = 'Database query failed.');
                }

                switch ($userType) {
                    case 'SUPER-ADMIN':
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['userType'] = $userType;
                        header('Location: ./auth/super-admin/super-admin_dashboard.php?page=dashboard?userType=' . $userType);
                        break;
                    case 'ADMIN':
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['userType'] = $userType;
                        header('Location: ./auth/admin/admin_dashboard.php?page=dashboard?userType=' . $userType);
                        break;
                    case 'MANAGER':
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['userType'] = $userType;
                        header('Location: ./auth/mannager/manager_dashboard.php?page=dashboard?userType=' . $userType);
                        break;
                    case 'PUMPER':
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['userType'] = $userType;
                        header('Location:./auth/pumper/pumper.php?page=dashboard?userType=' . $userType);
                        break;
                    default:
                        $msg .= 'Invalid user type';
                        break;
                }


            } else {
                $msg = 'login failed';

            }
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

?>





<?php
// check for form submission
//if (isset($_POST['btn-login'])) {
// $errors = array();
// // check if the username and password has been entered
// if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
// 	$errors[] = 'Username is Missing / Invalid';
// }
// if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
// 	$errors[] = 'Password is Missing / Invalid';
// }
// // check if there are any errors in the form
// if (empty($errors)) {
// 	// save username and password into variables
// 	$email 		= mysqli_real_escape_string($connection, $_POST['email']);
// 	$password 	= mysqli_real_escape_string($connection, $_POST['password']);
// 	$hashed_password = sha1($password);
// 	// prepare database query
// 	$query = "SELECT * FROM user
// 				WHERE email = '{$email}'
// 				AND password = '{$hashed_password}'
// 				LIMIT 1";
// 	$result_set = mysqli_query($connection, $query);
// 	verify_query($result_set);
// 	if (mysqli_num_rows($result_set) == 1) {
// 		// valid user found
// 		$user = mysqli_fetch_assoc($result_set);
// 		$_SESSION['user_id'] = $user['id'];
// 		$_SESSION['first_name'] = $user['first_name'];
// 		// updating last login
// 		$query = "UPDATE user SET last_login = NOW() ";
// 		$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";
// 		$result_set = mysqli_query($connection, $query);
// 		verify_query($result_set);
// 		// redirect to users.php
// 		header('Location: users.php');
// 	} else {
// 		// user name and password invalid
// 		$errors[] = 'Invalid Username / Password';
// 	}
// }
//}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once './res/link.php'; ?>

    <link rel="stylesheet" href="css/new.css">
    <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</head>

<body>


<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-8 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-4 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-10 mx-auto">


                            <h4 class="display-4">Login</h4>

                            <p class="text-muted mb-4">Sign in to your account</p>


                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email address</label>
                                    <input type="email" class="form-control mt-2" name="email"
                                           id="exampleFormControlInput1"  placeholder="name@example.com">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="exampleFormControlInput1">Password</label>
                                    <input type="password" class="form-control mt-2" name="password"
                                           id="exampleFormControlInput1" placeholder="password">
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Remember password</label>

                                </div>
                                <button type="submit"
                                        class="btn btn-primary btn-block text-uppercase mb-2  shadow-sm"
                                        name="btn-login">Login
                                </button>
                                <?php if (!empty($msg)) {
                                    echo "<script>swal('Error!', '$msg', 'error');</script>";
                                } ?>

                                <div class="text-center d-flex justify-content-between mt-4">
                                    <a class="small" href="auth/admin/admin_dashboard.php">Forgot password?</a>
                                </div>


                            </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
</body>

</html>