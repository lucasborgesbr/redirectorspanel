<?php 
session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];

$diretorio = "../assets/img/comprovantes/";

$suite = $iduser;
$loja = $_POST['loja'];
$tracking = $_POST['tracking'];
$valorcompra = $_POST['valorcompra'];
$numerocaixas = $_POST['numerocaixas'];

// echo "<pre>";
// var_dump($_POST);
// var_dump($_FILES);
// echo "</pre>";
// exit();

	$uploadfile = $diretorio.basename($_FILES['comprovante']['name']);
	//enviar o arquivo para a pasta
	move_uploaded_file($_FILES['comprovante']['tmp_name'], $uploadfile);
	//adiciona nome do arquivo a base de dados
	$file_name = basename($_FILES['comprovante']['name']); 


$sql = "INSERT INTO redirecionamento (suite, loja, tracking, valorcompra, numerocaixas, comprovante) VALUES 
(
    '$suite',
    '$loja',
    '$tracking',
    '$valorcompra',
    '$numerocaixas',
    '$file_name'
    )";
$query = mysqli_query($con, $sql) or die($con);

//redireciona de volta para a pagina
header("Location: ../redirecionamento.php");

?>