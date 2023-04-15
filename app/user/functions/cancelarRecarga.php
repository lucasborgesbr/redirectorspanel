<?
require ("conexao.php");

$transacao = $_GET['t'];

$sqlHistorico = "SELECT * FROM transacaoWallet WHERE idtran = '$transacao'";
$query_historico = mysqli_query($con, $sqlHistorico);
$row_historico = mysqli_fetch_assoc($query_historico);

if($row_historico['status'] == 'Aguardando Pagamento'){

	$sqlCancelamento = "UPDATE transacaoWallet SET status = 'Cancelado' WHERE idtran = '$transacao'";
	$queryCancelamento = mysqli_query($con, $sqlCancelamento);

}

header("Location: ../wallet.php");
exit();

?>