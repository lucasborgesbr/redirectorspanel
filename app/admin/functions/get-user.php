<? 

require "../../user/functions/conexao.php";

if($_POST){

	$iduser = $_POST['iduser'];

	$sql_user = "SELECT * FROM users WHERE iduser = '$iduser'";
	$query_user = mysqli_query ($con, $sql_user) or die(mysqli_error($con));
	$row_user = mysqli_fetch_assoc($query_user);

	
	$sqlTotalPesos = "SELECT SUM(peso) pesoTotalSuite FROM `produtos` 
	WHERE quantidade > 0 AND iduser = '$iduser'";

	$queryTotalPeso = mysqli_query($con, $sqlTotalPesos);
	$row_pesoTotal = mysqli_fetch_assoc($queryTotalPeso);

	if($row_pesoTotal['pesoTotalSuite'] != ''){
		$pesoTotal =  $row_pesoTotal['pesoTotalSuite'];
	}else{
		$pesoTotal = 0.00;
	}

	$select_saldo_wallet = "SELECT * FROM wallet WHERE iduser = '$iduser'";
	$query_select_saldo_wallet = mysqli_query($con,$select_saldo_wallet);
	$row_saldo = mysqli_fetch_assoc($query_select_saldo_wallet);

	if($row_saldo['saldo'] == "" || $row_saldo['saldo'] == "0"){
		$saldoWallet = money_format('%.2n',  '0.00');
	} else {
		setlocale(LC_MONETARY, 'en_US');
		$saldoWallet = money_format('%.2n', $row_saldo['saldo']);
	}


	$select_enderecos = "SELECT * FROM enderecos WHERE iduser = '$iduser'";
	$query_enderecos = mysqli_query($con,$select_enderecos);
	
	$arrayUser = array(
		'idSuite' 		=> $row_user['iduser'],
		'nomeCompleto'	=> $row_user['nome']." ".$row_user['sobrenome'],
		'cpf'			=> $row_user['cpf'],
		'pesoTotal'		=> $pesoTotal,
		'saldoWallet' 	=> $saldoWallet,
		'telefone'		=> $row_user['telefone'],
		'email' 		=> $row_user['email'],
		'dtCadastro' 	=> $row_user['criado'],
		'status'		=> $row_user['status'],
		'ativo'			=> $row_user['ativo'],
		'enderecos'		=> array(),
		'ativarUser'	=> 'functions/ativa-cliente.php?id='.$iduser,
		'desativarUser'	=> 'functions/desativa-cliente.php?id='.$iduser,
		'resetSenha'	=> 'functions/reseta-senha-cliente.php?id='.$iduser,
		'verificaUser'	=> 'functions/verifica-cliente.php?id='.$iduser,
		'logarComoUser'	=> 'functions/user-view.php?id='.$iduser

	);

	$countEnde = 1;
	do{	
		if($row_enderecos['idendereco'] != ''){

			$idendereco = $row_enderecos['idendereco'];

			$arrayUser['enderecos'][$countEnde] = array(
				'rua'			=> $row_enderecos['rua'],
				'numero'		=> $row_enderecos['numero'],
				'complemento'	=> $row_enderecos['complemento'],
				'bairro'		=> $row_enderecos['bairro'],
				'cidade'		=> $row_enderecos['cidade'],
				'estado'		=> $row_enderecos['estado'],
				'pais' 			=> $row_enderecos['pais'],
				'cep'			=> $row_enderecos['cep'],
			);
			$countEnde++;
		}

	} while($row_enderecos = mysqli_fetch_assoc($query_enderecos));

	$arrayUser['qtdEnderecos'] = $countEnde - 1;

	echo json_encode($arrayUser);

}


?>