<?php 
require ("functions/functions.php");
?>
<!doctype html>
<html lang="en">
<head>
<head>
  <meta http-equiv='Pragma' content='no-cache'>
  <meta http-equiv='Expires' content='-1'>
  <meta http-equiv='CACHE-CONTROL' content='NO-CACHE'><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	
	<link rel="apple-touch-icon" sizes="76x76" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
	<link rel="icon" type="image/png" sizes="96x96" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>SIB | Produtos Loja</title>
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
                    <a class="navbar-brand" href="#">Caixas a Caminho</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
                                    <i class="fa fa-angle-down"></i>
                                    
                                    <?php if ($row_user['avatar'] != ""){ ?>
                                        <img src="assets/img/avatar/<?= $row_user['avatar']; ?>" style="width:25px; border-radius:100%; border:2px solid #FFF; box-shadow: 1px 1px #ccc ">
                                        <?php } ?>&nbsp;
                                        <b><?= ucwords($row_user['nome']." ".$row_user['sobrenome']); ?></b> 
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
                <div class="row">
                    <div class="col-lg-12"><!-- card lista de produtos da caixa -->
                        <?php if ($row_redirecionamento['id'] != ""){ ?>
                            
                            
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="content">
                                            
                                           <p>Lista de caixas que estão a caminho.</p>   
                                           <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <tr>
                                                    <td>#</td>
                                                    <td>Suíte</td>
                                                    <td>Loja</td>
                                                    <td>Tracking Number, Número do Pedido</td>
                                                    <td>Número de Caixas</td>
                                                    <td>Valor da Compra</td>
                                                    <td>Comprovante</td>
                                                    
                                                    
                                                </tr>
                                                <!-- loop de produtos -->
                                                <?php do{ ?>
                                                    <tr>
                                                        <td><?=$row_redirecionamento['id'];?></td>
                                                        <td><?=$row_redirecionamento['suite'];?></td>
                                                        <td><?=$row_redirecionamento['loja'];?></td>
                                                        <td><?=$row_redirecionamento['tracking'];?></td>
                                                        <td><?=$row_redirecionamento['numerocaixas'];?></td>
                                                        <td><?=$row_redirecionamento['valorcompra'];?></td>
                                                        <td>
                                                            <a href="../user/assets/img/comprovantes/<?=$row_redirecionamento['comprovante']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem">
                                                                <img src="../user/assets/img/comprovantes/<?=$row_redirecionamento['comprovante'];?>" style="height:60px; border: 1px solid #ccc; padding:10px; border-radius:5px;">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php } while($row_redirecionamento = mysqli_fetch_assoc($query_select_redirecionamento)); ?>
                                                <!-- fim loop de produtos -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php } else { ?>
                        <div class="card">
                            <div class="content">
                                <p>Nenhuma caixa a caminho cadastrada.</p>
                            </div>
                        </div>
                        <?php } ?></div>
                        
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
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script type="text/javascript">
        function duplicarCampos(){
            var clone = document.getElementById('origem').cloneNode(true);
            var destino = document.getElementById('destino');
            destino.appendChild (clone);
            var camposClonados = clone.getElementsByTagName('input');
            for(i=0; i<camposClonados.length;i++){
                camposClonados[i].value = '';
            }
        }
        function removerCampos(id){
            var node1 = document.getElementById('destino');
            node1.removeChild(node1.childNodes[0]);
        }
    </script>
    </html>
