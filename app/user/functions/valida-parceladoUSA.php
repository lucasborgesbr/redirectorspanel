<?php 

require "conexao.php";
require "conf_email.php";
$apiLink = 'https://parceladousa.com/API/v1/payverify/approvedverify';

if($_POST){

	if($_POST['idenvio']){
		$idSource = $_POST['idenvio'];
	} else
	if($_POST['idtran']){
		$idSource = $_POST['idtran'];
	}

	$authcode = $_POST['authcode']; 
	$idcompra = $_POST['idcompra'];
	$tipo = $_POST['tipo'];
	$msg = $_POST['msg'];
	$source = $_POST['source']; 
	$iduser = $_POST['iduser'];

	$param = array(

		'id'		=>	$idcompra,
		'authcode'	=>	$authcode
	);


	//if($tipo == 'B'){

	$sqlBoletoPendente = "INSERT INTO boletos (source, idSource, idParc, authcodeParc, iduser, tipo) VALUES ('$source', '$idSource', '$idcompra', '$authcode', '$iduser','$tipo')";
	$queryBoleto = mysqli_query($con, $sqlBoletoPendente);

	//}

	$jsonPost = json_encode($param);
	
	$ch = curl_init($apiLink); 
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	$result = curl_exec($ch);
	curl_close($ch);

	echo $result;


} else {


	$sqlLerBoletos = "SELECT * FROM boletos WHERE pendente = 1 AND tipo = 'B'";
	$queryBoletos = mysqli_query($con, $sqlLerBoletos);
	$numBoletosPendentes = mysqli_num_rows($queryBoletos);
	$numBoletosBaixados = 0;

	do{
		if($row_boletos['idBoleto'] != ''){

			$idEnvio = '';
			$idtran = '';
			$file_name = '';
			$opPagamento = 'ParceladoUSA';
			$codPagamento = $row_boletos['authcodeParc'];
			$subject = '';
			$message = '';

			$param = array(

				'id'		=>	$row_boletos['idParc'],
				'authcode'	=>	$row_boletos['authcodeParc']
			);

			$jsonPost = json_encode($param);
			
			$ch = curl_init($apiLink); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
			$result = curl_exec($ch);
			curl_close($ch);
			$resultado = json_decode($result);

			if($resultado->cod == '200'){

				$idBoleto = $row_boletos['idBoleto'];
				
				$sqlUpdateBoleto = "UPDATE boletos SET pendente = 0 WHERE idBoleto = '$idBoleto'";
				$queryUpdateBoleto = mysqli_query($con, $sqlUpdateBoleto);
				$numBoletosBaixados++;

				$iduser = $row_boletos['iduser'];
				$sqlUserInfo = "SELECT * FROM users WHERE iduser = '$iduser'";
				$queryUserInfo = mysqli_query($con, $sqlUserInfo);
				$row_user = mysqli_fetch_assoc($queryUserInfo);

				$sqlExiteComprovante .= "SELECT * FROM comprovantes WHERE ";

				if($row_boletos['source'] == 'Envios'){
					$idEnvio = $row_boletos['idSource'];
					$subject = "Boleto Pago! - Envio #".$idEnvio;
					$message = "<html><p>Equipe ".$empresa.", <br> Reconhecemos o pagamento do Boleto referente ao Envio #".$idEnvio." para o cliente ".ucfirst($row_user['nome'])." ".ucfirst($row_user['sobrenome'])." - Suíte: ".$iduser." e o comprovante foi anexado com Sucesso! </p><br><p>Atenciosamente,</p>
					<p>Solutionsbox Mail System</p></html>";

					$sqlExiteComprovante .= "idEnvio = '$idEnvio'";

				} else
				if($row_boletos['source'] == 'Wallet'){
					$idtran = $row_boletos['idSource'];
					$subject = "Boleto Pago! - Wallet Tran#".$idtran;
					$message = "<html><p>Equipe ".$empresa.", <br> Reconhecemos o pagamento do Boleto referente ao Pagamento para a Recarga Nº: ".$idtran." para o cliente ".ucfirst($row_user['nome'])." ".ucfirst($row_user['sobrenome'])." - Suíte: ".$iduser." e o comprovante foi anexado com Sucesso! </p><br><p>Atenciosamente,</p>
					<p>Solutionsbox Mail System</p></html>";

					$sqlExiteComprovante .= "idtran = '$idtran'";
				}

				$queryExiteComprovante = mysqli_query($con, $sqlExiteComprovante);
				$numComprovantes = mysqli_num_rows($queryExiteComprovante);


				$urlAddComprovante = 'https://'.$_SERVER['HTTP_HOST'].'/app/user/functions/acrescenta-comprovante.php';

				$dataComprovante = array(
					'iduser' => $iduser,
					'opPagamento' => $opPagamento,
					'codPagamento' => $codPagamento,
					'idenvio' => $idEnvio,
					'idtran' => $idtran
				);

				$postvars = http_build_query($dataComprovante);
				$ch2 = curl_init();

				curl_setopt($ch2, CURLOPT_URL, $urlAddComprovante);
				curl_setopt($ch2, CURLOPT_POST, count($dataComprovante));
				curl_setopt($ch2, CURLOPT_POSTFIELDS, $postvars);

				if($numComprovantes <= 0){
					$result = curl_exec($ch2);
				}

				$to = $contato;

				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=UTF-8';

				$headers[] = 'From: '.$empresa.' <'.$contato.'>';

				mail($to, $subject, $message, implode("\r\n", $headers));

			}
		}
	} while($row_boletos = mysqli_fetch_assoc($queryBoletos));

	ob_flush();
	ob_start();

	date_default_timezone_set('America/Sao_Paulo');

	echo date('d/m/Y \à\s H:i:s');
	echo "\r\n";
	echo $numBoletosPendentes." Boletos Verificados \r\n".$numBoletosBaixados." Boletos Atualizados \r\n\r\n";

	file_put_contents("resultado-boletosParceladoUSA.txt", ob_get_flush(), FILE_APPEND);

}


?>