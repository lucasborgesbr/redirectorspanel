<?php 
session_start();
require "../../user/functions/conexao.php";

// echo "<pre>";
// print_r($_POST); 
// exit();

$criado = $_POST['criado'];
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];


$sql = "INSERT INTO notificacoes (conteudo, titulo, criado) VALUES ('$conteudo', '$titulo', '$criado')";
$query = mysqli_query($con, $sql);


header("Location: ../notifications.php");
 ?>