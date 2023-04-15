<?php 
require ("functions/functions.php");
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
      <title>SIB | Caixas a Caminho</title>
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
                <? include 'blocks/menu-flutuante.php'; ?>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="row">
            <div class="col-lg-12"><!-- card lista de produtos da caixa -->
                <div class="card">
                    <div class="header">
                        <h4 class="title">Lista de Envios</h4>
                    </div>
                    <div class="content">
                      <div class="table-responsive">
                        <table class="table table-bordered text-center" id="caixas">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <!--<td>Suíte</td>-->
                                    <td>Loja</td>
                                    <td>Tracking Number, Numero do Pedido</td>
                                    <td>Numero de Caixas</td>
                                    <td>Valor da Compra</td>
                                    <td>Comprovante</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- loop de produtos -->
                                <?php do{ ?>
                                    <?php if ($row_redirecionamento['id'] != ""){ ?>
                                        <tr>
                                            <td><?=$row_redirecionamento['id'];?></td>
                                            <!--<td><?=$row_redirecionamento['suite'];?></td>-->
                                            <td><?=$row_redirecionamento['loja'];?></td>
                                            <td><?=$row_redirecionamento['tracking'];?></td>
                                            <td><?=$row_redirecionamento['numerocaixas'];?></td>
                                            <td><?=$row_redirecionamento['valorcompra'];?></td>
                                            <td>
                                                <a href="assets/img/comprovantes/<?=$row_redirecionamento['comprovante']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem">
                                                    <div class="btn btn-success btn-fill btn-sm text-center">Comprovante</div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="functions/deleta-redirecionamento.php?id=<?=$row_redirecionamento['id']?>" data-toggle="tooltip" title="Clique aqui para cancelar esta transação."><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php }
                                } while($row_redirecionamento = mysqli_fetch_assoc($query_select_redirecionamento)); ?>
                                <!-- fim loop de produtos -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="functions/acrescenta-caixa-a-caminho.php" enctype='multipart/form-data'>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Loja</label>
                                            <input type="text" name="loja" class="form-control border-input" placeholder="Loja, Remetente">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>No. Pedido ou Tracking No.</label>
                                            <input type="text" name="tracking" class="form-control border-input" placeholder="Trackingnumber, Numero do Pedido ou da Compra">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Numero de Caixas</label>
                                            <input type="text" name="numerocaixas" class="form-control border-input" placeholder="4">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Valor da Compra</label>
                                            <input type="text" name="valorcompra" class="form-control border-input" placeholder="00.00">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Comprovante da Compra</label>
                                            <input type="file" name="comprovante" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-fill btn-sm text-center" style="margin-top:30px">CADASTRAR</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div></div>
        </div>
    </div>




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
<!-- <script src="assets/js/chartist.min.js"></script> -->
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>


<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script type="text/javascript" src="functions/functions.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>

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

    $(document).ready(function(){
        $('#caixas').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    });
</script>
</html>
