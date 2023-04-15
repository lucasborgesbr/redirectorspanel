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
                        <a class="navbar-brand" href="#">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <?php include("blocks/topbar.php"); ?>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <!-- card dos clientes -->
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="fa fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Clientes</p>
                                                <?= $total_users = mysqli_num_rows($query_select_users); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr>
                                        <div class="stats">
                                            <a href="users.php">Ver todos os clientes</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- termina card dos clientes -->
                        </div>
                        
                        <!-- card das caixas -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-danger text-center">
                                                <i class="ti-gift"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Caixas</p>
                                                <?= $total_caixas = mysqli_num_rows($query_select_caixas); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr>
                                        <div class="stats">
                                            <a href="caixas.php">Ver todas as caixas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- termina card das caixas -->
                        <!-- card dos produtos -->
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="fa fa-gamepad"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Produtos</p>
                                                <?= $total_produtos = mysqli_num_rows($query_select_produtos); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr>
                                        <div class="stats">
                                            <a href="produtos.php">Ver todos os produtos</a>
                                        </div>
                                    </div>
                                </div>
                            </div></div>
                            <!-- termina card dos produtos -->
                            <!-- card dos envios -->
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="fa fa-paper-plane"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Envios</p>
                                                    <?= $total_envios = mysqli_num_rows($query_select_envios); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr>
                                            <div class="stats">
                                                <a href="envios.php">Ver todos os envios</a>
                                            </div>
                                        </div>
                                    </div>
                                </div></div>
                                <!-- termina card dos envios -->
                            </div>
                            <div class="row">
                                <!-- card adiciona caixa -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Adicionar Caixas</h4>
                                        </div>
                                        <div class="content">
                                            <form method="post" action="functions/acrescenta-caixa.php" enctype="multipart/form-data" >
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>
                                                                Suite do Cliente *
                                                            </label>
                                                            <input type="text" name="suite" list="suite" class="form-control border-input" required value="<?php if(isset($_SESSION['suite'])){ echo $_SESSION['suite'];} ?>">


                                                            <datalist id="suite">
                                                              <?php do{?>
                                                                  <option value="<?=$row_users['iduser'].' | '.$row_users['nome'].' '.$row_users['sobrenome']; ?>"><?=$row_users['nome'].' '.$row_users['sobrenome'];?></option>
                                                              <?php } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                                                          </datalist>

                                                      </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Tracking Number Caixa
                                                        </label>
                                                        <input type="text" name="tracking" class="form-control border-input" placeholder="Ex: US897987BHG">

                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Peso
                                                        </label>
                                                        <input type="text" name="peso" class="form-control border-input">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Data Criação *
                                                        </label>
                                                        <input type="date" name="criado" value="<?=date('Y-m-d');?>" class="form-control border-input" required>
                                                    </div>    
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>
                                                            Remetente
                                                        </label>
                                                        <input type="text" name="remetente" class="form-control border-input">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>
                                                            Descrição
                                                        </label>
                                                        <textarea name="descricao" class="form-control border-input" rows="4"></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Imagem 1 *
                                                        </label>
                                                        <input type="file" name="imagem1" required class="form-control border-input">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Imagem 2
                                                        </label>
                                                        <input type="file" name="imagem2" class="form-control border-input">

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="form-group text-center">
                                                        <small>Todos os campos * são obrigatórios.</small><br>
                                                        <button type="submit" class="btn btn-success btn-fill">CADASTRAR CAIXA</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- card atualização de endereço -->
                    <!--div class="card">
                        <div class="header">
                            <h4 class="title">Atualizar Endereço do Serviço</h4>
                        </div>
                        <div class="content">
                            <form method="post" action="functions/atualiza-endereco.php">
                                <div class="form-group">
                                    <label>Endereço:</label>
                                    <input type="text" name="endereco" class="form-control border-input" value="<?= $row_admin['endereco'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Cidade:</label>
                                    <input type="text" name="cidade" class="form-control border-input" value="<?= $row_admin['cidade']; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Estado:</label>
                                            <input type="text" name="estado" class="form-control border-input" value="<?= $row_admin['estado']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ZIPCODE:</label>
                                            <input type="text" name="zipcode" class="form-control border-input" value="<?= $row_admin['cep']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>País:</label>
                                            <input type="text" name="pais" class="form-control border-input" value="<?= $row_admin['pais']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-group text-center">
                                            
                                            <button type="submit" class="btn btn-success btn-fill">ATUALIZAR ENDEREÇO</button>

                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div-->
                </div>    
                <!-- ends card nova caixa -->
                <!-- card adiciona produtos -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Adicionar Produtos</h4>
                        </div>
                        <div class="content">
                            <form method="post" action="functions/acrescenta-produto.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>
                                                Suite do Cliente *
                                            </label>
                                            <input type="text" name="suite" class="form-control border-input" required value="<?php if(isset($_SESSION['suite'])){ echo $_SESSION['suite'];} ?>">

                                            <datalist id="suite">
                                              <?php do{?>
                                                  <option value="<?=$row_users['iduser'].' | '.$row_users['nome'].' '.$row_users['sobrenome']; ?>"><?=$row_users['nome'].' '.$row_users['sobrenome'];?></option>
                                              <?php } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                                          </datalist>

                                      </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            Id Caixa
                                        </label>
                                        <input type="text" name="idcaixa" class="form-control border-input" value="<?php if(isset($_SESSION['last_id'])){ echo $_SESSION['last_id'];} ?>">

                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            Peso
                                        </label>
                                        <input type="text" name="peso" class="form-control border-input" value="<?php if(isset($_SESSION['peso'])){ echo $_SESSION['peso'];}?>">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            Quantidade
                                        </label>
                                        <input type="text" name="quantidade" class="form-control border-input">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            Data Criação *
                                        </label>
                                        <input type="date" name="criado" class="form-control border-input" value="<?php if(isset($_SESSION['criado'])){ echo $_SESSION['criado'];}else{echo date('Y-m-d');} ?>" required>
                                    </div>    
                                </div>
                                
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>
                                            Descrição
                                        </label>
                                        <textarea name="descricao" class="form-control border-input" rows="4"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            Imagem 1 *
                                        </label>
                                        <input type="file" name="imagem1" required class="form-control border-input">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            Imagem 2
                                        </label>
                                        <input type="file" name="imagem2" class="form-control border-input">

                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group text-center">
                                        <small>Todos os campos * são obrigatórios.</small><br>
                                        <button type="submit" class="btn btn-success btn-fill">CADASTRAR PRODUTO</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- card atualiza senha -->
                   <!-- <div class="card">
                            <div class="content">
                                <div class="header">
                                        <h4 class="title">Atualizar Senha</h4><br>
                                </div>
                                <form method="post" action="functions/atualiza-senha.php" onsubmit="return verificasenha()">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            
                                            <div class="form-group">
                                                <label>Nova Senha</label>
                                                    <input type="password" name="nova-senha" id="nova-senha" class="form-control border-input" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Confirma Senha</label>
                                                    <input type="password" name="conf-senha" id="conf-senha" class="form-control border-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR SENHA</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div> -->
                    </div>
                    <!-- ends adiciona produtos -->
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
	<!-- <script type="text/javascript">
    	$(document).ready(function(){
        	demo.initChartist();
        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."
            },{
                type: 'success',
                timer: 4000
            });
    	});
    </script> -->
    <script type="text/javascript">
        function verificasenha(){
            var senha = document.getElementById('nova-senha');
            var conf = document.getElementById('conf-senha');
            if (senha.value != conf.value) {
                alert('Verifique a senha digitada, elas não conferem!');
                conf.value = "";
                conf.focus();
                return false;
            }

        }
    </script>
    </html>
