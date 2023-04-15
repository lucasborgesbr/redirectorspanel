<?php 
$id = $_GET['id'];
	require ("conexao.php");

	$sql = "DELETE FROM redirecionamento WHERE id = '$id'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../redirecionamento.php");

 ?>