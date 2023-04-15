<?php 
session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];
// echo "<pre>";
// print_r($_POST); 
// exit();
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];
$cep = $_POST['cep'];

$sql = "INSERT INTO enderecos (iduser, rua, numero, bairro, complemento, cidade, estado, pais, cep) VALUES ('$iduser', '$rua', '$numero', '$bairro','$complemento', '$cidade', '$estado', '$pais', '$cep')";
$query = mysqli_query($con, $sql);

header("Location: ../user.php");
 ?>