<?


if($_POST){

	$peso = $_POST['peso'];
	$tipoEnvios = $_POST['tipoEnvios'];
	$tipoValor = '';

	if($tipoEnvios == 'ePacket'){
		$tipoValor = 'ePacket';
	}

	/*if($tipoEnvios == 'First_Class'){
		$tipoValor = 'USPSFirstClass';
	}

	if($tipoEnvios == 'USPS'){
		$tipoValor = 'USPS';
	}

	if($tipoEnvios == 'Frete Aereo'){
		$tipoValor = 'FreteAereo';
	}*/

	require ("conexao.php");
	// WHERE tipoValor = '$tipoValor' AND pesoMin <= '$peso' AND pesoMax >= '$peso' AND ativo = 1
	$select_preco_peso = "SELECT * FROM configPesos WHERE tipoValor = '$tipoValor' AND pesoMin <= '$peso' AND pesoMax >= '$peso' AND ativo = 1";
	$query_select_preco_peso = mysqli_query ($con, $select_preco_peso) or die(mysqli_error($con));

	$resumoPesos = array();

	do{
		if($row_preco_peso['idPeso'] != ''){

			array_push($resumoPesos,
				array(
					'idpeso' 	=>	$row_preco_peso['idPeso'],
					'pesomin'	=>	$row_preco_peso['pesoMin'],
					'pesomax'	=> 	$row_preco_peso['pesoMax'],
					'vlrpeso'	=>	$row_preco_peso['vlrPeso'],
					'tipoValor' =>  $row_preco_peso['tipoValor']
				));

		}

	}while($row_preco_peso = mysqli_fetch_assoc($query_select_preco_peso));

} else {

	$resumoPesos = array();
	array_push($resumoPesos,
		array(
			'erro' 	=>	'Pagina não pode ser acessada diretamente'
		));

}

header('Content-Type: application/json');
echo json_encode($resumoPesos);
exit;


?>