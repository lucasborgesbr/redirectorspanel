<?php 
session_start();
require "conexao.php";
require "functions.php";

 //echo "<pre>";
 //print_r($_POST); 
//print_r($_FILES); 
 //exit();

$idEnvio = $_POST['idEnvio'];
$txObs = $_POST['txObs'];
$admin = $_POST['admin'];
$dtAtual = date("Y-m-d H:m:s");
$emailUser = $_POST['email'];
$nomeUser = $_POST['nome'];

$sql_obs = "INSERT INTO observacoes (idEnvio, txObs, dtObs, admin) VALUES ('$idEnvio', '$txObs', '$dtAtual', '$admin')";
$query_obs = mysqli_query($con, $sql_obs) or die(mysqli_error());


if($admin == '1'){

	$to = $emailUser;
	$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';
	
} else if($admin == '0') {

	$to = $_SESSION['contato'];
	$headers[] = 'From: '.$nomeUser.' <'.$emailUser.'>';
}

// Subject
$subject =  'Observações do Envio '.$idEnvio.' - '.$_SESSION['empresa'];

// Message
$message = '
<html>
<head>
<head>
</head>
<body>
  <img src="'.$_SESSION['logo'].'" width="200" style="margin-bottom:20px;">
  <h3>Olá!</h3>
  <p>Foi adicionado uma nova mensagem ao ao envio '.$idEnvio.'</p>

<p>Qualquer dúvida entre em contato conosco.
Estamos aqui a sua disposição.
</p>
<p>Atenciosamente,</p>
<p>Equipe '.$_SESSION['empresa'].'</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));

header("Location: ../visualizar-envios.php?idenvio=".$idEnvio);
 ?>