<?php 

session_start();
require "../../user/functions/conexao.php";

if(isset($_POST)){

	if($_POST['Cotacao-ativo'] == 'on'){
		$cotacao = 1;
	} else {
		$cotacao = 0;
	}


	$sqlUpdate = "UPDATE Configuracoes SET cotacao = '$cotacao'";
	$queryUpdate = mysqli_query($con, $sqlUpdate);

}

header("Location: ../configuracoes.php");

?>