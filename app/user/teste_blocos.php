<style type="text/css">
	
	.blocoPreco {

		border-radius: 38px;
		box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.66);
		background: linear-gradient(0deg, rgba(0, 11, 61, 0.68), rgba(0, 11, 61, 0.68)), url(https://maribelshopper.com/wp-content/uploads/2020/02/boxes.jpg);
		width: 20%;
		background-repeat: no-repeat;
		background-size: cover; 
		background-position: top center;
	}

	.blocoPreco:hover {
		background: linear-gradient(0deg, rgba(0, 84, 127, 0.68), rgba(242, 41, 91, 0.68)), url(https://maribelshopper.com/wp-content/uploads/2020/02/boxes.jpg);
		background-repeat: no-repeat;
		background-size: cover; 
		background-position: top center;
		background-color: transparent;
		
	}

	.blocoPreco .titulo{

		text-align: center; 
		color: #ffffff;	
		font-family: "Poppins", Sans-serif;
		font-size: 30px; 
		font-weight: 300; 
		text-transform: uppercase; 
		line-height: 1em;
	}

	.blocoPreco .corpo{

		text-align: center; 
		color: #ffffff;	
		font-family: Poppins, Sans-serif;	
		font-size: 15px; 
		font-weight: 300; 
		line-height: 1.8em;
	}

	p {
		display: block;
		margin-block-start: 1em;
		margin-block-end: 1em;
		margin-inline-start: 0px;
		margin-inline-end: 0px;
	}


}

</style>

<?

function get_precos(){

	//$url = 'http://'.$_SERVER['SERVER_NAME'].'/app/user/functions/consulta-preco-peso.php';
	
	$url = 'http://modelo.storesinbox.com/app/user/functions/consulta-preco-peso.php';

	$jsonPrecos = file_get_contents($url);
	$obj = json_decode($jsonPrecos, true);

	$tamanhoArray = count($obj);
	$bloco = '<div class="elementor-row">';

	for ($i=0; $i < $tamanhoArray; $i++) {

		if($obj[$i]["idpeso"] != ''){

			$bloco .= '<div class="blocoPreco">
			<div class="titulo">
			<br>
			<p style="margin: 0 0 20px;">
			De '.$obj[$i]["pesomin"].' Lbs <br>Até<br>'.$obj[$i]["pesomax"].' Lbs
			</p>
			</div>
			<div class="corpo">
			<br>
			<p>U$ '.$obj[$i]["vlrpeso"].'</p>
			<p>+</p>
			<p>Frete</p>
			<p>+</p>
			<p>Taxa de Pagamento</p>
			<p>(Se Houver)</p>
			</div>
			<div>
			<br>
			</div>
			</div>';

		}

	}
	
	$bloco .= '</div>';
	echo $bloco;
}
//add_shortcode('box_precos', 'get_precos');

get_precos();

?>