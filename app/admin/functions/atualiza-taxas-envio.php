<?php 
session_start();
require "../../user/functions/conexao.php";

$criado = date("Y-m-d");

$sqlDesativaPesos = "UPDATE configPesos SET ativo = '0' WHERE tipoValor = 'TaxaServico'";
$query_sqlDesativaPesos = mysqli_query($con, $sqlDesativaPesos);

for ($i=0; $i <= count($_POST['pesoMin']); $i++) {

	$pesoMin =  $_POST['pesoMin'][$i];
	$pesoMax =  $_POST['pesoMax'][$i];
	$vlrPeso =  $_POST['precoPeso'][$i];

	if($pesoMin != '' && $pesoMax != '' && $vlrPeso != ''){

		$sql = "INSERT INTO configPesos 
		(pesoMin, pesoMax, vlrPeso, tipoValor, data, ativo) VALUES 
		('$pesoMin', '$pesoMax', '$vlrPeso', 'TaxaServico', '$criado', '1')";

		$query = mysqli_query($con, $sql);

	}
	
}


header("Location: ../configuracoes.php");
exit;

?>