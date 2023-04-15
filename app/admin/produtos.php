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
  
  <link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css?v=2.1.5">
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
            <a class="navbar-brand" href="#">Produtos</a>
          </div>
          <div class="collapse navbar-collapse">
            <?php include("blocks/topbar.php"); ?>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-12">
              <div class="card">
                <div class="header">
                  <h4 class="title">Lista de Produtos</h4>
                </div>
                <div class="content">
                  <div class="table-responsive">
                    <table class="table table-bordered text-center" id="produtos">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Suíte</th> 
                          <th>Descrição</th>
                          <th>Imagens</th>
                          <th>Peso</th>
                          <th>Quantidade em Estoque</th>

                          <th>Criado em</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php do { 
                          if($row_produtos['idproduto'] != ''){?>
                          <tr>
                            <td><?=$row_produtos['idproduto'] ?></td>
                            <td><?="{$row_produtos['iduser']} | {$row_produtos['nome']} {$row_produtos['sobrenome']}"?></td>
                            <td><?=$row_produtos['descricao'] ?></td>
                            <td>

                              <a href="../user/assets/img/produtos/<?=$row_produtos['imagem1']; ?>" data-fancybox-group="produtos" data-toggle="tooltip" data-placement="top" class="fancybox btn btn-primary btn-sm btn-fill">IMG1</i></a>
                              <?php if ($row_produtos['imagem2'] !=""){ ?>
                                <a href="../user/assets/img/produtos/<?=$row_produtos['imagem2']; ?>" data-fancybox-group="produtos" data-toggle="tooltip" data-placement="top" class="fancybox btn btn-primary btn-sm btn-fill hidden-xs hidden-sm">IMG2</a>
                              <?php } ?>
                            </td>
                            <td><?=$row_produtos['peso'] ?></td>
                            <td><?=$row_produtos['quantidade'] ?></td>

                            <td><?=substr($row_produtos['criado'], 0, 10) ?></td>
                            <td>
                              <a href="functions/deleta-produto.php?id=<?=$row_produtos['idproduto'];?>" onclick="return confirm('Deseja realmente excluir este item?');"><button type="button" class="btn btn-danger btn-sm btn-fill"><i class="fa fa-close"></i> Excluir</button></a>
                              <a href="#" class="updateProduto" data-toggle="modal" data-target="#editarProduto" data-id="<?=$row_produtos['idproduto'];?>"><button type="button" class="btn btn-success btn-sm btn-fill"><i class="fa fa-pencil"></i> Editar</button></a>
                            </td>
                          </tr>
                        <?php }
                      } while($row_produtos = mysqli_fetch_assoc($query_select_produtos)); ?>
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
</div> <!-- /*div wrapper ends*/ -->
</body>

<div class="modal fade" id="editarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h5 class="modal-title" id="tituloProduto">Editar Produto</h5>

      </div>
      <form method="post" action="functions/update-produto.php" enctype="multipart/form-data">
        <input type="hidden" name="idproduto" id="updateidproduto">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  Suite do Cliente *
                </label>
                <input type="text" name="suite" id="updateProdutoSuite" list="suite" class="form-control border-input" required value="">
                <datalist>
                  <?php do{?>
                    <option value="<?=$row_users['iduser']; ?>"><?=$row_users['nome'].' '.$row_users['sobrenome'];?></option>
                  <?php } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                </datalist>

              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  ID Produto
                </label>
                <input type="text" name="idcaixa" class="form-control border-input" id="updateProdutoIDProduto">

              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label>
                  Peso
                </label>
                <input type="text" name="peso" id="updateProdutoPeso" class="form-control border-input">

              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>
                  Quantidade
                </label>
                <input type="text" name="quantidade" id="updateProdutoQtd" class="form-control border-input">

              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>
                  Data Criação *
                </label>
                <input type="date" name="criado" id="updateProdutoDate" value="" class="form-control border-input" required>
              </div>    
            </div>


          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                  Descrição
                </label>
                <textarea name="descricao" id="updateProdutoDesc" class="form-control border-input" rows="4"></textarea>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  Imagem 1
                </label>
                <input type="file" name="imagem1" class="form-control border-input">

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
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success btn-fill">Editar Produto</button>
        </div>
      </form>
    </div>
  </div>
</div>


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
<script src="assets/fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $('#produtos').DataTable( {
      "order": [[ 0, "desc" ]]
    });

    $('.fancybox').fancybox();


    $("#produtos").on("click", ".updateProduto", function(){

      var idproduto = $(this).attr('data-id');

      $.post("functions/get-produto.php", {idproduto: idproduto})
      .done(function(response) {

        var data = JSON.parse(response);

        console.log(data);

        $('#updateidproduto').val(idproduto);
        $('#updateProdutoSuite').val(data.iduser);
        $('#updateProdutoIDProduto').val(data.idcaixa);
        $('#updateProdutoPeso').val(data.peso);
        $('#updateProdutoQtd').val(data.quantidade);
        $('#updateProdutoDate').val(data.criado.slice(0,10));
        $('#updateProdutoDesc').val(data.descricao);

        $('#tituloProduto').html('Editar Produto #'+idproduto);

      });


    });



  });
</script>
<!-- script  -->
</html>
