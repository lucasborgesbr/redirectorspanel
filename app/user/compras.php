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
      <title>SIB | Compras</title>
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
                <a class="navbar-brand" href="#">Compras Assistidas</a>
            </div>
            <div class="collapse navbar-collapse">
                <? include 'blocks/menu-flutuante.php'; ?>
            </div>
        </div>
    </nav>
    <div class="content">
        <!-- card lista de produtos da caixa -->
        <?php if ($row_compras['idcompra'] != ""){ ?>
            
            
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            
                         <p>Para criar um orçamento de compra assistida preencha o formulário abaixo.</p>   
                         <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <td>#</td>
                                    <td>Descricao</td>
                                    <td class="hidden-sm hidden-xs">Link</td>
                                    <td class="hidden-sm hidden-xs">Valor</td>
                                    <td>Quantidade</td>
                                    <td class="hidden-sm hidden-xs">Status</td>
                                    <td class="hidden-sm hidden-xs">Criado em</td>
                                    <td>Ação</td>
                                </tr>
                                <!-- loop de produtos -->
                                <?php do{ ?>
                                    <tr>
                                        <td><?= $row_compras['idcompra']; ?></td>                                
                                        <td>
                                            <?= $row_compras['descricao']; ?>
                                            <!-- se tiver tamanho -->
                                            <?php if ($row_compras['cor'] != ""){echo "<br>Cor: ".$row_compras['cor'];} ?>
                                            <!-- se tiver cor -->
                                            <?php if ($row_compras['tamanho'] != ""){echo "<br>Tamanho: ".$row_compras['tamanho'];} ?>
                                        </td>
                                        <?php if($row_compras['link'] != ''){ ?>                                
                                            <td class="hidden-sm hidden-xs">
                                                <a href="<?= $row_compras['link'];?>" target="_blank"><button type='button' class='btn btn-sm btn-fill'>Abrir Link</button></a>
                                            </td>
                                        <?php } else {echo "<td></td>";} ?>                            
                                        <td class="hidden-sm hidden-xs"><?= $row_compras['valor']; ?></td>                                
                                        <td><?= $row_compras['quantidade']; ?></td>                                
                                        <td class="hidden-sm hidden-xs"><?= $row_compras['status']; ?></td>                                
                                        <td class="hidden-sm hidden-xs"><?php $data = explode("-", $row_compras['criado']); echo $data[2]."/".$data[1]."/".$data[0]; ?></td>
                                        <?php if($row_compras['status'] == "Novo"){
                                            echo "<td><a href='functions/deleta-compra.php?id=".$row_compras['idcompra']."' onclick='return confirm('Deseja realmente excluir este item?');'><button type='button' class='btn btn-danger btn-sm btn-fill'><i class='fa fa-close'></i> Excluir</button></a></td>";
                                        }else{echo "<td></td>";}?>                                
                                        
                                    </tr>
                                    
                                <?php } while($row_compras = mysqli_fetch_assoc($query_select_compras)); ?>
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
                <p>Nenhum compra assistida cadastrado.</p>
            </div>
        </div>
    <?php } ?>
    
    <div class="card">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="functions/acrescenta-compra.php">
                        <div class="row" id="origem">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" name="descricao[]" class="form-control border-input" placeholder="Tennis Adidas Blade">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>Cor</label>
                                    <input type="text" name="cor[]" class="form-control border-input" placeholder="Branco">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label>Tamanho</label>
                                    <input type="text" name="tamanho[]" class="form-control border-input" placeholder="42">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link[]" class="form-control border-input" placeholder="http://">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input type="text" name="valor[]" class="form-control border-input" placeholder="00.00">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label>Quantidade</label>
                                    <input type="number" name="quantidade[]" class="form-control border-input" value="1" min="1" max="99">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    
                                    <a href="#" style="cursor: pointer;" onclick="removerCampos(this);" ><button style="margin-top: 30px" type="button" class="btn btn-danger btn-sm btn-fill"><i class="fa fa-close"></i> Excluir</button></a>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div id="destino"></div>
                        <a href="#" style="cursor: pointer;" onclick="duplicarCampos();"><button type="button" class="btn btn-success btn-sm btn-fill"><i class="fa fa-plus"></i> Adicionar mais campos</button> </a>
                        <br><br><br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-fill btn-wd text-center">CRIAR PEDIDO COMPRA ASSISTIDA</button>
                        </div><br>
                    </form>
                </div>
            </div>
        </div>
    </div></div>
    
    
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
