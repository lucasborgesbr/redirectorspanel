<?php 
session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];
// echo "<pre>";
// print_r($_POST); 
// exit();

$idenvio = $_POST['idenvio'];
$codigo = $_POST['codigo'];

$sql = "UPDATE envios SET codigopgto = '$codigo' WHERE idenvio = '$idenvio'";
$query = mysqli_query($con, $sql);


header("Location: ../envios.php");
 ?>