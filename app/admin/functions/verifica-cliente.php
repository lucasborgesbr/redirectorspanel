<?php 
session_start();
require "../../user/functions/conexao.php";
$iduser = $_GET['id'];
 //echo "<pre>";
 //print_r($iduser); 
 //exit();

$sql = "UPDATE users SET ativo = '1', codAcesso = '' WHERE iduser = '$iduser'";
$query = mysqli_query($con, $sql); 


header("Location: ../users.php");
 ?>