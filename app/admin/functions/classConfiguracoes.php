<?php

header("Content-type: text/html; charset=utf-8");

class configuracoes
{
	

	private function con()
	{
		include "../user/functions/conexao.php";
		return $con; 
	}

	private function con2()
	{
		include "../../user/functions/conexao.php";
		return $con; 
	}

	public function listaVideos()
	{
		$getVideos = $this->con()->query("SELECT * FROM Videos ORDER BY CodVideo DESC");
		if(mysqli_num_rows($getVideos)){
			while ($row = $getVideos->fetch_array() ) {
				echo '
				<li id="'.$row['CodVideo'].'" class="list-group-item listaVideo'.$row['CodVideo'].'">
	                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
	                    '.$row['TituloVideo'].'
	                </div>
	                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	                    <i id="'.$row['CodVideo'].'" class="fa fa-times fa-lg removerVideo"></i>
	                </div>
	                <div style="clear: both;"></div>
	            </li>';
			}
		}else{
			echo '
			<li class="list-group-item">
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-warning text-center">
	                Nenhum vídeo cadastrado.
	            </div>
	            <div style="clear: both;"></div>
	        </li>';
		}
		
	}


	public function novoVideo($titulo,$url)
	{

		$link = substr($url, -11);
		$link_final = "https://www.youtube.com/embed/".$link;

		if($this->con2()->query("INSERT INTO Videos (TituloVideo,Url,DataEnvaiado) VALUES ('".$titulo."','".$link_final."','".date('d/m/Y')."') ")){
			$array = array('resp'=>'s');
		}else{
			$array = array('resp'=>'n');
		}

		echo json_encode($array);
	}

	public function excluirVideo($id)
	{
		if($this->con2()->query("DELETE FROM Videos WHERE CodVideo = '".$id."' ")){
			$array = array('resp'=>'s');
		}else{
			$array = array('resp'=>'n');
		}
		echo json_encode($array);
	}

	public function mostraEndereco()
	{

		$getEndereco = $this->con()->query("SELECT * FROM Configuracoes ");
		$row = $getEndereco->fetch_array();

		$tip = explode('∞', $row['Endereco']);
		echo '
		<div class="form-group">
            <label>Endereço:</label>
            <input type="text" class="form-control border-input endereco" value="'.$tip[0].'">
        </div>
        <div class="form-group">
            <label>Cidade:</label>
            <input type="text" class="form-control border-input cidade" value="'.$tip[1].'">
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Estado:</label>
                    <input type="text" class="form-control border-input estado" value="'.$tip[2].'">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>ZIPCODE:</label>
                    <input type="text" class="form-control border-input zipcode" value="'.$tip[3].'">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>País:</label>
                    <input type="text" class="form-control border-input pais" value="'.$tip[4].'">
                </div>
            </div>
        </div>
        <button class="btn btn-success btn-fill btnAtualizarEndereco col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	ATUALIZAR ENDEREÇO
        </button>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>';
	}

	public function AtualizarEndereco($endereco,$cidade,$estado,$zipcode,$pais,$id_admin)
	{
		$endereco2 = $endereco.'∞'.$cidade.'∞'.$estado.'∞'.$zipcode.'∞'.$pais;
		$getEndereco = $this->con2()->query("SELECT * FROM Configuracoes");
		if(mysqli_num_rows($getEndereco)){
			if($this->con2()->query("UPDATE Configuracoes SET Endereco = '".$endereco2."' ")){
				$array = array('resp'=>'s');
			}else{
				$array = array('resp'=>'n');
			}
		}else{
			if($this->con()->query("INSERT INTO Configuracoes (Endereco) VALUES ('".$endereco2."') ")){
				$array = array('resp'=>'s');
			}else{
				$array = array('resp'=>'n');
			}
		}
		echo json_encode($array);
	}




}

$conf = new configuracoes;

if(isset($_POST['novoVideo'])){
	$conf->novoVideo($_POST['tituloVideo'],$_POST['novoVideo']);
}

if(isset($_POST['excluirVideo'])){
	$conf->excluirVideo($_POST['excluirVideo']);
}

if(isset($_POST['AtualizarEndereco'])){
	$conf->AtualizarEndereco($_POST['endereco'],$_POST['cidade'],$_POST['estado'],$_POST['zipcode'],$_POST['pais'],$_POST['id_admin']);
}

?>