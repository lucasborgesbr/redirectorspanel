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
    <link rel="apple-touch-icon" sizes="76x76" href="https://www.storesinbox.com/img/fav.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.storesinbox.com/img/fav.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SIB | Produtos</title>
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
    <!--link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"-->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <!-- jquery min-->
    <!--script src="http://code.jquery.com/jquery-3.3.1.js"></script-->

    <link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css?v=2.1.5">
    <link rel="stylesheet" type="text/css" href="assets/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />

    <script type="text/javascript" src="functions/functions.js"></script>
  </head>
  <body onload="calculapesototal();">
    <input type="hidden" class="saldo_wallet" value="<?=$_SESSION['saldo_wallet'];?>">
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
         <a class="navbar-brand" href="#">Produtos Cadastrados</a>
       </div>
       <div class="collapse navbar-collapse">
        <? include 'blocks/menu-flutuante.php'; ?>
      </div>
    </div>
  </nav>
  <div class="content">
   <!-- card lista de produtos da caixa -->
   <?php //if ($row_produtos['idproduto'] != ""){ ?>
    <!-- form criar envio -->
    <form method="post" action="functions/acrescenta-envio.php">
     <div class="row">
      <div class="col-lg-12">
       <div class="card">


        <div class="header">
         <h4 class="title">Para criar um envio basta manter os produtos e quantidades desejadas.</h4>   
       </div>
       <div class="content">
        <div class="table-responsive">
         <table class="table table-bordered text-center">
          <tr>
           <td>#</td>
           <td>Imagens</td>
           <td>Descricao</td>
           <td>Qtde. em Estoque</td>

           <td>Qtde. a Enviar</td>
           <td>Peso Unit.</td>
           <td>Criado em</td>
           <td>Ação</td>
         </tr>
         <!-- loop de produtos -->
         <?php 
         $contp = 1;
         do{ if($row_produtos['quantidade'] > 0){?>
           <tr>
            <td class="idProdutoCadastrado<?= $contp; ?>">
             <?= $row_produtos['idproduto']; ?></td>
             <td>
              <a href="assets/img/produtos/<?= $row_produtos['imagem1']; ?>" data-fancybox-group="produtos" class="fancybox">
                <img src="assets/img/produtos/<?= $row_produtos['imagem1']; ?>" style="border:1px solid #ccc; padding:1px; border-radius:5px; height:80px">
              </a>
              <?php if ($row_produtos['imagem2'] !=""){ ?>
                <a href="assets/img/produtos/<?= $row_produtos['imagem2']; ?>" data-fancybox-group="produtos" class="fancybox">
                  <img src="assets/img/produtos/<?= $row_produtos['imagem2']; ?>" style="border:1px solid #ccc; padding:1px; border-radius:5px; height:80px">
                </a>
              <?php } ?>
            </td>
            <td class="descricaoProduto<?= $contp; ?>"><?= $row_produtos['descricao']; ?></td>
            <td class="quantidade<?= $contp; ?>"><?= $row_produtos['quantidade']; ?></td>

            <td>
              <!-- ********* -->
              <select id="qtde<?=$contp?>" data-row="<?= $contp; ?>" class="form-control border-input quantidadeProdutosFirst quantidadeProdutosFirst<?= $contp; ?>" name="quantidade[<?= $row_produtos['idproduto'];?>]" onchange=" calculapesototal(); disablefirstclass(); servicosExtras();">
               <?php
               for ($i=$row_produtos['quantidade']; $i >= 1; $i--) { 
                echo '<option value="'.$i.'"';

                echo '>'.$i.'</option>';
              }
              ?>
            </select>
          </td>
          <td>
            <input type="text" name="peso[]" value="<?= $row_produtos['peso']; ?>" class="form-control pesosProdutosCadastrados pesoProdutoUnitario<?= $contp; ?>" style="border:0; background: transparent; width: 50px; padding: 0; text-align: center;" readonly>
          </td>
          <td>
            <?php $data = explode("-", $row_produtos['criado']); echo $data[2]."/".$data[1]."/".$data[0]; ?>
            <?php
            $dataCriacaoProduto = new DateTime($row_produtos['criado']);
            $hoje = new DateTime(date('Y-m-d'));

            $dateInterval = $hoje->diff($dataCriacaoProduto);
            ?>
          </td>
          <td>
            <a href="#" onclick="removerLinha(this); servicosExtras(); verificaPesoEnvio();" target="_self" class="btn btn-danger btn-fill btn-sm"><i class="fa fa-close"></i> Não Enviar</a>
          </td>
        </tr>


        <?php 
        $contp++;

      }} while($row_produtos = mysqli_fetch_assoc($query_select_produtos));?>
      <!-- fim loop de produtos -->

    </table>
  </div>
  <table>
    <tr>
     <td>Peso Total:  
      <input type="text" style="border: 0; width:40px" value="" id="pesototal" name="pesototal">
      (em libras)
      <a href="#" data-toggle="tooltip" title="O peso calculado aqui é apenas a soma dos produtos, não estão calculados os pesos de caixa, plástico bolha, etc... "><i class="fa fa-question-circle"></i></a>
      Peso máximo por envio 26,5kg ou aprox. 60lb 
    </td>
  </tr>


</table>
</div>
</div>
</div>
</div>




<div class="row">
  <!-- card para escolha do endereco -->
  <div class="col-lg-4">
   <div class="card">
    <div class="header">
     <h4 class="title">Endereço de Entrega</h4>
   </div>

   <div class="content">
    <? $countEnder = 0; ?>
    <?php if ($row_endereco['idendereco'] != "") { ?>
      <select name="endereco" class="form-control border-input informaEndereco" onchange="disablefirstclass();">
       <option value="">Escolha o endereço de entrega</option>    
       <?php do { 

        $ender = '';
        $ender .= $row_endereco['rua'].", ".$row_endereco['numero'];
        if($row_endereco['complemento'] != ''){
          $ender .= ", ".$row_endereco['complemento'];
        }
        $ender .= ", ".$row_endereco['bairro'].", ".$row_endereco['cidade']."/".$row_endereco['estado']." ".$row_endereco['pais']." ".$row_endereco['cep'];

        ?>
        <option class="<?=$row_endereco['pais'];?>" cep="<?=$row_endereco['cep'];?>" value="<?=$ender;?>">
          <?=$ender;?>
        </option>
        <?php 
        $countEnder++;
      } while($row_endereco = mysqli_fetch_assoc($query_select_endereco));?>
    </select>
  <?php } else {echo "Nenhum endereço cadastrado. <a href='user.php'>Clique aqui</a> para cadastrar.";} ?>
</div>

</div>
</div>


<!-- card para escolha da forma de envio -->
<div class="col-lg-4">
 <div class="card">
  <div class="header">
   <h4 class="title">Opção de Envio</h4>
 </div>
 <div class="content">
   <select name="opcaoenvio" id="opcaoenvio" class="form-control border-input">
    <option value="">Escolha a opção de envio</option>

    <? if($_SESSION['ePacket-ativo'] == '1'){ ?>
      <option value="ePacket" id="ePacket">ePacket</option>
    <? } ?>
    <option value="First_Class" id="firstclass">First Class</option>
    <option value="Priority">Priority Mail</option>
    <option value="Express">Priority Mail Express</option>
    <? if($_SESSION['PgtLocal-ativo'] == '1'){ ?>
      <option value="Pronta Entrega">Pronta Entrega</option>
    <? } ?>
  </select>
</div>
</div>
</div>


<!-- card para escolha da forma de pagamento -->
<div class="col-lg-4">
 <div class="card">
  <div class="header">
   <h4 class="title">Opção de Pagamento</h4>
 </div>
 <div class="content">
   <select name="opcaopgto" id="opcaopgto" class="form-control border-input">
    <option value="">Escolha a opção de pagamento</option>
    <? 
    do{
      if($row_fp['idFormaPagamento'] != ''){
        ?>
        <option value="<?=$row_fp['TipoPagamento']?>" <?if($row_fp['TipoPagamento'] == 'Pagamento no Local'){echo "id='pgtLocal' disabled='disabled'";}?> >
          <?=$row_fp['TipoPagamento'];?> - <?=$row_fp['taxa'];?>%
        </option>
        <?
      }
    }while($row_fp = mysqli_fetch_assoc($query_select_fp));
    ?>
    <option value="Wallet" id="Wallet">Wallet</option>
  </select>
</div>
</div>
</div>   

</div>

<div class="row">
  <div class="col-lg-6">
   <div class="card">
    <div class="header">
     <h4 class="title">Declaração Alfandegária</h4>
   </div>
   <div class="content">
    <div class="checkbox">
      <input type="checkbox" name="actDeclaracao" id="actDeclaracao" value="1"> 
      Não quero preencher a declaração alfandegária. *<br>
    </div>
    <br>  
    <div class="table-responsive">
     <table class="table table-bordered tabelaDeclaracao">
      <tr>
       <td>Item</td>
       <td>Quantidade</td>
       <td>Valor</td>
       <td>Subtotal</td>
     </tr>
     <?php $da=1; do{ ?>
       <tr>
        <td><input type="text" name="item[]" class="form-control border-input itemDec"></td>
        <td><input type="number" min="1" name="numeroitens[]" class="form-control border-input" onkeyup="valordeclarado()" onchange="valordeclarado()" onblur="valordeclarado()"></td>
        <td><input type="number" step="any" min="0" name="valor[]" class="form-control border-input" onkeyup="valordeclarado()" onchange="valordeclarado()" onblur="valordeclarado()"></td>
        <td><input type="text" name="subtotal[]" readonly style="background: transparent;" class="form-control border-input"></td>
      </tr>
      <?php $da++; }while($da <=10); ?>
      <tr>
        <td colspan="4" class="text-right">Valor Declarado Total: <input type="text" name="valortotaldeclarado" id="valortotaldeclarado" value="" class="form-control border-input text-right" readonly></td>

      </tr>
    </table>
    <div class="spaceDeclracao">

      * A Declaração Alfandegária está diretamente ligada com o a tributação alfandegária, e é obrigatória.
      <br>Iremos preencher ela pra você. Porém A <?=$_SESSION['empresa'];?> não se responsabiliza por possíveis tributações na Receita Federal.
      
      <br><br><br>
    </div>
  </div>



</div>

</div>
</div>
<div class="col-lg-6">
  <div class="card col-lg-12">
    <div class="header">
      <h4 class="title">Serviços Extras</h4>
    </div>
    <div class="content">

      <!-- servicos pagos -->
      <?
      do{
        if($row_servico_extra['idServicosExtras'] != ''){
          ?>

          <div class="checkbox">
            <input type="checkbox" name="<?=$row_servico_extra['idServicosExtras'];?>" id="<?=$row_servico_extra['idServicosExtras'];?>" class="<?=$row_servico_extra['idServicosExtras'];?>" value="<?=$row_servico_extra['descServico'];?> (USD $<?=$row_servico_extra['vlrServico'];?>)"> 
            <?=$row_servico_extra['descServico'];?> (USD $<?=$row_servico_extra['vlrServico'];?>)
          </div>

          <?
        }
      } while($row_servico_extra = mysqli_fetch_assoc($query_servico_extra));
      ?>
      <br>
    </div>
  </div>
</div>

<div class="col-lg-6 divUsarWallet">
  <div class="card col-lg-12">
    <div class="header">
      <h4 class="title">Utilizar Saldo da Carteira?</h4>
    </div>
    <div class="content">

      <div class="checkbox">
        <input type="checkbox" name="usarWallet" id="usarWallet" class="usarWallet" value="1"> 
        Usar Saldo da Carteira? <br> Saldo disponível: ($ <?=number_format($_SESSION['saldo_wallet'], 2, ".", ",");?>)
      </div>
      <small>Caso queira utilizar o valor da carteira, ele será utilizado como desconto.</small>
    </div>
  </div>
</div>

<div class="col-lg-6" style="float: right;">
 <!-- card do total -->
 <div class="card col-lg-12">
  <div class="header">
   <h4 class="title">Valor Final</h4>
 </div>
 <div class="content">
  <div class="table-responsive">
   <table class="table table-bordered">
    <tr>
      <td>Valor do Frete: </td>
      <td><input type="text" name="valorfrete" id="valorfrete" class="form-control" readonly="" value="0" style="text-align: right; background: transparent;"></td>
    </tr>
    <tr>
     <td>Valor do Serviço:</td>
     <td><input type="text" name="valorservico" id="valorservico" class="form-control" readonly="" value="0" style="text-align: right; background:transparent;"></td>
   </tr>
   <tr>
     <td>Serviços Extras:</td>
     <td><input type="text" name="servicosextras" id="servicosextras" class="form-control" readonly="" value="0" style="text-align: right; background: transparent;"></td>
   </tr>
   <tr>
     <td>Taxa extra de armazenamento:</td>
     <td><input type="text" name="armazenamento" id="armazenamento" class="form-control" readonly="" value="0" style="text-align: right; background: transparent;"></td>
   </tr>
   <tr>
     <td>Taxa do cartão:<br><small>sobre o valor final</small></td>
     <td><input type="text" name="taxacartao" id="taxacartao" class="form-control" readonly="" value="0" style="text-align: right; background: transparent;"></td>
   </tr>
   <tr>
    <td>Descontos:</td>
    <td><input type="text" id="vlrDescontos" name="vlrDescontos" class="form-control" readonly="" value="0" style="text-align: right; background: transparent;"></td>
  </tr>
  <tr>
   <td>VALOR FINAL:</td>
   <td><input type="text" id="valorfinal" name="valorfinal" class="form-control" readonly="" value="0" style="font-weight: bold; text-align: right"></td>
 </tr>
 <tr class="cpf">
  <td><a href="#" data-toggle="tooltip" title="Conforme resolução da Receita Federal, apartir de 1º de Janeiro de 2020, todas as encomendas internacionais devem conter o CPF do destinatário"><i class="fa fa-question-circle"></i></a> CPF:</td>
  <td>
    <input type="text" id="cpf" name="cpf" value="<?=$row_user['cpf'];?>" class="form-control border-input MaskCPF" required>
  </td>
</tr>
</table>
</div>
<? if($contp-1 > 0){ ?>
  <? if ($countEnder > 0){ ?>
    <div class="text-center btnEnviar">
      <button type="submit" id="botaoenvio" class="btn btn-fill btn-success btn-wd">CRIAR ENVIO</button>
    </div>
  <? } ?>
<? } else { ?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger text-center semProdutos">Não Existem produtos para enviar agora.</div>
<? } ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger text-center errEnvio">Ops.. Sua caixa não pode ultrapassar 60lb..<br>Retire alguns itens da caixa ou faça mais de um Envio</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger text-center errWallet">Seu saldo é menor que o Valor a ser Pago, escolha outra forma de Pagamento!</div>
</div>
</div>

</div>

</div>

</form>

<?php //} else {  ?>

  <?php //} ?>

</div>
<div style="clear: both;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
<footer style="clear: both;" class="footer">
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
<input type="hidden" class="qtdProdutos" value="<?= $contp-1;?>">
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<!-- <script src="assets/js/bootstrap-checkbox-radio.js"></script> -->
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<script src="assets/fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script>
<script type="text/javascript" src="assets/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  $("input.MaskCPF")
  .focusout(function (event) {  
    var target, cpf, element;  
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
    cpf = target.value.replace(/\D/g, '');
    console.log(cpf);
    element = $(target);  
    element.unmask();  
    if(cpf.length >= 11) {  
      element.mask("999.999.999-99");  
    }  
  });

  function frete(valor){
    var custo = parseFloat(valor);
    $('#valorfrete').val(custo);
  }

  function xmlToJson(xml) {

    var obj = {};

    if (xml.nodeType == 1) { 
      if (xml.attributes.length > 0) {
       obj["@attributes"] = {};
       for (var j = 0; j < xml.attributes.length; j++) {
        var attribute = xml.attributes.item(j);
        obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
      }
    }
  } else if (xml.nodeType == 3) { 
   obj = xml.nodeValue;
 }

 
 if (xml.hasChildNodes()) { 
   for(var i = 0; i < xml.childNodes.length; i++) {
    var item = xml.childNodes.item(i);
    var nodeName = item.nodeName;
    if (typeof(obj[nodeName]) == "undefined") {
     obj[nodeName] = xmlToJson(item);
   } else {
     if (typeof(obj[nodeName].push) == "undefined") {
      var old = obj[nodeName];
      obj[nodeName] = [];
      obj[nodeName].push(old);
    }
    obj[nodeName].push(xmlToJson(item));
  }
}
}
return obj;
};

function priceToShip(peso, valorMercadoria, tipo){

  paisTeste = $('select[name="endereco"] :selected').attr('class');
  cepDestino = $('select[name="endereco"] :selected').attr('cep');
  cepOrigem = '<?=$_SESSION['ZIPCODE'];?>'
  console.log(cepOrigem);
  var tipoEnvios = $('#opcaoenvio').val();

  if(tipoEnvios != 'Pronta Entrega'){

   $('.cpf').show();
   $('#cpf').show();
   document.getElementById('cpf').required = true;

   var pgtLocalCampo = document.getElementById('pgtLocal');
   
   if(pgtLocalCampo != null){
    document.getElementById('pgtLocal').disabled = true;
    if(document.getElementById('opcaopgto').value == 'Pagamento no Local'){
      document.getElementById('opcaopgto').value = "";
    }
  }

  

  var pounds = peso;
  var ounces = 0;
  var userid = "433STORE2182"; 
  var url = "https://secure.shippingapis.com/ShippingAPI.dll";

  if(paisTeste != 'USA'){

   <? if($_SESSION['fretePersonalizado-ativo'] == '1'){ ?>

    var data =
    {

      "peso" : pounds,
      "tipoEnvios" : tipoEnvios

    }

    $.post("functions/verifica-frete-personalizado.php", data)
    .done(function(xyz) {

     var resultado = xyz;
     var rate = resultado[0].vlrpeso;

     frete(rate);

   });

  <? } else { ?>


    var data =
    {
     "API" : "IntlRateV2",
     "XML" : "<IntlRateV2Request USERID=\"" + userid + "\"> \
     <Revision/> \
     <Package ID=\"1ST\"> \
     <Pounds>" + pounds + "</Pounds> \
     <Ounces>" + ounces + "</Ounces> \
     <MailType>Package</MailType> \
     <ValueOfContents>"+ valorMercadoria +"</ValueOfContents> \
     <Country>"+paisTeste+"</Country> \
     <Container>RECTANGULAR</Container> \
     <Size>REGULAR</Size> \
     <Width></Width> \
     <Length></Length> \
     <Height></Height> \
     <Girth></Girth> \
     </Package> \
     </IntlRateV2Request>"
   };

   $.post(url, data)
   .done(function(xyz) {
    console.log(xyz);
    var tipo = $('#opcaoenvio').val();
    var resultado = xmlToJson(xyz);
    if(tipo == 'First_Class'){
     var rate = resultado.IntlRateV2Response.Package.Service[8].Postage["#text"];
     frete(rate);
   }else if(tipo == 'Priority'){
     var rate = resultado.IntlRateV2Response.Package.Service[2].Postage["#text"];
     frete(rate);
   }else if(tipo == 'Express'){
     var rate = resultado.IntlRateV2Response.Package.Service[1].Postage["#text"];
     frete(rate);
   } else {
    var data =
    {
      "peso" : pounds,
      "tipoEnvios" : tipo
    }
    if(tipo != ''){

      $.post("functions/verifica-frete-personalizado.php", data)
      .done(function(xyz) {

        var resultado = xyz;
        rate = resultado[0].vlrpeso;
        
        frete(rate);

      });
    }
  }
  
});

 <? } ?>

} else {

  var tipo = $('#opcaoenvio').val();
  if(tipo == 'First_Class'){
    var tipoServico = 'First Class';
  }else if(tipo == 'Priority'){
    var tipoServico = 'Priority';
  }else if(tipo == 'Express'){
    var tipoServico = 'Priority Mail Express';
  } else if(tipo == 'Pronta Entrega'){
    var tipoServico = 'Pronta Entrega';
  }

  console.log(tipoServico);

  var data =
  {
   "API" : "RateV4",
   "XML" : "<RateV4Request USERID=\"" + userid + "\"> \
   <Revision/> \
   <Package ID=\"1ST\"> \
   <Service>"+ tipoServico +"</Service>\
   <FirstClassMailType>PACKAGE SERVICE</FirstClassMailType>\
   <ZipOrigination>"+ cepOrigem +"</ZipOrigination> \
   <ZipDestination>"+ cepDestino +"</ZipDestination> \
   <Pounds>" + pounds + "</Pounds> \
   <Ounces>" + ounces + "</Ounces> \
   <Container>VARIABLE</Container> \
   <Width></Width> \
   <Length></Length> \
   <Height></Height> \
   <Girth></Girth> \
   </Package> \
   </RateV4Request>"
 };

 $.post(url, data)
 .done(function(xyz) {
  var tipo = $('#opcaoenvio').val();
  var resultado = xmlToJson(xyz);
  console.log(resultado);
  var rate = resultado.RateV4Response.Package.Postage.Rate["#text"];

  frete(rate);
});

}
} else {

  $('.cpf').hide();
  $('#cpf').hide();
  document.getElementById('cpf').required = false;

  document.getElementById('pgtLocal').disabled = false;
  document.getElementById('opcaopgto').value = "Pagamento no Local";

  var rate = 0.00;
  frete(rate);
}


}

function totalItens(){
 var tp = document.querySelectorAll('option:checked');
 var x = tp.length-3;
 var qtde = 0;
 for(i=0;i<x;i++){
  qtde += parseInt(tp[i].value);
}
return qtde;
}

$(document).ready(function(){

  $(".fancybox").fancybox({
    closeBtn  : false,
    helpers : {

      buttons : {}
    },
  });

  disablefirstclass();

  $('.errEnvio').hide();
  $('.btnEnviar').hide();
  $('.errWallet').hide();
  $('.cpfPagador').hide();
  $('.divUsarWallet').hide();

  $('.declarapeso').change(function(event) {
    var pesoTotal = 0;
    $('.declarapeso').each(function(index, el) {
      var peso = $(this).val();
      if(peso == ''){
        peso = 0;
      }

      pesoTotal = pesoTotal + parseFloat(peso);
    });

    $('#pesototalFirst').val(pesoTotal.toFixed(2));
  });
  
  function servicosExtras(){

    var valorse = 0;
    var t = totalItens();
    var peso = $('#pesototal').val();
    var qtdEmbalagem = $('#qtdEmbalagem').val();
    var servicosextras = document.getElementById('servicosextras');

    <?
    $query_servico_extra = mysqli_query ($con, $select_servico_extra) or die(mysqli_error($con));
    do{
      if($row_servico_extra['idServicosExtras'] != ''){
        ?>
        var se<?=$row_servico_extra['idServicosExtras'];?> = document.getElementById('<?=$row_servico_extra['idServicosExtras'];?>').checked;

        if(se<?=$row_servico_extra['idServicosExtras'];?>){valorse += <?=$row_servico_extra['vlrServico'];?>;}
        <?
      }
    } while($row_servico_extra = mysqli_fetch_assoc($query_servico_extra));
    ?>

    servicosextras.value = parseFloat(valorse).toFixed(2);

  }

  $('.checkbox').click(function(){
    servicosExtras();
  });

  $('.informarValorListaPrincipal').change(function(event) {
    var id    = $(this).attr('id');
    var valor = $(this).val();
    var qtd   = $('.quantidadeListaPrincipal'+id).val();


    if(qtd == 0 || qtd == undefined || qtd == null || qtd == 'undefined' || qtd == 'null'){
     qtd = 0;
   }


   valor = parseFloat(valor) * parseFloat(qtd);

   $('.subValorListaPrincipal'+id).val(valor);

   atualizaValorTotal();
 });


  $('.informaQuantidadeListaPrincipal').change(function(event) {
    var id    = $(this).attr('id');
    var valor = $(this).val();
    var qtd   = $('.informarValorListaPrincipal'+id).val();



    if(qtd == 0 || qtd == undefined || qtd == null || qtd == 'undefined' || qtd == 'null'){
      qtd = 0;
    }

    valor = parseFloat(valor) * parseFloat(qtd);
    if(valor == null || valor == undefined || valor == ''){
      valor = 0;
    }

    $('.subValorListaPrincipal'+id).val(valor);

    atualizaValorTotal();
  });

  function atualizadorUSPS(){
   setTimeout(function(){
    atualizaUSPS()
    atualizadorUSPS();
    verificaPesoEnvio();
    valorservico();


    var end = $('.informaEndereco').val();
    var op  = $('#opcaopgto').val();
    var tipoFrete = $('#opcaoenvio').val();

    if(end == '' || op == '' || end == undefined || op == undefined || tipoFrete == '' || tipoFrete == undefined){
     $('.btnEnviar').hide();
   }



 }, 2000)
 }
 atualizadorUSPS();

 function verificaPesoEnvio(){
   var itensDlec = document.getElementsByName("item[]");
   var peso = $('#pesototal').val();

   if(peso == 'null' || peso == '' || peso == 'undefined' || peso == undefined || peso == 0){
    $('.btnEnviar').hide();
    $('.errEnvio').hide();
    $('#botaoenvio').attr("disabled", true); 
  }

  if(peso > 60){
    $('.btnEnviar').hide();
    $('.errEnvio').show();
  }
  if(peso <= 60){
    $('.btnEnviar').show();
    $('.errEnvio').hide();
  }

  var actDeclaracao = document.getElementById('actDeclaracao').checked;

  if(actDeclaracao == true){
    $('.tabelaDeclaracao').hide();
    $('.spaceDeclracao').show();
    $('#botaoenvio').attr("disabled", false);
  } else {
    $('.tabelaDeclaracao').show();
    $('.spaceDeclracao').hide();

    if(itensDlec[0].value == 'null' || itensDlec[0].value == '' || itensDlec[0].value == 'undefined' || itensDlec[0].value == undefined){
      $('#botaoenvio').attr("disabled", true); 
    } else {
      $('#botaoenvio').attr("disabled", false);
    }
  }

}

function atualizaUSPS(){
 setTimeout(function(){

  var tipo = $('#opcaoenvio').val();
  var peso  = $('#pesototal').val();
  var valorMercadoria = $('#valortotaldeclarado').val();
  priceToShip(peso, valorMercadoria, tipo);
  atualizaValorTotal();
  AtualizaPrimeiroPeso();
}, 500);
}

function atualizaValorTotal(){
 var valorTotal = 0;
 $('.informaSubTotalListaPrincipal').each(function(event) {

  var valorAtual = $(this).val();
  if(valorAtual == 0 || valorAtual == undefined || valorAtual == null || valorAtual == 'undefined' || valorAtual == 'null'){
   valorAtual = 0;
 }


 valorTotal = parseFloat(valorTotal) + parseFloat(valorAtual);
 $('#valortotaldeclarado').val(valorTotal);
});

 setTimeout(function(){

  var valorTotal = $('#valortotaldeclarado').val();
  if(valorTotal == 0 || valorTotal == undefined || valorTotal == null || valorTotal == 'undefined' || valorTotal == 'null'){
   valorTotal = 0;
 }

 var valorfrete = $('#valorfrete').val();
 if(valorfrete == 0 || valorfrete == undefined || valorfrete == null || valorfrete == 'undefined' || valorfrete == 'null'){
   valorfrete = 0;
 }

 var valorservico = $('#valorservico').val();
 if(valorservico == 0 || valorservico == undefined || valorservico == null || valorservico == 'undefined' || valorservico == 'null'){
   valorservico = 0;
 }

 var servicosextras = $('#servicosextras').val();
 if(servicosextras == 0 || servicosextras == undefined || servicosextras == null || servicosextras == 'undefined' || servicosextras == 'null'){
   servicosextras = 0;
 }

 var armazenamentoTaxa = $('#armazenamentodeclarado').val();
 if(armazenamentoTaxa == 0 || armazenamentoTaxa == undefined || armazenamentoTaxa == null || armazenamentoTaxa == 'undefined' || armazenamentoTaxa == 'null'){
   armazenamentoTaxa = 0;
 }

 var armazenamento = $('#armazenamento').val();
 if(armazenamento == 0 || armazenamento == undefined || armazenamento == null || armazenamento == 'undefined' || armazenamento == 'null'){
   armazenamento = 0;
 }

 var valorFinal = (parseFloat(valorfrete)) + (parseFloat(valorservico)) + (parseFloat(servicosextras)) + (parseFloat(armazenamento)) + (parseFloat(armazenamentoTaxa)); 

 var opt = $('#opcaopgto').val();
 <? 

 $select_fp = "SELECT * FROM configFormaPagamentos WHERE ativo = 1";
 $query_select_fp = mysqli_query ($con, $select_fp) or die(mysqli_error());

 do{
  if($row_fp['idFormaPagamento'] != ''){
    ?>
    if(opt == '<?=$row_fp['TipoPagamento']?>'){
      var valor = <?=$row_fp['taxa']?>;
    }

    <?
  }
}while($row_fp = mysqli_fetch_assoc($query_select_fp));
?>

var taxa = 0;

if(valor >= 1){
 taxa = (valorFinal * valor) / 100;
 valorFinal = valorFinal + taxa;
}

var usrWallet = document.getElementById('usarWallet').checked;

if(usrWallet){

  saldo_wallet = $('.saldo_wallet').val();

  if(saldo_wallet > valorFinal){

    descontoWallet = parseFloat(valorFinal).toFixed(2);;
    $('#vlrDescontos').val(parseFloat(descontoWallet).toFixed(2));


    valorFinal = parseFloat(valorFinal).toFixed(2) - parseFloat(descontoWallet).toFixed(2);

  } else {

    descontoWallet = parseFloat(saldo_wallet).toFixed(2);
    $('#vlrDescontos').val(parseFloat(descontoWallet).toFixed(2));

    valorFinal = parseFloat(valorFinal).toFixed(2) - parseFloat(descontoWallet).toFixed(2);
  }

} else {
  descontoWallet = 0.00;
  $('#vlrDescontos').val(parseFloat(descontoWallet).toFixed(2))
}

valorFinal = parseFloat(valorFinal).toFixed(2);

$('#taxacartao').val(parseFloat(taxa).toFixed(2));
$('#valorfinal').val(valorFinal);

var opt = $('#opcaopgto').val();
var vlrTotal = $('#valorfinal').val();

if(opt == 'Wallet'){

  $('.divUsarWallet').hide();
  $('#usarWallet').prop('checked', false);

  saldo_wallet = $('#saldo_wallet').val();

  if(vlrTotal > saldo_wallet){
   $('.errWallet').show();
   document.getElementById('Wallet').disabled = true;
   document.getElementById('opcaopgto').value = "";
 } else {
   $('.errWallet').hide();
   document.getElementById('Wallet').disabled = false;
   document.getElementById('opcaopgto').value = "Wallet";

 }
} else if (opt != 'Wallet'){

  if(opt != ''){
    $('.divUsarWallet').show();
  }

  document.getElementById('Wallet').disabled = false;
  if(opt != 'Wallet' && opt != ''){
   $('.errWallet').hide();
   
 }

}

}, 500);

}

function AtualizaPrimeiroPeso(){
 setTimeout(function(){
  var pesototal = 0;


  $('.quantidadeProdutosFirst').each(function(index, el) {
   var id   = $(this).data('row');
   var qtd  = $(this).val();
   var peso = $('.pesoProdutoUnitario'+id).val();

   pesototal = pesototal + (parseFloat(peso) * parseInt(qtd));
 });

  $('#pesototal').val(pesototal.toFixed(2));
  var valorservico = document.getElementById('valorservico');

  AtualizaPrimeiroPeso();
}, 2000);
}
AtualizaPrimeiroPeso();

function atualizarDias(){
 setTimeout(function(){

  var diastotal = 0;   
  
  $('.recebeDiasArmazenamento').each(function(index, el) {
   var id   = index + 1;
   var dias = $(this).val();

   if(dias > 60){
    var quantidadeProdutosFirst = $('.quantidadeProdutosFirst'+id).val();
    dias = dias - 60;

    diastotal += parseFloat(quantidadeProdutosFirst) * dias;

    
  }    
});
  diastotal = diastotal * 1;
  $('#armazenamento').val(diastotal);

  atualizarDias();
}, 1000);
}


atualizarDias();

});
</script>
<script>


</script>

</html>
