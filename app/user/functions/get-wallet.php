<?php 

if($_POST){

    session_start();
    require "conexao.php";

    $iduser = $_POST['iduser'];
    
    $select_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser'";
    $query_select_wallet = mysqli_query ($con, $select_wallet) or die(mysqli_error($con));
    $row_wallet = mysqli_fetch_assoc($query_select_wallet);

    echo json_encode($row_wallet);

} else {
    //echo "Hacking Attempt.";
    exit;
}




?>