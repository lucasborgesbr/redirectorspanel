<?php 
session_start();
require "conexao.php";

$iduser = $_COOKIE['id_user'];
// echo "<pre>";
// print_r($_POST); 
// exit();
$idwallet = $_POST['idwallet'];
$vlrRecarga = $_POST['vlrRecarga'];
$tipoTran = $_POST['tipoTran'];
$opcaopgto = $_POST['opcaopgto'];
$cpfPagador = $_POST['cpfPagador'];
$motivo = mysqli_real_escape_string($con, $_POST['motivoRecarga']);

$valorPorcentagem = ($vlrRecarga*7)/100;
$valorConvertido = $_SESSION['USDT-BRL-Compra'] * ($vlrRecarga+$valorPorcentagem);
$valorreal = $valorConvertido;

if($tipoTran == "Pedido de Recarga"){
	$sqlPedido = "INSERT INTO transacaoWallet (idwallet,recebe,tipoTran,status,opPagamento,cpfPagador,motivoRecarga,vlrReal) VALUES ('$idwallet','$vlrRecarga','$tipoTran','Aguardando Pagamento','$opcaopgto','$cpfPagador', '$motivo', '$valorreal')";
	
	$query = mysqli_query($con, $sqlPedido) or die(mysqli_error($con));

	$recuperaPedido = "SELECT idtran FROM transacaoWallet WHERE idwallet = '$idwallet' ORDER BY idtran DESC LIMIT 1";

	$queryRecuperaRecarga = mysqli_query($con, $recuperaPedido) or die(mysqli_error($con));
	$row_RecuperaRecarga = mysqli_fetch_assoc($queryRecuperaRecarga);
}

header("Location: ../wallet.php?t=".$row_RecuperaRecarga['idtran']);
?>