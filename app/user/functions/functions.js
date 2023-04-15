function valorservico(){

  var pesototal = $('#pesototal').val(); 
  var valorservico = $('#valorservico').val();
  var opcaoenvio = $('#opcaoenvio').val();
  var valor = 0;

  var data = {
    "peso" : pesototal,
  };

  $.post("functions/consulta-preco-peso.php", data)
  .done(function(xyz) {

   var resultado = xyz;
   var rate = resultado[0].vlrpeso;

   console.log(rate);
   $('#valorservico').val(rate);

 });

}

function calculapesototal(){

  var pesototal = document.getElementById('pesototal');

  var peso = document.getElementsByName('peso[]');
  var qtde = document.querySelectorAll('input[type="number"]');
  var somapeso = 0;
  var totalp = 0;

  for(d=0;d<peso.length;d++){
    somapeso += parseFloat(peso[d].value * qtde[d].value);
    totalp += qtde[d].value;
  }
  p = totalp;

  if (somapeso == 0) {

  }else{
    pesototal.value = parseFloat(somapeso).toFixed(2);
  }
  disablefirstclass();
}

function disablefirstclass(){
  var peso = $('#pesototal').val();
  if (peso > 4) {
    if(document.getElementById('firstclass') != null){
      document.getElementById('firstclass').disabled = true;      
    }
    
    if(document.getElementById('ePacket') != null){
      document.getElementById('ePacket').disabled = true;      
    }
    
    document.getElementById('opcaoenvio').value = "Priority";
    //metEnvio();
  } else{
    if(document.getElementById('firstclass') != null){
      document.getElementById('firstclass').disabled = false;      
    }
    if(document.getElementById('ePacket') != null){
      document.getElementById('ePacket').disabled = false;      
    }
    
  }
}



function valordeclarado(){

  var d;
  var v = document.getElementsByName("valor[]");
  var q = document.getElementsByName("numeroitens[]");
  var s = document.getElementsByName("subtotal[]");
  var valorzaofinal = 0;
  for(d = 0; d < v.length; d++ ){
    valorzaofinal += v[d].value.replace(",", ".") * q[d].value;
    
    s[d].value = v[d].value.replace(",", ".") * q[d].value;
    if (s[d].value == 0) {
      s[d].value = '';
    }
    if (s[d].value == 0 && q[d].value != '' && v[d].value != '') {
     s[d].value = 0;   
   }

 }
 valorzaofinal = valorzaofinal.toFixed(2);
 document.getElementById('valortotaldeclarado').value = valorzaofinal; 

 var valorMercadoria = document.getElementById('valortotaldeclarado').value;
 var opcaoenvio = document.getElementById('opcaoenvio').value;
 var pesototal = document.getElementById('pesototal').value;
}

// Função responsável em receber um objeto e extrair as informações necessárias para a remoção da linha.
function removerLinha(obj) {
    // Capturamos a referência da TR (linha) pai do objeto
    var objTR = obj.parentNode.parentNode;
    // Capturamos a referência da TABLE (tabela) pai da linha
    var objTable = objTR.parentNode;
    // Capturamos o índice da linha
    var indexTR = objTR.rowIndex;
    // Chamamos o método de remoção de linha nativo do JavaScript, passando como parâmetro o índice da linha  
    objTable.deleteRow(indexTR);
    calculapesototal();
    valordeclarado();
  } 

