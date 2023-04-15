<?

require ("conexao.php");

$peso = $_POST['peso'];
$tipoValor = 'TaxaServico';

$select_preco_peso = "SELECT * FROM configPesos WHERE tipoValor = '$tipoValor' AND pesoMin <= '$peso' AND pesoMax >= '$peso' AND ativo = 1";
$query_select_preco_peso = mysqli_query ($con, $select_preco_peso) or die(mysqli_error($con));

$selectConfiguracao = "SELECT * FROM Configuracoes";
$queryConfig = mysqli_query ($con, $selectConfiguracao) or die(mysqli_error($con));
$row_config = mysqli_fetch_assoc($queryConfig);

$resumoPesos = array();

do{
	if($row_preco_peso['idPeso'] != ''){

		array_push($resumoPesos,
			array(
				'idpeso' 	=>	$row_preco_peso['idPeso'],
				'pesomin'	=>	$row_preco_peso['pesoMin'],
				'pesomax'	=> 	$row_preco_peso['pesoMax'],
				'vlrpeso'	=>	$row_preco_peso['vlrPeso'],
				'nomeEmpresa' => $row_config['nomeEmpresa']
			));
	}
}while($row_preco_peso = mysqli_fetch_assoc($query_select_preco_peso));

header('Content-Type: application/json');
echo json_encode($resumoPesos);
exit;


?>