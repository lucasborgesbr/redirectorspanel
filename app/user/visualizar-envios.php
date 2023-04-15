<?php 
require ("functions/functions.php");
require ("functions/conexao.php");

require("assets/ebanx-new/vendor/autoload.php");
require_once __DIR__ . '/assets/CambioReal/autoload.php';

\CambioReal\Config::set(array(
    'appId'      => $_SESSION['CR_Token'],
    'appSecret'  => $_SESSION['CR_Account'],
    'testMode'   => false,
));

use Ebanx\Benjamin\Models\Configs\Config;
use Ebanx\Benjamin\Models\Currency;
use Ebanx\Benjamin\Models\Request;
use Ebanx\Benjamin\Models\Person;
use Ebanx\Benjamin\Models\Address;
use Ebanx\Benjamin\Models\Country;

?>
<!doctype html>
<html lang="en">
<head>
    <head>
      <meta http-equiv='Pragma' content='no-cache'>
      <meta http-equiv='Expires' content='-1'>
      <meta http-equiv='CACHE-CONTROL' content='NO-CACHE'>
      <meta charset="utf-8" />
      <link rel="apple-touch-icon" sizes="76x76" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
      <link rel="icon" type="image/png" sizes="96x96" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>SIB | Produtos</title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
      <meta name="viewport" content="width=device-width" />
      <!-- Bootstrap core CSS     -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
      <!-- Animation library for notifications   -->
      <link href="assets/css/animate.min.css" rel="stylesheet"/>
      <!--  Paper Dashboard core CSS    -->
      <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
      <!--  CSS for Demo Purpose, don't include it in your project     -->
      <link href="assets/css/demo.css" rel="stylesheet" />
      <!--  Fonts and icons     -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
      <link href="assets/css/themify-icons.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css?v=2.1.5">
      <link rel="stylesheet" type="text/css" href="assets/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
      <!-- jquery min-->
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      
      <script src="assets/js/redirect-jquery.js" type="text/javascript"></script>

      <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet">
      
      
    <!-- chamar functions.js  
        <script type="text/javascript" src="functions/functions.js"></script>-->
        <style type="text/css">
            #box-user{
                background-color:#d7ffd7;
                border-radius: 20px 20px;
                float: right;
                text-align: right;
            }

            #box-admin{
                background-color:#f2f2f2;
                border-radius: 20px 20px;
                float: left;
                text-align: left;
            }
        </style>
        <script src="https://pay.parceladousa.com"></script>
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
                            <a class="navbar-brand" href="#">Visualização de Envios</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <? include 'blocks/menu-flutuante.php'; ?>
                        </div>
                    </div>
                </nav>
                <div class="content" id="printJS-form">
                    <!-- form criar envio -->
                    <?php if ($row_envios['idenvio'] != ""){ ?>
                        <!-- <form method="post" action="functions/acrescenta-envio.php"> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if (isset($_GET['s'])): ?>
                                        <div class="alert alert-success" id="erro">
                                            <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                                            <span>Seu boleto foi gerado com sucesso!</span>
                                        </div>
                                    <?php endif ?>
                                    <?php if (isset($_GET['e'])): ?>
                                        <div class="alert alert-danger" id="erro">
                                            <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                                            <span>Oops! Houve um problema ao gerar seu Boleto!<br> Tente novamente!</span>
                                        </div>
                                    <?php endif ?>
                                    <div class="card">
                                        <div class="header printableArea">
                                            <h4 class="title">Dados do Envio # <?= $_GET['idenvio']; ?></h4>   
                                        </div>
                                        <div class="content">
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-center">
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Imagens</td>
                                                        <td>Descrição</td>
                                                        <td>Quantidade enviada</td>
                                                        <td>Quantidade no estoque</td>
                                                    </tr>
                                                    <?php 
                                                    $dados = explode("|", $row_envios['conteudo'], -1);

                                                    for ($i=0; $i < count($dados); $i++) { 
                                                        $colunas = explode("-", $dados[$i]);
                                                        $sql5 = "SELECT * FROM produtos WHERE idproduto = '$colunas[0]'";
                                                        $query5 = mysqli_query($con, $sql5);
                                                        $ln = mysqli_fetch_assoc($query5);

                                                        if($row_envios['status'] == 'CANCELADO'){
                                                            $qtd = "0";

                                                        }else{
                                                            $qtd = $colunas[2];

                                                        }

                                                        echo "<tr>
                                                        <td>".$colunas[0]."</td>
                                                        <td>";
                                                        if($ln["imagem1"] != ''){
                                                            echo "<a href='assets/img/produtos/".$ln["imagem1"]."' data-fancybox-group='produtos' class='fancybox'><img src='assets/img/produtos/".$ln['imagem1']."' style='border:1px solid #ccc; padding:1px; border-radius:5px; height:80px'></a>";
                                                        }
                                                        if($ln["imagem2"] != ''){
                                                            echo "<a href='assets/img/produtos/".$ln["imagem2"]."' data-fancybox-group='produtos' class='fancybox'><img src='assets/img/produtos/".$ln['imagem2']."' style='border:1px solid #ccc; padding:1px; border-radius:5px; height:80px'></a>";
                                                        }


                                                        echo "</td><td>".$colunas[1]."</td>
                                                        <td>".$qtd."</td>
                                                        <td>".$ln['quantidade']."</td>


                                                        </tr>"; 

                                                    }

                                                    ?>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="row" id="add-frete-pagamento">
                                <!-- card para escolha do endereco -->
                                <div class="col-lg-4">
                                    <div class="card printableArea">
                                        <div class="header">
                                            <h4 class="title">Endereço de Entrega</h4>
                                        </div>

                                        <div class="content">
                                            <p><?= $row_envios['endereco']; ?></p>
                                        </div>

                                    </div>
                                </div>

                                <!-- card para escolha da forma de envio -->
                                <div class="col-lg-4">
                                    <div class="card printableArea">
                                        <div class="header">
                                            <h4 class="title">Opção de Envio</h4>
                                        </div>
                                        <div class="content">
                                            <p>
                                                <?php if ($row_envios['formaenvio'] == "First_Class") {echo "USPS - First Class" ; } else ?>
                                                <?php if ($row_envios['formaenvio'] == "Priority") {echo "USPS - Prority Mail" ; } else ?>
                                                <?php if ($row_envios['formaenvio'] == "Express") {echo "USPS - Prority Mail Express" ; } else {
                                                    echo $row_envios['formaenvio'];
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>   

                                <!-- card para escolha da forma de pagamento -->
                                <div class="col-lg-4">
                                    <div class="card printableArea">
                                        <div class="header">
                                            <h4 class="title">Opção de Pagamento</h4>
                                        </div>
                                        <div class="content">
                                            <p><?= $row_envios['formapgto']; ?></p>
                                        </div>
                                    </div>
                                </div>   

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card" id="declaRemove">
                                        <div class="header">
                                            <h4 class="title">Declaração Alfandegária</h4>
                                        </div>
                                        <div class="content">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>

                                                        <td>Descrição</td>
                                                        <td>Valor Unit</td>
                                                        <td>Subtotal</td>
                                                    </tr>
                                                    <?php 
                                                    $declaracao = explode("|", $row_envios['declaracao'], -1);

                                                    for ($j=0; $j < count($declaracao); $j++) { 
                                                        $dec = explode("-", $declaracao[$j]);

                                                        if ($dec[0] != "") {
                                                            echo "<tr>
                                                            <td>".$dec[0]."</td>
                                                            <td>".$dec[1]."</td>
                                                            <td>".$dec[2]."</td>
                                                            </tr>"; 
                                                        }

                                                    }
                                                    echo "<tr><td></td><td>Valor Declarado Final:</td><td>".$row_envios['valordeclaradofinal']."</td></tr>";

                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" id="comprovanteList">
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
                                                    $envio = $_GET['idenvio'];
                                                    $select_cmp = "SELECT * FROM comprovantes WHERE idEnvio = $envio";
                                                    $query_select_cmp = mysqli_query($con, $select_cmp) or die(mysqli_error());
                                                    $num_cmp = mysqli_num_rows($query_select_cmp);
                                                    $i = 1;
                                                    do {
                                                        if($row_comprovante['comprovante'] != '' || $row_comprovante['codPagamento'] != ''){
                                                            ?>
                                                            <tr>
                                                                <td><?= $row_comprovante['opPagamento']; ?></td>
                                                                <td><?= $row_comprovante['codPagamento']; ?></td>
                                                                <?php if($row_comprovante['comprovante'] != ''){ ?>
                                                                    <td>
                                                                        <a href="assets/img/comprovantes/<?= $row_comprovante['comprovante']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 1" class="btn btn-success btn-fill">Comprovante <?= $i; ?></a>
                                                                    </td>
                                                                <?php } else { ?> <td></td> <?php } ?>
                                                            </tr>
                                                            <?php
                                                            $i++;}
                                                        } while ($row_comprovante = mysqli_fetch_assoc($query_select_cmp));
                                                        ?>

                                                    </table>
                                                </div>
                                                <form method="post" action="functions/acrescenta-comprovante.php" enctype="multipart/form-data">
                                                    <input type="hidden" name="idenvio" value="<?=$_GET['idenvio'];?>">
                                                    <input type="hidden" name="opPagamento" value="<?=$row_envios['formapgto'];?>">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <?php if($row_envios['formapgto'] == 'Paypal' || $row_envios['formapgto'] == 'WesterUnion') {?>
                                                                    <label>
                                                                        Codigo de Pagamento *
                                                                    </label>
                                                                    <input type="text" name="codPagamento" id="codPagamento">
                                                                <?php } else { ?>
                                                                    <?php if($row_envios['formapgto'] != 'ParceladoUSA') { ?>
                                                                        <label>
                                                                            Comprovante *
                                                                        </label>
                                                                        <input type="file" name="comprovante" required class="form-control border-input">
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if($row_envios['formapgto'] != 'ParceladoUSA') { ?>
                                                        <div class="text-center">
                                                            <button type="submit" id="enviarCmp" class="btn btn-fill btn-success btn-wd">ENVIAR COMPROVANTE</button>
                                                        </div>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card" id="obsCompra">
                                            <div class="header">
                                                <h4 class="title">Observações da Compra</h4>
                                                <small>Alguma observação especial sobre este envio? Conta pra gente</small>
                                            </div>
                                            <div class="content">
                                                <div id='divObs' style="height:200px; overflow: auto;">
                                                    <?php 
                                                    $select_obs = "SELECT * FROM observacoes WHERE idEnvio = $envio ORDER BY idObs ASC";
                                                    $query_select_obs = mysqli_query($con, $select_obs) or die(mysqli_error());
                                                    do{
                                                        if($row_obs['admin'] == '1'){?>
                                                            <div id="box-admin">&ensp;<?=$row_obs['txObs']?>&ensp;</div><br>
                                                            <?php 
                                                        } else if($row_obs['admin'] == '0'){ ?>
                                                            <div id="box-user">&ensp;<?=$row_obs['txObs']?>&ensp;</div><br>
                                                        <?php } else {}
                                                    } while ($row_obs = mysqli_fetch_assoc($query_select_obs))
                                                    ?>
                                                </div>
                                                <div>
                                                    <br>
                                                    <form method="post" action="functions/acrescenta-obs.php">
                                                        <input type="hidden" name="idEnvio" value="<?=$envio?>">
                                                        <input type="hidden" name="admin" value="0">
                                                        <input type="hidden" name="email" value="<?=$row_usuario['email']?>">
                                                        <input type="hidden" name="nome" value="<?=$row_usuario['nome']?>">

                                                        <input type="text" class="txObs form-control border-input" name="txObs" maxlength="60" placeholder="Escreva sua mensagem aqui">
                                                        <small>Caracteres Restantes: </small><small class="caracteresRestantes">60</small>
                                                        <br>
                                                        <button type="submit" class="btnobs btn btn-primary btn-sm btn-fill" style="float: right;">Enviar Resposta</button>
                                                    </form>
                                                </div>
                                            </div><br><br>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">Serviços Extras</h4>

                                            </div>
                                            <div class="content">

                                                <?php 
                                                $servicosex = explode("|", $row_envios['servicosextrasdesc'], -1);
                                                $servicex = "";
                                                for ($r=0; $r < count($servicosex); $r++) { 
                                                    $servicex .= $servicosex[$r]."<br>";
                                                }
                                                echo str_replace("_", " ", $servicex);
                                                ?>

                                            </div>
                                        </div>

                                        <!-- card do total -->
                                        <div class="card" id="vlrFinalList">
                                            <div class="header">
                                                <h4 class="title">Valor Final</h4>
                                            </div>
                                            <div class="content">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>Valor do Frete USPS:</td>
                                                            <td>U$ <?= $row_envios['usps']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Valor do Serviço:</td>
                                                            <td>U$ <?= $row_envios['taxaservico']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Serviços Extras:</td>
                                                            <td>U$ <?= $row_envios['taxaextras']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taxa extra de armazenamento:</td>
                                                            <td>U$ <?= $row_envios['taxaarmazenamento']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taxa do cartão:<br><small>sobre o valor final</small></td>
                                                            <td>U$ <?= number_format($row_envios['taxapgto'], 2, ".", "") ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Descontos:</td>
                                                            <td>
                                                                U$ -<?= $row_envios['vlrDesconto']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr style="font-size: 1.5em">
                                                            <td>TOTAL:</td>
                                                            <td>U$ <?= $row_envios['valortotal']; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <? if($row_envios['status'] != 'CANCELADO'){ ?>
                                                    <div class="text-center" id="btnPagamento">
                                                        <?php if ($row_envios['formapgto'] == "Paypal"){ ?>
                                                            <?php if($_SESSION['PP_Client_ID'] != ""){ ?>
                                                                <!-- PAYPAL API BUTTON-->
                                                                <script src="https://www.paypal.com/sdk/js?client-id=<?=$_SESSION['PP_Client_ID'];?>"></script>
                                                                <div id="paypal-button-container"></div>


                                                                <script>
                                                                    paypal.Buttons({
                                                                        createOrder: function(data, actions) {
                                                                            return actions.order.create({
                                                                                purchase_units: [{
                                                                                    amount: {

                                                                                        value: '<?=number_format($row_envios['valortotal'], 2, ".", "");?>'
                                                                                    }
                                                                                }]
                                                                            });
                                                                        },
                                                                        onApprove: function(data, actions) {
                                                                            return actions.order.capture().then(function(details) {

                                                                                if(details.status == "COMPLETED"){
                                                                                    alert('Pagamento Realizado com Sucesso!');
                                                                                    var idenvio = '<?=$envio;?>';
                                                                                    var opPagamento = 'Paypal';

                                                                                    $.ajax({
                                                                                        method: "POST",
                                                                                        url: "functions/acrescenta-comprovante.php",
                                                                                        data: { codPagamento:details.id, idenvio:idenvio, opPagamento:opPagamento }
                                                                                    })
                                                                                    .done(function(msg){
                                                                                        location.reload();
                                                                                    });
                                                                                }
                                                                            });
                                                                        }
                                                                    }).render('#paypal-button-container');
                                                                </script>

                                                            <?php } else if($_SESSION['paypal'] != ""){ ?>
                                                                <a href="https://www.paypal.me/<?=$_SESSION['paypal'];?>/<?=number_format($row_envios['valortotal'], 2, ".", "");?>" class="btn btn-success btn-fill" target="_blank">PAGAR COM PAYPAL</a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if ($row_envios['formapgto'] == "WesternUnion"): ?>
                                                            <p>
                                                            O pagamento via Western Union é realizado em determinadas agências do Banco do Brasil e/ou Bradesco; além das lojas Riachuelo.</p>

                                                            <p>Segue o site da WU, para que você possa localizar um agente mais próximo.
                                                            https://www.westernunion.com/br/pt/agent-locator.html</p>

                                                            <p>Para a realização do envio ao dinheiro, você necessitará de algumas informações como:</p><br>
                                                            <?
                                                            $WUExplode = explode('∞', $_SESSION['WU_Info']);

                                                            ?>
                                                            Nome:  <?=$WUExplode['0'];?><br>
                                                            Cidade: <?=$WUExplode['1'];?><br>
                                                            Estado: <?=$WUExplode['2'];?><br>
                                                            Pais: <?=$WUExplode['3'];?><br>

                                                            <p>Após o envio do valor, por favor enviar cópia do comprovante, pois necessitaremos do número MTCN para realização do saque.</p>
                                                        </p>
                                                    <?php endif ?>
                                                    <?php if ($row_envios['formapgto'] == "ParceladoUSA"): ?>
                                                        <?php if($num_cmp < 1){?>
                                                            <img src="" width="150px" type="button" id="bt_payparceladousa" title="Pague com a ParceladoUSA" alt="Pague com a ParceladoUSA">
                                                        <?php }?>
                                                    <?php endif ?>
                                                    <?php if ($row_envios['formapgto'] == "CambioReal"): ?>
                                                        <!-- INICIO FORM CambioReal-->
                                                        <? 
                                                        $requestBoleto = \CambioReal\CambioReal::request(array(
                                                            'client' => array(
                                                                'name'  => $row_user['nome']." ".$row_user['sobrenome'],
                                                                'email' => $row_user['email'],
                                                            ),
                                                            'currency'  => 'USD',
                                                            'amount'    => number_format($row_envios['valortotal'], 2, ".", ""),
                                                            'order_id'  => "Env-".$_GET['idenvio'],
                                                            'duplicate' => true,
                                                            'due_date'  => null,
                                                            'products'  => array(
                                                                array(
                                                                    'descricao'  => 'Envio #'.$_GET['idenvio'],
                                                                    'base_value' => number_format($row_envios['valortotal'], 2, ".", ""),
                                                                    'valor'      => number_format($row_envios['valortotal'], 2, ".", ""),
                                                                    'qty'        => 1,
                                                                    'ref'        => 1,
                                                                ),
                                                            ),
                                                        ));

                                                    //var_dump($requestBoleto->data->checkout);
                                                        ?>

                                                        <p>
                                                            <a href="<?=$requestBoleto->data->checkout;?>" target="_blank">
                                                                <img src="https://www.cambioreal.com/botoes/bnt-cr-523x148.png" height="65">
                                                            </a>
                                                            <!--//FIM FORM CambioReal -->
                                                        </p>
                                                    <?php endif ?>
                                                    <?php if ($row_envios['formapgto'] == "Transferencia"): ?>
                                                        <p> 
                                                            <strong>Valor para depósito: R$ <?=number_format($row_envios['valorReal'], 2, ".", "");?></strong>
                                                            <br><br>

                                                            Dados para o depósito no Itaú: <br><br>

                                                            <?=$_SESSION['PG_Itau'];?>

                                                            Após realizar o depósito, nos envie seu comprovante de Depósito/Transferência
                                                        </p>
                                                    <?php endif ?>
                                                    <?php if ($row_envios['formapgto'] == "TransferWise"): ?>
                                                        <p>
                                                            Essa é a forma mais barata para nos enviar dinheiro.<br><br>
                                                            Você deve baixar o App TransferWise (IOS ou Androide) ou acessar o site https://transferwise.com/br<br><br>
                                                            Após efetuar o seu cadastro basta incluir a nossa conta como destinatária da remessa.<br>
                                                            Para isso você precisa apenas do nosso e-mail <?=$_SESSION['TW_Email'];?> <br><br>
                                                            Ao digitar nosso e-mail o sistema da TranferWise reconhece automaticamente todos os nossos dados. Agora é só enviar o dinheiro.
                                                        </p>
                                                    <?php endif ?>
                                                    <?php if ($row_envios['formapgto'] == "Ebanx"): ?>
                                                        <?php 

                                                        $config = new Config([
                                                            'integrationKey' => $_SESSION['Ebanx_API'],
                                                            'isSandbox' => $_SESSION['Ebanx_Production'],
                                                            'baseCurrency' => Currency::USD
                                                        ]);

                                                        $payment = new Request([
                                                            'person' => new Person([
                                                                'email' => $row_user['email'],
                                                                'name' => ucwords($row_user['nome']." ".$row_user['sobrenome']),
                                                            ]),
                                                            'address' => new Address([
                                                                'country' => Country::BRAZIL
                                                            ]),
                                                            'amount' => $row_envios['valortotal'],
                                                            'merchantPaymentCode' => $_GET['idenvio'],
                                                            'type' => '_all',
                                                        ]);

                                                        $result_ebanx = EBANX($config)->hosted()->create($payment);

                                                        ?>
                                                        <?php 

                                                        if($result_ebanx['status'] == 'ERROR'){ 

                                                            if($result_ebanx['payment']['transaction_status']['code'] == 'OK'){ ?>

                                                                <div class="alert alert-success" id="erro">
                                                                    <p>Seu Pagamento foi realizado com Sucesso!</p>
                                                                </div>
                                                                <?php    
                                                            } else { ?>
                                                                <div class="alert alert-danger" id="erro">
                                                                    <p>Oops.. Houve um problema com seu pagamento</p>
                                                                </br>
                                                                <p><?=$result_ebanx['payment']['transaction_status']['description'];?></p>
                                                            </div> 
                                                            <?php    
                                                        }
                                                    }else {?>

                                                        <p>
                                                            <a href="<?=$result_ebanx['redirect_url'];?>" class="btn btn-success btn-fill" target="_blank">PAGAR COM EBANX</a>
                                                        </p>

                                                    <?php }

                                                    ?>

                                                <?php endif ?>

                                            </div>
                                        <? } ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- </form -->
                    <?php } else {echo "<div class='card'><div class='content'><p>Nenhum envio encontrado.</p></div></div>";} ?>




                </div>
                <!--<button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>-->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright pull-right">
                            <? include ("blocks/footer.php"); ?>  
                        </div>
                        <div class="copyright pull-left">
                            <? include ("blocks/translations.php"); ?>  
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
    <script src="assets/js/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <script src="assets/fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script>
    <script type="text/javascript" src="assets/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <!-- <script src="assets/js/demo.js"></script> 
        <script src="assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>-->
        <script src="https://printjs-4de6.kxcdn.com/print.min.js" type="text/JavaScript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $(".fancybox").fancybox({
                    closeBtn  : false,
                    helpers : {

                      buttons : {}
                  },
              });

                $("#print").click(function() {
                    printJS({
                        printable: 'printJS-form',
                        type: 'html',
                        ignoreElements: [
                        'obsCompra',
                        'btnPagamento',
                        'add-frete-pagamento',
                        'declaRemove',
                        'comprovanteList',
                        'vlrFinalList'
                        ]
                    });
                });

                <? if(isset($_GET['cancel'])){ ?>
                    document.location = '<?=str_replace("&cancel", "", $_SERVER['REQUEST_URI']);?>';
                <? } ?>
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            function fechar(){
                document.getElementById('erro').style.display = "none";
            }

            $().ready(function(){
                $("#divObs").animate({ scrollTop: 1000 }, 3000);
            });

            $(document).on("input", ".txObs", function () {
                var limite = 60;
                var caracteresDigitados = $(this).val().length;
                var caracteresRestantes = limite - caracteresDigitados;

                $(".caracteresRestantes").text(caracteresRestantes);
            });

        </script>

        <?php if ($row_envios['formapgto'] == "ParceladoUSA"): ?>
            <script>
             $(document).ready(function () {
               var startPay = new startGatewayParceladoUSA();
                 startPay.setValor("<?=$row_envios['valortotal'];?>"); //Informar valor total da compra
                 startPay.setPublickey("<?=$_SESSION['ParceladoUSA_API'];?>"); //Chave de cliente fornecida pela ParceladoUSA
                 startPay.setProduction(<?=$_SESSION['ParceladoUSA_Production'];?>); // false = testes, true = produção
                 startPay.setEmail("<?=$row_user['email'];?>"); //e-mail do cliente
                 startPay.setCpf("<?=$row_envios['cpf'];?>"); //CPF do cliente
                 startPay.setTel("<?=$row_user['telefone'];?>"); //Celular do cliente
                 //startPay.setCep("99999.999"); //Cep do cliente
                 //startPay.setEnd("Rua "); //Endereço do cliente
                 //startPay.setNum("18"); // Número do endereço do cliente
                 //startPay.setCidade("cidade"); // Cidade do cliente
                 //startPay.setUf("UF"); // Estado no padrão ES, SP, MG...
                 startPay.startForm(); //Starta o formulário
             });

             function RetPayParcelado(sucesso,idcompra,authcode,msg,tipo) {

               if(sucesso){

                  var idenvio = '<?=$envio;?>';
                  var data = {
                    idenvio:idenvio, 
                    authcode:authcode, 
                    idcompra:idcompra,
                    tipo:tipo,
                    msg:msg,
                    source:'Envios',
                    iduser:'<?=$id_user;?>'
                };

                if(tipo == 'B'){
                    $.post("functions/add-boleto.php", data)
                    .done(function(resposta){
                      console.log("Boleto Armazenado!");
                  });
                }
                
                $.post("https://parceladousa.com/API/v1/payverify/verify", {id:idcompra, authcode:authcode})
                .done(function(xpto){
                    if(xpto.cod == '200'){

                      $.post("functions/valida-parceladoUSA.php", data)
                      .done(function(result){
                        if(result.cod == '200' || tipo == 'C'){
                          $.post("functions/acrescenta-comprovante.php", { idenvio:idenvio, opPagamento: "ParceladoUSA", codPagamento:authcode })
                          .done(function(){
                             location.reload();
                         });
                      } else {
                          alert("Seu pagamento está em Analise..");
                          location.reload();
                      }
                  });

                  } else if(xpto.cod == '404'){
                      alert("Desculpe, seu pagamento não foi Processado!");
                      location.reload();
                  }                     
              });

            }
        }

    </script>                           
<?php endif ?>
<!--<script type="text/javascript" src="functions/functions.js"></script>-->

</html>
