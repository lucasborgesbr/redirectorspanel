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
                                    <h4 class="title">Lista de Compras Assistidas</h4>
                                </div>
                                <div class="content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <tr>
                                                <td>#</td>
                                                <td>Suíte</td>
                                                <td>Cliente</td>
                                                <td>Descricao</td>
                                                <td class="hidden-sm hidden-xs">Link</td>
                                                <td class="hidden-sm hidden-xs">Valor</td>
                                                <td>Qtde</td>
                                                <td class="hidden-sm hidden-xs">Status</td>
                                                <td class="hidden-sm hidden-xs">Criado em</td>
                                                <td>Status</td>
                                                <td>Ação</td>
                                            </tr>
                                            <!-- loop de produtos -->
                                            <?php do{ ?>
                                                <tr>
                                                    <td><?= $row_compras['idcompra']; ?></td>
                                                    <td><?= $row_compras['iduser']; ?></td>                                
                                                    <td>
                                                        <?php 
                                                        $iddouser = $row_compras['iduser'];
                                                        $sql_suite = "SELECT nome, sobrenome FROM users where iduser ='$iddouser'";
                                                        $query_suite = mysqli_query($con, $sql_suite);
                                                        $row_suite = mysqli_fetch_assoc($query_suite);
                                                        echo $row_suite['nome']." ".$row_suite['sobrenome'];
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <?= $row_compras['descricao']; ?>
                                                        <!-- se tiver cor -->
                                                        <?php if($row_compras['cor']!=""){echo "<br>Cor: ".$row_compras['cor'];}?>
                                                        <!-- se tiver tamanho -->
                                                        <?php if($row_compras['tamanho']!=""){echo "<br>Tamanho: ".$row_compras['tamanho'];}?>
                                                    </td>                                
                                                    <td class="hidden-sm hidden-xs"><a href="<?= $row_compras['link']; ?>" class="btn btn-fill btn-sm btn-success" target="_blank">link</a></td>                                
                                                    <td class="hidden-sm hidden-xs"><?= $row_compras['valor']; ?></td>                                
                                                    <td><?= $row_compras['quantidade']; ?></td>                                
                                                    <td class="hidden-sm hidden-xs"><?= $row_compras['status']; ?></td>                                
                                                    <td class="hidden-sm hidden-xs"><?php $data = explode("-", $row_compras['criado']); echo $data[2]."/".$data[1]."/".$data[0]; ?></td>
                                                    <td>
                                                        <form action="functions/altera-status-compra.php" method="post">
                                                            <input type="hidden" name="idcompra" value="<?= $row_compras['idcompra']; ?>">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <select class="form-control border-input" name="status">
                                                                            <option value="">Atualize o status aqui</option>
                                                                            <option value="Em análise">Em análise</option>
                                                                            <option value="Processando">Processando</option>
                                                                            <option value="Finalizado">Finalizado</option>
                                                                        </select>
                                                                        
                                                                        
                                                                        <button class="btn btn-sm btn-fill btn-success">Atualizar</button>
                                                                        
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            
                                                        </form>
                                                    </td>                               
                                                    <td><a href="functions/deleta-compra.php?id=<?= $row_compras['idcompra'];?>" onclick="return confirm('Deseja realmente excluir este item?');"><button type="button" class="btn btn-danger btn-sm btn-fill"><i class="fa fa-close"></i> Excluir</button></a></td>                                
                                                    
                                                </tr>
                                                
                                            <?php } while($row_compras = mysqli_fetch_assoc($query_select_compras)); ?>
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
// script para sortear a tabela
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("produtos");
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

<!-- script  -->
</html>
