<?php 
$idend = $_GET['id'];
	require ("conexao.php");
	$sql = "DELETE FROM enderecos WHERE idendereco = '$idend'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../user.php");
 ?>