<?php 
session_start();
require "../../user/functions/conexao.php";
// echo "<pre>";
// print_r($_POST); 
// exit();

$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$zipcode = $_POST['zipcode'];
$pais = $_POST['pais'];


$sql = "UPDATE admins SET endereco = '$endereco', cidade = '$cidade', estado = '$estado', pais = '$pais', cep = '$zipcode' WHERE idadmin = '1'";

//atualiza senha
$query = mysqli_query($con, $sql);
	header("Location: ../dashboard.php");		
?>