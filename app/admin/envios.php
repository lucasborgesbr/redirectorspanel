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
                    <a class="navbar-brand" href="#">Envios</a>
                </div>
                <div class="collapse navbar-collapse">
                    <?php include("blocks/topbar.php"); ?>
                </div>
            </div>
        </nav>
        <?php if (isset($_GET['s'])): ?>
            <div class="alert alert-success" id="erro">
                <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                <span>Tracking Number adicionado com sucesso!</span>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['e'])): ?>
            <div class="alert alert-success" id="erro">
                <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                <span>Erro ao enviar o Email!</span>
            </div>
        <?php endif ?>
        <div class="content">
            <div class="container-fluid">
                <!-- mostrar enderecos -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Lista de Envios</h4>
                            </div>
                            <div class="content">
                                <div class="table-responsive"> 
                                    <table class="table table-bordered text-center" id="envios">
                                        <thead>
                                            <tr>
                                                <td>Envio #</td>
                                                <td>Suíte</td>
                                                <td>Cliente</td>
                                                <td>Tracking Number</td>
                                                <td>Valor Final</td>
                                                <td>Forma de Pagamento</td>
                                                <td>Criado</td>
                                                <td>Status</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do{ ?>
                                                <?php if($row_envios['idenvio'] != ''){ ?>
                                                    <tr>
                                                        <td><?= $row_envios['idenvio']; ?></td>
                                                        <td><?= $row_envios['iduser'] ?></td>
                                                        <td><?=ucwords($row_envios['nome']." ".$row_envios['sobrenome']);?></td>
                                                        <td>
                                                            <form method="post" action="functions/acrescenta-tracking.php">
                                                                <input type="hidden" name="idenvio" value="<?= $row_envios['idenvio'];?>">
                                                                <div class="form-group">
                                                                    
                                                                    <input type="text" name="tracking" value="<?= $row_envios['tracking'];?>" class="form-control form-control-sm border-input">
                                                                    
                                                                    <button type="submit" class="btn btn-sm btn-fill btn-success">ADICIONAR</button>
                                                                    
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td><?= $row_envios['valortotal']; ?></td>
                                                        <td>
                                                            <?= $row_envios['formapgto']; ?>
                                                        </td>
                                                        <td><?php $nova_data = explode(" ",$row_envios['criado']); echo $nova_data[0]; ?></td>
                                                        <td>
                                                            <?=$row_envios['status'];?>
                                                        </td>
                                                        <td><a href="visualizar-envios.php?idenvio=<?= $row_envios['idenvio']; ?>" data-toggle="tooltip" title="Clique aqui para visualizar detalhes deste envio." class="btn btn-xs btn-fill btn-success"><i class="fa fa-external-link"></i> Abrir</a></td>


                                                    </tr>
                                                <? } ?>
                                            <?php } while($row_envios = mysqli_fetch_assoc($query_select_envios));?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                               <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th> 
                                            </tr>
                                        </tfoot>
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
<script type="text/javascript">
   
    $(document).ready(function(){
        $('#envios1').DataTable( {
            "order": [[ 0, "desc" ]]
        });
    });
    
        $(document).ready(function() {
    $('#envios').DataTable( {
        "order": [[ 0, "desc" ]],
        "pageLength": 100,
        initComplete: function () {
            this.api().columns([5, 7]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>
<!-- script  -->
</html>