<?php 
require ("functions/functions.php");
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
	<title>SIB | Wallet</title>
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
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <?php include("blocks/topbar.php"); ?>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div >
                        <!-- card Detalhes da Transação -->
                        <?php if($_GET['t']){ ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="header">
                                        <h4 class="title">Detalhes da Transação #<?=$_GET['t'];?></h4>
                                    </div>
                                    <div class="content">
                                        <?php
                                        $idtran = $_GET['t'];
                                        $sqlTran = "SELECT t.idtran, t.dtTran, t.tipoTran, t.status, t.opPagamento,
                                        t.recebe, t.paga, u.nome, u.sobrenome, u.iduser, t.idwallet, u.email 
                                        FROM transacaoWallet as t
                                        LEFT JOIN wallet as w ON w.idwallet = t.idwallet
                                        LEFT JOIN users as u ON w.iduser = u.iduser
                                        WHERE t.idtran = '$idtran' ORDER BY t.idtran DESC";
                                        $query_Tran = mysqli_query($con, $sqlTran) or die(mysqli_error());?>
                                        <div class="table-responsive">    
                                            <table class="table table-bordered" id="transacao">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cliente | Suíte</th>
                                                    <th>Data</th>
                                                    <th>Tipo de Transação</th>
                                                    <th>Forma de Pagamento</th>
                                                    <th>Valor</th>
                                                    <th>Status</th>
                                                </tr>
                                                <?php
                                                do{ if($row_tran['idtran'] != ''){
                                                    $status = $row_tran['status'];
                                                    $idwallet = $row_tran['idwallet'];
                                                    $email = $row_tran['email'];
                                                    $motivo = $row_tran['tipoTran'];
                                                    $idtran = $row_tran['idtran'];
                                                    $date = new DateTime($row_tran['dtTran']);?>
                                                    <tr>
                                                        <td><?=$row_tran['idtran'];?></td>
                                                        <td><?=$row_tran['nome']." ".$row_tran['sobrenome']." | ".$row_tran['iduser'];?></td>
                                                        <td><?=date_format($date, 'd-m-Y');?></td>
                                                        <td><?=$row_tran['tipoTran'];?></td>
                                                        <td><?=$row_tran['opPagamento'];?></td>
                                                        <?php if($row_tran['recebe'] != ''){ ?>
                                                            <td><?="U$ +".number_format($row_tran['recebe'], 2, ".", ".");?><?php $valorCredito = $row_tran['recebe'];?></td>
                                                            <?php 
                                                        } else if($row_tran['paga'] != ''){ ?>
                                                            <td><?="U$ -".number_format($row_tran['paga'], 2, ".", ".");?><?php $valorCredito = $row_tran['paga'];?></td>
                                                        <?php } ?>
                                                        <td><?=$row_tran['status'];?></td>
                                                    </tr>
                                                <?php    }} while($row_tran = mysqli_fetch_assoc($query_Tran)); ?>
                                            </table>
                                        </div>
                                        
                                        <?php

                                        $idtran = $_GET['t'];
                                        $sqlTran = "SELECT * FROM transacaoWallet WHERE idtran = '$idtran'";
                                        $query_Tran = mysqli_query($con, $sqlTran) or die(mysqli_error());
                                        $row_tran = mysqli_fetch_assoc($query_Tran);

                                        if($row_tran['recebe'] != '' || $row_tran['paga'] != ''){?>

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

                                                                if($row_comprovante['comprovante'] != '' || $row_comprovante['codPagamento'] != ''){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $row_comprovante['opPagamento']; ?></td>
                                                                        <td><?= $row_comprovante['codPagamento']; ?></td>
                                                                        <?php if($row_comprovante['comprovante'] != ''){ ?>
                                                                            <td><a href="../user/assets/img/comprovantes/<?= $row_comprovante['comprovante']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 1" class="btn btn-success btn-fill">Comprovante <?= $i; ?></a>
                                                                            </td>
                                                                        <?php } else { ?> <td></td> <?php } ?>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;}
                                                                } while ($row_comprovante = mysqli_fetch_assoc($query_select_cmp));
                                                                ?>
                                                                
                                                            </table>
                                                        </div>
                                                        <?php if($status == 'Processando'){ ?>
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="idtran" value="<?=$idtran;?>">
                                                                <input type="hidden" name="vlrRecarga" value="<?=$valorCredito;?>">
                                                                <input type="hidden" name="idwallet" value="<?=$idwallet;?>">
                                                                <input type="hidden" name="email" value="<?=$email;?>">
                                                                <input type="hidden" name="motivo" value="<?=$motivo;?>">
                                                                
                                                                <?php if($row_tran['recebe'] != ''){ ?>
                                                                    <div class="text-center" id="botoesForm">
                                                                        <button type="submit" id="enviarCmp" class="btn btn-fill btn-success btn-wd" formaction="functions/credito.php?a=1">Aprovar</button>
                                                                        <button type="submit" id="enviarCmp" class="btn btn-fill btn-danger btn-wd" formaction="functions/credito.php?r=1">Recusar</button>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if($row_tran['paga'] != ''){ ?>
                                                                    <div class="text-center" id="botoesForm">
                                                                        <button type="submit" id="enviarCmp" class="btn btn-fill btn-success btn-wd" formaction="functions/credito.php?a=2">Aprovar</button>
                                                                        <button type="submit" id="enviarCmp" class="btn btn-fill btn-danger btn-wd" formaction="functions/credito.php?r=2">Recusar</button>
                                                                    </div>
                                                                <?php }?>
                                                            </form>
                                                        <?php } ?>
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
                                                                    <td>Taxa do cartão:<br><small>sobre o valor final</small></td>
                                                                    <?php if($row_tran['recebe'] != ''){ 
                                                                        $valor = $row_tran['recebe'];
                                                                    } else if($row_tran['paga'] != ''){
                                                                        $valor = $row_tran['paga'];
                                                                    } 
                                                                    if($row_tran['opPagamento'] == "PayPal"){
                                                                        $taxapgto = $valor * 0.07;
                                                                        $valortotal = $valor + $taxapgto;
                                                                    } else {$valortotal = $valor;}?>
                                                                    <td>U$ <?= number_format($taxapgto, 2, ".", ".") ?></td>
                                                                    
                                                                </tr>
                                                                <tr style="font-size: 1.5em">
                                                                    <td>TOTAL:</td>
                                                                    <td>U$ <?= number_format($valortotal, 2, ".", "."); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <?php if($numComprovantes <= '0'){?>
                                                            <div class="text-center">
                                                                <?php if ($row_tran['opPagamento'] == "PayPal"): ?>
                                                                    <a href="https://www.paypal.me/<?=$_SESSION['paypal'];?>/<?=$valortotal;?>" class="btn btn-success btn-fill" target="_blank">PAGAR COM PAYPAL</a>    
                                                                <?php endif ?>
                                                                <?php if ($row_tran['opPagamento'] == "WesterUnion"): ?>
                                                                    <p>
                                                                    O pagamento via Western Union é realizado em determinadas agências do Banco do Brasil e/ou Bradesco; além das lojas Riachuelo.</p>

                                                                    <p>Segue o site da WU, para que você possa localizar um agente mais próximo.
                                                                    https://www.westernunion.com/br/pt/agent-locator.html</p>

                                                                    <p>Para a realização do envio ao dinheiro, você necessitará de algumas informações como:</p>
                                                                Nome: Thiago Gomes Rechi </br />
                                                            Pais: Estados Unidos</br />
                                                        Cidade: Windermere</br />
                                                    Estado: Florida</br />

                                                    <p>Após o envio do valor, por favor enviar cópia do comprovante, pois necessitaremos do número MTCN para realização do saque.</p>
                                                </p>
                                            <?php endif ?>
                                            <?php if ($row_tran['opPagamento'] == "Boleto"): ?>
                                                <p>
                                                    <!--    O mais fácil e rápido de todos! Você efetua o pagamento através de boleto bancário em real. Você acessa o site <a href="http://cambioreal.com/br" taget="_blank">cambioreal.com/br</a> faz seu cadastro, e escolhe a opção de “Envie Dinheiro” . Preenche os dados e pronto! É só gerar o boleto e efetuar o pagamento! Super fácil!-->
                                                    <!-- INICIO FORM CambioReal -->
                                                    <form action="https://www.cambioreal.com/pagamento/carrinho" method="post">
                                                        <!-- Campos Obrigatórios -->
                                                        <input type="hidden" name="token" value="<?=$_SESSION['CR_Token'];?>">
                                                        <input type="hidden" name="account" value="<?=$_SESSION['CR_Account'];?>">
                                                        <input type="hidden" name="url_callback" value="<?=$_SESSION['link'];?>/user/wallet.php?t=<?=$idtran;?>&s">
                                                        <input type="hidden" name="url_error" value="<?=$_SESSION['link'];?>/user/wallet.php?t=<?=$idtran;?>&e">
                                                        <!-- Campos opcionais para configuração da cobrança -->
                                                        <input type="hidden" name="currency" value="USD">
                                                        <input type="hidden" name="take_rates" value="0">
                                                        <input type="hidden" name="duplicate" value="1">
                                                        <input type="hidden" name="expiration_days" value="1">
                                                        <!-- Tempo máximo da sessão da compra em minutos (default 30min) -->
                                                        <input type="hidden" name="time_session" value="30min">
                                                        <!-- Código de referência do pagamento no seu sistema (opcional) -->
                                                        <input type="hidden" name="reference" value="<?=$idtran;?>">
                                                        <!-- Produto 1 -->
                                                        <input type="hidden" name="produtos[0][descricao]" value="Transação de Recarga #<?=$idtran;?>">
                                                        <input type="hidden" name="produtos[0][valor]" value="<?=$valortotal;?>">
                                                        <!--<input type="hidden" name="produtos[0][ref]" value="_REF_PRODUCT_1_">-->
                                                        <!-- Produto 2,3,.... (opcional) -->
                                                        <!--<input type="hidden" name="produtos[1][descricao]" value="test">-->
                                                        <!--<input type="hidden" name="produtos[1][valor]" value="80.00">-->
                                                        <!--<input type="hidden" name="produtos[1][ref]" value="T1">-->
                                                        <!-- Dados do comprador (opcionais) -->
                                                        <input name="client_name" type="hidden" value="<?= $row_user['nome']." ".$row_user['sobrenome'];?>">
                                                        <input name="client_email" type="hidden" value="<?= $row_user['email'];?>">
                                                        <input name="client_cpf" type="hidden" value="">
                                                        <!-- Imagem do botao (Veja na documentacao outros tamanhos) -->
                                                        <input type="image" height="65" src="https://www.cambioreal.com/botoes/bnt-cr-523x148.png"
                                                        type="submit" alt="Pague com CambioReal">
                                                        
                                                    </form>
                                                    <!-- //FIM FORM CambioReal -->
                                                </p>
                                            <?php endif ?>
                                            <?php if ($row_tran['opPagamento'] == "Banco do Brasil"): ?>
                                                <p>
                                                    Dados para o depósito no Banco do Brasil: <br><br>
                                                    Banco: 001 <br>
                                                    Agência: 0415 - 4 <br>
                                                    Conta Corrente: 51713 – 5 <br>
                                                    Favorecido: Vanessa Almeida de Morais Rechi <br>
                                                    CPF: 301.847.298-58 <br><br>


                                                    Após realizar o depósito, nos envie seu comprovante de Depósito/Transferência
                                                </p>
                                            <?php endif ?>
                                            <?php if ($row_tran['opPagamento'] == "Bradesco"): ?>
                                                <p>
                                                    Dados para o depósito no Bradesco: <br><br>
                                                    Banco: 237<br>
                                                    Agência: 7331<br>
                                                    Conta Corrente: 0002723 - 5 <br>
                                                    Favorecido: Vanessa Almeida de Morais Rechi<br>
                                                    CPF: 301.847.298-58 <br><br>
                                                    Após realizar o depósito, nos envie seu comprovante de Depósito/Transferência
                                                </p>
                                            <?php endif ?>
                                            <?php if ($row_tran['opPagamento'] == "TransferWise"): ?>
                                                <p>
                                                    Essa é a forma mais barata para nos enviar dinheiro.<br><br>
                                                    Você deve baixar o App TransferWise (IOS ou Androide) ou acessar o site https://transferwise.com/br<br><br>
                                                    Após efetuar o seu cadastro basta incluir a nossa conta como destinatária da remessa.<br>
                                                    Para isso você precisa apenas do nosso e-mail vanessaboxusa@icloud.com <br><br>
                                                    Ao digitar nosso e-mail o sistema da TranferWise reconhece automaticamente todos os nossos dados. Agora é só enviar o dinheiro.
                                                </p>
                                            <?php endif ?>
                                        </div>
                                    <?php }} ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- FIM DETALHES TRANSACAO -->
            <?php } ?>
            
            <div class="col-lg-12 col-md-12">
                <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header">
                        <h4 class="title">Transações Pendentes</h4>
                    </div>
                    <div class="content">
                        <?php
                                            //$idwallet = $row_wallet['idwallet'];
                        $sqlHistorico = "SELECT t.idtran, t.dtTran, t.tipoTran, t.status, t.opPagamento,
                        t.recebe, t.paga, u.nome, u.sobrenome, u.iduser 
                        FROM transacaoWallet as t
                        LEFT JOIN wallet as w ON w.idwallet = t.idwallet
                        LEFT JOIN users as u ON w.iduser = u.iduser
                        WHERE t.status = 'Processando' ORDER BY t.idtran DESC";
                        $query_historico = mysqli_query($con, $sqlHistorico) or die(mysqli_error());?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="historico">
                                <thead>
                                 <tr>
                                  <th>#</th>
                                  <th>Cliente | Suíte</th>
                                  <th>Data</th>
                                  <th>Tipo de Transação</th>
                                  <th>Motivo Recarga</th>
                                  <th>Forma de Pagamento</th>
                                  <th>Valor (U$)</th>
                                  <th>Status</th>
                                  <th>Ação</th>
                              </tr>
                          </thead>
                          <tbody>
                             <?php
                             $i = 0;
                             do{ if($row_historico['idtran'] != ''){
                              $i++;
                              $date = new DateTime($row_historico['dtTran']);?>
                              <tr>
                               <td><?=$row_historico['idtran'];?></td>
                               <td><?=$row_historico['nome']." ".$row_historico['sobrenome']." | ".$row_historico['iduser'];?></td>
                               <td><?=date_format($date, 'd-m-Y');?></td>
                               <td><?=$row_historico['tipoTran'];?></td>
                               <td><?=$row_historico['motivoRecarga'];?></td>
                               <td><?=$row_historico['opPagamento'];?></td>
                               <?php if($row_historico['recebe'] != ''){ ?>
                                <td><?="+".number_format($row_historico['recebe'], 2, ".", "");?></td>
                                <?php 
                            } else if($row_historico['paga'] != ''){ ?>
                                <td><?="-".number_format($row_historico['paga'], 2, ".", "");?></td>
                            <?php } ?>
                            <td><?=$row_historico['status'];?></td>
                            <td><a href="wallet.php?t=<?=$row_historico['idtran']?>" data-toggle="tooltip" title="Clique aqui para visualizar detalhes desta transação."><i class="fa fa-external-link"></i> Abrir</a></td>
                        </tr>

                    <?php    }else{ ?>


                    <?php }} while($row_historico = mysqli_fetch_assoc($query_historico)); ?>
                </tbody>
            </table>
        </div>
        <!-- <br><br><br><br><br><br><br><br> -->
    </div>
</div>
</div>

<div class="col-lg-6 col-md-6">
    <div class="card card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="content">
            <form method="post" action="functions/credito.php?c=1">
                <input type="hidden" name="idwallet" value="<?=$row_wallet['idwallet'];?>">
                <input type="hidden" name="tipoTran" value="Pedido de Recarga">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="title">Recarga de Saldo</h4><br>
                        <div class="form-group">
                            <label>Motivo:</label>
                            <input type="text" name="motivo" list="motivo" class="form-control border-input" required">


                            <datalist id="motivo">
                              <option value="Compra Assistida">Compra Assistida</option>
                              <option value="Extorno">Extorno</option>
                          </datalist>

                      </div>
                      <div class="form-group">
                        <label>Valor da Recarga:</label>
                        <input type="text" name="vlrRecarga" placeholder="U$ 100.00" class="form-control border-input vlrRecarga" > 
                    </div>
                    <div class="form-group">
                        <label>
                            Suite ou Nome do Cliente *
                        </label>
                        <input type="text" name="suite" list="suite" class="form-control border-input" required >


                        <datalist id="suite">
                          <?php do{?>
                              <option value="<?= $row_users['iduser']; ?>"><?=$row_users['nome'].' '.$row_users['sobrenome'];?></option>
                          <?php } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                      </datalist>

                  </div>
              </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success btn-fill btn-wd">Efetuar Depósito</button>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6">
    <div class="card card col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="content">
            <form method="post" action="functions/credito.php?d=1">
                <input type="hidden" name="idwallet" value="<?=$row_wallet['idwallet'];?>">
                <input type="hidden" name="tipoTran" value="Pedido de Recarga">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="title">Débito em Wallet</h4><br>
                        <div class="form-group">
                            <label>Motivo:</label>
                            <input type="text" name="motivo" list="motivo" class="form-control border-input" required">


                            <datalist id="motivo">
                              <option value="Compra Assistida">Compra Assistida</option>
                              <option value="Extorno">Extorno</option>
                          </datalist>

                      </div>
                      <div class="form-group">
                        <label>Valor do Débito:</label>
                        <input type="text" name="vlrRecarga" placeholder="U$ 100.00" class="form-control border-input vlrRecarga" > 
                    </div>
                    <div class="form-group">
                        <label>
                            Suite ou Nome do Cliente *
                        </label>
                        <input type="text" name="suite" list="suite" class="form-control border-input" required >


                        <datalist id="suite">
                          <?php do{?>
                              <option value="<?= $row_users['iduser']; ?>"><?=$row_users['nome'].' '.$row_users['sobrenome'];?></option>
                          <?php } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                      </datalist>

                  </div>
              </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-danger btn-fill btn-wd">Debitar da Wallet</button>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="copyright pull-right">
            <? include ("blocks/footer.php"); ?>  
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
    function sumirsuccess(){
        var este = document.getElementById('alert-success');
        este.style.display = "none";
    }
    function sumirdanger(){
        var este = document.getElementById('alert-danger');
        este.style.display = "none";
    }

    $('#enviarCmp').click(function(){
    $('#botoesForm').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadEnvia"><i class="fa fa-spin fa-spinner fa-lg"></i></div>');
});
</script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
   
    $(document).ready(function(){
        $('#historico').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    });
</script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>    
<script type="text/javascript">
    $('.vlrRecarga').mask('##0.00', {reverse: true});
</script>
</html>
