<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

    $mobile = 1;
} else {
    $mobile = 0;
}

require ("../user/functions/conexao.php");
require ("../user/functions/conf_email.php"); 
//session start.

$cookie_name = '_id_admin';

session_start();
if (!isset($_COOKIE[$cookie_name])) {
	header("Location: login.php?redirect=".$_SERVER["REQUEST_URI"]);
}
// atribuicao de session
$id_admin = $_COOKIE[$cookie_name];
//funcao logout
if (isset($_GET['logout'])) {
	session_destroy();
	header("Location: functions/processa-logout.php");
}

$_SESSION['empresa'] = $empresa;
$_SESSION['logo'] = $logo;
$_SESSION['contato'] = $contato;
$_SESSION['link'] = $link;

// Valor atual do Dolar

$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 1200,  //1200 Seconds is 20 Minutes
    )
));


@$dolar_api_json = file_get_contents("https://economia.awesomeapi.com.br/json/USDT-BRL/1", false, $ctx);   
$dolar_valores = json_decode($dolar_api_json);

$_SESSION['USDT-BRL-Compra'] = $dolar_valores[0]->ask; // Dolar Turismo Venda (Quando o Cliente Compra Dolar)
$_SESSION['USDT-BRL-Venda'] = $dolar_valores[0]->bid; //Dolar Turismo Compra (Quando o cliente Vende Dolar)
$_SESSION['USDT-BRL-Variacao'] = $dolar_valores[0]->varBid;
$_SESSION['USDT-BRL-Percent-Var'] = $dolar_valores[0]->pctChange;

//seleciona os dados dos users
$select_users = "SELECT * FROM users";

$query_select_users = mysqli_query ($con, $select_users) or die(mysqli_error($con));
$row_users = mysqli_fetch_assoc($query_select_users);

	//seleciona os users que nao estao verificados
	$select_user_nv = "SELECT * FROM users WHERE status ='new'";
	$query_select_user_nv = mysqli_query ($con, $select_user_nv) or die(mysqli_error($con));
	$row_user_nv = mysqli_fetch_assoc($query_select_user_nv);

if (isset($_GET['view-address'])) {
	$iduser = $_GET['id'];
	$select_enderecos = "SELECT * FROM enderecos WHERE iduser = '$iduser'";
	$query_select_enderecos = mysqli_query ($con, $select_enderecos) or die(mysqli_error($con));
	$row_enderecos = mysqli_fetch_assoc($query_select_enderecos);
}
if (isset($_GET['view-docs'])) {
	$iduser = $_GET['id-docs'];
	$select_docs = "SELECT * FROM docs WHERE iduser = '$iduser'";
	$query_select_docs = mysqli_query ($con, $select_docs) or die(mysqli_error($con));
	$row_docs = mysqli_fetch_assoc($query_select_docs);
}
if (isset($_GET['view-produtos'])) {
	$idcaixa = $_GET['id-caixa'];
	$select_produtos = "SELECT * FROM produtos WHERE idcaixa = '$idcaixa'";
	$query_select_produtos = mysqli_query ($con, $select_produtos) or die(mysqli_error($con));
	$row_produtos = mysqli_fetch_assoc($query_select_produtos);
}else{
	$select_produtos = "SELECT p.*, u.nome, u.sobrenome FROM produtos p LEFT JOIN users u ON u.iduser = p.iduser";
	$query_select_produtos = mysqli_query ($con, $select_produtos) or die(mysqli_error($con));
	$row_produtos = mysqli_fetch_assoc($query_select_produtos);
}
//seleciona os dados do admin
$select_admin = "SELECT * FROM admins WHERE idadmin = '$id_admin'";
$query_select_admin = mysqli_query ($con, $select_admin) or die(mysqli_error($con));
$row_admin = mysqli_fetch_assoc($query_select_admin);

//seleciona todas as caixas
$select_caixas = "SELECT * FROM caixas";
$query_select_caixas = mysqli_query ($con, $select_caixas) or die(mysqli_error($con));
$row_caixas = mysqli_fetch_assoc($query_select_caixas);

//seleciona todos os envios
if(isset($_GET['idenvio'])){
$idenvio = $_GET['idenvio'];
$select_envios = "SELECT * FROM envios WHERE idenvio = '$idenvio'";
$query_select_envios = mysqli_query ($con, $select_envios) or die(mysqli_error($con));
$row_envios = mysqli_fetch_assoc($query_select_envios);

}else{
$select_envios = "SELECT e.*, u.nome, u.sobrenome FROM envios e LEFT JOIN users u ON u.iduser = e.iduser";
$query_select_envios = mysqli_query ($con, $select_envios) or die(mysqli_error($con));
$row_envios = mysqli_fetch_assoc($query_select_envios);
}
//seleciona ultimo id da caixa
$sql_seleciona_last_box = "SELECT max(idcaixa) as idcaixa FROM caixas";
$query_seleciona_last_box = mysqli_query($con, $sql_seleciona_last_box);
$last_id = mysqli_fetch_assoc($query_seleciona_last_box);
$_SESSION['last_id'] = $last_id['idcaixa'];

//seleciona todas as compras
$select_compras = "SELECT * FROM compras";
$query_select_compras = mysqli_query ($con, $select_compras) or die(mysqli_error($con));
$row_compras = mysqli_fetch_assoc($query_select_compras);

//seleciona todas as notifications
$select_notifications = "SELECT * FROM notificacoes ORDER BY idnotificacao DESC";
$query_select_notifications = mysqli_query ($con, $select_notifications) or die(mysqli_error($con));
$row_notifications = mysqli_fetch_assoc($query_select_notifications);

//seleciona todas as configurações
$select_config = "SELECT * FROM Configuracoes";
$query_select_config = mysqli_query ($con, $select_config) or die(mysqli_error($con));
$row_config = mysqli_fetch_assoc($query_select_config);

$_SESSION['VERSION'] = $row_config['version'];

function exportar_users(){
$select_users = "SELECT * FROM users";
$query_select_users = mysqli_query ($con, $select_users) or die(mysqli_error($con));
$fp = fopen('file.csv', 'w');
while($row_u = mysql_fetch_assoc($query_select_users)){
    fputcsv($fp, $row_u);
}
fclose($fp);    

}

// seleciona as caixas que estão chegando
$select_redirecionamento = "SELECT * FROM redirecionamento";
$query_select_redirecionamento = mysqli_query ($con, $select_redirecionamento) or die(mysqli_error($con));
$row_redirecionamento = mysqli_fetch_assoc($query_select_redirecionamento);
$total_redirecionamento = mysqli_num_rows($query_select_redirecionamento);

// soma saldos wallet credito e devedores

$sqlDevedores = "SELECT SUM(saldo) as saldoDevedor FROM wallet WHERE saldo < '0'";
$queryDevedores = mysqli_query ($con, $sqlDevedores) or die(mysqli_error($con));
$row_saldoDevedor = mysqli_fetch_assoc($queryDevedores);

$sqlCredores = "SELECT SUM(saldo) as saldoCredor FROM wallet WHERE saldo >= '0'";
$queryCredores = mysqli_query ($con, $sqlCredores) or die(mysqli_error($con));
$row_saldoCredor = mysqli_fetch_assoc($queryCredores);

?>