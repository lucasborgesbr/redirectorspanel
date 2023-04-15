<?php 
session_start();
require "../../user/functions/conexao.php";

// echo "<pre>";
// print_r($_POST); 
// exit();

$idenvio = $_POST['idenvio'];
$statusenvio = $_POST['statusenvio'];


if($statusenvio == 'CANCELADO'){
	
	$sql_busca_envio = "SELECT * FROM envios WHERE idenvio = '$idenvio'";
	$busca_envio_query = mysqli_query($con, $sql_busca_envio);
	$row_envios = mysqli_fetch_assoc($busca_envio_query);
	
	$dados = explode("|", $row_envios['conteudo'], -1);
	
	for ($i=0; $i < count($dados); $i++) { 
		$colunas = explode("-", $dados[$i]);

		$idproduto = $colunas[0];
		
		$sql_busca_itens = "SELECT * FROM produtos WHERE idproduto = '$idproduto'";
		$query_itens = mysqli_query($con, $sql_busca_itens);
		$row_produtos = mysqli_fetch_assoc($query_itens);

		$quantidade = $row_produtos['quantidade'] + $colunas[2];

		$sql_retorna_itens = "UPDATE produtos SET quantidade = '$quantidade' WHERE idproduto = '$idproduto'";
		$query_pdt = mysqli_query($con, $sql_retorna_itens);

	}

	if($row_envios['vlrDesconto'] != '' && $row_envios['vlrDesconto'] > 0){
		$iduser = $row_envios['iduser'];
		$recupera_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser'";
		$query_recupera_wallet = mysqli_query($con, $recupera_wallet);
		$row_wallet = mysqli_fetch_assoc($query_recupera_wallet);

		$saldoAtual = $row_wallet['saldo'];
		$vlrExtorno = $row_envios['vlrDesconto'];
		$saldoNovo = $vlrExtorno + $saldoAtual;

		$sql_extorno_wallet = "UPDATE wallet SET saldo = '$saldoNovo' WHERE iduser = '$iduser'";
		$query_extorno_wallet = mysqli_query($con, $sql_extorno_wallet);

		$idwallet = $row_wallet['idwallet'];

		$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,recebe,tipoTran,status,opPagamento) VALUES ('$idwallet','$vlrExtorno','Extorno - (Cancelamento do Envio #$idenvio)','Finalizado','Wallet')";
		$query_insert_tran = mysqli_query($con, $sql_insert_tran);
		
	}
} 


$sql = "UPDATE envios SET status = '$statusenvio' WHERE idenvio = '$idenvio'";
$query = mysqli_query($con, $sql);


header("Location: ../envios.php");
?>