<?php 

if($_POST){

    session_start();
    require "../../user/functions/conexao.php";

    $idproduto = $_POST['idproduto'];
    
    $select_produtos = "SELECT * FROM produtos WHERE idproduto = '$idproduto'";
    $query_select_produtos = mysqli_query ($con, $select_produtos) or die(mysqli_error($con));
    $row_produtos = mysqli_fetch_assoc($query_select_produtos);

    echo json_encode($row_produtos);

} else {
    //echo "Hacking Attempt.";
    exit;
}




?>