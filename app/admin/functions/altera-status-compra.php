<?php 
session_start();
require "../../user/functions/conexao.php";
// echo "<pre>";
// print_r($_POST);
// exit();

$idcompra = $_POST['idcompra'];
$status = $_POST['status'];

//atualiza senha
$sql = "UPDATE compras SET status = '$status' WHERE idcompra = '$idcompra'";
$query = mysqli_query($con, $sql);
	header("Location: ../compras.php");		
?>