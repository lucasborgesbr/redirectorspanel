<? 

function deleteDir($dirPath) {
	if (! is_dir($dirPath)) {
		throw new InvalidArgumentException("$dirPath must be a directory");
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		$dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) {
		if (is_dir($file)) {
			deleteDir($file);
		} else {
			unlink($file);
		}
	}
	rmdir($dirPath);
}

function restoreMysqlDB($filePath, $conn)
{
	$sql = '';
	$error = '';

	if (file_exists($filePath)) {
		$lines = file($filePath);

		foreach ($lines as $line) {

			if (substr($line, 0, 2) == '--' || $line == '') {
				continue;
			}

			$sql .= $line;

			if (substr(trim($line), - 1, 1) == ';') {
				$result = mysqli_query($conn, $sql);
				if (! $result) {
					$error .= mysqli_error($conn) . "\n";
				}
				$sql = '';
			}
		}

		if ($error) {
			$response = array(
				"type" => "error",
				"message" => $error
			);
		} else {
			$response = array(
				"type" => "success",
				"message" => "Database Restore Completed Successfully."
			);
		}
	} 
	return $response;
}

if($_POST){

	$nomeEmpresa = $_POST['nomeEmpresa'];
	$nomeAdmin = $_POST['nomeAdmin'];
	$emailAdmin = $_POST['emailAdmin'];
	$senhaAdmin = md5($_POST['senhaAdmin']);
	$senhaCrua = $_POST['senhaAdmin'];



	require_once realpath( dirname(__FILE__) . '/vendor/autoload.php');


	//ssh://storesinbox@192.185.104.91/home2/storesinbox/cpanel3-skel/public_html
	$cpanel = new \Gufy\CpanelPhp\Cpanel([
      'host'        =>  'https://sens.websitewelcome.com:2087', // required
      'username'    =>  'storesinbox', // required
      'auth_type'   =>  'password', // optional, default 'hash'
      'password'    =>  'vXkYGirl11x1wPP', // required
  ]);


	
	if(substr($_SERVER['SERVER_NAME'], 0, 4) == "www."){
		$dominioAtual = substr($_SERVER['SERVER_NAME'], 4);
	} else {
		$dominioAtual = $_SERVER['SERVER_NAME'];
	}


	$accounts = $cpanel->listaccts([
		'searchtype'	=>	'domain', 
		'searchmethod'	=>	'exact', 
		'search'		=>	$dominioAtual
	//	'search'		=>	'solutionsbox.com.br'
	]); 

	if(sizeof($accounts['acct']) >= 1){

		$userCpanel = $accounts['acct'][0]['user'];
		$domainCpanel = $accounts['acct'][0]['domain'];
		$planoCpenal = $accounts['acct'][0]['plan'];

		$nomeDB = substr($userCpanel, 0, 8)."_app";
		$userDB = substr($userCpanel, 0, 8)."_appUser";
		$senhaDB = substr(md5(uniqid(rand(), true)), 0, 15);
		$existeBase = 0;

		/** Incluindo Informações na Base de Instancias **/
		
		$instanciaIP = $_SERVER['SERVER_ADDR'];
		
		$conInstancias = mysqli_connect("localhost", "solution_fin", "Ugmd9YKiwLTz5qj", "solution_instancias");
		
		$insertIntancia = "INSERT INTO instancias (ip, user, senha, nomeDB, ativo) VALUES ('$instanciaIP','$userDB','$senhaDB','$nomeDB', '1')";

		$querysqlInstancias = mysqli_query($conInstancias, $insertIntancia);

		mysqli_close($conInstancias);

		/** Criação do Email de Contato **/

		$emailContato = 'contato@'.$dominioAtual;
		$senhaEmail = substr(md5(uniqid(rand(), true)), 0, 20);

		$criarEmailContato = $cpanel->execute_action('3', 'Email', 'add_pop', $userCpanel, array(
			'email'     		=> 'contato',
			'password'			=> $senhaEmail,
			'quota'				=> 'unlimited',
			'domain'			=> $dominioAtual,
			'skip_update_db'	=> '1',
			'send_welcome_email'=> '1'

		));


		/** Verifica se Base já Existe para a conta **/
		$ListaBases = $cpanel->execute_action('3', 'Mysql', 'list_databases', $userCpanel);

		$numeroDeBases = sizeof($ListaBases['result']['data']);

		for ($i=0; $i <= $numeroDeBases; $i++) { 
			if($ListaBases['result']['data'][$i]['database'] == $nomeDB){
				$existeBase = 1;
			}
		}

		/** Criação da Base de Dados para o conta **/

		if($existeBase == 1){
			echo "Base já Existente! .... <br><br>";
		} else {
			$CriarBase = $cpanel->execute_action('3', 'Mysql', 'create_database', $userCpanel, array('name' => $nomeDB));
		}


		/** Criação de Usuário e Senha e Permissões **/

		$criaUsuarioDB = $cpanel->execute_action('3', 'Mysql', 'create_user', $userCpanel, array(
			'name'       => $userDB,
			'password'   => $senhaDB
		));

		$cpanel->execute_action('3', 'Mysql', 'set_privileges_on_database', $userCpanel, array(
			'user'       => $userDB,
			'database'   => $nomeDB,
			'privileges' => 'ALL PRIVILEGES'
		));

		/** Criando CronJob do ParceladoUSA **/

		$cpanel->execute_action('2', 'Cron', 'add_line', $userCpanel, array(

			'command'        => '/usr/local/bin/php '.substr(getcwd(), 0, -8).'/app/user/functions/valida-parceladoUSA.php',
			'day'            => '*',
			'hour'           => '*',
			'minute'         => '0,30',
			'month'          => '*',
			'weekday'        => '*',
		));

		/** Recupera arquivo de conexao **/

		$conexao = file_get_contents(__DIR__ . '/../app/user/functions/conexao2.php');

		/** Editar Usuario DB **/

		$conexao = str_replace("__userDB", $userDB, $conexao);
		$conexao = str_replace("__senhaDB", $senhaDB, $conexao);
		$conexao = str_replace("__database", $nomeDB, $conexao);

		$novaConexao = file_put_contents(__DIR__ . '/../app/user/functions/conexao.php', $conexao);

		/** Deploy do Primeiro SQL - Populando Base de Dados **/

		$conn = mysqli_connect("localhost", $userDB, $senhaDB, $nomeDB);

		if ($conn) {

			$linkSistema = 'http://www.'.$dominioAtual;

			$sqlFile = file_get_contents(__DIR__ . '/database.sql');

			$sqlFile = str_replace("__nomeEmpresa", $nomeEmpresa, $sqlFile);
			$sqlFile = str_replace("__nomeAdmin", $nomeAdmin, $sqlFile);
			$sqlFile = str_replace("__emailAdmin", $emailAdmin, $sqlFile);
			$sqlFile = str_replace("__senhaAdmin", $senhaAdmin, $sqlFile);
			$sqlFile = str_replace("__emailContato", $emailContato, $sqlFile);
			$sqlFile = str_replace("__linkSistema", $linkSistema, $sqlFile);

			$novoSQL = file_put_contents(__DIR__ . '/database_full.sql', $sqlFile);

			$fileRestore = __DIR__ . "/database_full.sql";

			$response = restoreMysqlDB($fileRestore, $conn);
			
			
			if($response){

				deleteDir(__DIR__);
			}

			echo '
			<script>
			alert("O Setup foi realizado com Sucesso! \n\nDados para Acesso:\n\nLogin: '.$emailAdmin.'\nSenha: '.$senhaCrua.'");
			window.location.href = "'.$linkSistema.'/app/admin/";
			</script>
			';

		}



	} else {

		echo "Desculpe, mas não foi possivel fazer a configuração automática do seu sistema!<br><br>
		O Endereço <strong>".$dominioAtual."</strong> não está cadastrado no sistema Solutionsbox";

	}

} else {
	echo "Essa pagina não pode ser acessada diretamente!";
}
?>