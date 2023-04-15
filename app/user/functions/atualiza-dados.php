<?php 

session_start();
require "conexao.php";
$iduser = $_COOKIE['id_user'];
// print_r($_POST); 
// exit();
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
if ($_FILES['avatar']['name'] != "") {
$diretorio = '../assets/img/avatar/';
$tipo = $_FILES['avatar']['type'];
$uploadfile = $diretorio."sib_".$iduser."_". basename($_FILES['avatar']['name']);
    if($tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/png"){
        //enviar o arquivo para a pasta
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);
        //adiciona nome do arquivo a base de dados
        $file_name = "sib_".$iduser."_". basename($_FILES['avatar']['name']); 
        $sql = "UPDATE users SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone', avatar = '$file_name', cpf = '$cpf' WHERE iduser = '$iduser'";
    }else{
        $sql = "UPDATE users SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone', cpf = '$cpf' WHERE iduser = '$iduser'";
        ?>
            <script type="text/javascript">
	            alert("Faça o upload de um arquivo .JPG ou .PNG!");
            </script>
        <?php
    }
            
    
}else{
$sql = "UPDATE users SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone', cpf = '$cpf' WHERE iduser = '$iduser'";
}

//atualiza senha
$query = mysqli_query($con, $sql);
    
    
header("Location: ../user.php");		
?>