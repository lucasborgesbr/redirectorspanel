<?php 
session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];
// echo "<pre>";
// print_r($_FILES); 
// exit();
$status = "Processando";
$criado = date("Y-m-d");
if ($_FILES['doc']['type'] == "image/jpg" OR $_FILES['doc']['type'] == "image/jpeg" OR $_FILES['doc']['type'] == "image/png" OR $_FILES['doc']['type'] == "application/pdf") {
		if ($_FILES['doc']['size'] <= 200000) {
		
		$diretorio = '../assets/img/docs/';
		$uploadfile = $diretorio."sib_".$iduser."_". basename($_FILES['doc']['name']);
		//enviar o arquivo para a pasta
		move_uploaded_file($_FILES['doc']['tmp_name'], $uploadfile);
		//adiciona nome do arquivo a base de dados
		$file_name = "sib_".$iduser."_". basename($_FILES['doc']['name']); 
		$sql = "INSERT INTO docs (iduser, file, criado) VALUES ('$iduser', '$file_name', '$criado')";
		$query = mysqli_query($con, $sql) or die(mysqli_error());
		header("Location: ../user.php?ok");
	} else { 
	header("Location: ../user.php?nope");
	}
}
 ?>
