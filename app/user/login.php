<?

if(isset($_COOKIE['id_user'])){
  header("Location: dashboard.php");
  exit();
}
require ("functions/conf_email.php");
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
  <link rel="canonical" href="https://www.kuotis.com/app/gc"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <!-- Bootstrap core CSS     -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!--  Paper Dashboard core CSS    -->
  <link href="assets/css/paper-dashboard.css?v=1.2.1" rel="stylesheet"/>
  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="assets/css/demo.css" rel="stylesheet" />
  <!--  Fonts and icons     -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
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
  
          <?php if(isset($_GET['a'])){
            echo '<input type="hidden" class="ativa" id="ativa" value="1">';
            echo '<input type="hidden" class="ativaEmail" id="ativaEmail" value="'.$_GET['ea'].'">';
          }?>
          <?php 

          if(isset($_GET['redirect'])){
            $redirect = $_GET['redirect'];
          } else {
            $redirect = "/app/user/dashboard.php";
          }


          ?>
          <div class="wrapper wrapper-full-page">
            <div class="full-page login-page" data-color="green" data-image="assets/img/background/background-2.jpg">
              <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
              <div class="content">
                <div class="container">
                  <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                      <div class="formLogin">
                        <form method="post" action="functions/processa-login.php">
                          <div class="card card-novo" data-background="color" data-color="blue">
                            <? if($_SERVER['SERVER_NAME'] == 'www.modelo.solutionsbox.com.br'){ ?>
                              <div class="alert alert-success" id="infoModelo">
                                <span>Faça o login para testar. <br><br>Login: user@solutionsbox.com.br<br>Senha: 123456<br><br>Logar como Administrador? <a href="http://modelo.solutionsbox.com.br/app/admin">Clique aqui</a></span>
                              </div>
                            <? } ?>
                            <?php if (isset($_GET['w'])): ?>
                              <div class="alert alert-warning" id="erro">
                                <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                                <span>Sua conta foi desativada pelo Administrador. <br>Entre em contato para saber mais.</span>
                              </div>
                            <?php endif ?>
                            <?php if (isset($_GET['e'])): ?>
                              <div class="alert alert-warning" id="erro">
                                <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                                <span>Usuário ou senha não confere, tente novamente.</span>
                              </div>
                            <?php endif ?>
                            <?php if (isset($_GET['s'])): ?>
                              <div class="alert alert-warning" id="erro">
                                <button type="button" aria-hidden="true" class="close" onclick="fechar()">×</button>
                                <span>Usuário Cadastrado com Sucesso.</span>
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

                              require "functions/conexao.php";

                              $select_config = "SELECT * FROM Configuracoes";
                              $query_select_config = mysqli_query ($con, $select_config) or die(mysqli_error($con));
                              $row_config = mysqli_fetch_assoc($query_select_config);

                              if($row_config['logo'] != ''){

                                ?>

                                <img src="../admin/assets/img/logo/<?=$row_config['logo'];?>" style="border:0px; width: 250px;  height:auto; margin:auto">
                              <? } ?>

                            </div>
                            <h3 class="card-title">Login</h3>
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
                            <button type="submit" class="btn btn-fill btn-wd">LOGIN</button><br/><br/>
                            <div class="forgot">
                              <a href="#" class="btnEsqueci">Esqueceu sua senha?</a>
                              &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
                              <a href="register.php">Crie sua conta gratuita</a>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="formEsqueci" style="display: none">
                      <div class="card card-novo" data-background="color" data-color="blue">
                        <div class="card-header">
                         <div style="text-align: center; margin:0 auto;">
                          <!-- logo do cliente -->
                          <img src="../admin/assets/img/logo/<?=$row_config['logo'];?>" style="border:0px; width: 250px;  height:auto; margin:auto">
                        </div>
                        <h3 class="card-title text-center">Esqueci a senha</h3>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
                        <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          Enviaremos um e-mail para você com um código de verificação.
                        </p>
                      </div>
                      <div class="card-content">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" autofocus class="form-control emailr" style="border:1px solid #ccc; background: #fff;">
                        </div>
                      </div>
                      <div class="card-footer text-center">
                        <div class="respRecuperar"></div>
                        <button class="btn btn-fill btn-wd recuperaSenha">RECUPERAR SENHA</button><br/><br/>
                        <div class="forgot">
                          <a href="#" class="btnEsqueciVoltar">Voltar</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="formAtiva" style="display: none">
                    <div class="card card-novo" data-background="color" data-color="blue">
                      <div class="card-header">
                       <div style="text-align: center; margin:0 auto;">
                        <!-- logo do cliente -->
                        <img src="../admin/assets/img/logo/<?=$row_config['logo'];?>" style="border:0px; width: 250px;  height:auto; margin:auto">
                      </div>
                      <br>
                      <div class="alert alert-warning" id="infoSPAM" style="text-align: center; margin:0 auto;">
                        <span>Não esqueça de verificar sua caixa de SPAM/Lixo Eletrônico. <br> Inclua o email <strong><?=$contato;?></strong><br>em sua lista de contatos. </span>
                      </div>
                      <h3 class="card-title text-center">Ativação da Conta</h3>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
                      <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        Informe o código recebido por email.
                      </p>
                    </div>
                    <div class="card-content">
                      <div class="form-group">
                        <label>Código de Ativação</label>
                        <input type="number" name="codAcesso" autofocus class="form-control codAcesso" style="border:1px solid #ccc; background: #fff;">
                      </div>
                    </div>
                    <div class="card-footer text-center">
                      <div class="respAtiva"></div>
                      <button class="btn btn-fill btn-wd btnAtiva">ATIVAR CONTA</button><br/><br/>
                    </div>
                  </div>

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
    <script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
    <script type="text/javascript">
      function fechar(){
        document.getElementById('erro').style.display = "none";
      }

      $(document).ready(function(){
        $.cookie("notifica", 1, {expires:1});

        if($('.ativa').val() == '1'){
          $('.formLogin').hide();
          $('.formEsqueci').hide();
          $('.formAtiva').fadeIn();
        }

        $('.btnEsqueci').click(function(){
          $('.formLogin').hide();
          $('.formAtiva').hide();
          $('.formEsqueci').fadeIn();
        });
        $('.btnEsqueciVoltar').click(function(){
          $('.emailr').val('');
          $('.formAtiva').hide();
          $('.formEsqueci').hide();
          $('.formLogin').fadeIn();
        });
        $('.btnAtiva').click(function(){
          var email = $('.ativaEmail').val();
          var codAcesso = $('.codAcesso').val();

          console.log(codAcesso);

          $('.btnAtiva').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadAtivar"><i class="fa fa-spin fa-spinner fa-lg"></i></div>');

          $.ajax({
            url: 'functions/ativa-conta.php',
            type: 'POST',
            data: {codAcesso: codAcesso,
             email: email
           },
         }).done(function(xhr) {
          console.log(xhr);
          var obj = $.parseJSON(xhr);
          $('.loadAtivar').remove();
          if(obj.resp == 's'){
            $('.respAtiva').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-success">Sua conta foi ativada com Sucesso. Aproveite!</div>');
            setTimeout(function(){
              location.href = 'login.php';
            }, 1000);
          }else{
            $('.respAtiva').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger">Houve um Erro ao Ativar sua conta!</div>');
            setTimeout(function(){
              $('.btnAtiva').fadeIn();
              $('.respAtiva').html('');
            }, 1000);
          }
        }).fail(function() {
          $('.loadRecuperar').remove();
          $('.respAtiva').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger">Houve um Erro ao Ativar sua conta!</div>');
          setTimeout(function(){
            $('.btnAtiva').fadeIn();
            $('.respAtiva').html('');
          }, 1000);
        });
      });

        $('.recuperaSenha').click(function(){

          $('.recuperaSenha').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadRecuperar"><i class="fa fa-spin fa-spinner fa-lg"></i></div>');

          var email = $('.emailr').val();
          $.ajax({
            url: 'functions/recuperar-senha.php',
            type: 'POST',
            data: {
              recuperarSenha: email
            },
          })
          .done(function(xhr) {
            console.log(xhr);
            var obj = $.parseJSON(xhr);
            $('.loadRecuperar').remove();
            if(obj.resp == 's'){
              $('.respRecuperar').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-success">Enviamos um e-mail para você!</div>');

              setTimeout(function(){
                location.href = 'recuperar.php?email='+email;
              }, 3000);
            }else{
              $('.respRecuperar').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger">Erro ao recuperar senha!</div>');
              setTimeout(function(){
                $('.recuperaSenha').fadeIn();
                $('.respRecuperar').html('');
              }, 3000);
            }
          })
          .fail(function() {
            $('.loadRecuperar').remove();
            $('.respRecuperar').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger">Erro ao recuperar senha!</div>');
            setTimeout(function(){
              $('.recuperaSenha').fadeIn();
              $('.respRecuperar').html('');
            }, 3000);
          });

        });
      });
    </script>
    </html>
