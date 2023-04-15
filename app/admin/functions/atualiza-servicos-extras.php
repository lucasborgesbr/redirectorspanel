<?php 
session_start();
require "../../user/functions/conexao.php";

$criado = date("Y-m-d");

$sqlDesativaPesos = "UPDATE configServicosExtras SET ativo = '0'";
$query_sqlDesativaPesos = mysqli_query($con, $sqlDesativaPesos);

for ($i=0; $i < count($_POST['descServ']); $i++) {

	$descServico =  $_POST['descServ'][$i];
	$vlrServico =  $_POST['precoPeso'][$i];
	
	if($vlrServico != '' && $descServico != ''){

		$sql = "INSERT INTO configServicosExtras 
		(descServico, vlrServico, criado, ativo) VALUES 
		('$descServico', '$vlrServico', '$criado', '1')";

		$query = mysqli_query($con, $sql);

	}
	
}


header("Location: ../configuracoes.php");
exit;

?>