<?php
require "conf_email.php";

	if(isset($_POST['codAcesso'])){
		require "conexao.php";

		$confereEmail = mysqli_query($con, "SELECT email FROM users WHERE ativo = '0' AND codAcesso = '".$_POST['codAcesso']."'");
		if(mysqli_num_rows($confereEmail)){

			$ativaUsuário = mysqli_query($con, "UPDATE users SET ativo = '1', codAcesso = NULL WHERE codAcesso = '".$_POST['codAcesso']."'");

			$titulo = 'Ativação de Conta - '.$empresa;
			$corpo  = '<!DOCTYPE html>
				<html>
				<head>
					<title></title>
				</head>
				<body>

					<img src="'.$logo.'" width="200" style="margin-bottom:20px;">

					<h3><strong>Olá '.$row['nome'].'</strong></h3>
					</br>
					</br>
					<p>Sua conta foi ativada com sucesso! Aproveite o inicio desta nova parceria.</p>
					<br/>
					<p>Qualquer dúvida entre em contato conosco. Estamos aqui a sua disposição.</p>
					<br/>
					<p>Atenciosamente,</p>
					<br/>
					<p>Equipe '.$empresa.'</p>
				</body>
				</html>';

			    $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				$headers .= 'From: '.$empresa.' <'.$contato.'>' . "\r\n";
				
			$success = mail($_POST['email'], $titulo, $corpo,$headers);


			if(!$success){
				$errorMessage = error_get_last()['message'];
			} else {
				$array = array('resp'=>'s');
			}
			
		}else{
			$array = array('resp'=>'n');
		}

		echo json_encode($array);
		//echo json_encode($confereEmail);
	}
?>