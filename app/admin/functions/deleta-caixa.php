<?php 
$id = $_GET['id'];
	require ("../../user/functions/conexao.php");
	$sql = "DELETE FROM caixas WHERE idcaixa = '$id'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../caixas.php");
 ?>