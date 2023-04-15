<?php 
session_start();
require "../../user/functions/conexao.php";

$recusar = $_GET['r'];
$debito = $_GET['d'];
$credito = $_GET['c'];
$aprovar = $_GET['a'];
$idtran  = $_POST['idtran'];
$vlrRecarga = $_POST['vlrRecarga'];
$idwallet = $_POST['idwallet'];
$email = $_POST['email'];
$iduser = filter_var($_POST['suite'], FILTER_SANITIZE_NUMBER_INT);
$motivo = filter_var($_POST['motivo'], FILTER_SANITIZE_STRIPPED);

if($credito){

	$sql_select_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser' ORDER BY idwallet DESC";
	$query_insert_wallet = mysqli_query($con, $sql_select_wallet);
	$row_wallet = mysqli_fetch_assoc($query_insert_wallet);

	$idwallet = $row_wallet['idwallet'];

	$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,recebe,tipoTran,status) VALUES ('$idwallet','$vlrRecarga','Credito - ($motivo)','Processando')";
	$query_insert_tran = mysqli_query($con, $sql_insert_tran);

/*	$sql_select_tran = "SELECT * FROM transacaoWallet WHERE idwallet = '$idwallet' LIMIT 1";
	$query_insert_tran = mysqli_query($con, $sql_select_tran);
	$row_tran = mysqli_fetch_assoc($query_insert_tran);

	$idtran = $row_tran['idtran'];

	/*$saldo_atual = $row_wallet['saldo'];
	$saldo = $saldo_atual + $vlrRecarga;

	$sql_credito = "UPDATE wallet SET saldo = '$saldo' WHERE idwallet = '$idwallet'";
	$query_credito = mysqli_query($con, $sql_credito);

	$subject = "Crédito na Wallet - ".$motivo;

	$message = "<html><p>Olá!</p><br>
				<p>Você recebeu um depósito de U$ ".number_format($vlrRecarga, 2, ".", ".")."!<br><br>O Valor já está disponível em sua Wallet!</p><p>Atenciosamente,</p>
				<p>Equipe ".$_SESSION['empresa']."</p></html>";*/
}

if($debito){

	$sql_select_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser' ORDER BY idwallet DESC";
	$query_insert_wallet = mysqli_query($con, $sql_select_wallet);
	$row_wallet = mysqli_fetch_assoc($query_insert_wallet);

	$idwallet = $row_wallet['idwallet'];

	$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,paga,tipoTran,status) VALUES ('$idwallet','$vlrRecarga','Debito - ($motivo)','Processando')";
	$query_insert_tran = mysqli_query($con, $sql_insert_tran);

/*
	$sql_select_tran = "SELECT * FROM transacaoWallet WHERE idwallet = '$idwallet' ORDER BY idwaller DESC LIMIT 1";
	$query_insert_tran = mysqli_query($con, $sql_select_tran);
	$row_tran = mysqli_fetch_assoc($query_insert_tran);

	$idtran = $row_tran['idtran'];

	/*$saldo_atual = $row_wallet['saldo'];
	$saldo = $saldo_atual - $vlrRecarga;

	$sql_credito = "UPDATE wallet SET saldo = '$saldo' WHERE idwallet = '$idwallet'";
	$query_credito = mysqli_query($con, $sql_credito);

	$subject = "Débito na Wallet - ".$motivo;

	$message = "<html><p>Olá!</p><br>
				<p>Foi debitado da sua conta o valor de U$ ".number_format($vlrRecarga, 2, ".", ".")." referente à: ".$motivo."!<br><br></p><p>Atenciosamente,</p>
				<p>Equipe ".$_SESSION['empresa']."</p></html>";*/
}

if($aprovar == '1'){
	
	/*$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,recebe,tipoTran,status) VALUES ('$idwallet','$vlrRecarga','$motivo','Aprovado')";
	$query_insert_tran = mysqli_query($con, $sql_insert_tran);*/

	$sql_select_wallet = "SELECT * FROM wallet WHERE idwallet = '$idwallet' ORDER BY idwallet DESC";
	$query_insert_wallet = mysqli_query($con, $sql_select_wallet);
	$row_wallet = mysqli_fetch_assoc($query_insert_wallet);

	$sql_update_tran = "UPDATE transacaoWallet SET status = 'Finalizado' WHERE idtran = '$idtran'";
	$query_update_tran = mysqli_query($con, $sql_update_tran);

	$saldo_atual = $row_wallet['saldo'];
	$saldo = $saldo_atual + $vlrRecarga;

	$sql_credito = "UPDATE wallet SET saldo = '$saldo' WHERE idwallet = '$idwallet'";
	$query_credito = mysqli_query($con, $sql_credito);

	$subject = "Crédito na Wallet - Recarga - Transação: ".$idtran;

	$message = "<html><p>Olá!</p><br>
				<p>Sua recarga de U$ ".number_format($vlrRecarga, 2, ".", ".")." foi aprovada!<br><br>O Valor já está disponível em sua Wallet!</p><p>Atenciosamente,</p>
				<p>Equipe ".$_SESSION['empresa']."</p></html>";

}

if($aprovar == '2'){
	
/*	$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,paga,tipoTran,status) VALUES ('$idwallet','$vlrRecarga','$motivo','Aprovado')";
	$query_insert_tran = mysqli_query($con, $sql_insert_tran);*/

	$sql_select_wallet = "SELECT * FROM wallet WHERE idwallet = '$idwallet' ORDER BY idwallet DESC";
	$query_insert_wallet = mysqli_query($con, $sql_select_wallet);
	$row_wallet = mysqli_fetch_assoc($query_insert_wallet);

	$sql_update_tran = "UPDATE transacaoWallet SET status = 'Finalizado' WHERE idtran = '$idtran'";
	$query_update_tran = mysqli_query($con, $sql_update_tran);

	$saldo_atual = $row_wallet['saldo'];
	$saldo = $saldo_atual - $vlrRecarga;

	$sql_credito = "UPDATE wallet SET saldo = '$saldo' WHERE idwallet = '$idwallet'";
	$query_credito = mysqli_query($con, $sql_credito);

	$subject = "Débito na Wallet - ".$motivo;

	$message = "<html><p>Olá!</p><br>
				<p>Foi debitado da sua conta o valor de U$ ".number_format($vlrRecarga, 2, ".", ".")." referente à: ".$motivo."!<br><br></p><p>Atenciosamente,</p>
				<p>Equipe ".$_SESSION['empresa']."</p></html>";


	## Verificando se Existe um comprovante de Pagamento ##
	$sql_select_comp = "SELECT * FROM comprovantes WHERE idtran = '$idtran'";
	$query_insert = mysqli_query($con, $sql_select_comp);
	$row_comp = mysqli_fetch_assoc($query_insert);

	$id_cmp_tran = $row_comp['idtran'];

	if($id_cmp_tran == $idtran){

		$token = date("Y-m-d H:m:s").uniqid(rand(), true);
		$codPagamento = strtoupper(substr(md5($token), 0, 15)); //Gera código de pagamento com 15 Caracteres.

		$sql_insert = "UPDATE comprovantes SET opPagamento = 'Wallet', codPagamento = '$codPagamento' WHERE idtran = '$idtran'";
		$query_insert = mysqli_query($con, $sql_insert);
		
		$subject2 = "Comprovante de Pagamento - Recarga - Transação: ".$idtran;

		$message2 = "<html><p>Olá! <br> foi adicionado um comprovante de pagamento para a sua transação #".$idtran." referente ao Pagamento de um Envio! </p><br><p>Atenciosamente,</p>
		<p>Equipe ".$_SESSION['empresa']."</p></html>";
	}

}


if($recusar){

	$sql_update_tran = "UPDATE transacaoWallet SET status = 'Recusado' WHERE idtran = '$idtran'";
	$query_update_tran = mysqli_query($con, $sql_update_tran);

	$subject = "Recarga Recusada - Transação: ".$idtran;

	$message = "<html><p>Olá!</p><br>
				<p>Sua recarga de U$ ".number_format($vlrRecarga, 2, ".", ".")." foi recusada pelo Administrador!<br>Para mais informações entre em contato pelo email ".$_SESSION['contato']."<br></p><p>Atenciosamente,</p>
				<p>Equipe ".$_SESSION['empresa']."</p></html>";
}

// Acresentar Email de Notificação
$to = $email;
//$subject = "Comprovante de Pagamento - Envio: ".$idEnvio;
/*$message = "<html><p>Equipe ".$_SESSION['empresa'].", <br> o cliente da suíte #".$iduser." adicionou um comprovante de Pagamento ao Envio Nº: ".$idEnvio." </p><br><p>Atenciosamente,</p>
<p>Solutionsbox Mail System</p></html>";*/

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=UTF-8';

// Additional headers
$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));

if($message2 != ''){
	mail($to, $subject2, $message2, implode("\r\n", $headers));
}

//redireciona de volta para a pagina
header("Location: ../wallet.php?t=".$idtran);
?>