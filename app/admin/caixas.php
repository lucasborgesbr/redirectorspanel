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
            <a class="navbar-brand" href="#">Caixas</a>
          </div>
          <div class="collapse navbar-collapse">
            <?php include("blocks/topbar.php"); ?>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="container-fluid">
          <!-- mostrar enderecos -->
          <?php if (isset($_GET['view-produtos']) AND $row_produtos['idproduto']!=""): ?>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="header">
                    <h4 class="title">Produtos da Caixa #<?= $_GET['id-caixa'];?></h4>
                  </div>
                  <div class="content">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <th># Produto</th>
                          <th>Descrição</th>
                          <th>Imagens</th>
                          <th>Peso</th>
                          <th>Quantidade em Estoque</th>
                          
                          <th>Criado em</th>
                          <th>Status</th>
                        </tr>

                        <?php do { ?>
                          <tr>
                            <td><?=$row_produtos['idproduto'];?></td>
                            <td><?= $row_produtos['descricao'] ?></td>
                            <td>
                              <a href="../user/assets/img/produtos/<?= $row_produtos['imagem1'] ?>" data-fancybox class="btn btn-sm btn-primary btn-fill">IMG1</a>
                              <?php if ($row_produtos['imagem2'] !=""){ ?>
                                <a href="../user/assets/img/produtos/<?= $row_produtos['imagem2']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 2" class="btn btn-sm btn-fill btn-primary hidden-xs hidden-sm">IMG2</a>
                              <?php } ?>
                            </td>
                            <td><?= $row_produtos['peso'] ?></td>
                            <td><?= $row_produtos['quantidade'] ?></td>
                            
                            <td><?= $row_produtos['criado'] ?></td>
                            <td><?= $row_produtos['status'] ?></td>
                            
                          </tr>
                        <?php } while($row_produtos = mysqli_fetch_assoc($query_select_produtos)); ?>
                      </table>
                    </div>                            
                  </div>
                </div>
              </div>
            </div>
            <?php else: ?>
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <?php if (isset($_GET['id-caixa'])): ?>
                      <div class="header">
                        <h4 class="title">Produtos da Caixa #<?= $_GET['id-caixa'];?></h4>
                      </div>
                    <?php endif ?>
                    <?php if (isset($_GET['view-produtos'])): ?>
                      <div class="content">
                        Nenhum produto encontrado para esta caixa.
                      </div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            <?php endif ?>
            <!-- mostrar docs -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="header">
                    <h4 class="title">Lista de Caixas</h4>
                  </div>
                  <div class="content">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="caixas">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Suíte</th>
                            <th>Remetente</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Tracking</th>
                            <th>Imagens</th>
                            <th>Criado em </th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <? do{ ?>
                            <? if ($row_caixas['idcaixa'] != ""){ ?>
                             <tr>
                               <td><?= $row_caixas['idcaixa'] ?></td>
                               <td><?= $row_caixas['iduser'] ?></td>
                               <td><?= $row_caixas['remetente'] ?></td>
                               <td><?= $row_caixas['descricao'] ?></td>
                               <td><?= $row_caixas['peso'] ?></td>
                               <td><?= $row_caixas['tracking'] ?></td>
                               <td>
                                <a href="../user/assets/img/caixas/<?= $row_caixas['imagem1']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 1" class="btn btn-sm btn-primary btn-fill">IMG1</a>
                                <?php if ($row_caixas['imagem2'] !=""){ ?>
                                  <a href="../user/assets/img/caixas/<?= $row_caixas['imagem2']; ?>" data-fancybox data-toggle="tooltip" data-placement="top" title="Clique para ampliar a imagem 2" class="btn btn-sm btn-fill btn-primary">IMG2</a>
                                <?php } ?>
                              </td>
                              <td><?= $row_caixas['criado'] ?></td>
                              <td><a href="?view-produtos&id-caixa=<?= $row_caixas['idcaixa']; ?>"><button class="btn btn-fill btn-primary btn-sm">Ver produtos</button></a></td>
                              <td>
                                <a href="functions/deleta-caixa.php?id=<?= $row_caixas['idcaixa'];?>" onclick="return confirm('Deseja realmente excluir este item?');"><button type="button" class="btn btn-danger btn-sm btn-fill"><i class="fa fa-close"></i> Excluir</button></a>
                                <a href="#" class="updateCaixa" data-toggle="modal" data-target="#editarCaixa" data-id="<?=$row_caixas['idcaixa'];?>"><button type="button" class="btn btn-success btn-sm btn-fill"><i class="fa fa-pencil"></i> Editar</button></a>
                              </td>
                            </tr>
                          <? }
                        } while($row_caixas = mysqli_fetch_assoc($query_select_caixas));?>
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

<div class="modal fade" id="editarCaixa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h5 class="modal-title" id="tituloCaixa">Editar Caixa</h5>
        
      </div>
      <form method="post" action="functions/update-caixa.php" enctype="multipart/form-data">
        <input type="hidden" name="idcaixa" id="updateidcaixa">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  Suite do Cliente *
                </label>
                <input type="text" name="suite" id="updateCaixaSuite" list="suite" class="form-control border-input" required value="">
                <datalist>
                  <?php do{?>
                    <option value="<?= $row_users['iduser']; ?>"><?=$row_users['nome'].' '.$row_users['sobrenome'];?></option>
                  <?php } while($row_users = mysqli_fetch_assoc($query_select_users));?>
                </datalist>

              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  Tracking Number Caixa
                </label>
                <input type="text" name="tracking" class="form-control border-input" id="updateCaixaTracking">

              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  Peso
                </label>
                <input type="text" name="peso" id="updateCaixaPeso" class="form-control border-input">

              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                  Data Criação *
                </label>
                <input type="date" name="criado" id="updateCaixaDate" value="" class="form-control border-input" required>
              </div>    
            </div>


          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                  Remetente
                </label>
                <input type="text" name="remetente" id="updateCaixaRemetente" class="form-control border-input">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                  Descrição
                </label>
                <textarea name="descricao" id="updateCaixaDesc" class="form-control border-input" rows="4"></textarea>

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
          <button type="submit" class="btn btn-success btn-fill">Editar Caixa</button>
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
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
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
        // script para sortear a tabela
        function sortTable(n) {
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("meusclientes");
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
<script type="text/javascript">

  $(document).ready(function(){
    $('#caixas').DataTable( {
      "order": [[ 0, "desc" ]]
    });

    $("#caixas").on("click", ".updateCaixa", function(){
    
      var idcaixa = $(this).attr('data-id');
      
      $.post("functions/get-caixa.php", {idcaixa: idcaixa})
      .done(function(response) {

        var data = JSON.parse(response);

        console.log(data);

        $('#updateidcaixa').val(data.idcaixa);
        $('#updateCaixaSuite').val(data.iduser);
        $('#updateCaixaTracking').val(data.tracking);
        $('#updateCaixaPeso').val(data.peso);
        $('#updateCaixaDate').val(data.criado);
        $('#updateCaixaRemetente').val(data.remetente);
        $('#updateCaixaDesc').val(data.descricao);

        $('#tituloCaixa').html('Editar Caixa #'+idcaixa);

      });

     
    });


  });
</script>


</html>
