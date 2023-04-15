<?php 
session_start();
require ("../../user/functions/conexao.php");

$sqlRecuperarDados = "SELECT * FROM Configuracoes";
$queryDados = mysqli_query ($con, $sqlRecuperarDados) or die(mysqli_error($con));
$row_dadosEmail = mysqli_fetch_assoc($queryDados);

$empresa = $row_dadosEmail['nomeEmpresa'];
$logo = "";
$contato = $row_dadosEmail['contato'];
$link = $row_dadosEmail['link'];


// echo "<pre>";
// print_r($_POST); 
// exit();

$iduser45 = $_GET['id'];
$cod_acesso = substr(uniqid(rand()), 0, 6); //Gera Codigo de Acesso com 6 Caracteres.
$senha45 = md5($cod_acesso);

$sql45 = "UPDATE users SET senha = '$senha45' WHERE iduser = '$iduser45'";
$query45 = mysqli_query($con, $sql45);

$sqlConsulta = "SELECT * FROM users WHERE iduser = '$iduser45'";
$queryConsulta = mysqli_query($con, $sqlConsulta);

$row = mysqli_fetch_assoc($queryConsulta);

$para = $row['email'];
$titulo = 'Reset de Senha - '.$_SESSION['empresa'];
$corpo  = '
<h3><strong>Olá '.$row['nome'].'</strong></h3>
</br>
</br>
<p>Houve uma Reset de senha para sua conta.</p>
<p>Nova Senha:</p>
<p>
<h3>'.$cod_acesso.'</h3>
<p>Você pode Acessar o Sistema e Alterar sua senha Sempre que precisar.</p>
<p>Qualquer dúvida entre em contato conosco. Estamos aqui a sua disposição.</p>
<p>Atenciosamente,</p>
<br/>
<p>Equipe '.$_SESSION['empresa'].'</p>
';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>' . "\r\n";


$sent = mail($para, $titulo, $corpo,$headers);


header("Location: ../users.php?uid=".$iduser45."&rs=".$cod_acesso);		
?>