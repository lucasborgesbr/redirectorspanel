<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>

<?php 

require "conf_email.php";
require "conexao.php";

function getIPAddress() {  
    //whether ip is from the share internet  
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
		$ip = $_SERVER['HTTP_CLIENT_IP'];  
	}  
    //whether ip is from the proxy  
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	}  
	//whether ip is from the remote address  
	else{  
		$ip = $_SERVER['REMOTE_ADDR'];  
	}  
	return $ip;  
}  

$ip = getIPAddress();  

//echo 'User Real IP Address - '.$ip; 

$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];
$cep = $_POST['cep'];


$nome = $_POST['nome'];
$sobrenome =  $_POST['sobrenome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];

$senha = md5($_POST['senha']);
$date = date("Y-m-d h:m:s");
//verifica se existe cadastro
$sql_verifica = "SELECT email FROM users WHERE email = '$email'";
$query_verifica = mysqli_query($con, $sql_verifica);
$user = mysqli_fetch_assoc($query_verifica);
if ($user['email'] == "$email") {
	//retorna erro
	$redirect = "<script>$(document).ready(function(){setTimeout(function(){location.href = '../login.php?email=$email&t&utm=".md5($email)."';}, 10)});</script>";
	echo $redirect;
	//header("Location:../login.php?email=$email&t&utm=".md5($email));
	exit();
} 

$sql_insere = "INSERT INTO users 
(nome, sobrenome, email, senha, criado, status, ativo, cpf, telefone, IPAddr) VALUES 
('$nome','$sobrenome','$email','$senha','$date','new', '0', '$cpf', '$telefone', '$ip')";

if(mysqli_query($con, $sql_insere)){

	$iduser = mysqli_insert_id($con);

	$sqlEndereco = "INSERT INTO enderecos (iduser, rua, numero, bairro, complemento, cidade, estado, pais, cep) VALUES ('$iduser', '$rua', '$numero', '$bairro','$complemento', '$cidade', '$estado', '$pais', '$cep')";
	$query = mysqli_query($con, $sqlEndereco);

	$sqlCreateWallet = "INSERT INTO wallet(iduser, idwallet, saldo) VALUES ($iduser, $iduser, 0)";
	mysqli_query($con, $sqlCreateWallet);


	$to = $email; 

	$subject = $empresa.' - BOAS VINDAS!';

	$message = '
	<html>
	<head>
	<head>
	<title>'.$empresa.' - BOAS VINDAS</title>
	</head>
	<body>
	<img src="'.$logo.'" width="200" style="margin-bottom:20px;">
	<h2>Olá '.$nome.' '.$sobrenome.'!</h2>
	<p>Nós da '.$empresa.' ficamos muito felizes em ter você por aqui! Esperamos que este seja o começo de uma incrível parceria.</p>
	<p>Dados de acesso:</p>
	<p>
	Login: '.$email.'<br>
	Senha: '.$_POST['senha'].'<br>
	</p>
	<p>Acesse seu painel e você terá acesso ao “Seu Endereço aqui nos Estados Unidos”. Lembre-se de anotar todos os campos, inclusive <em>#Suíte</em>. É nela que vamos armazenar todas as suas compras em nosso estoque.</p>

	<p>Qualquer dúvida entre em contato conosco. Estamos aqui a sua disposição.</p>
	<p>Atenciosamente,</p>
	<p>Equipe '.$empresa.'</p>
	</body>
	</html>
	';

	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	$headers[] = 'From: '.$empresa.' <'.$contato.'>';

	if(mail($to, $subject, $message, implode("\r\n", $headers))){


		$redirect = "<script>$(document).ready(function(){setTimeout(function(){location.href = '../login.php?email=$email&s&utm=".md5($email)."';}, 10)});</script>";
		echo $redirect;
	}

}

?>