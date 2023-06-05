<?php
session_start();

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['userType']);
    header('Location: ./login.php?logout=success');
}
?>