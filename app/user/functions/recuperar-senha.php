<?php

require "conf_email.php";
require '../assets/PHPMailer/test.php';

if(isset($_POST['recuperarSenha'])){
	require "conexao.php";
	include '../templates/recovery-email.php';

	$confereEmail = mysqli_query($con, "SELECT email FROM users WHERE email = '".$_POST['recuperarSenha']."' ");
	if(mysqli_num_rows($confereEmail)){

		$select_user = "SELECT * FROM users WHERE email = '".$_POST['recuperarSenha']."'";
		$query_select_user = mysqli_query ($con, $select_user) or die(mysqli_error($con));
		$row_user = mysqli_fetch_assoc($query_select_user);

			$cod_acesso = substr(uniqid(rand()), 0, 6); //Gera Codigo de Acesso com 6 Caracteres.

			$sql_insere = "UPDATE users SET codAcesso = '$cod_acesso' WHERE email = '".$_POST['recuperarSenha']."'";
			if(mysqli_query($con, $sql_insere)){

				$tags = array("#nome", "#CODE", "#LOGOIMG#");
				$logoimg = $link."/app/admin/assets/img/logo/".$logo;
				$newtag = array(ucwords($row_user['nome']), $cod_acesso, $logoimg);

				$body = str_replace($tags, $newtag, $recoveryEmail);

				$mail = new PHPMailer\PHPMailer\PHPMailer();

				try {

					$mail->isSMTP();                                            
					$mail->Host       = 'mail.solutionsbox.com.br';              
					$mail->SMTPAuth   = true;                                   
					$mail->Username   = 'no-reply@solutionsbox.com.br';           
					$mail->Password   = 'UUOMJ4C5HR65';                         
					$mail->SMTPSecure = 'ssl';         
					$mail->Port       = 465;                                    

		    		//Recipients
					$mail->setFrom('no-reply@solutionsbox.com.br', $empresa);
					$mail->addAddress($row_user['email'], ucwords($row_user['nome'].' '.$row_user['sobrenome']));

		    		// Content
					$mail->isHTML(true);                                 
					$mail->Subject = $cod_acesso.' - Recovery Code';
					$mail->Body    = $body;

					$mail->send();

					//$recoveryResponse['email'] = $row_user['email'];
					//$recoveryResponse['success'] = 'true';
					//$recoveryResponse['message'] = 'Recovery Code Sent Successfuly';

				} catch (Exception $e) {
					//$recoveryResponse['success'] = 'false';
					//$recoveryResponse['error'] = 'Message could not be sent';
					//$recoveryResponse['errorDetails'] = 'Mailer Error: {$mail->ErrorInfo}';
				}


				/*$titulo = 'Recuperar Senha - '.$empresa;
				$corpo  = '
				<img src="'.$logo.'" width="200" style="margin-bottom:20px;">

				<h3><strong>Olá '.$row['nome'].'</strong></h3>
				</br>
				</br>
				<p>Identificamos uma tentativa de recuperar a senha para a sua conta. Utilize o código abaixo para validar a troca da senha.</p>
				<br/>
				<p>Código de Validação:</p>
				<p>
				<h3>'.$cod_acesso.'</h3>
				<br/>
				<p>Caso não tenha sido você, desconsidere essa mensagem.</p>
				<p>Qualquer dúvida entre em contato conosco. Estamos aqui a sua disposição.</p>
				<br/>
				<p>Atenciosamente,</p>
				<br/>
				<p>Equipe '.$empresa.'</p>
				';

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				$headers .= 'From: '.$empresa.' <'.$contato.'>' . "\r\n";

				mail($_POST['recuperarSenha'], $titulo, $corpo,$headers);*/



				mysqli_query($con, "UPDATE users SET senha = 'NULL' WHERE email = '".$_POST['recuperarSenha']."' ");

				$array = array('resp'=>'s');
			}
		}else{
			$array = array('resp'=>'n');
		}

		echo json_encode($array);
	}

	if(isset($_POST['novaSenha']) && isset($_POST['novoEmail'])){
		require "conexao.php";

		$email = $_POST['novoEmail'];

		$confereSenhaVazia = mysqli_query($con, "SELECT senha FROM users WHERE email = '".$_POST['novoEmail']."' AND senha = 'NULL' ");

		$confereCodigo = mysqli_query($con, "SELECT codAcesso FROM users WHERE email = '".$_POST['novoEmail']."' AND codAcesso = '".$_POST['codAcesso']."' ");

		if(mysqli_num_rows($confereSenhaVazia)){

			if(mysqli_num_rows($confereSenhaVazia)){

				$nSenha = md5($_POST['novaSenha']);
				if(mysqli_query($con, "UPDATE users SET senha = '".$nSenha."' WHERE email = '".$_POST['novoEmail']."' ")){
					$array = array('resp'=>'s', 'email' => $email);
				}else{
					$array = array('resp'=>'n');
				}
			}else{
				$array = array('resp'=>'n');
			}
		}else{
			$array = array('resp'=>'n');
		}

		$sql_insere = "UPDATE users SET codAcesso = '' WHERE email = '$email'";
		mysqli_query($con, $sql_insere);
		
		echo json_encode($array);
	}

	?>