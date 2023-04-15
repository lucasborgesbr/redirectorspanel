<?php 
session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];
$senha = md5($_POST['nova-senha']);
//atualiza senha
$sql = "UPDATE users SET senha = '$senha' WHERE iduser = '$iduser'";
$query = mysqli_query($con, $sql);
	header("Location: ../user.php");		
?>