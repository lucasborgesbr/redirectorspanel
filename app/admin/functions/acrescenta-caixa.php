<?php 
session_start();
require "../../user/functions/conexao.php";

 //echo "<pre>";
 //print_r($_POST); 
//print_r($_FILES); 
 //exit();

$suite = filter_var($_POST['suite'], FILTER_SANITIZE_NUMBER_INT);
$criado = $_POST['criado'];
$remetente = mysqli_real_escape_string($con, $_POST['remetente']);
$descricao = mysqli_real_escape_string($con, $_POST['descricao']);
$tracking = $_POST['tracking'];
$peso = $_POST['peso'];
$status = "new";

function compress($source, $destination, $quality) {
    if (function_exists('exif_read_data')) {
        $exif = exif_read_data($source);
        if($exif && isset($exif['Orientation'])) {
            try{
                $orientation = $exif['Orientation'];
                if($orientation != 1){
                    $info = getimagesize($source);

                    if ($info['mime'] == 'image/jpeg') { 
                        $image = imagecreatefromjpeg($source);

                    } else if ($info['mime'] == 'image/gif'){
                        $image = imagecreatefromgif($source);

                    } else if ($info['mime'] == 'image/png') {
                        $image = imagecreatefrompng($source);

                    }
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                        $deg = 180;
                        break;
                        case 6:
                        $deg = 270;
                        break;
                        case 8:
                        $deg = 90;
                        break;
                    }
                    if ($deg) {
                        $image = imagerotate($image, $deg, 0);        
                    }

                    imagejpeg($image, $destination, $quality);
                    
                } else {

                    $info = getimagesize($source);

                    if ($info['mime'] == 'image/jpeg') { 
                        $image = imagecreatefromjpeg($source);

                    } else if ($info['mime'] == 'image/gif'){
                        $image = imagecreatefromgif($source);

                    } else if ($info['mime'] == 'image/png') {
                        $image = imagecreatefrompng($source);

                    }

                    imagejpeg($image, $destination, $quality);

                }
            } catch (Exception $ex) {

                $info = getimagesize($source);

                if ($info['mime'] == 'image/jpeg') { 
                    $image = imagecreatefromjpeg($source);

                } else if ($info['mime'] == 'image/gif'){
                    $image = imagecreatefromgif($source);

                } else if ($info['mime'] == 'image/png') {
                    $image = imagecreatefrompng($source);

                }

                imagejpeg($image, $destination, $quality);
                
            }
        } else {

            $info = getimagesize($source);

            if ($info['mime'] == 'image/jpeg') { 
                $image = imagecreatefromjpeg($source);

            } else if ($info['mime'] == 'image/gif'){
                $image = imagecreatefromgif($source);

            } else if ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($source);

            }

            imagejpeg($image, $destination, $quality);
        } 
    } else {
        
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') { 
            $image = imagecreatefromjpeg($source);

        } else if ($info['mime'] == 'image/gif'){
            $image = imagecreatefromgif($source);

        } else if ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);

        }

        imagejpeg($image, $destination, $quality);
    } 
}

$diretorio = "../../user/assets/img/caixas/";

if ($_FILES['imagem1']['name'] != "") {
	$file_name =  "_S".$suite."_IMG1_".basename($_FILES['imagem1']['tmp_name'].'.jpg'); 
}
if ($_FILES['imagem2']['name'] != "") {
	$file_name2 = "_S".$suite."_IMG2_".basename($_FILES['imagem2']['tmp_name'].'.jpg');
}


$sql = "INSERT INTO caixas (iduser, descricao, remetente, tracking, peso, imagem1, imagem2, status, criado) VALUES ('$suite', '$descricao', '$remetente','$tracking', '$peso', '$file_name', '$file_name2', '$status', '$criado')";
$query = mysqli_query($con, $sql);

if ($_FILES['imagem1']['name'] != "") {
	$sql_img1 = "SELECT idcaixa FROM caixas WHERE imagem1 = '$file_name'";
	$q1 = mysqli_query($con, $sql_img1);
	while ($idp1 = mysqli_fetch_assoc($q1)){
		$uploadfile = $diretorio.$idp1['idcaixa'].$file_name;
		$file = $idp1['idcaixa'].$file_name;
		@compress($_FILES['imagem1']['tmp_name'], $uploadfile, 30);

		$sql_new1 = "UPDATE caixas SET imagem1 = '$file' WHERE imagem1 = '$file_name'";
		$qn1 = mysqli_query($con, $sql_new1);
	}
}


if ($_FILES['imagem2']['name'] != "") {
	$sql_img2 = "SELECT idcaixa FROM caixas WHERE imagem2 = '$file_name2'";
	$q2 = mysqli_query($con, $sql_img2);
	while($idp2 = mysqli_fetch_assoc($q2)){
		$uploadfile2 = $diretorio.$idp2['idcaixa'].$file_name2;
		$file2 = $idp2['idcaixa'].$file_name2;
		@compress($_FILES['imagem2']['tmp_name'], $uploadfile2, 30);

		$sql_new2 = "UPDATE caixas SET imagem2 = '$file2' WHERE imagem2 = '$file_name2'";
		$qn2 = mysqli_query($con, $sql_new2);
		
	}
}

$sql_seleciona_usuario = "SELECT nome, sobrenome, email FROM users WHERE iduser = '$suite'";
$query_seleciona_usuario = mysqli_query($con, $sql_seleciona_usuario);
$row_usuario = mysqli_fetch_assoc($query_seleciona_usuario);

$nome = $row_usuario['nome'];
$sobrenome = $row_usuario['sobrenome'];
$email = $row_usuario['email'];

$_SESSION['suite'] = $suite;
$_SESSION['criado'] = $criado;

/* FUNCAO EMAIL DE NOTIFICACAO DE BOAS VINDAS  */




// Multiple recipients
$to = $email; 

// Subject
$subject = $_SESSION['empresa'].' - NOVA CAIXA!';

// Message
$message = '
<html>
<head>
<head>
  <title>'.$_SESSION['empresa'].' - NOVA CAIXA</title>
</head>
<body>
  <img src="'.$_SESSION['logo'].'" width="200" style="margin-bottom:20px;">
  <h3>Olá '.$nome.' '.$sobrenome.'!</h3>
  <p>Recebemos uma caixa sua e acabamos de cadastrá-la na sua suíte.</p>

<p>Acesse <a href="'.$_SESSION['link'].'/app/user" target="_blank">'.$_SESSION['link'].'/app/user</a> para verificar seus produtos</p>
<br>
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

// Additional headers
$headers[] = 'From: '.$_SESSION['empresa'].' <'.$_SESSION['contato'].'>';


// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));






header("Location: ../dashboard.php");
 ?>