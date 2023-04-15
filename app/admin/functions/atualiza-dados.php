<?php 
session_start();
require "../../user/functions/conexao.php";
$iduser = $_SESSION['id_user'];
// print_r($_POST); 
// exit();
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
if ($_FILES['avatar']['name'] != "") {
$diretorio = '../assets/img/avatar/';
$uploadfile = $diretorio."sib_".$iduser."_". basename($_FILES['avatar']['name']);
//enviar o arquivo para a pasta
move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);
//adiciona nome do arquivo a base de dados
$file_name = "sib_".$iduser."_". basename($_FILES['avatar']['name']); 
$sql = "UPDATE users SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone', avatar = '$file_name'  WHERE iduser = '$iduser'";}else{
$sql = "UPDATE users SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', telefone = '$telefone',  WHERE iduser = '$iduser'";
}
//atualiza senha
$query = mysqli_query($con, $sql);
	header("Location: ../user.php");		
?>