<?php 
$id = $_GET['id'];
	require ("../../user/functions/conexao.php");
	$sql = "DELETE FROM notificacoes WHERE idnotificacao = '$id'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../notifications.php");
 ?> 