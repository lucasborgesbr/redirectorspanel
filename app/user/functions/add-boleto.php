<?

require "conexao.php"; 

if($_POST){

	if($_POST['idenvio']){
		$idSource = $_POST['idenvio'];
	} else
	if($_POST['idtran']){
		$idSource = $_POST['idtran'];
	} else
	if($_POST['idcompracoletiva']){
		$idSource = $_POST['idcompracoletiva'];
	} else
	if($_POST['idGrupoCompras']){
		$idSource = $_POST['idGrupoCompras'];
	} else 
	if($_POST['idTributo']){
		$idSource = $_POST['idTributo'];
	}

	$authcode = $_POST['authcode']; 
	$idcompra = $_POST['idcompra'];
	$tipo = $_POST['tipo'];
	$msg = $_POST['msg'];
	$source = $_POST['source'];
	$iduser = $_POST['iduser'];

	$param = array(

		'id'		=>	$idcompra,
		'authcode'	=>	$authcode
	);


	if($tipo == 'B'){

	$sqlBoletoPendente = "INSERT INTO boletos (source, idSource, idParc, authcodeParc, iduser, tipo) VALUES ('$source', '$idSource', '$idcompra', '$authcode', '$iduser','$tipo')";
	$queryBoleto = mysqli_query($con, $sqlBoletoPendente);

	}


} 

?>