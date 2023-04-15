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
  <title>SIB | Recuperar Senha</title>
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
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#">Kuotis Dashboard Login</a> -->
            </div>
            <!-- <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                       <a href="register.php">
                            Register
                        </a>
                    </li>
                    <li>
                      <a href="mailto:contact@kuotis.com">
                        User Support
                      </a>
                    </li>
                    <li>
                       <a href="../dashboard/overview.html">
                            Dashboard
                        </a>
                    </li> 
                </ul>
            </div> -->
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="green" data-image="assets/img/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            
                            <div class="formEsqueci">
                              <div class="card card-novo" data-background="color" data-color="blue">
                                <div class="card-header">
                                   <div style="text-align: center; margin:0 auto;">
                                      <!-- logo do cliente -->
                                   </div>
                                    <h3 class="card-title text-center">Recuperar a senha</h3>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
                                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      Escolha a nova senha
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" autofocus class="form-control emailr" disabled value="<?= $_GET['email']; ?>" style="border:1px solid #ccc; background: #fff;">
                                    </div>
                                    <div class="form-group">
                                        <label>Nova senha</label>
                                        <input type="password" name="novaSenha" class="form-control mSenha" style="border:1px solid #ccc; background: #fff;">
                                    </div>
                                    <div class="form-group">
                                        <label>Código de Validação *</label>&nbsp;
                                        <input type="codAcesso" name="codAcesso" class="form-control mcodAcesso" style="border:1px solid #ccc; background: #fff;">
                                        <small>* Enviamos por Email esse Código!</small>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="respRecuperar"></div>
                                    <button class="btn btn-fill btn-wd atualizarSenha">ATUALIZAR SENHA</button><br><br>
                                    <div class="forgot">
                                        <a href="#" class="btnEsqueciVoltar">Voltar</a>
                                    </div>
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
  <script type="text/javascript">
    function fechar(){
      document.getElementById('erro').style.display = "none";
    }

    $(document).ready(function(){
      
      $('.btnEsqueciVoltar').click(function(){
        location.href = 'login.php';
      });

      $('.atualizarSenha').click(function(){

        $('.recuperaSenha').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadRecuperar"><i class="fa fa-spin fa-spinner fa-lg"></i></div>');

        var senha  = $('.mSenha').val();
        var emailr = $('.emailr').val();
        var codAcesso = $('.mcodAcesso').val();
        $.ajax({
          url: 'functions/recuperar-senha.php',
          type: 'POST',
          data: {
            novaSenha: senha,
            novoEmail: emailr,
            codAcesso: codAcesso
          },
        })
        .done(function(xhr) {
          console.log(xhr);
          var obj = $.parseJSON(xhr);
          $('.loadRecuperar').remove();
          if(obj.resp == 's'){
            $('.respRecuperar').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-success">Senha alterada com sucesso!</div>');
            setTimeout(function(){
              location.href = 'login.php';
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
