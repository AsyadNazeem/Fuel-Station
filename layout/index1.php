<?php

include '../config/conn.php';

$user_id = '87887';
$email = 'test@gm.com';
$password = '123456';
$fname = 'test';
$phone = '1234567890';



//$user_id = '2';
$query3 = "INSERT INTO user (user_id,email,pwd,roleid) VALUES ('{$user_id}','{$email}','{$password}','2')";
$result3 = mysqli_query($connection, $query3);

$query4 = "INSERT INTO userinfo (user_id, fname, phone) VALUES ('{$user_id}', '{$fname}', '{$phone}')";
$result = mysqli_query($connection, $query4);

//$data = mysqli_fetch_assoc($ShowResult);
//echo $data['user_id'];


