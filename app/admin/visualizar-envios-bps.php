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
    <!-- jquery min-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="assets/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- chamar functions.js  -->
    <script type="text/javascript" src="functions/functions.js"></script>
    <style type="text/css">
        #box-admin{
            background-color:#d7ffd7;
            border-radius: 20px 20px;
            float: right;
            text-align: right;
        }

        #box-user{
            background-color:#f2f2f2;
            border-radius: 20px 20px;
            float: left;
            text-align: left;
        }
    </style>
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
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        <i class="fa fa-angle-down"></i>
                                        <b><?= ucwords($row_admin['nome']." - ".$row_admin['empresa']); ?></b> 
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="configuracoes.php">Configurações</a></li>
                                    <li><a href="?logout">Sair</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">

                <!-- form criar envio -->
                <?php if ($row_envios['idenvio'] != ""){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">


                                <div class="header">
                                    <h4 class="title">Dados do Envio # <?= $_GET['idenvio']; ?></h4>   
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center" id="produtos">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Imagens</td>
                                                    <td>Descrição</td>
                                                    <td>Quantidade enviada</td>
                                                    <td>Quantidade no estoque</td>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                        echo "<a href='../user/assets/img/produtos/".$ln["imagem1"]."' data-fancybox data-toggle='tooltip' data-placement='top' title='Clique para ampliar a imagem 1' class='btn btn-success'><img src='../user/assets/img/produtos/".$ln["imagem1"]."' style='height:60px;'></a>";
                                                    }
                                                    if($ln["imagem2"] != ''){
                                                        echo "<a href='../user/assets/img/produtos/".$ln["imagem2"]."' data-fancybox data-toggle='tooltip' data-placement='top' title='Clique para ampliar a imagem 2' class='btn btn-success'><img src='../user/assets/img/produtos/".$ln["imagem2"]."' style='height:60px;'></a>";
                                                    }


                                                    echo "</td>
                                                    <td>".$colunas[1]."</td>
                                                    <td>".$qtd."</td>
                                                    <td>".$ln['quantidade']."</td>


                                                    </tr>"; 

                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <!-- card para escolha do endereco -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Endereço de Entrega</h4>
                                </div>

                                <div class="content">


                                    <p><?= $row_envios['iduser']; ?></p>
                                    <p>
                                        <?php 
                                        $id_usuario = $row_envios['iduser'];
                                        $sql_usario = "SELECT nome, sobrenome, email, telefone, type FROM users WHERE iduser = '$id_usuario'";
                                        $query_usuario = mysqli_query($con, $sql_usario);
                                        $row_usuario = mysqli_fetch_assoc($query_usuario);
                                        echo $row_usuario['nome']." ".$row_usuario['sobrenome'];
                                        ?>
                                    </p> 
                                    <p><?= $row_usuario['email']." - ".$row_usuario['telefone'];?></p>
                                    <p>CPF: <?=$row_envios['cpf'];?></p>
                                    <p><?= $row_envios['endereco']; ?></p>
                                </div>

                            </div>
                        </div>

                        <!-- card para escolha da forma de envio -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Opção de Envio</h4>
                                </div>
                                <div class="content">
                                    <p>
                                        <?=$row_envios['formaenvio'];?>
                                        <?php if ($row_envios['pesototal'] != ""){ echo " - Peso final: ".$row_envios['pesototal']." lb";} ?>
                                    </p>
                                </div>
                            </div>
                        </div>   

                        <!-- card para escolha da forma de pagamento -->
                        <div class="col-lg-4">
                            <div class="card">
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
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Declaração Alfandegâria</h4>
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>

                                                <td>Descrição</td>
                                                <td>Quantidade</td>
                                                <td>Valor Unit</td>
                                            </tr>
                                            <?php 
                                            $declaracao = explode("|", $row_envios['declaracao'], -1);

                                            for ($j=0; $j < count($declaracao); $j++) { 
                                                $dec = explode("-", $declaracao[$j]);

                                                if ($dec[0] != "") {
                                                    echo "<tr>
                                                    <td style='word-wrap: break-word;'>".$dec[0]."</td>
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
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Comprovante de Pagamento</h4>
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Metodo de Pagamento</td>
                                                <td>Código de Pagamento</td>
                                                <td>Comprovante</td>
                                            </tr>
                                            <?php
                                            $envio = $_GET['idenvio'];
                                            $select_cmp = "SELECT * FROM comprovantes WHERE idEnvio = $envio";
                                            $query_select_cmp = mysqli_query($con, $select_cmp) or die(mysqli_error());
                                            $i = 1;
                                            do {
                                                if($row_comprovante['comprovante'] != '' || $row_comprovante['codPagamento'] != ''){
                                                    ?>
                                                    <tr>
                                                        <td><?= $row_comprovante['opPagamento']; ?></td>
                                                        <td><?= $row_comprovante['codPagamento']; ?></td>
                                                        <?php if($row_comprovante['comprovante'] != ''){ ?>
                                                            <td>
                                                             <a href="../user/assets/img/comprovantes/<?= $row_comprovante['comprovante']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 1" class="btn btn-success btn-fill">Comprovante <?= $i; ?></a>
                                                         </td>
                                                     <?php } else { ?> <td></td> <?php } ?>
                                                 </tr>
                                                 <?php
                                                 $i++;}
                                             } while ($row_comprovante = mysqli_fetch_assoc($query_select_cmp));
                                             ?>

                                         </table>
                                     </div>
                                 </div>
                             </div>
                             <div class="card">
                                <div class="header">
                                    <h4 class="title">Observações da Compra</h4>
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
                                            <input type="hidden" name="admin" value="1">
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
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Valor Final</h4>
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Valor do Frete:</td>
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
                                            <? if($row_envios['seguro'] == '1'){ ?>
                                                <tr>
                                                    <td>Valor Seguro:<br></td>
                                                    <td>U$ <?= number_format($row_envios['vlrSeguro'], 2, ".", ",") ?></td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td>Taxa do cartão:<br><small>sobre o valor final</small></td>
                                                <td>U$ <?= number_format($row_envios['taxapgto'], 2, ".", ",") ?></td>
                                            </tr>
                                            <tr style="font-size: 1.5em">
                                                <td>TOTAL:</td>
                                                <td>U$ <?= $row_envios['valortotal']; 
                                                if($row_envios['formapgto'] == 'Itau'){
                                                    echo " | R$: ".number_format($row_envios['valorReal'], 2, ".", ",");
                                                } ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <a href="envios.php"><button type="button" class="btn btn-primary btn-sm btn-fill">Voltar para envios</button></a>
                                </div>
                            </div>

                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Status do Envio</h4>
                                </div>
                                <div class="content text-center">
                                    <form method="post" action="functions/altera-status-envio.php">
                                        <input type="hidden" name="idenvio" value="<?= $row_envios['idenvio'];?>">
                                        <div class="form-group">


                                          <select name="statusenvio" class="form-control border-input" <?php if($row_envios['status'] == "CANCELADO"){echo "disabled='disabled'";}?>>

                                            <option value="NOVO" <?php if($row_envios['status'] == "NOVO"){echo "selected='selected'";}?>>NOVO</option>
                                            <option value="PROCESSANDO" <?php if($row_envios['status'] == "PROCESSANDO"){echo "selected='selected'";}?>>PROCESSANDO</option>
                                            <option value="FINALIZADO" <?php if($row_envios['status'] == "FINALIZADO"){echo "selected='selected'";}?>>FINALIZADO</option>
                                            <option value="CANCELADO" <?php if($row_envios['status'] == "CANCELADO"){echo "selected='selected'";}?>>CANCELADO</option>

                                        </select>
                                        <br>
                                        <button class="btn btn-sm btn-fill btn-success" type="submit">ATUALIZAR</button>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <? if($row_envios['idParcelBPS'] == ''){ ?>
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Gerar Parcel</h4>
                                </div>
                                <div class="content text-center">
                                    <form method="post" action="functions/gerar-parcel-bps.php">
                                        <input type="hidden" name="idenvio" value="<?=$row_envios['idenvio'];?>">
                                        <input type="hidden" name="iduser" value="<?=$id_usuario;?>">

                                        <div class="form-group">
                                            <label>Peso Final do envio:</label>
                                            <input type="text" class="form-control border-input" name="pesoFinalParcel" placeholder="Peso final do Envio.." value="<?=$row_envios['pesototal'];?>">
                                            <br>
                                            <label>Frete Declarado:</label>
                                            <input type="text" class="form-control border-input" name="freteDeclarado" placeholder="Valor do Frete.." value="<?=$row_envios['usps'];?>">
                                            <br>
                                            <button class="btn btn-sm btn-fill btn-success" type="submit">Gerar Parcel</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        <? } else {?>
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Gerar Labels BPS</h4>
                                </div>
                                <div class="content text-center">
                                    <form method="post" action="functions/gerar-label-bps.php" target="_blank">
                                        <input type="hidden" name="idParcelBPS" value="<?=$row_envios['idParcelBPS'];?>">
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-fill btn-success" type="submit">Gerar Label</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <? } ?>

                    </div>
                </div>

                </form
            <?php } else {echo "<div class='card'><div class='content'><p>Nenhum envio encontrado.</p></div></div>";} ?>




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
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>


<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $().ready(function(){
        $("#divObs").animate({ scrollTop: 1000 }, 3000);
    });

    $(document).on("input", ".txObs", function () {
        var limite = 60;
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        $(".caracteresRestantes").text(caracteresRestantes);
    });

    $(document).ready(function(){
        $('#produtos').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    });

</script>

<script type="text/javascript" src="functions/functions.js"></script>

</html>
