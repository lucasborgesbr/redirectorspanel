    function frete(valor){
            var custo = parseFloat(valor);
            $('#valorfrete').val(custo);
            console.log(custo);
        }

    function xmlToJson(xml) {
    
    // Create the return object
    var obj = {};

    if (xml.nodeType == 1) { // element
        // do attributes
        if (xml.attributes.length > 0) {
        obj["@attributes"] = {};
            for (var j = 0; j < xml.attributes.length; j++) {
                var attribute = xml.attributes.item(j);
                obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
            }
        }
    } else if (xml.nodeType == 3) { // text
        obj = xml.nodeValue;
    }

    // do children
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

  var pounds = peso;//gramsToPounds(grams);
  var ounces = 0;//gramsToOunces(grams);
  var userid = "433STORE2182"; //"[userid]";
  var url = "https://secure.shippingapis.com/ShippingAPI.dll";
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
                   <Country>Brazil</Country> \
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
        var tipo = $('#opcaoenvio').val();
        var resultado = xmlToJson(xyz);
        if(tipo == 'First_Class'){
            var rate = resultado.IntlRateV2Response.Package.Service[8].Postage["#text"];
        }else if(tipo == 'Priority'){
            var rate = resultado.IntlRateV2Response.Package.Service[2].Postage["#text"];
        }else if(tipo == 'Express'){
            var rate = resultado.IntlRateV2Response.Package.Service[1].Postage["#text"];
        }
        frete(rate);
    });
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
    apagavalorfinal();
    valordeclarado();
} 

var p = 0;

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
        //pesototal.value = 0;
    }else{
        pesototal.value = parseFloat(somapeso).toFixed(2);
    }
    valorservico();
    disablefirstclass();
    armazenamento();

    
}


function armazenamento(){
    var dias = document.getElementsByName('dias[]');
    var qtde = document.querySelectorAll('input[type="number"]');
    var armaz = document.getElementById('armazenamento');
    var diastotal = 0;
    for(e=0;e<dias.length;e++){
            if(dias[e].value > 60){
            
            diastotal += (dias[e].value - 60)* qtde[e].value;
            // definir aqui a taxa diaria apos 60 dias, nesse caso 1$ por dia;
            diastotal = diastotal * 1;
            }
    }
    
    armaz.value = parseFloat(diastotal).toFixed(2);


}

function valorservico(){
  var pesototal = document.getElementById('pesototal').value;
  var valorservico = document.getElementById('valorservico');

  var valor = 10;
  //if (pesototal <= 1814) { valor = 10;}
  //if (pesototal >= 1815 && pesototal <= 4536) {valor = 20;}
  //if (pesototal >= 4537 && pesototal <= 13607) {valor= 30;}
  //if (pesototal >= 13608) {valor = 40;}
  
  valorservico.value = parseFloat(valor).toFixed(2);

 }

function opcaoPgto(){
    var oppgto = document.getElementById('opcaopgto').value;
    var taxacartao = document.getElementById('taxacartao');
    var taxa = 0;
    
    if (oppgto == "PayPal") {taxa = "7.00";}
    if (oppgto == "WesterUnion") {taxa = "0";}
    if (oppgto == "Boleto") {taxa = "0";}

    taxacartao.value = parseFloat(taxa).toFixed(2);
    apagavalorfinal();

}


function disablefirstclass(){
     if (document.getElementById('pesototal').value > 4) {
      document.getElementById('firstclass').disabled = true;
      document.getElementById('opcaoenvio').value = "Priority";
      metEnvio();
    } else{
      document.getElementById('firstclass').disabled = false;
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

function servicosExtras(){

    var cinco = document.getElementById('5').checked;
        var seis = document.getElementById('6').checked;
        var sete = document.getElementById('7').checked;
        var oito = document.getElementById('8').checked;
        var nove = document.getElementById('9').checked;
        var dez = document.getElementById('10').checked;
        var onze = document.getElementById('11').checked;
    
        var valorse = 0;
        var t = totalItens();
        var servicosextras = document.getElementById('servicosextras');
    
        if(cinco){valorse += 5;}
        if(seis){valorse += 3;}
        if(sete){valorse += 20;}
        if(oito){valorse += 3;}
        if(nove){valorse += 5;}
        if(dez){valorse += 3;}
        if(onze){valorse += 5;}
        
    
        servicosextras.value = parseFloat(valorse).toFixed(2);
        atualizaValorTotal();

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
            s[d].value = "";
        }
  }
  valorzaofinal = valorzaofinal.toFixed(2);
  document.getElementById('valortotaldeclarado').value = valorzaofinal; 

    var valorMercadoria = document.getElementById('valortotaldeclarado').value;
    var opcaoenvio = document.getElementById('opcaoenvio').value;
    var pesototal = document.getElementById('pesototal').value;
    priceToShip(peso, valorMercadoria, tipo);
                

}



function metEnvio(){
    // atualizado em 04/03/2018
    var custo;
    var valorMercadoria = document.getElementById('valortotaldeclarado').value;
    var valorfrete = document.getElementById('valorfrete');
    var opcaoenvio = document.getElementById('opcaoenvio').value;
    var pesototal = document.getElementById('pesototal').value;
    
    priceToShip(pesototal, valorMercadoria, opcaoenvio);
      valorfrete.value = parseFloat(custo).toFixed(2);
      
      apagavalorfinal();
    }
    
    
function calculofinal(){
    var valorfrete = document.getElementById('valorfrete').value;
    var valorservico = document.getElementById('valorservico').value;
    var servicosextras = document.getElementById('servicosextras').value;
    var taxacartao = document.getElementById('taxacartao').value;
    var armazenamento = document.getElementById('armazenamento').value;
    var valorfinal = document.getElementById('valorfinal');
    var calculofinal = 0;
    var botaoenvio = document.getElementById('botaoenvio');
    calculofinal = parseFloat(valorfrete) + parseFloat(valorservico) + parseFloat(servicosextras) + parseFloat(armazenamento);
    calculofinal = parseFloat(calculofinal) + (parseFloat(calculofinal) * (parseFloat(taxacartao).toFixed(2)/100));

    valorfinal.value = parseFloat(calculofinal).toFixed(2);

    if (calculofinal >0 ) {
        botaoenvio.disabled = false;
    }
    
    
    // console.log(parseFloat(valorfrete));
    // console.log(parseFloat(valorservico));
    // console.log(parseFloat(servicosextras));
    // console.log(parseFloat(taxacartao));
    // console.log(parseFloat(armazenamento));
    // console.log(calculofinal);


}

function apagavalorfinal(){
    var valorfinal = document.getElementById('valorfinal');

    valorfinal.value = 0;
    // console.log("to mudando");
}