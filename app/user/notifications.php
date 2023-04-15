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
      <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
      <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
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
      <!-- toggle -->
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
                    <a class="navbar-brand" href="#">Notificações</a>
                </div>
                <div class="collapse navbar-collapse">
                    <? include 'blocks/menu-flutuante.php'; ?>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <?php if ($row_notificacao['idnotificacao'] != ""){ ?>
                                <div class="table-responsive">
                                    <table class="table border-table" id="notificacoes">
                                        <tr>
                                            <td style="width:5%"># <i class="fa fa-sort" onclick="sortTable(0)"></i></td>
                                            <td>Título <i class="fa fa-sort" onclick="sortTable(1)"></i></td>
                                            <td>Conteúdo <i class="fa fa-sort" onclick="sortTable(2)"></i></td>
                                            <td style="width:10%">Criado em <i class="fa fa-sort" onclick="sortTable(3)"></i></td>
                                            
                                        </tr>
                                        <?php  do{ ?>
                                            <tr>
                                                <td><?= $row_notificacao['idnotificacao']; ?></td>
                                                <td><?= $row_notificacao['titulo']; ?></td>
                                                <td><?= $row_notificacao['conteudo']; ?></td>
                                                <td><?php $data = explode("-",$row_notificacao['criado']); echo $data[2]."/".$data[1]."/".$data[0] ; ?></td>
                                                
                                            </tr>
                                        <?php  } while($row_notificacao = mysqli_fetch_assoc($query_select_notificacao)); ?>
                                    </table>
                                </div>
                            <?php } else {echo "<p>Nenhuma notificação ativa.</p>";} ?>
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
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
<script type="text/javascript">
// script para sortear a tabela
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("notificacoes");
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
</html>
