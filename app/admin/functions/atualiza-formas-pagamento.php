<?php 
session_start();
require "../../user/functions/conexao.php";

$paypal = $_POST['Paypal-ativo'];
$paypalme = $_POST['PaypalME-ativo'];
$ebanx = $_POST['Ebanx-ativo'];
$cambioreal = $_POST['CambioReal-ativo'];
$westernunion = $_POST['WesternUnion-ativo'];
$transferwise = $_POST['TransferWise-ativo'];
$transferencia = $_POST['Transferencia-ativo'];
$parceladoUSA = $_POST['ParceladoUSA-ativo'];
$PgtLocal = $_POST['PgtLocal-ativo'];

// Pagamento no Local

if($PgtLocal == 'on'){
	$sqlAtualizaPgtLocal = "UPDATE configFormaPagamentos SET ativo = 1 WHERE TipoPagamento = 'Pagamento no Local'";
	$queryAtualizaPgtLocal = mysqli_query($con, $sqlAtualizaPgtLocal);
} else if($PgtLocal != 'on'){
	$sqlAtualizaPgtLocal = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'Pagamento no Local'";
	$queryAtualizaPgtLocal = mysqli_query($con, $sqlAtualizaPgtLocal);
}

// PAYPAL

if($paypal == 'on'){
	
	$PaypalClientID = $_POST['Paypal-Client-ID'];
	$PaypalSecretID = $_POST['Paypal-Secret-ID'];
	$PaypalTaxa = $_POST['Paypal-taxa'];

	if($PaypalTaxa == ''){
		$PaypalTaxa = 0;
	}

	$sqlAtualizaPaypal = "UPDATE configFormaPagamentos SET key1 = '$PaypalClientID', key2 = '$PaypalSecretID', taxa = '$PaypalTaxa', ativo = 1 WHERE TipoPagamento = 'Paypal'";
	$queryAtualizaPaypal = mysqli_query($con, $sqlAtualizaPaypal);

} else if($paypal != 'on'){
	$sqlAtualizaPaypal = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'Paypal'";
	$queryAtualizaPaypal = mysqli_query($con, $sqlAtualizaPaypal);
}
//PAYPAL ME

if($paypalme == 'on'){
	
	$PaypalMEAccount = $_POST['PaypalME-Account'];
	$PaypalMETaxa = $_POST['PaypalME-taxa'];

	if($PaypalMETaxa == ''){
		$PaypalMETaxa = 0;
	}

	$sqlAtualizaPaypalME = "UPDATE configFormaPagamentos SET key1 = '$PaypalMEAccount', taxa = '$PaypalMETaxa', ativo = 1 WHERE TipoPagamento = 'Paypal.me'";
	$queryAtualizaPaypalME = mysqli_query($con, $sqlAtualizaPaypalME);

} else if($paypalme != 'on'){
	$sqlAtualizaPaypalME = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'Paypal.me'";
	$queryAtualizaPaypalME = mysqli_query($con, $sqlAtualizaPaypalME);
}

// EBANX 

if($ebanx == 'on'){
	
	$EbanxAPI = $_POST['Ebanx-API'];
	$EbanxTaxa = $_POST['Ebanx-taxa'];

	if($EbanxTaxa == ''){
		$EbanxTaxa = 0;
	}

	$sqlAtualizaEbanx = "UPDATE configFormaPagamentos SET key1 = '$EbanxAPI', taxa = '$EbanxTaxa', ativo = 1 WHERE TipoPagamento = 'Ebanx'";
	$queryAtualizaEbanx = mysqli_query($con, $sqlAtualizaEbanx);

} else if($ebanx != 'on'){
	$sqlAtualizaEbanx = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'Ebanx'";
	$queryAtualizaEbanx = mysqli_query($con, $sqlAtualizaEbanx);
}

// CAMBIOREAL 

if($cambioreal == 'on'){
	
	$CRAppIDLive = $_POST['CR-App-ID-Live'];
	$CRAppSecretLive = $_POST['CR-App-Secret-Live'];
	$CRTaxa = $_POST['CR-taxa'];

	if($CRTaxa == ''){
		$CRTaxa = 0;
	}

	$sqlAtualizaCambioReal = "UPDATE configFormaPagamentos SET key1 = '$CRAppIDLive', key2 = '$CRAppSecretLive', taxa = '$CRTaxa', ativo = 1 WHERE TipoPagamento = 'CambioReal'";
	$queryAtualizaCambioReal = mysqli_query($con, $sqlAtualizaCambioReal);

} else if($cambioreal != 'on'){
	$sqlAtualizaCambioReal = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'CambioReal'";
	$queryAtualizaCambioReal = mysqli_query($con, $sqlAtualizaCambioReal);
}

// WESTERNUNION 

if($westernunion == 'on'){
	
	$WUnome = $_POST['WU-nome'];
	$WUcidade = $_POST['WU-cidade'];
	$WUestado = $_POST['WU-estado'];
	$WUpais = $_POST['WU-pais'];

	$WUFinal = $WUnome."∞".$WUcidade."∞".$WUestado."∞".$WUpais; 


	$sqlAtualizaWesternUnion = "UPDATE configFormaPagamentos SET key1 = '$WUFinal', ativo = 1 WHERE TipoPagamento = 'WesternUnion'";
	$queryAtualizaWesternUnion = mysqli_query($con, $sqlAtualizaWesternUnion);

} else if($westernunion != 'on'){
	$sqlAtualizaWesternUnion = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'WesternUnion'";
	$queryAtualizaWesternUnion = mysqli_query($con, $sqlAtualizaWesternUnion);
}

// TrasnferWise 

if($transferwise == 'on'){
	
	$TWemail = $_POST['TW-email'];

	$sqlAtualizaTransferWiser = "UPDATE configFormaPagamentos SET key1 = '$TWemail', ativo = 1 WHERE TipoPagamento = 'TransferWise'";
	$queryAtualizaTransferWiser = mysqli_query($con, $sqlAtualizaTransferWiser);

} else if($transferwise != 'on'){
	$sqlAtualizaTransferWiser = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'TransferWise'";
	$queryAtualizaTransferWiser = mysqli_query($con, $sqlAtualizaTransferWiser);
}

// Transferência Brancária 

if($transferencia == 'on'){
	
	$TBbanco = $_POST['TB-banco'];
	$TBagencia = $_POST['TB-agencia'];
	$TBconta = $_POST['TB-conta'];
	$TBnome = $_POST['TB-nome'];
	$TBcpf = $_POST['TB-cpf'];

	$TBFinal = $TBbanco."∞".$TBagencia."∞".$TBconta."∞".$TBnome."∞".$TBcpf; 


	$sqlAtualizaTransferencia = "UPDATE configFormaPagamentos SET key1 = '$TBFinal', ativo = 1 WHERE TipoPagamento = 'Transferencia'";
	$queryAtualizaTransferencia = mysqli_query($con, $sqlAtualizaTransferencia);

} else if($transferencia != 'on'){
	$sqlAtualizaTransferencia = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'Transferencia'";
	$queryAtualizaTransferencia = mysqli_query($con, $sqlAtualizaTransferencia);
}

// ParceladoUSA

if($parceladoUSA == 'on'){
	
	$parceladoUSAKey = $_POST['ParceladoUSA-Publickey'];
	$parceladoUSATaxa = $_POST['ParceladoUSA-taxa'];

	if($parceladoUSATaxa == ''){
		$parceladoUSATaxa = 0;
	}
	
	$sqlAtualizaparceladoUSA = "UPDATE configFormaPagamentos SET key1 = '$parceladoUSAKey', taxa = '$parceladoUSATaxa', ativo = 1 WHERE TipoPagamento = 'ParceladoUSA'";
	$queryAtualizaparceladoUSA = mysqli_query($con, $sqlAtualizaparceladoUSA);

} else if($paypal != 'on'){
	$sqlAtualizaparceladoUSA = "UPDATE configFormaPagamentos SET ativo = 0 WHERE TipoPagamento = 'ParceladoUSA'";
	$queryAtualizaparceladoUSA = mysqli_query($con, $sqlAtualizaparceladoUSA);
}

 //echo "<pre>";
 //print_r($_POST); 
 //exit();

header("Location: ../configuracoes.php");
exit;

?>