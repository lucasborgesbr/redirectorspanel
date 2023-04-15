<?php 
session_start();
require "../../user/functions/conexao.php";

// echo "<pre>";
// print_r($_POST); 
// exit();

$iduser_tipo = $_POST['iduser_tipo'];
$tipo = $_POST['tipo'];

$sql = "UPDATE users SET type = '$tipo' WHERE iduser = '$iduser_tipo'";
$query = mysqli_query($con, $sql);


header("Location: ../users.php");
 ?>