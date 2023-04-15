<?php 
session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];
// echo "<pre>";
// print_r($_POST); 
// exit();
$status = "Novo";
$criado = date("Y-m-d");
for ($i=0; $i < count($_POST['descricao']); $i++) { 
	$descricao = $_POST['descricao'][$i];
	$link = $_POST['link'][$i];
	$valor = $_POST['valor'][$i];
	$cor = $_POST['cor'][$i];
	$tamanho = $_POST['tamanho'][$i];

	$quantidade = $_POST['quantidade'][$i];
	$sql = "INSERT INTO compras 
	(iduser, descricao, link, valor, cor, tamanho, quantidade, status, criado) VALUES 
	('$iduser', '$descricao', '$link', '$valor', '$cor', '$tamanho', '$quantidade', '$status', '$criado')";
	$query = mysqli_query($con, $sql);
	
}
header("Location: ../compras.php");
 ?>