<?

 include './config/conn.php';

 $user_id = 1;

     $query3 = "UPDATE  login_recode SET last_login = now() WHERE user_id = '{$user_id}' LIMIT 1";
 $Result = mysqli_query($connection, $query3);

    if (!$Result) {
        die('Database query failed.');
    }
    ?>