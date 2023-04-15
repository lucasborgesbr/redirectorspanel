<!doctype html>
<html>
<head>
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
  <link href="../app/user/assets/css/bootstrap.min.css" rel="stylesheet" />
  <!--  Paper Dashboard core CSS    -->
  <link href="../app/user/assets/css/paper-dashboard.css?v=1.2.1" rel="stylesheet"/>
  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="../app/user/assets/css/demo.css" rel="stylesheet" />
  <!--  Fonts and icons     -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
  <link href="../app/user/assets/css/themify-icons.css" rel="stylesheet">
  <style type="text/css">
    .card label{color: #333; background: transparent !important;}
    .card{box-shadow: none; padding: 20px;}
    .card-novo {background: transparent;}
    a, a:visited, .copyright{color: #333 !important;}
    a:hover{text-decoration: underline;}
  </style>
</head>
<body>
  <br>

  <div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="green" data-image="../app/user/assets/img/background/background-2.jpg">

      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="formLogin">
                <form method="post" action="processa-install.php">
                  <div class="card card-novo" data-background="color" data-color="blue">
                    <div style="text-align: center;" class="alert alert-success" id="infoModelo">
                      <span>
                        Parabéns!<br>
                        Seu sistema do Solutionsbox está quase pronto!<br>
                        <br>
                        Preencha as informações desse formulário para que possamos terminar a instalação do seu sistema.
                      </span>
                    </div>
                    <div class="card-header" style="text-align: center;">
                      <h3 class="card-title">Auto Instalação Solutionsbox</h3>
                    </div>
                    <br>
                    <div class="card-content">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Nome da Empresa de Redirecionamento</label>
                          <input type="text" name="nomeEmpresa" autofocus class="form-control" style="border:1px solid #ccc; background: #fff;">
                          <small>Esse nome será usado para identificar sua empresa em Emails e outros locais.</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Nome Completo</label>
                          <input type="text" name="nomeAdmin" autofocus class="form-control" style="border:1px solid #ccc; background: #fff;">
                          <small>Precisamos do Seu nome aqui.</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Email para Login</label>
                          <input type="email" name="emailAdmin" autofocus class="form-control" style="border:1px solid #ccc; background: #fff;">
                          <small>Esse será o email utilizado para acessar a area administrativa.</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Senha</label>
                          <input type="password" name="senhaAdmin" id="password" autofocus class="form-control" style="border:1px solid #ccc; background: #fff;">
                          <small>Senha para acesso do sistema.</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Confirmar Senha</label>
                          <input type="password" name="confirmaSenhaAdmin" id="confirm_password" autofocus class="form-control" style="border:1px solid #ccc; background: #fff;">
                          <small>confirme sua senha.</small>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-center">
                      <button type="submit" class="btn btn-fill btn-wd">Iniciar Configuração</button><br/><br/>
                      <small>Esse procedimento pode demorar um pouco... Não saia feche seu navegador!</small>
                    </div>
                  </div>
                </form>
              </div>
              
            </div>
            <div class="col-lg-2"></div>
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <div class="copyright">
              <? 
              echo 'Auto Install Solutionsbox &copy; <script>document.write(new Date().getFullYear())</script><br>Desenvolvido por <a href="http://www.solutionsbox.com.br">Solutionsbox</a>';
              ?> 
            </div>
          </div>
        </footer>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="../app/user/assets/js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="../app/user/assets/js/jquery.cookie.js"></script>
  <script type="text/javascript">
    var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("As Senhas não são iguais");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
  </script>
  </html>
