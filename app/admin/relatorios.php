<?php 
include ("functions/functions.php");

?>
<html>
<head>
    <head>
      <meta http-equiv='Pragma' content='no-cache'>
      <meta http-equiv='Expires' content='-1'>
      <meta http-equiv='CACHE-CONTROL' content='NO-CACHE'>
      <meta charset="utf-8" />
      <link rel="apple-touch-icon" sizes="76x76" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
      <link rel="icon" type="image/png" sizes="96x96" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>SIB | Relatórios</title>
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
      <!-- jquery min-->
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="assets/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.min.css">
      <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
       <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="#">Financeiro</a>
                </div>
                <div class="collapse navbar-collapse">
                    <?php include("blocks/topbar.php"); ?>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <!-- mostrar enderecos -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Relatórios</h4>
                            </div>
                            <div class="content">

                             <ul>
                                <li>
                                    <a href="relatorios.php?id=7">Saldos - Wallet</a>
                                </li>
                                <li>
                                 <a href="relatorios.php?id=2">Histórico de Transações - Wallet</a>
                             </li>
                             <li>
                                 <a href="relatorios.php?id=1">Total de Envios por Usuário </a>

                             </li>
                                  <!-- <li>
                                       <a href="relatorios.php?id=3">Total de Compras Assistidas por Usuário</a>
                                   </li> 
                                   <li>
                                       <a href="relatorios.php?id=4">Receita - Envios</a>
                                   </li>
                                   <li>
                                       <a href="relatorios.php?id=5">Fluxo de Caixa</a>
                                   </li> -->
                               </ul>   

                           </div>
                       </div>
                   </div>
               </div>
               <!--<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Lançar Despesas</h4>
                            </div>
                            <div class="content">

                               <ul>
                                   <li>
                                       <a href="relatorios.php?id=6">Lançar Despesas <?=$_SESSION['empresa'];?></a>
                                   </li>
                               </ul>   

                           </div>
                       </div>
                   </div>
               </div> -->
           </div>
           <?php if($_GET['id'] == '1'){ ?>
            <div class="container-fluid">
                <!-- mostrar enderecos -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Total de Envios por Usuário</h4>
                            </div>
                            <div class="content">
                                <?php 
                                
                                $sql = "SELECT e.idenvio as idenvios, u.nome 'nome', u.sobrenome 'sobrenome', e.iduser as 'suite', COUNT(idenvio) as 'tlCaixas', SUM(e.pesototal) as 'Peso', SUM(e.usps) as 'Frete', SUM(e.taxaservico) as 'TxRed' FROM envios as e LEFT JOIN users as u ON e.iduser = u.iduser GROUP BY e.iduser";
                                
                                $query = mysqli_query($con, $sql) or die(mysqli_error($con));

                                ?>
                                <div class="table-responsive"><table class='table table-bordered reports'>
                                    <thead>
                                        <tr>
                                            <td>Suíte</td>
                                            <td>Cliente</td>
                                            <td>Nº de Caixas</td>
                                            <td>Peso das Caixas</td>
                                            <td>Total Frete</td>
                                            <td>Taxa de Redirecionamento</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php do { 
                                           if($row['suite']){?>
                                            <tr>
                                                <td><?=$row['suite'];?></td>
                                                <td><?=$row['nome'].' '.$row['sobrenome'];?></td>
                                                <td><?=$row['tlCaixas'];?></td>
                                                <td><?=number_format($row['Peso'], 2, ".", ".");?> lb</td>
                                                <td>U$ <?=number_format($row['Frete'], 2, ".", ".");?></td>
                                                <td>U$ <?=number_format($row['TxRed'], 2, ".", ".");?></td>
                                            </tr>
                                            <?php 
                                        }} while ($row = mysqli_fetch_assoc($query));
                                        ?>
                                    </tbody></table></div>

                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            <?php } ?>
            <?php if($_GET['id'] == '2'){ ?>
                <div class="container-fluid">
                    <!-- mostrar enderecos -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Histórico Transações - Wallet</h4>
                                </div>
                                <div class="content">
                                    <?php 

                                    $sql = "SELECT t.idtran, t.dtTran as 'data', t.tipoTran as 'desc', t.paga as paga, t.recebe as recebe, u.iduser 'iduser', u.nome 'nome', u.sobrenome 'sobrenome', t.opPagamento as 'opPagamento', t.status 'status' FROM transacaoWallet as t LEFT JOIN wallet as w ON w.idwallet = t.idwallet LEFT JOIN users as u ON u.iduser = w.iduser";

                                    $query = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    ?>

                                    <div class="table-responsive"><table class='table table-bordered reports'>
                                        <thead>
                                            <tr>
                                                <td># Tran</td>
                                                <td>Descrição</td>
                                                <td>Valor</td>
                                                <td>Suíte</td>
                                                <td>Cliente</td>
                                                <td>Forma de Pagamento</td>
                                                <td>Status</td>
                                                <td>Data</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { 
                                                if($row['idtran'] != ''){ ?>
                                                    <tr>
                                                        <td><?=$row['idtran'];?></td>
                                                        <td><?=$row['desc'];?></td>
                                                        <?php if($row['recebe'] != ''){ ?>
                                                            <td><?="U$ +".number_format($row['recebe'], 2, ".", ".");?></td>
                                                            <?php 
                                                        } else if($row['paga'] != ''){ ?>
                                                            <td><?="U$ -".number_format($row['paga'], 2, ".", ".");?></td>
                                                        <?php } ?>
                                                        <td><?=$row['iduser']?></td>
                                                        <td><?=$row['nome'].' '.$row['sobrenome'];?></td>
                                                        <td><?=$row['opPagamento'];?></td>
                                                        <td><?=$row['status'];?></td>
                                                        <td><?=$row['data'];?></td>                                                       
                                                    </tr>
                                                <?php } else if(mysqli_num_rows($query) <= '1'){
                                                    echo "<td colspan='5'>Nenhum Registro para ser Mostrado</td>";
                                                }
                                            } while ($row = mysqli_fetch_assoc($query));
                                            ?>
                                        </tbody></table></div>

                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                <?php } ?>
                <?php if($_GET['id'] == '3'){ ?>
                    <div class="container-fluid">
                        <!-- mostrar enderecos -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Total de Compras Assistidas por Usuário</h4>
                                    </div>
                                    <div class="content">
                                        <?php 
                                        $sql = "SELECT c.idcompra, u.iduser as 'suite', CONCAT(u.nome,' ',u.sobrenome) as 'nome', COUNT(c.idcompra) as 'tlCompras', SUM(c.valor) as 'valor', SUM(c.taxa) as 'taxas' FROM compras as c LEFT JOIN users as u ON c.iduser = u.iduser GROUP BY u.iduser";
                                        
                                        $query = mysqli_query($con, $sql) or die(mysqli_error($con));

                                        ?>
                                        <div class="table-responsive"><table class='table table-bordered reports'>
                                            <thead>
                                                <tr>
                                                    <td>Suíte</td>
                                                    <td>Cliente</td>
                                                    <td>Nº de Compras</td>
                                                    <td>Total em Compras</td>
                                                    <td>Total Taxas</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php do { 
                                                    if($row['idcompra'] != ''){ ?>
                                                        <tr>
                                                            <td><?=$row['suite'];?></td>
                                                            <td><?=$row['nome'];?></td>
                                                            <td><?=$row['tlCompras'];?></td>
                                                            <td><?=$row['valor'];?></td>
                                                            <td><?=$row['taxas'];?></td>
                                                        </tr>
                                                    <?php }
                                                } while ($row = mysqli_fetch_assoc($query));
                                                ?>
                                            </tbody></table></div>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                    <?php if($_GET['id'] == '4'){ ?>
                        <div class="container-fluid">
                            <!-- mostrar enderecos -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Receita nos Envios</h4>
                                        </div>
                                        <div class="content">
                                            <?php 
                                            $sql = "SELECT 
                                            u.iduser as 'suite',
                                            CONCAT(u.nome,' ',u.sobrenome) as 'nome', 
                                            e.criado as 'eCriado',
                                            c.criado as 'cCriado',
                                            e.usps as 'frete',
                                            e.taxapgto as 'TxCartao',
                                            e.taxaservico as 'TxRed',
                                            e.taxaextras as 'TxServicos',
                                            e.taxaarmazenamento as 'TxArmazem',
                                            e.valortotal as 'tlEnvios',
                                            c.taxa as 'txCompras',
                                            c.valor as 'tlCompras',
                                            (e.usps+e.taxapgto+c.valor) as 'Despesas',
                                            (e.taxaservico+e.taxaextras+e.taxaarmazenamento+c.taxa) as 'Receita'
                                            FROM users as u
                                            LEFT JOIN compras as c ON c.iduser = u.iduser
                                            LEFT JOIN envios as e ON e.iduser = u.iduser";

                                            $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                                            $vlrDespesas = 0;
                                            $vlrReceita = 0;
                                            ?>
                                            <div class="table-responsive"><table class='table table-bordered reports'>
                                                <thead>
                                                    <tr>
                                                        <td>Suíte</td>
                                                        <td>Cliente</td>
                                                        <td>Frete</td>
                                                        <td>Taxa de Cartão</td>
                                                        <td>Taxa Redirecionamento</td>
                                                        <td>Serviços Extras</td>
                                                        <td>Aramazenamento</td>
                                                        <td>Total Envios</td>
                                                        <td>Taxa Compras A.</td>
                                                        <td>Total Compras A.</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php do { 
                                                        $vlrDespesas = $vlrDespesas + $row['Despesas'];
                                                        $vlrReceita = $vlrReceita + $row['Receita'];
                                                        if($row['suite'] != ''){ ?>
                                                            <tr>
                                                                <td><?=$row['suite'];?></td>
                                                                <td><?=$row['nome'];?></td>
                                                                <td>-<?=number_format($row['frete'], 2, ".", ".");?></td>
                                                                <td>-<?=number_format($row['TxCartao'], 2, ".", ".");?></td>
                                                                <td>+<?=number_format($row['TxRed'], 2, ".", ".");?></td>
                                                                <td>+<?=number_format($row['TxServicos'], 2, ".", ".");?></td>
                                                                <td>+<?=number_format($row['TxArmazem'], 2, ".", ".");?></td>
                                                                <td><?=number_format($row['tlEnvios'], 2, ".", ".");?></td>
                                                                <td>+<?=number_format($row['txCompras'], 2, ".", ".");?></td>
                                                                <td>-<?=number_format($row['tlCompras'], 2, ".", ".");?></td>
                                                            </tr>
                                                        <?php }
                                                    } while ($row = mysqli_fetch_assoc($query));
                                                    ?>
                                                </tbody>
                                                <td colspan="5" class="text-center" style="background-color:#ff9999">Despesas: U$ -<?=number_format($vlrDespesas, 2, ".", ".");?></td>
                                                <td colspan="5" class="text-center" style="background-color: #99ff99">Receita: U$ +<?=number_format($vlrReceita, 2, ".", ".");?></td>
                                            </table></div>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                    <?php if($_GET['id'] == '5'){ ?>
                        <div class="container-fluid">
                            <!-- mostrar enderecos -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Fluxo de Caixa</h4>
                                        </div>
                                        <div class="content">
                                            <?php 
                                            $sql_envios = "SELECT 
                                            u.iduser as 'suite',
                                            e.idenvio as 'idenvio',
                                            CONCAT(u.nome,' ',u.sobrenome) as 'nome', 
                                            e.criado as 'eCriado',
                                            e.usps as 'frete',
                                            e.taxapgto as 'TxCartao',
                                            e.taxaservico as 'TxRed',
                                            e.taxaextras as 'TxServicos',
                                            e.taxaarmazenamento as 'TxArmazem',
                                            e.valortotal as 'tlEnvios',
                                            (e.usps+e.taxapgto) as 'Despesas',
                                            (e.taxaservico+e.taxaextras+e.taxaarmazenamento) as 'Receita'
                                            FROM users as u
                                            LEFT JOIN envios as e ON e.iduser = u.iduser";

                                            $query = mysqli_query($con, $sql_envios) or die(mysqli_error($con));
                                            $vlrDespesas = 0;
                                            $vlrReceita = 0;
                                            ?>
                                            <div class="table-responsive"><table class='table table-bordered reports'>
                                                <thead>
                                                    <tr>
                                                        <td>Data</td>
                                                        <td>Fornecedor</td>
                                                        <td>Descrição</td>
                                                        <td>U$ Despesa (-)</td>
                                                        <td>U$ Receita (+)</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php do { 
                                                        $vlrDespesas = $vlrDespesas + $row['Despesas'];
                                                        $vlrReceita = $vlrReceita + $row['Receita'];
                                                        if($row['idenvio'] != ''){ 
                                                            $date = new DateTime($row_despesas['eCriado']);?>
                                                            <tr>
                                                                <td><?=date_format($date, 'd-m-Y');?></td>
                                                                <td><?=$row['nome'];?></td>
                                                                <td>Envio #<?=$row['idenvio'];?></td>
                                                                <?php if($row['Despesas']!=''){?>
                                                                    <td>-<?=number_format($row['Despesas'], 2, ".", ".");?></td>
                                                                <?php } else {echo "<td>0.00</td>";}?>
                                                                <?php if($row['Receita']!=''){?>
                                                                    <td>+<?=number_format($row['Receita'], 2, ".", ".");?></td>
                                                                <?php } else {echo "<td>0.00</td>";}?>
                                                            </tr>
                                                        <?php }
                                                    } while ($row = mysqli_fetch_assoc($query));
                                                    ?>
                                                    <?php 
                                                    $sql_compras = "SELECT 
                                                    u.iduser as 'suite',
                                                    CONCAT(u.nome,' ',u.sobrenome) as 'nome', 
                                                    c.idcompra as 'idcompra',
                                                    c.criado as 'cCriado',
                                                    c.valor as 'Despesas',
                                                    c.taxa as 'Receita' FROM users as u
                                                    LEFT JOIN compras as c ON c.iduser = u.iduser";

                                                    $query_compras = mysqli_query($con, $sql_compras) or die(mysqli_error($con));

                                                    ?>
                                                    <?php do { 
                                                        $vlrDespesas = $vlrDespesas + $row['Despesas'];
                                                        $vlrReceita = $vlrReceita + $row['Receita'];
                                                        if($row['idcompra'] != ''){ 
                                                            $date = new DateTime($row_despesas['cCriado']);?>
                                                            <tr>
                                                                <td><?=date_format($date, 'd-m-Y');?></td>
                                                                <td><?=$row['nome'];?></td>
                                                                <td>Compra #<?=$row['idcompra'];?></td>
                                                                <?php if($row['Despesas']!=''){?>
                                                                    <td>-<?=number_format($row['Despesas'], 2, ".", ".");?></td>
                                                                <?php } else {echo "<td>0.00</td>";}?>
                                                                <?php if($row['Receita']!=''){?>
                                                                    <td>+<?=number_format($row['Receita'], 2, ".", ".");?></td>
                                                                <?php } else {echo "<td>0.00</td>";}?>
                                                            </tr>
                                                        <?php }
                                                    } while ($row = mysqli_fetch_assoc($query_compras));
                                                    ?>
                                                    <?php 
                                                    $sql_despesas = "SELECT * FROM despesas";
                                                    $query_despesas = mysqli_query($con, $sql_despesas) or die(mysqli_error($con));

                                                    ?>
                                                    <?php do { 
                                                        $vlrDespesas = $vlrDespesas + $row['Despesas'];
                                                        $vlrReceita = $vlrReceita + $row['Receita'];
                                                        if($row['iddespesa'] != ''){ 
                                                            $date = new DateTime($row_despesas['dtdespesa']);?>
                                                            <tr>
                                                                <td><?=date_format($date, 'd-m-Y');?></td>
                                                                <td><?=$row['frdespesa'];?></td>
                                                                <td><?=$row['txdespesa'];?></td>
                                                                <?php if($row['vlrdespesas']!=''){?>
                                                                    <td>-<?=number_format($row['Despesas'], 2, ".", ".");?></td>
                                                                <?php } else {echo "<td>0.00</td>";}?>
                                                                <td>0.00</td>
                                                            </tr>
                                                        <?php }
                                                    } while ($row = mysqli_fetch_assoc($query_despesas));
                                                    ?>
                                                </tbody>
                                                <td colspan="3"></td>
                                                <td colspan="1" class="text-center" style="background-color:#ff9999">Despesas: U$ -<?=number_format($vlrDespesas, 2, ".", ".");?></td>
                                                <td colspan="1" class="text-center" style="background-color: #99ff99">Receita: U$ +<?=number_format($vlrReceita, 2, ".", ".");?></td>
                                            </table></div>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    <?php } ?>

                    <?php if($_GET['id'] == '6'){ ?>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div>

                                        <div class="col-lg-4 col-md-5">
                                            <div class="card card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="content">
                                                    <form method="post" action="functions/acrescenta-despesa.php">
                                                        <div class="row">
                                                            <div class="col-lg-12 text-center">
                                                                <h4 class="title">Despesas<br><?=ucfirst(strtolower($_SESSION['empresa']));?></h4><br>
                                                                <div class="form-group">
                                                                    <label>Valor:</label>
                                                                    <input type="number" name="vlrDespesa" placeholder="U$ 100.00" class="form-control border-input" > 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Fornecedor</label>
                                                                    <input type="text" name="fornecedor" placeholder="Aluguel, Internet..." class="form-control border-input" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Descrioção </label>
                                                                    <input type="text" name="desc" placeholder="Motivo do Gasto" class="form-control border-input" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-success btn-fill btn-wd">Lançar Despesa</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-8 col-md-7">
                                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="header">
                                                    <h4 class="title">Histórico de Despesas</h4>
                                                </div>
                                                <div class="content">
                                                    <?php
                                                    $sqlDespesas = "SELECT * FROM despesas";
                                                    $query_despesas = mysqli_query($con, $sqlDespesas) or die(mysqli_error());?>
                                                    <div class="table-responsive"><table class="table table-bordered" id="despesas">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Data</th>
                                                                <th>Fornecedor</th>
                                                                <th>Valor (U$)</th>
                                                                <th>Descrição</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            do{ if($row_despesas['iddespesa'] != ''){
                                                                $date = new DateTime($row_despesas['dtdespesa']);?>
                                                                <tr>
                                                                    <td><?=$row_despesas['iddespesa'];?></td>
                                                                    <td><?=date_format($date, 'd-m-Y');?></td>
                                                                    <td><?=$row_despesas['frdespesa'];?></td>
                                                                    <td><?=number_format($row_despesas['vlrdespesa'], 2, ".", ".");?></td>
                                                                    <td><?=$row_despesas['txdespesa'];?></td>
                                                                </tr>

                                                            <?php    }} while($row_despesas = mysqli_fetch_assoc($query_despesas)); ?>
                                                        </tbody>
                                                    </table></div>
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
                      <?php } ?>
                      <?php if($_GET['id'] == '7'){ ?>
                        <div class="container-fluid">
                            <!-- mostrar enderecos -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Saldos - Wallet</h4>
                                        </div>
                                        <div class="content">
                                            <?php 

                                            $sql = "SELECT u.iduser 'suite', u.nome 'nome', u.sobrenome 'sobrenome', u.email 'email', u.telefone 'telefone', w.saldo 'saldo' FROM users u LEFT JOIN wallet w ON w.iduser = u.iduser WHERE w.saldo <> 0 ORDER BY `w`.`saldo` ASC";

                                            $query = mysqli_query($con, $sql) or die(mysqli_error($con));

                                            ?>

                                            <div class="table-responsive"><table class='table table-bordered reports'>
                                                <thead>
                                                    <tr>
                                                        <td>Suite</td>
                                                        <td>Nome</td>
                                                        <td>Email</td>
                                                        <td>Telefone</td>
                                                        <td>Saldo Atual</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php do { 
                                                        if($row['suite'] != ''){ ?>
                                                            <tr>
                                                                <td><?=$row['suite'];?></td>
                                                                <td><?=$row['nome'].' '.$row['sobrenome'];?></td>
                                                                <td><?=$row['email'];?></td>
                                                                <td><?=$row['telefone'];?></td>
                                                                <td><?=$row['saldo'];?></td>
                                                                
                                                            </tr>
                                                        <?php } else if(mysqli_num_rows($query) <= '1'){
                                                            echo "<td colspan='5'>Nenhum Registro para ser Mostrado</td>";
                                                        }
                                                    } while ($row = mysqli_fetch_assoc($query));
                                                    ?>
                                                </tbody></table></div>

                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <?php } ?>

                        <footer class="footer">
                            <div class="container-fluid">
                                <div class="copyright pull-right">
                                    <? include ("blocks/footer.php"); ?>  
                                </div>
                            </div>
                        </footer>
                    </div>
                </div> <!-- /*div wrapper ends*/ -->
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
            <!--  Google Maps Plugin    -->
            <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
            <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
            <script src="assets/js/paper-dashboard.js"></script>
            <script type="text/javascript">

                function fechar(){
                  document.getElementById('erro').style.display = "none";
              }
// script para sortear a tabela
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("envios");
    switching = true;
// Set the sorting direction to ascending:
dir = "asc"; 
/* Make a loop that will continue until
no switching has been done: */
while (switching) {
// Start by saying: no switching is done:
switching = false;
rows = table.getElementsByTagName("TR");
/* Loop through all table rows (except the
first, which contains table headers): */
for (i = 1; i < (rows.length - 1); i++) {
// Start by saying there should be no switching:
shouldSwitch = false;
/* Get the two elements you want to compare,
one from current row and one from the next: */
x = rows[i].getElementsByTagName("TD")[n];
y = rows[i + 1].getElementsByTagName("TD")[n];
/* Check if the two rows should switch place,
based on the direction, asc or desc: */
if (dir == "asc") {
    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
// If so, mark as a switch and break the loop:
shouldSwitch= true;
break;
}
} else if (dir == "desc") {
    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
// If so, mark as a switch and break the loop:
shouldSwitch= true;
break;
}
}
}
if (shouldSwitch) {
/* If a switch has been marked, make the switch
and mark that a switch has been done: */
rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
switching = true;
// Each time a switch is done, increase this count by 1:
switchcount ++; 
} else {
/* If no switching has been done AND the direction is "asc",
set the direction to "desc" and run the while loop again. */
if (switchcount == 0 && dir == "asc") {
    dir = "desc";
    switching = true;
}
}
}
}

</script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        
        /*$('.reports').DataTable( {
            "order": [[ 0, "desc" ]]
        });*/

        $('.reports').DataTable( {
            "order": [[ 0, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
            ]
        } );
    });
</script>
<!-- script  -->
</html>
