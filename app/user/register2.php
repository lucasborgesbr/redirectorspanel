<? 
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
  <title>Storesinbox | Criar Conta</title>
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
  <br>
<div class="wrapper wrapper-full-page">
  <div class="full-page login-page" data-color="" data-image="assets/img/background/background-2.jpg">
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
    <div class="content">
      <div class="container">
        <div class="row"> 
          <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="alert alert-warning" id="infoSPAM" style="text-align: center; margin:0 auto;">
              <span>Não esqueça de verificar sua caixa de SPAM/Lixo Eletrônico. <br> Inclua o email <strong><?=$contato;?></strong><br>em sua lista de contatos. </span>
            </div>
            <form method="post" action="functions/processa-registro.php">
              <div class="card card-novo" data-background="color" data-color="blue">
                <div class="card-header">
                  <div style="text-align: center; margin:0 auto;">
                    <!-- logo do cliente -->
                  </div><h3 class="card-title">Criar Uma Conta</h3>
                </div>
                <div class="card-content">
                  <div class="form-group">
                    <label>Nome</label>
                    <input type="text" autofocus name="nome" class="form-control" required style="border:1px solid #ccc; background: #fff;">
                  </div>
                  <div class="form-group">
                    <label>Sobrenome</label>
                    <input type="text" name="sobrenome" class="form-control" required style="border:1px solid #ccc; background: #fff;">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required style="border:1px solid #ccc; background: #fff;">
                  </div>
                  <div class="form-group">
                    <label>Telefone</label>
                    <input type="phone" name="telefone" class="form-control MaskTelefone" required style="border:1px solid #ccc; background: #fff;">
                    <small>Formato: (99) 99999-9999</small>
                  </div>
                  <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" required  style="border:1px solid #ccc; background: #fff;">
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-fill btn-wd ">CRIAR</button><br><br>
                  <div class="forgot">
                    <a href="login.php">Já possui uma conta?</a>
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
<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<script src="assets/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<script type="text/javascript">

  $("input.MaskTelefone")
  .focusout(function (event) {  
    var target, phone, element;  
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
    phone = target.value.replace(/\D/g, '');
    element = $(target);  
    element.unmask();
    
    if(phone.length > 0 && phone.length <= 9){
      element.mask("99999-9999");
    } else if(phone.length > 9 && phone.length <= 11){
      element.mask("(99) 99999-9999");
    } else if(phone.length == 12){
      element.mask("+9 (99) 99999-9999");
    } else if(phone.length > 12){
      element.mask("+99 (99) 99999-9999");
    } else if(phone.length <= 0){
        
        element.unmask();
        $('.MaskTelefone').val("");
    }
  });

</script>

</html>
