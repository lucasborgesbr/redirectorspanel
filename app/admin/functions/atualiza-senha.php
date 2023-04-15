<?php 
session_start();
require "../../user/functions/conexao.php";

$senha = md5($_POST['nova-senha']);
//atualiza senha
$sql = "UPDATE admins SET senha = '$senha' WHERE idadmin = '1'";
$query = mysqli_query($con, $sql);
	header("Location: ../dashboard.php");		
?>