<?php  
require "../../user/functions/conexao.php";

session_start();
$cookie_name = '_id_admin';
unset($_COOKIE[$cookie_name]);
setcookie($cookie_name, "", time() - (86400 * 60), "/"); // 86400 = 1 day
session_destroy();

if($_GET['redir'] == '1'){
	$email = $_GET['em'];
	$senha = $_GET['ps'];
} else {
	$email = $_POST['email'];
	$senha = md5($_POST['password']);
}

$now = date("Y-m-d");

//verifica se existe cadastro
$sql = "SELECT email, senha, idadmin FROM admins WHERE email = '$email' AND senha = '$senha'";
$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) > 0) {
	
	$admin = mysqli_fetch_assoc($query);

	session_start();
	$cookie_name = '_id_admin';
	$cookie_value = $admin['idadmin'];

	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	
	$link = $_SESSION['link'];
	if($_GET['redir'] == '1'){
		$redirect = '../dashboard.php';
	} else {
		$redirect = $link.$_POST['redirect'];
	}
	
	header("Location: ".$redirect);				
} else {
	header("Location: ../login.php?email=".$email."&e&utm=".md5($email));
} 
?> 