<?

require ("conexao.php");

$select_preco_peso = "SELECT * FROM configPesos WHERE tipoValor = 'TaxaServico' AND ativo = 1 ORDER BY pesoMax ASC";
$query_select_preco_peso = mysqli_query ($con, $select_preco_peso) or die(mysqli_error($con));

$selectConfiguracao = "SELECT * FROM Configuracoes";
$queryConfig = mysqli_query ($con, $selectConfiguracao) or die(mysqli_error($con));
$row_config = mysqli_fetch_assoc($queryConfig);

$resumoPesos = array();

$pesoAnterior = 0;
do{
	if($row_preco_peso['idPeso'] != ''){

		if($pesoAnterior > 0){
			$pesoMin = $pesoAnterior + 0.1;
		} else {
			$pesoMin = $pesoAnterior;
		}

		array_push($resumoPesos,
			array(
				'idpeso' 	=>	$row_preco_peso['idPeso'],
				'pesomin'	=>	$pesoMin,
				'pesomax'	=> 	$row_preco_peso['pesoMax'],
				'vlrpeso'	=>	$row_preco_peso['vlrPeso'],
				'nomeEmpresa' => $row_config['nomeEmpresa']
			));


		$pesoAnterior = $row_preco_peso['pesoMax'];
	}
}while($row_preco_peso = mysqli_fetch_assoc($query_select_preco_peso));

header('Content-Type: application/json');
echo json_encode($resumoPesos);
exit;


?>