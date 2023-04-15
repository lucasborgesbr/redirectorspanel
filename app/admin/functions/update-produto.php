<?php 
session_start();
require "../../user/functions/conexao.php";

// echo "<pre>";
// print_r($_POST); 
//print_r($_FILES); 
//exit();

$idproduto = $_POST['idproduto']; 
$suite = $_POST['suite'];
$idcaixa = $_POST['idcaixa'];
$criado = $_POST['criado'];
$descricao = $_POST['descricao'];
$quantidade = $_POST['quantidade'];
$peso = $_POST['peso'];


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

$diretorio = "../../user/assets/img/produtos/";

$sql = "UPDATE produtos SET
    idcaixa = '$idcaixa',
    iduser = '$suite',
    descricao = '$descricao',
    quantidade = '$quantidade',
    peso = '$peso',
    criado = '$criado'";

if ($_FILES['imagem1']['name'] != "") {
	$file_name = "_S".$suite."_IMG1_".basename($_FILES['imagem1']['tmp_name'].'.jpg');
    $sql .= ", imagem1 = '$file_name' ";
}
if ($_FILES['imagem2']['name'] != "") {
	$file_name2 = "_S".$suite."_IMG2_".basename($_FILES['imagem2']['tmp_name'].'.jpg');
    $sql .= ", imagem2 = '$file_name2' ";
}

$sql .= " WHERE idproduto = '$idproduto'";



$query = mysqli_query($con, $sql);

if ($_FILES['imagem1']['name'] != "") {
	$sql_img1 = "SELECT idproduto FROM produtos WHERE imagem1 = '$file_name'";
	$q1 = mysqli_query($con, $sql_img1);
	while ($idp1 = mysqli_fetch_assoc($q1)){
		$uploadfile = $diretorio.$idp1['idproduto'].$file_name;
		$file = $idp1['idproduto'].$file_name;
		@compress($_FILES['imagem1']['tmp_name'], $uploadfile, 30);

		$sql_new1 = "UPDATE produtos SET imagem1 = '$file' WHERE imagem1 = '$file_name'";
		$qn1 = mysqli_query($con, $sql_new1);
	}
}


if ($_FILES['imagem2']['name'] != "") {
	$sql_img2 = "SELECT idproduto FROM produtos WHERE imagem2 = '$file_name2'";
	$q2 = mysqli_query($con, $sql_img2);
	while($idp2 = mysqli_fetch_assoc($q2)){
		$uploadfile2 = $diretorio.$idp2['idproduto'].$file_name2;
		$file2 = $idp2['idproduto'].$file_name2;
		@compress($_FILES['imagem2']['tmp_name'], $uploadfile2, 30);

		$sql_new2 = "UPDATE produtos SET imagem2 = '$file2' WHERE imagem2 = '$file_name2'";
		$qn2 = mysqli_query($con, $sql_new2);
		
	}
}


header("Location: ../produtos.php");
 ?>