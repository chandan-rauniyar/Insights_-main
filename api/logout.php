<?php
session_start();

// Unset all session variables
$_SESSION = array();
unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
unset($_SESSION["profile_pic"]);
session_destroy();
header("Location: ../index.php");
exit();
?>