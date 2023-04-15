<?php 
$idca = $_GET['id'];
	require ("../../user/functions/conexao.php");
	$sql = "DELETE FROM compras WHERE idcompra = '$idca'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../compras.php");
 ?>