<?

require ("conexao.php");

$selectConfiguracao = "SELECT * FROM Configuracoes";
$queryConfig = mysqli_query ($con, $selectConfiguracao) or die(mysqli_error($con));
$row_config = mysqli_fetch_assoc($queryConfig);

$config = array();

array_push($config,
	array(
		'logo' 	=>	$row_config['logo'],
		'nomeEmpresa'	=>	$row_config['nomeEmpresa'],
		'contato'	=> 	$row_config['contato'],
		'link'	=>	$row_config['link']
	));


header('Content-Type: application/json');
echo json_encode($config);
exit;


?>