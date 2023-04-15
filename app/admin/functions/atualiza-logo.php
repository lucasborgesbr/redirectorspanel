<?

session_start();
require "../../user/functions/conexao.php";


function compress($source, $destination, $quality) {
	if (function_exists('exif_read_data')) {
		$exif = exif_read_data($source);
		if($exif && isset($exif['Orientation'])) {
			try{
				$orientation = $exif['Orientation'];
				if($orientation != 1){
					$info = getimagesize($source);

					if ($info['mime'] == 'image/jpeg') { 
						$image = imagecreatefromjpeg($source);

					} else if ($info['mime'] == 'image/gif'){
						$image = imagecreatefromgif($source);

					} else if ($info['mime'] == 'image/png') {
						$image = imagecreatefrompng($source);

					}
					$deg = 0;
					switch ($orientation) {
						case 3:
						$deg = 180;
						break;
						case 6:
						$deg = 270;
						break;
						case 8:
						$deg = 90;
						break;
					}
					if ($deg) {
						$image = imagerotate($image, $deg, 0);        
					}

					imagejpeg($image, $destination, $quality);

				} else {

					$info = getimagesize($source);

					if ($info['mime'] == 'image/jpeg') { 
						$image = imagecreatefromjpeg($source);

					} else if ($info['mime'] == 'image/gif'){
						$image = imagecreatefromgif($source);

					} else if ($info['mime'] == 'image/png') {
						$image = imagecreatefrompng($source);

					}

					imagejpeg($image, $destination, $quality);

				}
			} catch (Exception $ex) {

				$info = getimagesize($source);

				if ($info['mime'] == 'image/jpeg') { 
					$image = imagecreatefromjpeg($source);

				} else if ($info['mime'] == 'image/gif'){
					$image = imagecreatefromgif($source);

				} else if ($info['mime'] == 'image/png') {
					$image = imagecreatefrompng($source);

				}

				imagejpeg($image, $destination, $quality);

			}
		} else {

			$info = getimagesize($source);

			if ($info['mime'] == 'image/jpeg') { 
				$image = imagecreatefromjpeg($source);

			} else if ($info['mime'] == 'image/gif'){
				$image = imagecreatefromgif($source);

			} else if ($info['mime'] == 'image/png') {
				$image = imagecreatefrompng($source);

			}

			imagejpeg($image, $destination, $quality);
		} 
	} else {

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') { 
			$image = imagecreatefromjpeg($source);

		} else if ($info['mime'] == 'image/gif'){
			$image = imagecreatefromgif($source);

		} else if ($info['mime'] == 'image/png') {
			$image = imagecreatefrompng($source);

		}

		imagejpeg($image, $destination, $quality);
	} 
}

$diretorio = "../assets/img/logo/";


if ($_FILES['logo']['name'] != "") {
	$file_name = "_logo_".basename($_FILES['logo']['tmp_name'].'.jpg'); 


	$sql_img1 = "SELECT * FROM Configuracoes WHERE logo = '$file_name'";
	$q1 = mysqli_query($con, $sql_img1);
	
	$uploadfile = $diretorio.$file_name;
	$file = $file_name;
	move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile);
	//@compress($_FILES['logo']['tmp_name'], $uploadfile, 30);

	$sqlUpdate = "UPDATE Configuracoes SET logo = '$file_name'";
	$query_sqlUpdate = mysqli_query ($con, $sqlUpdate) or die(mysqli_error($con));

}

header("Location: ../configuracoes.php");


?>