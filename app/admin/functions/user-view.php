<?

session_start();
require "../../user/functions/functions.php";

if(isset($_GET['id'])){

	$iduser = $_GET['id'];

	$sqlPesquisaUser = "SELECT * FROM users WHERE iduser = '$iduser'";
	$queryUser = mysqli_query($con, $sqlPesquisaUser);

	$row_user = mysqli_fetch_assoc($queryUser);

	if($row_user['iduser'] != ''){

		$cookie_name = 'id_user';
		$cookie_value = $row_user['iduser'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

		header("Location: ../../user/dashboard.php");
	} else {
		header("Location: ../dashboard.php");
	}

} else {
	header("Location: ../dashboard.php");
}

?>