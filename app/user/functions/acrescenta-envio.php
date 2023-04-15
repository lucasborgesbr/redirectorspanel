<?php 

$lifetime=3600;
session_start();
setcookie(session_name(),session_id(),time()+$lifetime);

require "conexao.php";
$iduser = $_COOKIE['id_user'];

if(!isset($_COOKIE['id_user']) || $_COOKIE['id_user'] == '' || $_COOKIE['id_user'] == 0){
	header("Location: ../login.php?timeout");
	exit;
}

 //echo "<pre>";
 //print_r($_POST); 
 //exit();
$conteudo = "";
$usps = $_POST['valorfrete'];
$taxacartao = $_POST['taxacartao'];
$taxaservico = $_POST['valorservico'];
$servicosextrasdesc = "";
$taxaextras = $_POST['servicosextras'];
$taxaarmazenamento = $_POST['armazenamento'];
$pesototal = $_POST['pesototal'];
$valortotal = $_POST['valorfinal'];
$valorreal = 0;
$endereco = $_POST['endereco'];
$formapgto = $_POST['opcaopgto'];
$formaenvio = $_POST['opcaoenvio'];
$actDeclaracao = $_POST['actDeclaracao'];
$declaracao = "";
$valortotaldeclarado = $_POST['valortotaldeclarado']; 
$status = "novo";
$criado = date("Y-m-d");
$cpf = $_POST['cpf']; 

$usarWallet = $_POST['usarWallet'];
$vlrDesconto = $_POST['vlrDescontos'];


foreach ($_POST['quantidade'] as $key => $value) {
	 // Verificando se Quantidade no estoque é valida
	$sqlEstoque = "SELECT * FROM produtos WHERE idproduto = '$key'";
	$queryEstoque = mysqli_query($con, $sqlEstoque)  or die(mysqli_error($con));
	$row_Estoque = mysqli_fetch_assoc($queryEstoque);

	$qtdeEstoque = $row_Estoque['quantidade'];
	if($qtdeEstoque < $value){
		header("Location: ../produtos.php?errEstoque=1");
		exit;
	}
	//$sql3 = "UPDATE produtos SET quantidade = quantidade - '$value', status = 'sent' WHERE idproduto = '$key'";
	//$query3 = mysqli_query($con, $sql3)  or die(mysqli_error($con));
}

if($actDeclaracao == '1'){

	$valortotaldeclarado = 0;

} else {

	if($_POST['valortotaldeclarado'] == ""){
		header("Location: ../produtos.php?errDeclaracao=1");
		exit;
	}

	//declaracao alfandegaria
	for ($z=0; $z < 10; $z++) { 
		$declaracao .= str_replace("-", "", $_POST['item'][$z])."-".$_POST['numeroitens'][$z]."-".$_POST['valor'][$z]."-".$_POST['subtotal'][$z]."|";
	}
	$declaracao .= "<br>Valor Declarado Final: ".$_POST['valortotaldeclarado'];
	$declaracaobruta = $declaracao;
}

foreach ($_POST['quantidade'] as $key => $value) {
	$sql1 = "SELECT * FROM produtos WHERE idproduto = '$key'";
	$query1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
	$ln = mysqli_fetch_assoc($query1);
	$conteudobruto .= $key." - ".$ln['descricao']." - ".$value." | ";
}

// servicos extras
for ($i=1; $i < 50; $i++) { 
	if (isset($_POST[$i])) {
		$servicosextrasdesc .= $_POST[$i]."|";
	}
}

$conteudo = str_replace("'", "", $conteudobruto);
$declaracao = str_replace("'", "", $declaracaobruta);

if($formapgto == 'Itau'){

	$dolar_api_json = file_get_contents("https://economia.awesomeapi.com.br/json/USD-BRL/1");   
	$dolar_valores = json_decode($dolar_api_json);

    //$USDT_BRL_Compra = $dolar_valores[0]->bid; //Dolar Turismo Compra (Quando o cliente Vende Dolar)
    $USDT_BRL_Venda = $dolar_valores[0]->ask; // Dolar Turismo Venda (Quando o Cliente Compra Dolar)
    
    $valorPorcentagem = ($valortotal*7)/100;
    $valorConvertido = $USDT_BRL_Venda * ($valortotal+$valorPorcentagem);
    
    $valorreal = $valorConvertido;
    
}


// criando registro do envio
$sql2 = "INSERT INTO envios
(iduser, conteudo, usps, taxapgto, taxaservico, servicosextrasdesc, taxaextras, taxaarmazenamento, pesototal, vlrDesconto, valortotal, valorReal, endereco, formapgto, formaenvio, declaracao, valordeclaradofinal, status, cpf) VALUES 
('$iduser', '$conteudo', '$usps', '$taxacartao', '$taxaservico', '$servicosextrasdesc', '$taxaextras', '$taxaarmazenamento', '$pesototal', '$vlrDesconto', '$valortotal', '$valorreal', '$endereco', '$formapgto', '$formaenvio', '$declaracao', '$valortotaldeclarado', '$status', '$cpf')";

$query2 = mysqli_query($con, $sql2)  or die(mysqli_error($con));

$sql4 = "SELECT idenvio FROM envios WHERE iduser = '$iduser' ORDER BY idenvio desc limit 1";

$query4 = mysqli_query($con, $sql4);
$envio = mysqli_fetch_assoc($query4);

$to = $_SESSION['contato'];
$subject = "Novo pedido de envio";
$message = "Equipe ".$_SESSION['empresa'].", o cliente #".$iduser."criou um envio em ".date("d-m-Y h:i:s").".<br><br>Atenciosamente, <br><em>Solutionsbox Mail System</em>";

mail($to, $subject, $message);

if(isset($_POST['usarWallet'])){

	$saldo_wallet = $_SESSION['saldo_wallet'];
	$novo_saldo = $saldo_wallet - $vlrDesconto;
	$motivo = "Utilização de Saldo no Envio #".$envio['idenvio'];

	$sql_select_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser' ORDER BY idwallet DESC";
	$query_insert_wallet = mysqli_query($con, $sql_select_wallet);
	$row_wallet = mysqli_fetch_assoc($query_insert_wallet);

	$idwallet = $row_wallet['idwallet'];

	$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,paga,tipoTran,status,opPagamento) VALUES ('$idwallet','$vlrDesconto','Desconto - ($motivo)','Finalizado','Wallet')";
	$query_insert_tran = mysqli_query($con, $sql_insert_tran);

	$sql_debito_wallet = "UPDATE wallet SET saldo = '$novo_saldo' WHERE idwallet = '$idwallet'";
	$query_debito_wallet = mysqli_query($con, $sql_debito_wallet);

}

if($formapgto == 'Wallet'){

	$saldo_wallet = $_SESSION['saldo_wallet'];
	$novo_saldo = $saldo_wallet - $valortotal;
	$motivo = "Envio #".$envio['idenvio'];

	$sql_select_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser' ORDER BY idwallet DESC";
	$query_insert_wallet = mysqli_query($con, $sql_select_wallet);
	$row_wallet = mysqli_fetch_assoc($query_insert_wallet);

	$idwallet = $row_wallet['idwallet'];

	$sql_insert_tran = "INSERT INTO transacaoWallet (idwallet,paga,tipoTran,status,opPagamento) VALUES ('$idwallet','$valortotal','Pagamento - ($motivo)','Processando','$formapgto')";
	$query_insert_tran = mysqli_query($con, $sql_insert_tran);

	$sql5 = "SELECT idtran FROM transacaoWallet WHERE idwallet = '$idwallet' ORDER BY idtran desc limit 1";
	$query5 = mysqli_query($con, $sql5);
	$row_idtran = mysqli_fetch_assoc($query5);
	$idtran = $row_idtran['idtran'];

	$idEnvio = $envio['idenvio'];

	$sql = "INSERT INTO comprovantes (idEnvio, idtran) VALUES ('$idEnvio', '$idtran')";
	$query = mysqli_query($con, $sql);
}

foreach ($_POST['quantidade'] as $key => $value) {
	 // descontando o produto do estoque
	$sql3 = "UPDATE produtos SET quantidade = quantidade - '$value', status = 'sent' WHERE idproduto = '$key'";
	$query3 = mysqli_query($con, $sql3)  or die(mysqli_error($con));
}

header("Location: ../visualizar-envios.php?idenvio=".$envio['idenvio']);

?>