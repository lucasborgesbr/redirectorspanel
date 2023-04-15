<?php 
require "conexao.php";
require "conf_email.php";
$email = $_POST['email'];
$senha = md5($_POST['password']);
$now = date("Y-m-d");


//verifica se email é administrativo
$sqlVerificaAdmin = "SELECT email FROM admins WHERE email = '$email' AND senha = '$senha'";
$queryVerificaAdmin = mysqli_query($con, $sqlVerificaAdmin);

if(mysqli_num_rows($queryVerificaAdmin) > 0){

	header("Location: ../../admin/functions/processa-login.php?em=".$email."&ps=".$senha."&redir=1");
	exit;
}


//verifica se existe cadastro
$sql = "SELECT nome, email, senha, iduser, ativo, status FROM users WHERE email = '$email' AND senha = '$senha'";
$query = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($query);
if($user['status'] == 'inactive'){
	header("Location: ../login.php?ea=".$email."&w");
}
else if($user['ativo'] == '0'){

	$cod_acesso = substr(uniqid(rand()), 0, 6); //Gera Codigo de Acesso com 6 Caracteres.

	$sql_insere = "UPDATE users SET codAcesso = '$cod_acesso' WHERE email = '$email'";
	
	if(mysqli_query($con, $sql_insere)){

		$to = $user['email'];
		$subject = $empresa.' - TOKEN '.$cod_acesso;
		$message = '
		<html>
		<head>
<head>
  <title>'.$empresa.' - Código de Ativação</title>
		</head>
		<body>
		<h2>Olá '.$user['nome'].'!</h2>
		<p>Aqui está seu código de Ativação:</p>
		<p>
		<h3>'.$cod_acesso.'</h3>
		<br>
		<p>Atenciosamente,</p>
		<p>Equipe '.$empresa.'</p>
		</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';

		// Additional headers
		$headers[] = 'From: '.$empresa.' <'.$contato.'>';

		mail($to, $subject, $message, implode("\r\n", $headers));
		
	}
	header("Location: ../login.php?ea=".$email."&a");
} else if ($user) {
	session_start();
	$cookie_name = 'id_user';
	$cookie_value = $user['iduser'];

	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	
	$link = $_SESSION['link'];
	$redirect = $link.$_POST['redirect']; 
	
	header("Location: ".$redirect);		
} else {
	
	header("Location: ../login.php?email=".$email."&e&utm=".md5($email));
}
?>