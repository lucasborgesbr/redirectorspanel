<?php

require 'conexao.php';

$sqlRecuperarDados = "SELECT * FROM Configuracoes";
$queryDados = mysqli_query ($con, $sqlRecuperarDados) or die(mysqli_error($con));
$row_dadosEmail = mysqli_fetch_assoc($queryDados);

$empresa = $row_dadosEmail['nomeEmpresa'];
$logo = $row_dadosEmail['logo'];
$contato = $row_dadosEmail['contato'];
$link = $row_dadosEmail['link'];

?>