<?php include_once('./res/conn.php');?>
<?php

    if(isset($_POST['submit'])){

        //Declaring variables and assign empty values
        $firstname = "";
        $lastname = "";
        $email = "";
        $password = "";
        $msg = "";

        $firstname = input_varify($_POST['firstname']);
        $lastname = input_varify($_POST['lastname']);
        $email = input_varify($_POST['email']);
        $password = input_varify($_POST['password']);

        $query1 = "SELECT * FROM TBL_User WHERE Fname = '{$firstname}' AND email = '{$email}'";

        $ShowResult = mysqli_query($conn, $query1);

        if($ShowResult){

            if(mysqli_num_rows($ShowResult) == 1){

                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Sorry!</strong> This user already have in this system.Please try another email account.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";

            }
            else{

                $query = "INSERT INTO TBL_User(Fname,Lname,email,pwd,Reg_DT) VALUES( 
                    '{$firstname}','{$lastname}','{$email}','{$password}',NOW()
                )";
        
                
                $result = mysqli_query($conn, $query);
        
                if($result){
                    
                    $msg = "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                    <strong>User Registration Success!</strong> Welcome to the DevTubes Community.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
        
                }
                else{
                    echo mysqli_error($conn);
                }

            }

        }

    }


    function input_varify($data){
        //Remove empty spece from user input
        $data = trim($data);
        //Remove back slash from user input
        $data  = stripslashes($data);
        //conver special chars to html entities
        $data = htmlspecialchars($data);

        return $data;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Plugin/bootstrap.min.css">
    <script src="Plugin/jquery.min.js"></script>
    <script src="Plugin/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/sign_up.css">
    <title>Blog App</title>
</head>
<body>

    <?php include_once('inc/navbar.php')?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mt-4">
                    <div class="card-header" id="card-header">
                        <h4>Sign Up Form</h4>
                    </div>
                    <div class="card-body" id="card-body">

                    <form action="sign_up.php" method="POST" autocomplete="off">

                        <?php if(!empty($msg)){echo $msg;}?>

                        <div class="form-group">
                          <label for="">First Name</label>
                          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Enter your first name</small>
                        </div>

                        <div class="form-group">
                          <label for="">Last Name</label>
                          <input type="text" name="lastname" id="lastname" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Enter your last name</small>
                        </div>

                        <div class="form-group">
                          <label for="">Email</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Enter your email address</small>
                        </div>

                        <div class="form-group">
                          <label for="">Password</label>
                          <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Create your own password</small>
                        </div>

                    </div>
                    <div class="card-footer" id="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                    </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>