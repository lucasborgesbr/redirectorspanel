var countries;
var pmei;
var fcpi;
var pmi;

var rangeable;
$(document).ready(function () {

  $("#shippingCompanies").hide();

  var weightType = $("#weightType option:selected").val();
  var pais = $("#txtDestination option:selected").val();
  var rangeValue = $(".rangeable-input").val();

  ResetRange();

            //GetData();
            //priceToShip(rangeValue, pais);
        });

$("#txtPackage").change(function () {
    var package = $("#txtPackage option:selected").val();
    var maxValue = 0.00;
            //$("#shippingCompanies").slideUp(600);
            ResetRange();

            var weightType = $("#weightType option:selected").val();
            var selectedDestination = $("#txtDestination option:selected").text();
            var rangeValue = $(".rangeable-input").val();

            if (weightType == 2) {
                rangeValue = Math.round(rangeValue * 2.20462);
            }
            
            priceToShip(rangeValue, selectedDestination);
            //CalculateServiceFee(weightType, selectedDestination, rangeValue);
        });
$("#weightType").change(function () {
    $("#shippingCompanies").slideUp(600);
    ResetRange();

    var weightType = $("#weightType option:selected").val();
    var selectedDestination = $("#txtDestination option:selected").text();
    var rangeValue = $(".rangeable-input").val();

    if (weightType == 2) {
        rangeValue = Math.round(rangeValue * 2.20462);
    }

    priceToShip(rangeValue, selectedDestination);
            //CalculateServiceFee(weightType, selectedDestination, rangeValue);
        });
$("#txtDestination").change(function () {
            //$("#shippingCompanies").slideUp(600);
            //ResetRange();

            var weightType = $("#weightType option:selected").val();
            var selectedDestination = $("#txtDestination option:selected").text();
            var rangeValue = $(".rangeable-input").val();

            if (weightType == 1) {
                rangeValue = Math.round(rangeValue / 2.20462);
            }
            
            priceToShip(rangeValue, selectedDestination);
            //CalculateServiceFee(weightType, selectedDestination, rangeValue);
        });

rangeable = new Rangeable('#myRange', {
    min: 1,
    max: 65,
    step: 1,
    value: 0,
    onChange: function () {

    }
});

function CalculateServiceFee(pmeiValue, pmiValue, fcpiValue) {
    $("#shippingCompanies").slideUp(600);
    var packageFee = '';
    var rangeValue = $(".rangeable-input").val();

    var weightType = $("#weightType").val();

    if(weightType == 2){
        rangeValue = Math.round(rangeValue * 2.20462);
    }      

           // if(rangeValue <= 10){packageFee = 20;}
           // if(rangeValue >= 10.1 && rangeValue <= 30){packageFee = 30;}
           // if(rangeValue > 30){packageFee = 40;}

           $.ajax({
            method: "POST",
            url: "../app/user/functions/consulta-preco-peso.php",
        })
           .done(function(xpto){
            var tamanhoArray = xpto.length;
            for(var i=0; i<=tamanhoArray; i++){

                if(xpto[i] !== undefined){

                    if(rangeValue >= parseFloat(xpto[i].pesomin) && rangeValue <= parseFloat(xpto[i].pesomax)){
                        packageFee = parseFloat(xpto[i].vlrpeso);
                    }

                    nomeEmpresa = xpto[i].nomeEmpresa;
                }
            }

           var mailExpressInternational = parseFloat(pmeiValue);
           var mailInternational = parseFloat(pmiValue);
           var firstClassPackage = parseFloat(fcpiValue);

           console.log(pmeiValue);
           console.log(pmiValue);
           console.log(fcpiValue);


           if (mailExpressInternational === undefined || isNaN(mailExpressInternational)) {
            $("#delivery-1").parent().hide();
        } else {
            $("#delivery-1").parent().show();
        }
        if (mailInternational === undefined || isNaN(mailInternational)) {
            $("#delivery-2").parent().hide();
        } else {
            $("#delivery-2").parent().show();
        }

        if (firstClassPackage === undefined || isNaN(firstClassPackage)) {
            $("#delivery-3").parent().hide();
        } else if (firstClassPackage === 0) {
            $("#delivery-3").parent().hide();
        } else {
            $("#delivery-3").parent().show();
        }

        $("#shipExpressInternational").text("Envio: US $ " + mailExpressInternational);
        $("#shipInternational").text("Envio: US $ " + mailInternational);
        $("#firstClassInternational").text("Envio: US $ " + firstClassPackage);

        var paypalFee1 = ((mailExpressInternational + packageFee) * 0.07);
        var paypalFee2 = ((mailInternational + packageFee) * 0.07);
        var paypalFee3 = ((firstClassPackage + packageFee) * 0.07);

        $(".packageFee").text("Taxa "+ nomeEmpresa +": US $ " + packageFee);

            //$("#paypalFees-1").text("Taxa Paypal: US $ " + paypalFee1.toFixed(2));
            //$("#paypalFees-2").text("Taxa Paypal: US $ " + paypalFee2.toFixed(2));
            //$("#paypalFees-3").text("Taxa Paypal: US $ " + paypalFee3.toFixed(2));
            
            $("#paypalFees-1").text("");
            $("#paypalFees-2").text("");
            $("#paypalFees-3").text("");

            //var totalFee1 = mailExpressInternational + packageFee + paypalFee1;
            //var totalFee2 = mailInternational + packageFee + paypalFee2;
            //var totalFee3 = firstClassPackage + packageFee + paypalFee3;
            
            var totalFee1 = mailExpressInternational + packageFee;
            var totalFee2 = mailInternational + packageFee;
            var totalFee3 = firstClassPackage + packageFee;

            $("#totalFee-1").text("Total: US $ " + totalFee1.toFixed(2));
            $("#totalFee-2").text("Total: US $ " + totalFee2.toFixed(2));
            $("#totalFee-3").text("Total: US $ " + totalFee3.toFixed(2));

            $("#shippingCompanies").slideDown(600);
           });       
}

        function ResetRange() {
            var package = $("#txtPackage option:selected").val();
            var weightType = $("#weightType option:selected").val();
            var maxValue = 65;
            var minValue = 0;

           if (weightType == 2) {
                maxValue = Math.round(maxValue / 2.20462);
                minValue = Math.round(minValue / 2.20462);
            }

            if (rangeable) {
                rangeable.destroy();
            }
            rangeable = new Rangeable('#myRange', {
                min: minValue,
                max: maxValue,
                step: 1,
                value: minValue,
                onEnd: function (value) {
                    var unidade = $("#weightType option:selected").val();
                    var pais = $("#txtDestination option:selected").val();
                    var package = $("#txtPackage option:selected").val();
                    //CalculateServiceFee(unidade, pais, value);
                    var rangeValue = value;
                    if(rangeValue == 0){
                        $("#shippingCompanies").slideUp(600);
                    } else 

                    //priceToShip(value, pais);
                    if (weightType == 2) {
                        value = Math.round(value * 2.20462);
                        priceToShip(value, pais);
                        if (package == 20 && rangeValue == 0) {
                            $(".rangeable-tooltip").text("0");
                        } else if (package == 30 && rangeValue == 10) {
                            $(".rangeable-tooltip").text("4,5");
                        } else if (package == 40 && rangeValue == 30) {
                            $(".rangeable-tooltip").text("13,6");
                        }
                    } else {
                        priceToShip(value, pais);
                        if (package == 20 && rangeValue == 0) {
                            $(".rangeable-tooltip").text("0");
                        } else if (package == 30 && rangeValue == 10) {
                            $(".rangeable-tooltip").text("10.1");
                        } else if (package == 40 && rangeValue == 30) {
                            $(".rangeable-tooltip").text("30.1");
                        }
                    }
                }
            });

            var rangeValue = $(".rangeable-input").val();
            if (weightType == 2) {
                if (package == 20 && rangeValue == 0) {
                    $(".rangeable-tooltip").text("0");
                } else if (package == 30 && rangeValue == 10) {
                    $(".rangeable-tooltip").text("4,5");
                } else if (package == 40 && rangeValue == 30) {
                    $(".rangeable-tooltip").text("13,6");
                }
            } else {
                if (package == 20 && rangeValue == 0) {
                    $(".rangeable-tooltip").text("0");
                } else if (package == 30 && rangeValue == 10) {
                    $(".rangeable-tooltip").text("10.1");
                } else if (package == 40 && rangeValue == 30) {
                    $(".rangeable-tooltip").text("30.1");
                }
            }
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

function priceToShip(peso, pais){

  var pounds = peso;//gramsToPounds(grams);
  var ounces = 0;//gramsToOunces(grams);
  var userid = "433STORE2182"; //"[userid]";
  var url = "https://secure.shippingapis.com/ShippingAPI.dll";
  var valorMercadoria = 1;
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
      <Country>"+ pais +"</Country> \
      </Package> \
      </IntlRateV2Request>"
  };

  $.post(url, data)
  .done(function(xyz) {
        //var tipo = $('#opcaoenvio').val();
        var resultado = xmlToJson(xyz);
        console.log(resultado);
        //console.log(pounds);
        if(pounds <= 4){
            var fcpiValue = resultado.IntlRateV2Response.Package.Service[8].Postage["#text"];
        } else {var fcpiValue = 0;}
        var pmiValue = resultado.IntlRateV2Response.Package.Service[2].Postage["#text"];
        var pmeiValue = resultado.IntlRateV2Response.Package.Service[1].Postage["#text"];
        //frete(rate);

        CalculateServiceFee(pmeiValue, pmiValue, fcpiValue);
    });
}