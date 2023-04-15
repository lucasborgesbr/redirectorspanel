<?php

require("conexao.php");
//session start.
session_start();
if (!isset($_COOKIE['id_user'])) {
    header("Location: login.php?redirect=" . $_SERVER["REQUEST_URI"]);
}
// atribuicao de session
$id_user = $_COOKIE['id_user'];
$_SESSION['notficacao'] = 1;
//funcao logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: functions/processa-logout.php");
}

require "conf_email.php";

$_SESSION['empresa'] = $empresa;
$_SESSION['logo'] = $logo;
$_SESSION['contato'] = $contato;
$_SESSION['link'] = $link;

// Valor atual do Dolar

$ctx = stream_context_create(array('http' =>
    array(
        'timeout' => 1200,  //1200 Seconds is 20 Minutes
    )
));


@$dolar_api_json = file_get_contents("https://economia.awesomeapi.com.br/json/USDT-BRL/1", false, $ctx);
$dolar_valores = json_decode($dolar_api_json);

$_SESSION['USDT-BRL-Compra'] = $dolar_valores[0]->ask; // Dolar Turismo Venda (Quando o Cliente Compra Dolar)
$_SESSION['USDT-BRL-Venda'] = $dolar_valores[0]->bid; //Dolar Turismo Compra (Quando o cliente Vende Dolar)
$_SESSION['USDT-BRL-Variacao'] = $dolar_valores[0]->varBid;
$_SESSION['USDT-BRL-Percent-Var'] = $dolar_valores[0]->pctChange;


//seleciona os dados do user
$select_user = "SELECT * FROM users WHERE iduser = '$id_user'";
$query_select_user = mysqli_query($con, $select_user) or die(mysqli_error($con));
$row_user = mysqli_fetch_assoc($query_select_user);
//seleciona os dados do admin
$select_admin = "SELECT * FROM admins";
$query_select_admin = mysqli_query($con, $select_admin) or die(mysqli_error($con));
$row_admin = mysqli_fetch_assoc($query_select_admin);
//seleciona caixas do user
$select_caixas = "SELECT * FROM caixas WHERE iduser = '$id_user'";
$query_select_caixas = mysqli_query($con, $select_caixas) or die(mysqli_error($con));
$row_caixas = mysqli_fetch_assoc($query_select_caixas);
$total_caixas = mysqli_num_rows($query_select_caixas);
//seleciona produtos do user
if (!isset($_GET['view-produtos'])) {
    $select_produtos = "SELECT * FROM produtos WHERE iduser = '$id_user'";
    $query_select_produtos = mysqli_query($con, $select_produtos) or die(mysqli_error($con));
    $row_produtos = mysqli_fetch_assoc($query_select_produtos);
    $total_produtos = mysqli_num_rows($query_select_produtos);
} else {
    if (isset($_GET['id-caixa'])) {
        $idcaixa = $_GET['id-caixa'];
        $select_produtos = "SELECT * FROM produtos WHERE iduser = '$id_user' AND idcaixa = '$idcaixa'";
        $query_select_produtos = mysqli_query($con, $select_produtos) or die(mysqli_error($con));
        $row_produtos = mysqli_fetch_assoc($query_select_produtos);
        $total_produtos = mysqli_num_rows($query_select_produtos);
    }
}
//seleciona envios do user
if (isset($_GET['idenvio'])) {
    $idenvio = $_GET['idenvio'];
    $select_envios = "SELECT * FROM envios WHERE idenvio = '$idenvio' AND iduser = '$id_user'";
    $query_select_envios = mysqli_query($con, $select_envios) or die(mysqli_error($con));
    $row_envios = mysqli_fetch_assoc($query_select_envios);
    $total_envios = mysqli_num_rows($query_select_envios);
} else {
    $select_envios = "SELECT * FROM envios WHERE iduser = '$id_user' ORDER BY idenvio DESC";
    $query_select_envios = mysqli_query($con, $select_envios) or die(mysqli_error($con));
    $row_envios = mysqli_fetch_assoc($query_select_envios);
    $total_envios = mysqli_num_rows($query_select_envios);
}
//seleciona enderecos do user
$select_endereco = "SELECT * FROM enderecos WHERE iduser = '$id_user'";
$query_select_endereco = mysqli_query($con, $select_endereco) or die(mysqli_error($con));
$row_endereco = mysqli_fetch_assoc($query_select_endereco);
$total_endereco = mysqli_num_rows($query_select_endereco);
//seleciona notificacao do user
$select_notificacao = "SELECT * FROM notificacoes";
$query_select_notificacao = mysqli_query($con, $select_notificacao) or die(mysqli_error($con));
$row_notificacao = mysqli_fetch_assoc($query_select_notificacao);
$total_notificacao = mysqli_num_rows($query_select_notificacao);
//seleciona compras assistidas do user
$select_compras = "SELECT * FROM compras WHERE iduser = '$id_user' ORDER BY idcompra DESC";
$query_select_compras = mysqli_query($con, $select_compras) or die(mysqli_error($con));
$row_compras = mysqli_fetch_assoc($query_select_compras);
$total_compras = mysqli_num_rows($query_select_compras);
//seleciona docs do user
$select_docs = "SELECT * FROM docs WHERE iduser = '$id_user'";
$query_select_docs = mysqli_query($con, $select_docs) or die(mysqli_error($con));
$row_docs = mysqli_fetch_assoc($query_select_docs);
$total_docs = mysqli_num_rows($query_select_docs);
//seleciona wallet do user
$select_wallet = "SELECT * FROM wallet WHERE iduser = '$id_user'";
$query_select_wallet = mysqli_query($con, $select_wallet) or die(mysqli_error($con));
$row_wallet = mysqli_fetch_assoc($query_select_wallet);
$total_wallet = mysqli_num_rows($query_select_wallet);
//$salto_wallet = $row_wallet['saldo'];
$_SESSION['saldo_wallet'] = $row_wallet['saldo'];

//se usuário não possuí wallet, Cria uma!
if ($total_wallet == '0') {
    $sql_new_wallet = "INSERT INTO wallet (iduser, saldo) VALUES ('$id_user', '0.00')";
    $query_new_wallet = mysqli_query($con, $sql_new_wallet) or die(mysqli_error($con));
    $row_wallet = mysqli_fetch_assoc($query_select_wallet);
    $total_wallet = mysqli_num_rows($query_select_wallet);
}
//seleciona historico de transações da wallet do user
$idwallet = $row_wallet['idwallet'];
$select_wallet_tran = "SELECT * FROM transacaoWallet WHERE idwallet = '$idwallet'";
$query_select_wallet_tran = mysqli_query($con, $select_wallet_tran) or die(mysqli_error($con));
$row_wallet_tran = mysqli_fetch_assoc($query_select_wallet_tran);

// seleciona as caixas que estão chegando
$select_redirecionamento = "SELECT * FROM redirecionamento WHERE suite = '$id_user'";
$query_select_redirecionamento = mysqli_query($con, $select_redirecionamento) or die(mysqli_error($con));
$row_redirecionamento = mysqli_fetch_assoc($query_select_redirecionamento);
$total_redirecionamento = mysqli_num_rows($query_select_redirecionamento);

//formas de pagamento ativas
$select_fp = "SELECT * FROM configFormaPagamentos WHERE ativo = 1";
$query_select_fp = mysqli_query($con, $select_fp) or die(mysqli_error($con));
$row_fp = mysqli_fetch_assoc($query_select_fp);

//taxas das formas de pagamento

$select_fp_taxas = "SELECT * FROM configFormaPagamentos";
$query_select_fp_taxas = mysqli_query($con, $select_fp_taxas) or die(mysqli_error($con));

do {
    if ($row_fp_taxas['idFormaPagamento'] != '') {

        if ($row_fp_taxas['TipoPagamento'] == 'Pagamento no Local') {

            $_SESSION['PgtLocal-ativo'] = $row_fp_taxas['ativo'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'Paypal' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-Paypal'] = $row_fp_taxas['taxa'];

            $_SESSION['PP_Client_ID'] = $row_fp_taxas['key1'];
            $_SESSION['PP_Scret_ID'] = $row_fp_taxas['key2'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'Paypal.me' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-PaypalME'] = $row_fp_taxas['taxa'];

            $_SESSION['paypal'] = $row_fp_taxas['key1'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'Ebanx' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-Ebanx'] = $row_fp_taxas['taxa'];

            $_SESSION['Ebanx_API'] = $row_fp_taxas['key1'];

            if ($row_fp_taxas['sandbox'] == 0) {
                $_SESSION['Ebanx_Production'] = 'true';
            } else {
                $_SESSION['Ebanx_Production'] = 'false';
            }
        }

        if ($row_fp_taxas['TipoPagamento'] == 'CambioReal' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-CR'] = $row_fp_taxas['taxa'];

            $_SESSION['CR_Token'] = $row_fp_taxas['key1'];
            $_SESSION['CR_Account'] = $row_fp_taxas['key2'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'WesternUnion' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-WU'] = $row_fp_taxas['taxa'];

            $_SESSION['WU_Info'] = $row_fp_taxas['key1'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'TransferWise' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-TW'] = $row_fp_taxas['taxa'];

            $_SESSION['TW_Email'] = $row_fp_taxas['key1'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'Transferencia' && $row_fp_taxas['taxa'] != '') {
            $_SESSION['taxa-Transferencia'] = $row_fp_taxas['taxa'];

            $_SESSION['PG_Transferencia'] = $row_fp_taxas['key1'];
        }

        if ($row_fp_taxas['TipoPagamento'] == 'ParceladoUSA' && $row_fp_taxas['taxa'] != '') {

            $_SESSION['taxa-ParceladoUSA'] = $row_fp_taxas['taxa'];

            $_SESSION['ParceladoUSA_API'] = $row_fp_taxas['key1'];
            if ($row_fp_taxas['sandbox'] == 0) {
                $_SESSION['ParceladoUSA_Production'] = 'true';
            } else {
                $_SESSION['ParceladoUSA_Production'] = 'false';
            }
        }

        if ($row_fp_taxas['TipoPagamento'] == 'SpliPay' && $row_fp_taxas['taxa'] != '') {

            $_SESSION['taxa-SpliPay'] = $row_fp_taxas['taxa'];
            $_SESSION['clientID-SpliPay'] = $row_fp_taxas['key1'];
            $_SESSION['clientSecret-SpliPay'] = $row_fp_taxas['key2'];

            if ($_SESSION['expires-Splipay'] == '' || strtotime($_SESSION['expires-Splipay']) <= time()) {


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://sandbox.splipay.com/oauth/token");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,
                    http_build_query(
                        array(
                            'client_id' => $_SESSION['clientID-SpliPay'],
                            'client_secret' => $_SESSION['clientSecret-SpliPay'],
                            'grant_type' => 'client_credentials'
                        )
                    )
                );

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $response = json_decode($response);

                //$_SESSION['expires-Splipay'] = $response['expires_in'];
                //define("TOKEN_SPLIPAY", $response['access_token']);

            }


        }

    }
} while ($row_fp_taxas = mysqli_fetch_assoc($query_select_fp_taxas));

//Select dos preços por peso
$select_preco_peso = "SELECT * FROM configPesos WHERE ativo = 1 ORDER BY pesoMax ASC";
$query_select_preco_peso = mysqli_query($con, $select_preco_peso) or die(mysqli_error($con));
$row_preco_peso = mysqli_fetch_assoc($query_select_preco_peso);

// Select dos Serviços Extras

$select_servico_extra = "SELECT * FROM configServicosExtras WHERE ativo = 1 ORDER BY vlrServico ASC";
$query_servico_extra = mysqli_query($con, $select_servico_extra) or die(mysqli_error($con));
$row_servico_extra = mysqli_fetch_assoc($query_servico_extra);


//seleciona todas as configurações
$select_config = "SELECT * FROM Configuracoes";
$query_select_config = mysqli_query($con, $select_config) or die(mysqli_error($con));
$row_config = mysqli_fetch_assoc($query_select_config);

$_SESSION['VERSION'] = $row_config['version'];
$_SESSION['MostrarCotacao'] = $row_config['cotacao'];

$tip = explode('∞', $row_config['Endereco']);

$_SESSION['ZIPCODE'] = $tip[3];

// ATIVA ePacket

$_SESSION['ePacket-ativo'] = 0;

// Frete Personalizado

$_SESSION['fretePersonalizado-ativo'] = $row_config['FretePersonalizado'];


?>