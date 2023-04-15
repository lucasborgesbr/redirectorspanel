<?php

require ("conexao.php");
require("../assets/CambioReal/autoload.php");

$sqlBuscaAPI = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'CambioReal'";
$query_BuscaAPI = mysqli_query ($con, $sqlBuscaAPI) or die(mysqli_error($con));
$row_API = mysqli_fetch_assoc($query_BuscaAPI);

$appID = $row_API['key1'];
$appSecret = $row_API['key2'];

if($row_API['sandbox'] == '0'){
	$testMode = false;
} else {
	$testMode = true;
}


\CambioReal\Config::set(array(
  'appId'      => $row_API['key1'],
  'appSecret'  => $row_API['key2'],
  'testMode'   => $testMode,
));


$notificacao = \CambioReal\CambioReal::get(array(
	'id'    => $_POST['id'],
	'token' => $_POST['token'],
));


if($notificacao->status === 'success'){

	$TipoTran = substr($notificacao->data->ref, 0, 6);

	if($TipoTran == 'Wallet'){
		$idtran = substr($notificacao->data->ref, 7, 3);
		if($idtran <= '999'){
			$idtran = substr($notificacao->data->ref, 7, 4);
			if($idtran <= '999'){
				$idtran = substr($notificacao->data->ref, 7, 3);
			} else {
				$idtran = substr($notificacao->data->ref, 7, 4);
			}
		}
	} else {
		$TipoTran = substr($notificacao->data->ref, 0, 3);
		if($TipoTran == 'Env'){
			$idtran = substr($notificacao->data->ref, 4, 3);
			if($idtran <= '999'){
				$idtran = substr($notificacao->data->ref, 4, 4);
				if($idtran <= '999'){
					$idtran = substr($notificacao->data->ref, 4, 3);
				} else {
					$idtran = substr($notificacao->data->ref, 4, 4);
				}
			}
		}
	}


	if($notificacao->data->status == 'SOLICITACAO_PAGO' || $notificacao->data->status == 'SOLICITACAO_FINALIZADA'){

		$codComprovante = $_POST['token'];
		$opPagamento = 'CambioReal';

		if($TipoTran == 'Wallet'){
			$sqlComprovantes = "SELECT * FROM comprovantes WHERE idtran = '$idtran'";
		}

		if($TipoTran == 'Env'){
			$sqlComprovantes = "SELECT * FROM comprovantes WHERE idEnvio = '$idtran'";
		}

		$querysqlComprovantes = mysqli_query ($con, $sqlComprovantes);
		//$row_cmp = mysqli_fetch_assoc($querysqlComprovantes);
		$qtdComprovantes = mysqli_num_rows($querysqlComprovantes);



		if($qtdComprovantes <= 0){
			if($TipoTran == 'Wallet'){

				$sqlInsertComprovantes = "INSERT INTO comprovantes (opPagamento, codPagamento, idtran) VALUES ('$opPagamento', '$codComprovante', '$idtran')";
				$queryInsertComprovantes = mysqli_query ($con, $sqlInsertComprovantes);
				
				$sqlComprovantes = "SELECT * FROM comprovantes WHERE idtran = '$idtran'";
				$querysqlComprovantes1 = mysqli_query ($con, $sqlComprovantes);
				$row_cmp1 = mysqli_fetch_assoc($querysqlComprovantes1);

				$idComprovante = $row_cmp1['idComprovante'];

				$sqlAtualizaTran = "UPDATE transacaoWallet SET status = 'Processando', idComprovante = '$idComprovante' WHERE idtran = '$idtran'";
				$queryAtualizaTran = mysqli_query ($con, $sqlAtualizaTran);
				

			}

			if($TipoTran == 'Env'){
				$sqlInsertComprovantes = "INSERT INTO comprovantes (opPagamento, codPagamento, idEnvio) VALUES ('$opPagamento', '$codComprovante', '$idtran')";
				$queryInsertComprovantes = mysqli_query ($con, $sqlInsertComprovantes);
			}

			
		}
	}

}




ob_flush();
ob_start();

print_r($_POST);

print_r($notificacao);

print_r($TipoTran);
print_r($idtran);

file_put_contents("cambioreal-resultado.txt", ob_get_flush(), FILE_APPEND);

?>