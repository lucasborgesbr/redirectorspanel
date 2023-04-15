<?
$cookie_name = '_id_admin';
if(isset($_COOKIE[$cookie_name])){
  header("Location: dashboard.php");
  exit();
}
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
  <title>SIB | Login</title>
  <!-- Canonical SEO -->
  <link rel="canonical" href="http://www.kuotis.com/app/gc"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <!-- Bootstrap core CSS     -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!--  Paper Dashboard core CSS    -->
  <link href="assets/css/paper-dashboard.css?v=1.2.1" rel="stylesheet"/>
  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="assets/css/demo.css" rel="stylesheet" />
  <!--  Fonts and icons     -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
  <link href="assets/css/themify-icons.css" rel="stylesheet">
  <style type="text/css">

   .card label{color: #333; background: transparent !important;}
   .card{box-shadow: none; padding: 20px;}
   .card-novo {background: transparent;}
   a, a:visited, .copyright{color: #333 !important;}
   a:hover{text-decoration: underline;}
 </style>
</head>
<body>
  
  <?php 

  if(isset($_GET['redirect'])){
    $redirect = $_GET['redirect'];
  } else {
    $redirect = "/app/admin/dashboard.php";
  }

  ?>
  <div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="green" data-image="assets/img/background/background-2.jpg">
      <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
              <form method="post" action="functions/processa-login.php">
                <div class="card card-novo" data-background="color" data-color="blue">
                  <? if($_SERVER['SERVER_NAME'] == 'www.modelo.solutionsbox.com.br'){ ?>
                    <div class="alert alert-success" id="infoModelo">
                      <span>Faça o login para testar. <br><br>Login: admin@solutionsbox.com.br<br>Senha: 123456<br><br>Logar como Usuário? <a href="http://modelo.solutionsbox.com.br/app/user">Clique aqui</a></span>
                    </div>
                  <? } ?>
                  <?php if (isset($_GET['e'])): ?>
                    <div class="alert alert-warning" id="erro">
                      <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                      <span>Usuário ou senha não confere, tente novamente.</span>
                    </div>
                  <?php endif ?>
                  <?php if (isset($_GET['t'])): ?>
                    <div class="alert alert-warning" id="erro">
                      <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                      <span>Este email já está registrado.</span>
                    </div>
                  <?php endif ?>
                  <div class="card-header">
                   <div style="text-align: center; margin:0 auto;">
                    <!-- logo do cliente -->
                    <?

                    require "../user/functions/conexao.php";

                    $select_config = "SELECT * FROM Configuracoes";
                    $query_select_config = mysqli_query ($con, $select_config) or die(mysqli_error($con));
                    $row_config = mysqli_fetch_assoc($query_select_config);

                    if($row_config['logo'] != ''){

                      ?>
                      <img src="assets/img/logo/<?=$row_config['logo'];?>" style="border:0px; width: 250px;  height:auto; margin:auto">
                    <? } ?>
                  </div>
                  <h3 class="card-title">Painel Administrativo</h3>
                </div>
                <div class="card-content">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" autofocus value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control" style="border:1px solid #ccc; background: #fff;">
                  </div>
                  <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="password" class="form-control"  style="border:1px solid #ccc; background: #fff;">
                  </div>
                </div>
                <div class="card-footer text-center">
                  <input type="hidden" name="redirect" value="<?=$redirect;?>">
                  <button type="submit" class="btn btn-fill btn-wd">LOGIN</button><br><br>
                  <div class="forgot">
                    <!-- <a href="forgot.php">Esqueceu sua senha?</a> |   -->
                    <!-- <a href="register.php">Crie sua conta gratuita</a> -->
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container-fluid">
        <div class="copyright">
          <? include ("blocks/footer.php"); ?>   
        </div>
      </div>
    </footer>
  </div>
</div>
</body>

<script type="text/javascript">
  function fechar(){
    document.getElementById('erro').style.display = "none";
  }
</script>
</html>
