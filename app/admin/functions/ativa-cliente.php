<?php 
session_start();
require "../../user/functions/conexao.php";
$iduser = $_GET['id'];
// echo "<pre>";
// print_r($_POST); 
// exit();

$sql = "UPDATE users SET status = 'active' WHERE iduser = '$iduser'";
$query = mysqli_query($con, $sql);


header("Location: ../users.php");
 ?>