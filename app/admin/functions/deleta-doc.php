<?php 
$id = $_GET['id'];
	require ("../../user/functions/conexao.php");
	$sql = "DELETE FROM docs WHERE iddoc = '$id'";
	$query = mysqli_query($con, $sql);
	
header("Location: ../users.php");
 ?>