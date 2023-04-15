<?php 
session_start();
require "conexao.php";

if(!$_POST['iduser']){
	$iduser = $_COOKIE['id_user'];
} else {
	$iduser = $_POST['iduser'];
}

$diretorio = "../assets/img/comprovantes/";

$idEnvio = $_POST['idenvio'];
$opPagamento = $_POST['opPagamento'];
$comprovante = $_POST['comprovante'];
$codPagamento = $_POST['codPagamento'];
$idtran = $_POST['idtran'];

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
//exit();

if ($_FILES['comprovante']['name'] != "") {
	$uploadfile = $diretorio.$idEnvio."_". basename($_FILES['comprovante']['name']);
	//enviar o arquivo para a pasta
	move_uploaded_file($_FILES['comprovante']['tmp_name'], $uploadfile);
	//adiciona nome do arquivo a base de dados
	$file_name = $idEnvio."_". basename($_FILES['comprovante']['name']); 
} else {
	$file_name = '';
}

if($idEnvio != ''){

$sql = "INSERT INTO comprovantes (idEnvio, comprovante, opPagamento, codPagamento) VALUES ('$idEnvio', '$file_name', '$opPagamento', '$codPagamento')";
$query = mysqli_query($con, $sql) or die($con);
$subject = "Comprovante de Pagamento - Envio: ".$idEnvio;

$message = "<html><p>Equipe ".$_SESSION['empresa'].", <br> o cliente da suíte #".$iduser." adicionou um comprovante de Pagamento ao Envio Nº: ".$idEnvio." </p><br><p>Atenciosamente,</p>
<p>Solutionsbox Mail System</p></html>";

// Acresentar Email de Notificação
$to = $_SESSION['contato'];

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=UTF-8';

// Additional headers
$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));

}


if($idtran != ''){

$sql_insert = "INSERT INTO comprovantes (idtran, comprovante, opPagamento, codPagamento) VALUES ('$idtran', '$file_name', '$opPagamento', '$codPagamento')";
$query_insert = mysqli_query($con, $sql_insert);
$subject = "Comprovante de Pagamento - Recarga - Transação: ".$idtran;

$message = "<html><p>Equipe ".$_SESSION['empresa'].", <br> o cliente da suíte #".$iduser." adicionou um comprovante de Pagamento para a Recarga Nº: ".$idtran." </p><br><p>Atenciosamente,</p>
<p>Solutionsbox Mail System</p></html>";

$sql_select_comp = "SELECT * FROM comprovantes WHERE idtran = '$idtran'";
$query_insert = mysqli_query($con, $sql_select_comp);
$row_comp = mysqli_fetch_assoc($query_insert);

$idComprovante = $row_comp['idComprovante'];

$sql_status = "UPDATE transacaoWallet SET status = 'Processando', idComprovante = '$idComprovante' WHERE idtran = '$idtran'";
$query_status = mysqli_query($con, $sql_status);

// Acresentar Email de Notificação
$to = $_SESSION['contato'];

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=UTF-8';

// Additional headers
$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));

//redireciona de volta para a pagina
header("Location: ../wallet.php?t=".$idtran);

} else {

//redireciona de volta para a pagina
header("Location: ../visualizar-envios.php?idenvio=".$idEnvio);}

?>
