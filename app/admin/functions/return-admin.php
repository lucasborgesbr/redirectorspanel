<?
session_start();
require "../../user/functions/functions.php";

$cookie_name = 'id_user';
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, "", time() - (86400 * 60), "/");

header("Location: ../dashboard.php");

?>