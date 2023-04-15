<?php
session_start();

class usuarios
{
	
	private function con()
	{
		include "../../user/functions/conexao.php";
		return $con;
	}


	public function lista()
	{
		$getUsuarios = $this->con()->query("SELECT * FROM users ORDER BY nome ASC");
        while ($row = $getUsuarios->fetch_array()) {
	        echo '<tr>
                <td id="'.$row['iduser'].'" class="verDetalhes">'.$row['iduser'].'</td>
                <td id="'.$row['iduser'].'" class="verDetalhes">'.$row['nome'].' '.$row['sobrenome'].'</td>
                <td id="'.$row['iduser'].'" class="verDetalhes">'.$row['email'].'</td>
                <td id="'.$row['iduser'].'" class="verDetalhes">'.$row['type'].'</td>
                <td id="'.$row['iduser'].'" class="verDetalhes">'.$row['criado'].'</td>
                <td id="'.$row['iduser'].'" class="verDetalhes">'.$row['status'].'</td>
                <td>';

                if($row['status'] == 'active'){
                    echo '<div class="btn btn-fill btn-warning">Bloquear</div>';
                }

            echo '</td>
            </tr>';
        }
	}



	public function detalhes($id)
	{
		$getUsuarios = $this->con()->query("SELECT * FROM users WHERE iduser = '".$id."' ");
		if(mysqli_num_rows($getUsuarios)){
			$array = array('resp'=>'s');
			while ($row = $getUsuarios->fetch_array()) {
        
				if($row['status'] == 'new'){
					$status = 'Novo usuário';
				}else if($row['status'] == 'active'){
					$status = 'Verificado';
				}else if($row['status'] != 'new' || $row['status'] != 'active'){
					$status = 'Bloqueado';
				}


	            $array['Usuario'] = array(
	            	'Suite'		=>$row['iduser'],
	            	'Mome' 		=>$row['nome'],
	            	'Sobrenome' =>$row['sobrenome'],
	            	'Email'		=>$row['email'],
	            	'Telefone'  =>$row['telefone'],
	            	'Status'	=>$status,
	            	'Tipo' 		=>$row['type'],
	            	'criado' 	=>$row['criado']
	            );
	        
	        }	
		}else{
			$array = array('resp'=>'n');
		}

		echo json_encode($array);
	}

	public function excluirUsuario($id)
	{
		if($this->con()->query("DELETE FROM users WHERE iduser = '".$id."' ")){
			$array = array('resp'=>'s');
		}else{
			$array = array('resp'=>'n');
		}

		echo json_encode($array);
	}


	public function btnResetarSenhaUsuario($id)
	{

		$getUsuario = $this->con()->query("SELECT * FROM users WHERE iduser = '".$id."' ");
		$row = $getUsuario->fetch_array();

		// Subject
		$subject = $_SESSION['empresa'].' - Recuperar Senha';

		// Message
		$message = '
		<html>
		<head>
<head>
  </head>
		<body>
			<img src="'.$_SESSION['logo'].'" width="200" style="margin-bottom:20px;">
			<h3>Olá '.$row['nome'].' '.$row['sobrenome'].'!</h3>
			<p>Uma tentativa de recuperar senha foi feita para a sua conta.</p>
			<p>Clique nesse <a href="'.$_SESSION['link'].'/app/user/recuperarSenha.php?id='.$id.'">link para recuperar a senha</a>!</p>
		
		
		
			<p>Caso não tenha sido você, desconsidere esse e-mail.</p>
	

			<p>Qualquer dúvida entre em contato conosco. Estamos aqui a sua disposição.</p>
			<p>Atenciosamente,</p>
			<p>Equipe '.$_SESSION['empresa'].'</p>
		</body>
		</html>
		';

		echo $message;

		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=utf-8';

		// Additional headers
		$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';


		// Mail it
		if(mail($row['email'], $subject, $message, implode("\r\n", $headers))){
			$array = array('resp'=>'s');
		}else{
			$array = array('resp'=>'n');
		}
		echo json_encode($array);
	}

}



$user = new usuarios;

if(isset($_POST['getDetalhes'])){
	$user->detalhes($_POST['getDetalhes']);
}

if(isset($_POST['excluirUsuarioSim'])){
	$user->excluirUsuario($_POST['excluirUsuarioSim']);
}

if(isset($_POST['btnResetarSenhaUsuario'])){
	$user->btnResetarSenhaUsuario($_POST['btnResetarSenhaUsuario']);
}

?>