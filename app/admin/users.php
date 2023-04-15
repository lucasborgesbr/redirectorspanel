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
      <title>SIB | Dashboard</title>
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
                        <a class="navbar-brand" href="#">Clientes</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <?php include("blocks/topbar.php"); ?>
                    </div>
                </div>
            </nav>
            <div class="content">
               <? if($_GET['rs'] != ''){ ?>
                <div class="alert alert-success" id="erro">
                    <span>Senha resetada para a Suite #<?=$_GET['uid'];?> com Sucesso.<br>Nova Senha: <strong><?=$_GET['rs'];?></strong></span>
                </div>
            <? } ?>
            <div class="container-fluid">
                <!-- mostrar enderecos -->
                <?php if (isset($_GET['view-address']) AND $row_enderecos['idendereco']!=""){ ?>
                    <div class="row">
                        <div class="col-lg-12">


                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Endereços da Suíte #<?= $_GET['id'];?></h4>
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Rua/Avenida</th>
                                                <th>Número</th>
                                                <th>Complemento</th>
                                                <th>Bairro</th>
                                                <th>Cidade</th>
                                                <th>Estado</th>
                                                <th>País</th>
                                                <th>CEP/ZIPCODE</th>
                                            </tr>

                                            <?php do { ?>
                                                <tr>
                                                    <td><?= $row_enderecos['rua'] ?></td>
                                                    <td><?= $row_enderecos['numero'] ?></td>
                                                    <td><?= $row_enderecos['complemento'] ?></td>
                                                    <td><?= $row_enderecos['bairro'] ?></td>
                                                    <td><?= $row_enderecos['cidade'] ?></td>
                                                    <td><?= $row_enderecos['estado'] ?></td>
                                                    <td><?= $row_enderecos['pais'] ?></td>
                                                    <td><?= $row_enderecos['cep'] ?></td>
                                                </tr>
                                            <?php } while($row_enderecos = mysqli_fetch_assoc($query_select_enderecos)); ?>
                                        </table>      
                                    </div>                      
                                </div>
                            </div>

                        </div>
                    </div>
                <? } else if (isset($_GET['view-address']) AND $row_enderecos['idendereco']==""){ ?>
                    <div class="alert alert-warning" id="erro">
                        <span>Nenhum Endereço cadastrado.</span>
                    </div>
                <? } ?>
                <!-- mostrar docs -->
                <?php if (isset($_GET['view-docs']) AND $row_docs['iddoc']!=""): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Docs da Suíte #<?= $_GET['id-docs'];?></h4>
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Arquivo</th>
                                                <th>Criado em</th>
                                                <th></th>
                                            </tr>

                                            <?php do { ?>
                                                <tr>
                                                    <td><a href="../user/assets/img/docs/<?= $row_docs['file']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 1"><?= $row_docs['file']; ?></a></td>
                                                    <td><?= $row_docs['criado'] ?></td>
                                                    <td><a href="functions/deleta-doc.php?id=<?= $row_docs['iddoc'];?>" onclick="return confirm('Deseja realmente excluir este item?');"><button type="button" class="btn btn-sm btn-fill btn-danger"><i class="fa fa-close"></i> Excluir</button></a></td>
                                                </tr>
                                            <?php } while($row_docs = mysqli_fetch_assoc($query_select_docs)); ?>
                                        </table> 
                                    </div>                           
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h4 class="title">Lista de Clientes</h4>
                                    </div>
                                    <div class="col-lg-2">
                                    </div>    
                                </div>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="meusclientes">
                                        <thead>
                                            <tr>
                                                <th>Suite</th>
                                                <th>Nome Completo</th>
                                                <? if($mobile == 0){ ?>
                                                    <th>Peso Total na Suíte</th>
                                                    <th>Saldo Wallet</th>
                                                    <th>CPF/Telefone/Email</th>
                                                    <th>Endereços</th>
                                                    <th>Criado em </th>
                                                <? } ?>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do{ 
                                                if($row_users['iduser'] != ''){
                                                    $iduserAtual = $row_users['iduser'];
                                                    ?>
                                                    <tr>
                                                        <td><?= $row_users['iduser']; ?></td>

                                                        <td><?= $row_users['nome']." ".$row_users['sobrenome']; ?></td>
                                                        <? if($mobile == 0){ ?>
                                                            <td>
                                                                <?
                                                                $sqlTotalPesos = "SELECT SUM(peso * quantidade) pesoTotalSuite FROM `produtos` WHERE quantidade > 0 AND iduser = '$iduserAtual'";
                                                                $queryTotalPeso = mysqli_query($con, $sqlTotalPesos);
                                                                $row_pesoTotal = mysqli_fetch_assoc($queryTotalPeso);

                                                                if($row_pesoTotal['pesoTotalSuite'] != ''){
                                                                    echo $row_pesoTotal['pesoTotalSuite'];
                                                                }else{
                                                                    echo "0.00";
                                                                }

                                                                ?>
                                                            </td>
                                                            <td>
                                                                <!-- saldo da wallet -->
                                                                <?php 
                                                                $iduser_saldo = $row_users['iduser'];
                                                                $select_saldo_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser_saldo'";
                                                                $query_select_saldo_wallet = mysqli_query($con,$select_saldo_wallet) or die(mysqlir_error());
                                                                $row_saldo = mysqli_fetch_assoc($query_select_saldo_wallet);
                                                                if($row_saldo['saldo'] == "" || $row_saldo['saldo'] == "0"){
                                                                    echo money_format('%.2n',  '0.00');
                                                                } else {
                                                                    setlocale(LC_MONETARY, 'en_US');
                                                                    echo money_format('%.2n', $row_saldo['saldo']);

                                                                } ?>
                                                            </td>
                                                            <td>
                                                                CPF: <?=$row_users['cpf'];?><br>
                                                                <a href="tel:<?= $row_users['telefone']; ?>">
                                                                    <?=$row_users['telefone']; ?>
                                                                </a>
                                                                <?php if($row_users['telefone']!=""){
                                                                    echo " | ";
                                                                } ?>
                                                                <a href="mailto:<?=$row_users['email']; ?>"><?=$row_users['email']; ?></a>
                                                            </td>

                                                            <td><a href="?view-address&id=<?= $row_users['iduser'];?>"><button class="btn btn-primary btn-fill btn-sm">Ver endereços</button></a></td>

                                                            <td><?= $row_users['criado']; ?></td>

                                                            <td>
                                                                <?php if ($row_users['status'] == "inactive"): ?>
                                                                    <a href="functions/ativa-cliente.php?id=<?= $row_users['iduser'];?>"><button class="btn btn-fill btn-sm btn-success"><i class="fa fa-check"></i> Ativar</button></a>
                                                                    <?php else: ?>
                                                                        <a href="functions/desativa-cliente.php?id=<?= $row_users['iduser'];?>"><button class="btn btn-fill btn-sm btn-danger"><i class="fa fa-close"></i> Desativar</button></a>
                                                                        <a href="functions/reseta-senha-cliente.php?id=<?= $row_users['iduser'];?>"><button class="btn btn-fill btn-sm btn-light"><i class="fa fa-recycle"></i> Resetar Senha</button></a>

                                                                    <?php endif ?>
                                                                    <?php if($row_users['ativo'] == '0'){ ?>
                                                                        <br><br>
                                                                        <a href="functions/verifica-cliente.php?id=<?= $row_users['iduser'];?>" class="btn btn-fill btn-sm btn-info"><i class="fa fa-check"></i> Verificar Cliente</a>
                                                                    <?php } ?>
                                                                    <br>
                                                                    <a href="functions/user-view.php?id=<?=$row_users['iduser'];?>">
                                                                        <button class="btn btn-sm"><i class="fa fa-long-arrow-right"></i> Acessar Cliente</button>
                                                                    </a>
                                                                </td>
                                                            <? } ?>
                                                            <? if($mobile == 1){ ?>
                                                                <td>
                                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400 maisInfos" data-id='<?=$row_users['iduser'];?>'></i>
                                                                </td>
                                                            <? } ?>
                                                        </tr> 
                                                    <?php }
                                                } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                                            </tbody>
                                        </table>
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
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $('#meusclientes').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    });

    $('.maisInfos').click(function(){

       var iduser = $(this).attr('data-id');

       $.post( "functions/get-user.php", {iduser: iduser})
       .done(function(response) {

        var data = JSON.parse(response);
        console.log(data);

        $('#ativarUser').hide();
        $('#ativarUser').attr('href', '');

        $('#desativarUser').hide();
        $('#desativarUser').attr('href', '');

        $('#resetSenha').hide();
        $('#resetSenha').attr('href', '');

        $('#verificaUser').hide();
        $('#verificaUser').attr('href', '');

        $('#logarComoUser').attr('href', '');

        $('#tituloInfo').text('Detalhes Suíte: #'+iduser)

        $('#enderecoSuite').html('');


        $('#numeroSuite').val(data.idSuite);
        $('#NomeCompleto').val(data.nomeCompleto);
        $('#pesoSuite').val(data.pesoTotal);
        $('#saldoWallet').val(data.saldoWallet);
        $('#telefoneSuite').val(data.telefone);
        $('#emailSuite').val(data.email);
        $('#cadastradoDesde').val(data.dtCadastro);
        $('#cpf').val(data.cpf);
        


        if(data.qtdEnderecos > 0) {

            var textEndereco = '';

            for(var i=1;i<=data.qtdEnderecos;i++){

                textEndereco += '<br>Endereço #'+i+'<br>';
                if(data.enderecos[i].pais == 'Brazil'){
                    textEndereco += data.enderecos[i].rua+', '+data.enderecos[i].numero;
                    if(data.enderecos[i].complemento != ''){
                        textEndereco += ', '+data.enderecos[i].complemento;
                    }
                    textEndereco += '<br>'+data.enderecos[i].bairro+', '+data.enderecos[i].cidade+'/'+data.enderecos[i].estado+'<br>';
                    textEndereco += data.enderecos[i].pais+'<br>';
                    textEndereco += data.enderecos[i].cep+'<br>';
                } else {
                    textEndereco += data.enderecos[i].rua;
                    if(data.enderecos[i].complemento != ''){
                        textEndereco += ', '+data.enderecos[i].complemento;
                    }
                    textEndereco += '<br>'+data.enderecos[i].cidade+' - '+data.enderecos[i].estado+'<br>';
                    textEndereco += data.enderecos[i].pais+'<br>'+data.enderecos[i].cep;
                }

            }

            $('#enderecoSuite').append(textEndereco);
            $('#enderecoSuite').append('<br>');

        }
        if(data.status == 'inactive'){
            $('#ativarUser').attr('href', data.ativarUser);
            $('#ativarUser').show();
        } else {

            $('#desativarUser').attr('href', data.desativarUser);
            $('#desativarUser').show();

            $('#resetSenha').attr('href', data.resetSenha);
            $('#resetSenha').show();
        }

        if(data.ativo == '0'){

           $('#verificaUser').attr('href', data.verificaUser);
           $('#verificaUser').show();
       }

       $('#logarComoUser').attr('href', data.logarComoUser);

       $('#modalUser').modal('show');

   });


   });

</script>

<div id="modalUser" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tituloInfo">Detalhes Suíte: </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12"><strong>Suíte: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="numeroSuite">
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Nome Completo: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="NomeCompleto">
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>CPF: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="cpf">
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Peso Total na Suite: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="pesoSuite">
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Saldo da Wallet: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="saldoWallet">
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Telefone: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="telefoneSuite">
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Email: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="emailSuite">
                        <br><br>
                    </div>
                </div>
                <!-- Endereços? -->
                <div class="row">
                    <div class="col-lg-12"><strong>Endereços: </strong></div>
                    <div class="col-lg-12" id="enderecoSuite">

                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Cadastrado Desde: </strong></div>
                    <div class="col-lg-12">
                        <input type="text" style="border: 0; width: 300px;" value="" id="cadastradoDesde">
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" id="ativarUser">
                    <button class="btn btn-fill btn-sm btn-success"><i class="fa fa-check"></i> Ativar</button>
                </a>

                <a href="" id="desativarUser">
                    <button class="btn btn-fill btn-sm btn-danger"><i class="fa fa-close"></i> Desativar</button>
                </a>

                <a href="" id="resetSenha">
                    <button class="btn btn-fill btn-sm btn-light"><i class="fa fa-recycle"></i> Resetar Senha</button>
                </a>

                <a href="" id="verificaUser">
                    <button class="btn btn-fill btn-sm btn-info"><i class="fa fa-check"></i> Verificar Cliente</button>
                </a>

                <a href="" id="logarComoUser">
                    <button class="btn btn-sm"><i class="fa fa-long-arrow-right"></i> Acessar Cliente</button>
                </a>
            </div>
        </div>
    </div>
</div>

</html>
