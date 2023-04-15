<?php 

session_start();

$cookie_name = 'id_user';
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, "", time() - (86400 * 60), "/"); // 86400 = 1 day
session_destroy();

header("Location: ../login.php");
?>