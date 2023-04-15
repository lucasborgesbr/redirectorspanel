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
    <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
                        <? include 'blocks/menu-flutuante.php'; ?>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- jumbrotron chamando a atenção para as notificações. -->
                        <div class="jumbotron" id="jumbo" style="display:none; margin-left: 10px; margin-right: 10px;">
                            <a href="#" onclick="hidejumbotron()" class="pull-right">
                              <i class="fa fa-close fa-2x"></i>
                          </a>
                          <h2 class="display-4">Olá, <?= ucwords($row_user['nome']); ?>!</h1>
                              <p class="lead">Mantenha-se sempre atualizado sobre as novidades e notificações do nosso serviço, acessando o seu painel de notificações.</p>
                              <hr class="my-4">
                              <p>Sempre que precisarmos avisar você sobre alguma novidade, modificação de endereço ou detalhes sobre uma promoção, enviaremos uma notificação pelo seu painel, para ver essas informações basta clicar no link abaixo.</p>
                              <p class="lead">
                                <a class="btn btn-primary btn-lg" href="notifications.php" role="button">Ver Notificações</a>
                            </p>
                        </div>
                        <!-- coluna da esquerda -->
                        <div class="col-lg-5">

                            <div class="card card-user">
                                <div class="image">
                                    <img src="assets/img/background/background.png" alt="..."/>
                                </div>
                                <div class="content">
                                    <div class="author">

                                      <img class="avatar border-white" src="assets/img/avatar/<?php if($row_user['avatar']!=""){echo $row_user['avatar'];}else{echo "user.png";}?>" alt="..."/>
                                      <h4 class="title"><?= ucwords($row_user['nome']." ".$row_user['sobrenome']); ?><br />
                                       <a href="#"><small><?= $row_user['telefone']."<br>".$row_user['email']; ?></small></a><br>
                                       <small>Membro desde: <?=substr($row_user['criado'], 0, 10)?></small></h4>

                                   </div>

                               </div>
                               <hr>
                               <div class="text-center">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><?= $total_caixas; ?><br /><small><?php if($total_caixas <= 1){echo "Caixa";}else{echo "Caixas";} ?></small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= $total_produtos; ?><br /><small><?php if($total_produtos <= 1){echo "Produto";}else{echo "Produtos";} ?></small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><?= $total_envios; ?><br /><small><?php if($total_envios <= 1){echo "Envio";}else{echo "Envios";} ?></small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="text-align: center;">Este é o seu endereço aqui nos Estados Unidos <img src="assets/img/usaflag.png" height="25"></h4>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table">

                                        <?php

                                        $getEndereco = $con->query("SELECT * FROM Configuracoes ");
                                        $row = $getEndereco->fetch_array();

                                        $tip = explode('∞', $row['Endereco']);
                                        ?>

                                        <tbody>
                                            <tr>
                                                <td><b>Nome Completo:</b></td>
                                                <td><?= ucwords($row_user['nome']." ".$row_user['sobrenome']); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address 1:</b></td>  
                                                <td><?= $tip[0]; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address 2:</b></td>
                                                <td>#suite <?= $row_user['iduser'] ?> </td>
                                            </tr>
                                            <tr>
                                                <td><b>City:</b></td>
                                                <td><?= $tip[1]; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>State:</b></td>
                                                <td><?= $tip[2]; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Zipcode:</b></td>
                                                <td><?= $tip[3]; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Country:</b></td>
                                                <td><?= $tip[4]; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- coluna da direita -->
                    <div class="col-lg-7">
                        <div class="card">
            <!--<div class="header">
                <h4 class="title">Vídeos</h4>
            </div>-->
            <div class="content">
                <div class="embed-responsive embed-responsive-16by9">

                    <?php

                    if(isset($_GET['video'])){
                        $firstvideo = mysqli_real_escape_string($con, $_GET['video']);
                        $GetVideos = $con->query("SELECT * FROM Videos WHERE CodVideo = '".$firstvideo."' ");
                        $row = $GetVideos->fetch_array();
                        ?>
                        <iframe width="560" height="315" src="<?= $row['Url']; ?>" frameborder="0" allowfullscreen></iframe>
                        
                        <?php
                    }else{
                        $GetVideos = $con->query("SELECT * FROM Videos ORDER BY CodVideo DESC");
                        if(mysqli_num_rows($GetVideos)){
                            $row = $GetVideos->fetch_array();
                            ?>
                            <iframe class="embed-responsive-item" src="<?= $row['Url']; ?>" allowfullscreen></iframe>
                            <?php
                        }else{
                            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger text-center">Nenhum vídeo cadastrado.</div>';
                        }    
                    }
                    
                    
                    ?>



                </div>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4 class="title">Vídeos</h4>
            </div>
            <div class="content">
                <div class="list-group">
                    <?php

                    $GetVideos = $con->query("SELECT * FROM Videos ORDER BY CodVideo DESC");
                    while($row = $GetVideos->fetch_array()){
                        echo '<a href="?video='.$row['CodVideo'].'" class="list-group-item list-group-item-action">'.$row['TituloVideo'].'</a>';
                    }

                    ?>
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
<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
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
        function hidejumbotron(){
            document.getElementById('jumbo').style.display = "none";
            $.cookie("notifica", 0);

        }

        function showjumbotron(){
            document.getElementById('jumbo').style.display = "inline-block";

        }

        $(document).ready(function(){

            var notifica = $.cookie("notifica");
            console.log(notifica);
            if(notifica == 1){
                showjumbotron();
            }
        });

    </script>
    </html>
