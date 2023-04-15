<?php
require("functions/functions.php");

require_once __DIR__ . '/assets/CambioReal/autoload.php';

\CambioReal\Config::set(array(
    'appId' => $_SESSION['CR_Token'],
    'appSecret' => $_SESSION['CR_Account'],
    'testMode' => false,
));

?>
<html lang="en">
<head>
    <head>
        <meta http-equiv='Pragma' content='no-cache'>
        <meta http-equiv='Expires' content='-1'>
        <meta http-equiv='CACHE-CONTROL' content='NO-CACHE'>
        <script src="https://pay.parceladousa.com"></script>
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76"
              href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
        <link rel="icon" type="image/png" sizes="96x96"
              href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>SIB | Wallet</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
        <meta name="viewport" content="width=device-width"/>
        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>
        <!--  Paper Dashboard core CSS    -->
        <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet"/>
        <!--  Fonts and icons     -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    </head>
<body>
<div class="wrapper">
    <?php include 'menu.php'; ?>
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Wallet</a>
                </div>
                <div class="collapse navbar-collapse">
                    <? include 'blocks/menu-flutuante.php'; ?>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div>
                        <?php if ($_GET['t']) { ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="header">
                                        <h4 class="title">Detalhes da Transação #<?= $_GET['t']; ?></h4>
                                    </div>
                                    <div class="content">
                                        <?php
                                        $idtran = $_GET['t'];
                                        $sqlTran = "SELECT * FROM transacaoWallet WHERE idtran = '$idtran'";
                                        $query_Tran = mysqli_query($con, $sqlTran) or die(mysqli_error()); ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="transacao">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Data</th>
                                                    <th>Tipo de Transação</th>
                                                    <th>Motivo</th>
                                                    <th>Forma de Pagamento</th>
                                                    <th>Valor</th>
                                                    <th>Status</th>
                                                </tr>
                                                <?php
                                                do {
                                                    if ($row_tran['idtran'] != '') {
                                                        $date = new DateTime($row_tran['dtTran']); ?>
                                                        <tr>
                                                            <td><?= $row_tran['idtran']; ?></td>
                                                            <td><?= date_format($date, 'd-m-Y'); ?></td>
                                                            <td><?= $row_tran['tipoTran']; ?></td>
                                                            <td><?= $row_tran['motivoRecarga']; ?></td>
                                                            <td><?= $row_tran['opPagamento']; ?></td>
                                                            <?php if ($row_tran['recebe'] != '') { ?>
                                                                <td><?= "U$ +" . number_format($row_tran['recebe'], 2, ".", ""); ?></td>
                                                                <?php
                                                            } else if ($row_tran['paga'] != '') { ?>
                                                                <td><?= "U$ -" . number_format($row_tran['paga'], 2, ".", ""); ?></td>
                                                            <?php } ?>
                                                            <td><?= $row_tran['status']; ?></td>
                                                        </tr>
                                                    <?php }
                                                } while ($row_tran = mysqli_fetch_assoc($query_Tran)); ?>
                                            </table>
                                        </div>

                                        <?php

                                        $idtran = $_GET['t'];
                                        $sqlTran = "SELECT * FROM transacaoWallet WHERE idtran = '$idtran'";
                                        $query_Tran = mysqli_query($con, $sqlTran) or die(mysqli_error());
                                        $row_tran = mysqli_fetch_assoc($query_Tran);

                                        if ($row_tran['recebe'] != ''){
                                        ?>

                                        <div class="col-lg-6">
                                            <div class="header">
                                                <h4 class="title">Comprovante de Pagamento</h4>
                                            </div>
                                            <div class="content">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>Metodo de Pagamento</td>
                                                            <td>Codigo</td>
                                                            <td>Comprovante</td>
                                                        </tr>
                                                        <?php
                                                        $select_cmp = "SELECT * FROM comprovantes WHERE idtran = $idtran";
                                                        $query_select_cmp = mysqli_query($con, $select_cmp);
                                                        $numComprovantes = mysqli_num_rows($query_select_cmp);
                                                        $i = 1;
                                                        do {
                                                            if ($row_comprovante['comprovante'] != '' || $row_comprovante['codPagamento'] != '') {
                                                                ?>
                                                                <tr>
                                                                    <td><?= $row_comprovante['opPagamento']; ?></td>
                                                                    <td><?= $row_comprovante['codPagamento']; ?></td>
                                                                    <?php if ($row_comprovante['comprovante'] != '') { ?>
                                                                        <td>
                                                                            <a href="../user/assets/img/comprovantes/<?= $row_comprovante['comprovante']; ?>"
                                                                               data-fancybox data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="Clique para ampliar a imagem 1"
                                                                               class="btn btn-success btn-fill">Comprovante <?= $i; ?></a>
                                                                        </td>
                                                                    <?php } else { ?>
                                                                        <td></td> <?php } ?>
                                                                </tr>
                                                                <?php
                                                                $i++;
                                                            }
                                                        } while ($row_comprovante = mysqli_fetch_assoc($query_select_cmp));
                                                        ?>

                                                    </table>
                                                </div>
                                                <form method="post" action="functions/acrescenta-comprovante.php"
                                                      enctype="multipart/form-data">

                                                    <input type="hidden" name="idtran" value="<?= $idtran; ?>">
                                                    <input type="hidden" name="opPagamento"
                                                           value="<?= $row_tran['opPagamento']; ?>">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <?php if ($row_tran['opPagamento'] == 'WesterUnion') { ?>
                                                                    <label>
                                                                        Codigo de Pagamento *
                                                                    </label>
                                                                    <input type="text" name="codPagamento"
                                                                           id="codPagamento">
                                                                <?php } else { ?>
                                                                    <?php if ($row_tran['opPagamento'] != 'ParceladoUSA' && $row_tran['opPagamento'] != 'CambioReal' && $row_tran['opPagamento'] != 'Paypal') { ?>
                                                                        <label>
                                                                            Comprovante *
                                                                        </label>
                                                                        <input type="file" name="comprovante" required
                                                                               class="form-control border-input">
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($row_tran['opPagamento'] != 'ParceladoUSA' && $row_tran['opPagamento'] != 'CambioReal' && $row_tran['opPagamento'] != 'Paypal') { ?>
                                                        <div class="text-center">
                                                            <button type="submit" id="enviarCmp"
                                                                    class="btn btn-fill btn-success btn-wd">ENVIAR
                                                                COMPROVANTE
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="header">
                                                <h4 class="title">Valor Final</h4>
                                            </div>
                                            <div class="content">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>Taxa do cartão:<br><small>sobre o valor final</small>
                                                            </td>
                                                            <?php if ($row_tran['recebe'] != '') {
                                                                $valor = $row_tran['recebe'];
                                                            } else if ($row_tran['paga'] != '') {
                                                                $valor = $row_tran['paga'];
                                                            }
                                                            if ($row_tran['opPagamento'] == "Paypal") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-Paypal'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "Paypal.me") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-PaypalME'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "Ebanx") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-Ebanx'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "CambioReal") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-CR'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "WesternUnion") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-WU'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "TransferWise") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-TW'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "Transferencia") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-Transferencia'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else if ($row_tran['opPagamento'] == "ParceladoUSA") {

                                                                $taxapgto = $valor * ($_SESSION['taxa-ParceladoUSA'] / 100);
                                                                $valortotal = $valor + $taxapgto;

                                                            } else {
                                                                $valortotal = $valor;
                                                            }

                                                            ?>


                                                            <td>U$ <?= number_format($taxapgto, 2, ".", "") ?></td>

                                                        </tr>
                                                        <tr style="font-size: 1.5em">
                                                            <td>TOTAL:</td>
                                                            <td>U$ <?= number_format($valortotal, 2, ".", ""); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <?php if ($numComprovantes <= '0' && $row_tran['status'] == 'Aguardando Pagamento') { ?>
                                                    <div class="text-center">
                                                        <?php if ($row_tran['opPagamento'] == "Paypal") { ?>
                                                            <?php if ($_SESSION['PP_Client_ID'] != "") { ?>
                                                                <!-- PAYPAL API BUTTON-->
                                                                <script src="https://www.paypal.com/sdk/js?client-id=<?= $_SESSION['PP_Client_ID']; ?>"></script>
                                                                <div id="paypal-button-container"></div>


                                                                <script>
                                                                    paypal.Buttons({
                                                                        createOrder: function (data, actions) {
                                                                            return actions.order.create({
                                                                                purchase_units: [{
                                                                                    amount: {
                                                                                        value: '<?=number_format($valortotal, 2, ".", "");?>'
                                                                                    }
                                                                                }]
                                                                            });
                                                                        },
                                                                        onApprove: function (data, actions) {
                                                                            return actions.order.capture().then(function (details) {

                                                                                if (details.status == "COMPLETED") {
                                                                                    alert('Pagamento Realizado com Sucesso!');
                                                                                    var idtran = '<?=$idtran;?>';
                                                                                    var opPagamento = 'Paypal';

                                                                                    $.ajax({
                                                                                        method: "POST",
                                                                                        url: "functions/acrescenta-comprovante.php",
                                                                                        data: {
                                                                                            codPagamento: details.id,
                                                                                            idtran: idtran,
                                                                                            opPagamento: opPagamento
                                                                                        }
                                                                                    })
                                                                                        .done(function (msg) {
                                                                                            location.reload();
                                                                                        });
                                                                                }
                                                                            });
                                                                        }

                                                                    }).render('#paypal-button-container');
                                                                </script>

                                                            <?php } ?>
                                                        <?php } ?>
                                                        <? if ($row_tran['opPagamento'] == "Paypal.me") { ?>
                                                            <a href="https://www.paypal.me/<?= $_SESSION['paypal']; ?>/<?= number_format($valortotal, 2, ".", ""); ?>"
                                                               class="btn btn-success btn-fill" target="_blank">PAGAR
                                                                COM PAYPAL</a>
                                                        <?php } ?>
                                                        <?php if ($row_tran['opPagamento'] == "Transferencia"): ?>
                                                            <p>
                                                                <?php $valorReal = $valortotal * $_SESSION['USDT-BRL-Compra']; ?>

                                                                <strong>Valor para depósito:
                                                                    R$ <?= number_format($valorReal, 2, ".", ""); ?></strong>
                                                                <br><br>
                                                                Dados para o depósito: <br><br>

                                                                <?
                                                                $TransferenciaExplode = explode('∞', $_SESSION['PG_Transferencia']);
                                                                ?>

                                                                Banco: <?= $TransferenciaExplode['0']; ?><br>
                                                                Agência: <?= $TransferenciaExplode['1']; ?><br>
                                                                Conta Corrente: <?= $TransferenciaExplode['2']; ?><br>
                                                                Favorecido: <?= $TransferenciaExplode['3']; ?><br>
                                                                CPF: <?= $TransferenciaExplode['4']; ?> <br><br>

                                                                Após realizar o depósito, nos envie seu comprovante de
                                                                Depósito/Transferência
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if ($row_tran['opPagamento'] == "WesternUnion"): ?>
                                                            <p>
                                                                O pagamento via Western Union é realizado em
                                                                determinadas agências do Banco do Brasil e/ou Bradesco;
                                                                além das lojas Riachuelo.</p>

                                                            <p>Segue o site da WU, para que você possa localizar um
                                                                agente mais próximo.
                                                                https://www.westernunion.com/br/pt/agent-locator.html</p>

                                                            <p>Para a realização do envio ao dinheiro, você necessitará
                                                                de algumas informações como:</p>
                                                            <?
                                                            $WUExplode = explode('∞', $_SESSION['WU_Info']);

                                                            ?>
                                                            Nome:  <?= $WUExplode['0']; ?><br>
                                                            Cidade: <?= $WUExplode['1']; ?><br>
                                                            Estado: <?= $WUExplode['2']; ?><br>
                                                            Pais: <?= $WUExplode['3']; ?><br>

                                                            <p>Após o envio do valor, por favor enviar cópia do
                                                                comprovante, pois necessitaremos do número MTCN para
                                                                realização do saque.</p>
                                                            </p>
                                                        <?php endif ?>
                                                        <?php if ($row_tran['opPagamento'] == "ParceladoUSA"): ?>
                                                            <?php if ($numComprovantes < 1) { ?>
                                                                <img src="" width="150px" type="button"
                                                                     id="bt_payparceladousa"
                                                                     title="Pague com a ParceladoUSA"
                                                                     alt="Pague com a ParceladoUSA">
                                                            <?php } ?>
                                                        <?php endif ?>
                                                        <?php if ($row_tran['opPagamento'] == "CambioReal"): ?>
                                                        <!-- INICIO FORM CambioReal-->
                                                    <?
                                                    $requestBoleto = \CambioReal\CambioReal::request(array(
                                                        'client' => array(
                                                            'name' => $row_user['nome'] . " " . $row_user['sobrenome'],
                                                            'email' => $row_user['email'],
                                                        ),
                                                        'currency' => 'USD',
                                                        'amount' => number_format($valortotal, 2, ".", ""),
                                                        'order_id' => "Wallet-" . $idtran,
                                                        'duplicate' => true,
                                                        'due_date' => null,
                                                        'products' => array(
                                                            array(
                                                                'descricao' => 'Transação de Recarga #' . $idtran,
                                                                'base_value' => number_format($valortotal, 2, ".", ""),
                                                                'valor' => number_format($valortotal, 2, ".", ""),
                                                                'qty' => 1,
                                                                'ref' => 1,
                                                            ),
                                                        ),
                                                    ));


                                                    ?>

                                                        <p>
                                                            <a href="<?= $requestBoleto->data->checkout; ?>"
                                                               target="_blank">
                                                                <img src="https://www.cambioreal.com/botoes/bnt-cr-523x148.png"
                                                                     height="65">
                                                            </a>
                                                            <!--//FIM FORM CambioReal -->
                                                            <?php endif ?>
                                                            <?php if ($row_tran['opPagamento'] == "TransferWise"): ?>
                                                        <p>
                                                            Essa é a forma mais barata para nos enviar dinheiro.<br><br>
                                                            Você deve baixar o App TransferWise (IOS ou Androide) ou
                                                            acessar o site https://transferwise.com/br<br><br>
                                                            Após efetuar o seu cadastro basta incluir a nossa conta como
                                                            destinatária da remessa.<br>
                                                            Para isso você precisa apenas do nosso e-mail
                                                            <strong><?= $_SESSION['TW_Email']; ?></strong> <br><br>
                                                            Ao digitar nosso e-mail o sistema da TranferWise reconhece
                                                            automaticamente todos os nossos dados. Agora é só enviar o
                                                            dinheiro.
                                                        </p>
                                                    <?php endif ?>
                                                        <?php if ($row_tran['opPagamento'] == "Ebanx"): ?>

                                                            <?php

                                                            $config = new Config([
                                                                'integrationKey' => $_SESSION['Ebanx_API'],
                                                                'isSandbox' => $_SESSION['Ebanx_Production'],
                                                                'baseCurrency' => Currency::USD
                                                            ]);

                                                            $payment = new Request([
                                                                'person' => new Person([
                                                                    'email' => $row_user['email'],
                                                                    'name' => ucwords($row_user['nome'] . " " . $row_user['sobrenome']),
                                                                ]),
                                                                'address' => new Address([
                                                                    'country' => Country::BRAZIL
                                                                ]),
                                                                'amount' => $valortotal,
                                                                'merchantPaymentCode' => "Wallet-" . $_GET['t'],
                                                                'type' => '_all',
                                                            ]);

                                                            $result_ebanx = EBANX($config)->hosted()->create($payment);

                                                            ?>
                                                            <?php

                                                            if ($result_ebanx['status'] == 'ERROR') {

                                                                if ($result_ebanx['payment']['transaction_status']['code'] == 'OK') { ?>

                                                                    <div class="alert alert-success" id="erro">
                                                                        <p>Seu Pagamento foi realizado com Sucesso!</p>
                                                                    </div>
                                                                    <?php
                                                                } else { ?>
                                                                    <div class="alert alert-danger" id="erro">
                                                                        <p>Oops.. Houve um problema com seu
                                                                            pagamento</p>
                                                                        </br>
                                                                        <p><?= $result_ebanx['payment']['transaction_status']['description']; ?></p>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            } else { ?>

                                                                <p>
                                                                    <a href="<?= $result_ebanx['redirect_url']; ?>"
                                                                       class="btn btn-success btn-fill" target="_blank">PAGAR
                                                                        COM EBANX</a>
                                                                </p>

                                                            <?php }

                                                            ?>
                                                        <?php endif ?>
                                                        <? if ($row_tran['opPagamento'] == "SpliPay") {

                                                            if ($row_tran['idext'] != '' || $row_tran['idext'] != 0) {
                                                                $endpoint = $_SESSION['API-SpliPay'] . "api/order/" . $row_tran['idext'];
                                                                $dataArray = "";
                                                                $methodRequest = "GET";
                                                            } else {
                                                                $endpoint = $_SESSION['API-SpliPay'] . "api/orders";
                                                                $dataArray = array(
                                                                    'reference' => 'Wallet-' . $_GET['t'],
                                                                    'client' => array(
                                                                        'cpf' => preg_replace("/[^0-9]/", "", $row_user['cpf']),
                                                                        'name' => $row_user['nome'] . ' ' . $row_user['sobrenome'],
                                                                        'email' => $row_user['email'],
                                                                        'birthdate' => '1994-05-04',
                                                                        'cep' => preg_replace("/[^0-9]/", "", "73005-085"),
                                                                        'phone' => preg_replace("/[^0-9]/", "", $row_user['telefone'])
                                                                    ),
                                                                    'items' => array(
                                                                        0 => array(
                                                                            'reference' => 'Wallet-' . $_GET['t'],
                                                                            'description' => 'Wallet-' . $_GET['t'],
                                                                            'quantity' => 1,
                                                                            'amount' => preg_replace("/[^0-9]/", "", $valortotal)
                                                                        )
                                                                    ),
                                                                    'shipping' => array(
                                                                        'amount' => 0
                                                                    ),
                                                                    'redirect' => array(
                                                                        'success' => $_SESSION['link'] . "/app/user/wallet.php?success&t=" . $_GET['t'],
                                                                        'failed' => $_SESSION['link'] . "/app/user/wallet.php?fail&t=" . $_GET['t']
                                                                    )
                                                                );
                                                                $methodRequest = "POST";
                                                            }


                                                            $postData = json_encode($dataArray);

                                                            $curl = curl_init();

                                                            curl_setopt_array($curl, array(
                                                                CURLOPT_URL => $endpoint,
                                                                CURLOPT_RETURNTRANSFER => true,
                                                                CURLOPT_ENCODING => '',
                                                                CURLOPT_MAXREDIRS => 10,
                                                                CURLOPT_TIMEOUT => 0,
                                                                CURLOPT_FOLLOWLOCATION => true,
                                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                CURLOPT_CUSTOMREQUEST => $methodRequest,
                                                                CURLOPT_POSTFIELDS => $postData,
                                                                CURLOPT_HTTPHEADER => array(
                                                                    'Content-Type: application/json',
                                                                    'Authorization: Bearer ' . $_SESSION['TOKEN_SPLIPAY']
                                                                ),
                                                            ));

                                                            $response = curl_exec($curl);
                                                            $response = json_decode($response);

                                                            //echo $row_tran['idext'];
                                                            //var_dump(curl_getinfo($curl));
                                                            var_dump($response);

                                                            if ($row_tran['idext'] == '' || $row_tran['idext'] == 0) {

                                                                $sqlUpdateTran = "UPDATE transacaoWallet SET idext = '{$response->data->order_id}' WHERE idtran = '{$idtran}'";
                                                                $queryUpdateTran = mysqli_query($con, $sqlUpdateTran);

                                                                if ($response->success) {
                                                                    ?>
                                                                    <p>
                                                                        <a href="<?= $response->data->url_checkout; ?>"
                                                                           class="btn btn-success btn-fill"
                                                                           target="_blank">PAGAR
                                                                            COM SPLIPAY</a>
                                                                    </p>
                                                                    <?

                                                                }


                                                            } else {
                                                                ?>
                                                                <p>
                                                                    <a href="<?= $response->data->url_checkout; ?>"
                                                                       class="btn btn-success btn-fill" target="_blank">PAGAR
                                                                        COM SPLIPAY</a>
                                                                </p>

                                                                <?
                                                            }


                                                        } ?>
                                                    </div>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- FIM DETALHES TRANSACAO -->
                        <?php } ?>
                        <div class="col-lg-4 col-md-5">
                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="content">
                                    <!-- <form method="post" action="functions/atualiza-senha.php"> -->
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h4 class="title"><?= $_SESSION['empresa']; ?> WALLET</h4><br>
                                            <div class="form-group">
                                                &nbsp;&nbsp;&nbsp;<br>
                                                <label>Saldo em Conta</label>
                                                &nbsp;&nbsp;&nbsp;<br>
                                                &nbsp;&nbsp;&nbsp;<br>

                                                <div><h5>U$ <?= $row_wallet['saldo'] ?></h5></div>
                                            </div>
                                            <div class="form-group">
                                                &nbsp;&nbsp;&nbsp;<br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="card card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="content">
                                    <form method="post" action="functions/solicita-recarga.php">
                                        <input type="hidden" name="idwallet" value="<?= $row_wallet['idwallet']; ?>">
                                        <input type="hidden" name="tipoTran" value="Pedido de Recarga">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <h4 class="title">Recarga de Saldo</h4><br>
                                                <div class="form-group">
                                                    <label>Valor da Recarga:</label>
                                                    <input type="text" name="vlrRecarga" placeholder="U$ 100.00"
                                                           class="form-control border-input vlrRecarga">
                                                </div>
                                                <div class="form-group">
                                                    <label>Motivo da Recarga:</label>
                                                    <? if (isset($_GET['v']) and $_GET['v'] <> "") { ?>
                                                        <input type="text" name="motivoRecarga"
                                                               class="form-control border-input motivoRecarga"
                                                               value="Grupo de Compras" required>
                                                    <? } else { ?>
                                                        <input type="text" name="motivoRecarga"
                                                               class="form-control border-input motivoRecarga" required>
                                                    <? } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Opção de Pagamento</label>
                                                    <select name="opcaopgto" id="opcaopgto"
                                                            class="form-control border-input">
                                                        <option value="">Escolha a opção de pagamento</option>
                                                        <?
                                                        do {
                                                            if ($row_fp['idFormaPagamento'] != '') {
                                                                ?>
                                                                <option value="<?= $row_fp['TipoPagamento'] ?>">
                                                                    <?= $row_fp['TipoPagamento']; ?>
                                                                    - <?= $row_fp['taxa']; ?>%
                                                                </option>
                                                                <?
                                                            }
                                                        } while ($row_fp = mysqli_fetch_assoc($query_select_fp));
                                                        ?>

                                                    </select>
                                                    <br>
                                                    <div class="cpfPagador">
                                                        <input type="text" class="cpfPagador form-control border-input"
                                                               oninput="mascaraCPF(this)" name="cpfPagador"
                                                               maxlength="11"
                                                               placeholder="CPF - Obrigatório PaceladoUSA"
                                                               style="font-weight: bold; text-align: left">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-fill btn-wd">Solicitar
                                                Recarga
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 col-md-7">
                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header">
                                    <h4 class="title">Histórico de Transações</h4>
                                </div>
                                <div class="content">
                                    <?php
                                    $idwallet = $row_wallet['idwallet'];
                                    $sqlHistorico = "SELECT * FROM transacaoWallet WHERE idwallet = '$idwallet' AND status <> 'Recusado' ORDER BY idtran DESC";
                                    $query_historico = mysqli_query($con, $sqlHistorico) or die(mysqli_error()); ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="historico">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Data</th>
                                                <th>Tipo de Transação</th>
                                                <th>Forma de Pagamento</th>
                                                <th>Valor (U$)</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            do {
                                                if ($row_historico['idtran'] != '') {
                                                    $date = new DateTime($row_historico['dtTran']); ?>
                                                    <tr>
                                                        <td><?= $row_historico['idtran']; ?></td>
                                                        <td><?= date_format($date, 'd-m-Y'); ?></td>
                                                        <td><?= $row_historico['tipoTran']; ?></td>
                                                        <td><?= $row_historico['opPagamento']; ?></td>
                                                        <?php if ($row_historico['recebe'] != '') { ?>
                                                            <td><?= "+" . number_format($row_historico['recebe'], 2, ".", ""); ?></td>
                                                            <?php
                                                        } else if ($row_historico['paga'] != '') { ?>
                                                            <td><?= "-" . number_format($row_historico['paga'], 2, ".", ""); ?></td>
                                                        <?php } ?>
                                                        <td><?= $row_historico['status']; ?></td>
                                                        <td>
                                                            <a href="wallet.php?t=<?= $row_historico['idtran'] ?>"
                                                               data-toggle="tooltip"
                                                               title="Clique aqui para visualizar detalhes desta transação."><i
                                                                        class="fa fa-external-link"></i> Abrir</a>
                                                            <? if ($row_historico['status'] == 'Aguardando Pagamento') { ?>
                                                                <br>
                                                                <a href="functions/cancelarRecarga.php?t=<?= $row_historico['idtran'] ?>"
                                                                   data-toggle="tooltip"
                                                                   title="Clique aqui para cancelar esta transação."><i
                                                                            class="fa fa-trash"></i></a>
                                                            <? } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } while ($row_historico = mysqli_fetch_assoc($query_historico)); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <br><br><br><br><br><br><br><br> -->
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-4 col-md-5"> -->

                        <!--  </div> -->

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    <? include("blocks/footer.php"); ?>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>
<!--  Charts Plugin -->
<!-- <script src="assets/js/chartist.min.js"></script> -->
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
<script type="text/javascript">
    function sumirsuccess() {
        var este = document.getElementById('alert-success');
        este.style.display = "none";
    }

    function sumirdanger() {
        var este = document.getElementById('alert-danger');
        este.style.display = "none";
    }
</script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    function atualizaPagamento() {
        setTimeout(function () {
            var opt = $('#opcaopgto').val();

            if (opt == 'ParceladoUSA') {
                $('.cpfPagador').show();
            } else {
                $('.cpfPagador').hide();
            }

            atualizaPagamento();

        }, 500);
    }

    $(document).ready(function () {

        $('.cpfPagador').hide();
        atualizaPagamento();

        $('#historico').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $('.vlrRecarga').mask('##0.00', {reverse: true});
</script>
<script>
    function mascaraCPF(i) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length - 1);
            return;
        }

        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
</script>
<?php if ($row_tran['opPagamento'] == "ParceladoUSA"): ?>
    <script>
        $(document).ready(function () {
            var startPay = new startGatewayParceladoUSA();
            startPay.setValor("<?=number_format($valortotal, 2, ".", "");?>"); //Informar valor total da compra
            startPay.setPublickey("<?=$_SESSION['ParceladoUSA_API'];?>"); //Chave de cliente fornecida pela ParceladoUSA
            startPay.setProduction(<?=$_SESSION['ParceladoUSA_Production'];?>); // false = testes, true = produção
            startPay.setEmail("<?=$row_user['email'];?>"); //e-mail do cliente
            startPay.setCpf("<?=$row_tran['cpfPagador'];?>"); //CPF do cliente
            startPay.setTel("<?=$row_user['telefone'];?>"); //Celular do cliente
            startPay.startForm(); //Starta o formulário
        });

        //Função de retorno, receberá o retorno do processamento.

        function RetPayParcelado(sucesso, idcompra, authcode, msg, tipo) {

            if (sucesso) {

                var idtran = '<?=$idtran;?>';
                var data = {
                    idtran: idtran,
                    authcode: authcode,
                    idcompra: idcompra,
                    tipo: tipo,
                    msg: msg,
                    source: 'Wallet',
                    iduser: '<?=$id_user;?>'
                };

                console.log(data);

                $.post("functions/valida-parceladoUSA.php", data)
                    .done(function (result) {

                        response = JSON.parse(result);
                        console.log(result);

                        if (response.cod == '404') {
                            alert("Desculpe, seu pagamento não foi Processado!");
                        } else if (response.addComprovante == true) {
                            $.post("functions/acrescenta-comprovante.php", {
                                idtran: idtran,
                                opPagamento: "ParceladoUSA",
                                codPagamento: authcode
                            })
                                .done(function () {
                                    //location.reload();
                                });
                        } else if (response.addComprovante == false) {
                            alert("Seu pagamento está em Analise..");
                        }

                    });

            } else {
                console.log("erro pagamento: " + msg);
            }
        }


    </script>
<?php endif ?>
</html>
