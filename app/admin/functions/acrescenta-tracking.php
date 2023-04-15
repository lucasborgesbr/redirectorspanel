<?php 
session_start();
require "../../user/functions/conexao.php"; 

 //echo "<pre>";
 //print_r($_POST); 
 //exit();

$idenvio = $_POST['idenvio'];
$tracking = $_POST['tracking'];

$sql = "UPDATE envios SET tracking = '$tracking' WHERE idenvio = '$idenvio'";
$query = mysqli_query($con, $sql);

/* FUNCAO EMAIL DE ENVIO DA CAIXA  */

//Recupera email do usuário
$sql_BuscaEmail = "SELECT email FROM users WHERE iduser = (SELECT iduser FROM envios WHERE idenvio = '".$idenvio."')";
$query = mysqli_query($con, $sql_BuscaEmail); 

?>
<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<?php

$row = $query->fetch_assoc();

$to = $row['email'];

// Multiple recipients
//$to = $email; 

// Subject
$subject = $_SESSION['empresa'].' - Notícia boa a caminho!';

// Message
$message = '
<html>
<head>
<head>
</head>
<body>
  <img src="'.$_SESSION['logo'].'" width="200" style="margin-bottom:20px;">
<p>Acabamos de enviar sua caixa para o Brasil!!!</p>

<p>Este é o seu numero do rastreio <strong>'.$tracking.'</strong><br />
Enquanto sua caixa estiver aqui nos Estados Unidos voce consegue rastrear pelo site&nbsp;<a href="https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels='.$tracking.'%2C" rel="noreferrer nofollow" target="_blank">www.usps.com</a>, ela pode demorar até 3 dias para aparecer no site da USPS,<br />
depois que ele chegar no Brasil voce consegue rastrear pelo site dos correios&nbsp;<a href="https://www2.correios.com.br/sistemas/rastreamento/default.cfm" rel="noreferrer nofollow" target="_blank">www.correios.com.br</a></p>

<p>Atenção!!! Desde 01 de Setembro de 2018 o correio decidiu cobrar uma nova tarifa nas importações.<br />
Assim que sua caixa passar pela alfandega e aparecer a mensagem "Fiscalização aduaneira finalizada", clique no link abaixo e faça seu cadastro e depois digite o seu número de rastreio.<br />
<a href="https://apps.correios.com.br/cas/login" rel="noreferrer nofollow" target="_blank">https://apps.correios.com.br/cas/login</a></p>

<p>Estamos aqui a sua disposição<br />
Atenciosamente,<br />
<strong>Equipe '.$_SESSION['empresa'].'</strong></p>

</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';

// Additional headers
$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';

// Mail it
$xyz = mail($to, $subject, $message, implode("\r\n", $headers));

if($xyz == '1'){

$redirect = "<script>$(document).ready(function(){setTimeout(function(){location.href = '../envios.php?s';}, 3000)});</script>";
echo $redirect;
} else {

$redirect = "<script>$(document).ready(function(){setTimeout(function(){location.href = '../envios.php?e';}, 3000)});</script>";
echo $redirect;

}
?>
