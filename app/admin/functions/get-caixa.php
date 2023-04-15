<?php 

if($_POST){

    session_start();
    require "../../user/functions/conexao.php";

    $idcaixa = $_POST['idcaixa'];
    
    $select_caixas = "SELECT * FROM caixas WHERE idcaixa = '$idcaixa'";
    $query_select_caixas = mysqli_query ($con, $select_caixas) or die(mysqli_error($con));
    $row_caixas = mysqli_fetch_assoc($query_select_caixas);

    echo json_encode($row_caixas);

} else {
    //echo "Hacking Attempt.";
    exit;
}




?>