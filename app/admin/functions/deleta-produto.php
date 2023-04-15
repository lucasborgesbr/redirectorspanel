<?php 
$id = $_GET['id'];
	require ("../../user/functions/conexao.php");
	$sql = "DELETE FROM produtos WHERE idproduto = '$id'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../produtos.php");
 ?>