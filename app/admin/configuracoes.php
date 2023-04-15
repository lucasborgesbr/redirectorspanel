<?php 
include ("functions/functions.php");
include ("functions/classConfiguracoes.php");
?>
<html>
<head>
<head>
  <meta http-equiv='Pragma' content='no-cache'>
  <meta http-equiv='Expires' content='-1'>
  <meta http-equiv='CACHE-CONTROL' content='NO-CACHE'>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
	<link rel="icon" type="image/png" sizes="96x96" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>SIB | Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<!-- Bootstrap core CSS     -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<!-- Animation library for notifications   -->
	<link href="assets/css/animate.min.css" rel="stylesheet"/>
	<!--  Paper Dashboard core CSS    -->
	<link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="assets/css/demo.css" rel="stylesheet" />
	<!--  Fonts and icons     -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/themify-icons.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<?php include 'menu.php'; ?>
		<div class="main-panel">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar bar1"></span>
							<span class="icon-bar bar2"></span>
							<span class="icon-bar bar3"></span>
						</button>
						<a class="navbar-brand" href="#">Dashboard</a>
					</div>
					<div class="collapse navbar-collapse">
						<?php include("blocks/topbar.php"); ?>
					</div>
				</div>
			</nav>
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- card adiciona caixa -->
						<!-- card atualização de endereço -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Atualizar Endereço de Recebimento</h4>
								</div>
								<div class="content">
									<!--form method="post" action="functions/atualiza-endereco.php"-->
									<? $cookie_name = '_id_admin'; ?>
									<input type="hidden" class="id_admin" value="<?= $_COOKIE[$cookie_name]; ?>">

									<?php $conf->mostraEndereco(); ?>
									<!--/form-->
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Vídeos do Redirecionador</h4>
								</div>
								<div class="content">
									<ul class="list-group">
										<?php $conf->listaVideos(); ?>
									</ul>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-primary btn-fill addNovoVideo">Adicionar vídeo</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
								</div>
							</div>
						</div>
						<!-- ends card nova caixa -->
						<!-- card adiciona produtos -->
						<!-- ends adiciona produtos -->
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Atualizar Senha</h4><br>
								</div>
								<div class="content">
									<form method="post" action="functions/atualiza-senha.php" onsubmit="return verificasenha()">
										<div class="row">
											<div class="col-lg-6">

												<div class="form-group">
													<label>Nova Senha</label>
													<input type="password" name="nova-senha" id="nova-senha" class="form-control border-input" >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Confirma Senha</label>
													<input type="password" name="conf-senha" id="conf-senha" class="form-control border-input">
												</div>
											</div>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR SENHA</button>
										</div>
										<div class="clearfix"></div>
									</form>
								</div>
							</div>

							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Atualizar Logo</h4><br>
								</div>
								<div class="content">
									<form method="post" action="functions/atualiza-logo.php" enctype="multipart/form-data">
										<div class="row">
											<div class="col-lg-6">

												<div class="form-group">
													<label>Logomarca</label>
													<input type="file" name="logo" required class="form-control border-input">
													<small>Dê preferência para imagens .png com fundo transparente</small>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Logomarca Atual</label>
													<br>
													<img src="assets/img/logo/<?=$row_config['logo'];?>" style="border:0px; width: 250px;  height:auto; margin:auto">
												</div>
											</div>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR LOGO</button>
										</div>
										<div class="clearfix"></div>
									</form>
								</div>
							</div>

							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Taxas de Serviço de Envio</h4><br>
								</div>
								<div class="content">
									<form method="post" action="functions/atualiza-taxas-envio.php">
										<? 
										$sqlPesos = "SELECT * FROM configPesos WHERE tipoValor = 'TaxaServico' AND ativo = 1 ORDER BY pesoMin ASC";
										$queryPesos = mysqli_query($con, $sqlPesos);
										$contp = 0;

										do{	
											if($row_pesos != ''){
												?>
												<div class="row origem">
													<div class="col-lg-4">
														<input type="number" placeholder="Peso Min" name="pesoMin[]" class="form-control border-input" value="<?=$row_pesos['pesoMin'];?>" <?if($row_pesos['pesoMin'] == '0'){echo "disabled='disabled'";}?> step="0.01" min="0.00" onblur="validity.valid||(value='');" required>
														<small>Peso Inicial em lb</small>
													</div>
													<div class="col-lg-4">
														<input type="number" placeholder="Peso Max" name="pesoMax[]" class="form-control border-input" value="<?=$row_pesos['pesoMax'];?>" step="0.01" min="0.01" onblur="validity.valid||(value='');" required>
														<small>Peso Final em lb</small>
													</div>
													<div class="col-lg-3">
														<input type="number" placeholder="Valor" name="precoPeso[]" class="form-control border-input" value="<?=$row_pesos['vlrPeso'];?>" step="0.01" min="0.01" onblur="validity.valid||(value='');" required>
														<small>Preço do Intervalo</small>
													</div>
													<div class="col-lg-1">
														<a href="#" style="cursor: pointer;" onclick="removerCampos(this);" ><button type="button" class="btn btn-danger btn-sm btn-fill removerLinha"><i class="fa fa-trash"></i></button></a>
													</div>
													<br><br>
												</div>
												<? 
												$contp++;
											}
										} while ($row_pesos = mysqli_fetch_assoc($queryPesos));
										?>
										<div class="row origem" id="origem">
											<div class="col-lg-4">
												<input type="number" placeholder="Peso Min" name="pesoMin[]" class="form-control border-input" value="" <?if($row_pesos['pesoMin'] == '0'){echo "disabled='disabled'";}?> step="0.01" min="0.00" onblur="validity.valid||(value='');" >
												<small>Peso Inicial em lb</small>
											</div>
											<div class="col-lg-4">
												<input type="number" placeholder="Peso Max" name="pesoMax[]" class="form-control border-input" value="" step="0.01" min="0.01" onblur="validity.valid||(value='');" >
												<small>Peso Final em lb</small>
											</div>
											<div class="col-lg-3">
												<input type="number" placeholder="Valor" name="precoPeso[]" class="form-control border-input" value="" step="0.01" min="0.01" onblur="validity.valid||(value='');" >
												<small>Preço do Intervalo</small>
											</div>
											<div class="col-lg-1">
												<a href="#" style="cursor: pointer;" onclick="removerCampos(this);" ><button type="button" class="btn btn-danger btn-sm btn-fill removerLinha"><i class="fa fa-trash"></i></button></a>
											</div>
											<br><br>
										</div>
										<div id="destino"></div>
										<br>
										<a href="#" style="cursor: pointer;" onclick="duplicarCampos('P');"><button type="button" class="btn btn-success btn-sm btn-fill"><i class="fa fa-plus"></i> Adicionar mais campos</button> </a>
										<br><br>
										<div class="text-center">
											<button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR PREÇOS</button>
										</div>
										<div class="clearfix"></div>
									</form>
								</div>
							</div>

							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Serviços Extras dos Envios</h4><br>
								</div>
								<div class="content">
									<form method="post" action="functions/atualiza-servicos-extras.php">
										<? 
										$sqlServicosExtras = "SELECT * FROM configServicosExtras WHERE ativo = 1 ORDER BY vlrServico ASC";
										$queryServicosExtras = mysqli_query($con, $sqlServicosExtras);
										
										do{	
											if($row_servicosExtras != ''){
												?>
												<div class="row origem origemExtras">
													<div class="col-lg-7">
														<input type="text" placeholder="Ex: Plastico Bolha" name="descServ[]" class="form-control border-input" value="<?=$row_servicosExtras['descServico']?>">
														<small>Descrição do Serviço</small>
													</div>
													<div class="col-lg-4">
														<input type="number" placeholder="Valor" name="precoPeso[]" class="form-control border-input" value="<?=$row_servicosExtras['vlrServico']?>" step="0.01"  onblur="validity.valid||(value='');" >
														<small>Preço do Serviço Extra</small>
													</div>
													<div class="col-lg-1">
														<a href="#" style="cursor: pointer;" onclick="removerCampos(this);" ><button type="button" class="btn btn-danger btn-sm btn-fill removerLinha"><i class="fa fa-trash"></i></button></a>
													</div>
													<br><br>
												</div>
												<? 
											}
										} while ($row_servicosExtras = mysqli_fetch_assoc($queryServicosExtras));
										?>
										<div class="row origem origemExtras" id="origemExtras">
											<div class="col-lg-7">
												<input type="text" placeholder="Ex: Plastico Bolha" name="descServ[]" class="form-control border-input" value="">
												<small>Descrição do Serviço</small>
											</div>
											<div class="col-lg-4">
												<input type="number" placeholder="Valor" name="precoPeso[]" class="form-control border-input" value="" step="0.01" onblur="validity.valid||(value='');" >
												<small>Preço do Serviço Extra</small>
											</div>
											<div class="col-lg-1">
												<a href="#" style="cursor: pointer;" onclick="removerCampos(this);" ><button type="button" class="btn btn-danger btn-sm btn-fill removerLinha"><i class="fa fa-trash"></i></button></a>
											</div>
											<br><br>
										</div>
										<div id="destinoExtras"></div>
										<br>
										<a href="#" style="cursor: pointer;" onclick="duplicarCampos('SE');"><button type="button" class="btn btn-success btn-sm btn-fill"><i class="fa fa-plus"></i> Adicionar mais campos</button> </a>
										<br><br>
										<div class="text-center">
											<button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR SERVIÇOS EXTRAS</button>
										</div>
										<div class="clearfix"></div>
									</form>
								</div>
							</div>

						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Formas de Pagamento do Sistema</h4><br>
								</div>
								<div class="content">
									<form method="post" action="functions/atualiza-formas-pagamento.php">
										<?

										$sqlPaypal = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'Paypal'";
										$queryPaypal = mysqli_query($con, $sqlPaypal);
										$row_paypal = mysqli_fetch_assoc($queryPaypal);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="Paypal-ativo" name="Paypal-ativo" <?if($row_paypal['ativo']=='1'){echo "checked";}?>>
													<label class="custom-control-label" for="Paypal-ativo">Paypal</label>
												</div>
												
											</div>
										</div>
										<div class="row" id="FP-Paypal">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Client ID</label>
													<input type="text" name="Paypal-Client-ID" class="form-control border-input" value="<?=$row_paypal['key1'];?>">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Secret ID</label>
													<input type="text" name="Paypal-Secret-ID" class="form-control border-input" value="<?=$row_paypal['key2'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>Taxa %</label>
													<input type="number" step="0.01" min="0.00" onblur="validity.valid||(value='');" name="Paypal-taxa" class="form-control border-input" value="<?=$row_paypal['taxa'];?>">
												</div>
											</div>
										</div>
										<!-- FIM PAYPAL -->
										<!-- INICIO PAYPAL.ME-->
										<?

										$sqlPaypalME = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'Paypal.me'";
										$queryPaypalME = mysqli_query($con, $sqlPaypalME);
										$row_paypalME = mysqli_fetch_assoc($queryPaypalME);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="PaypalME-ativo" name="PaypalME-ativo" <?if($row_paypalME['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="PaypalME-ativo">Paypal.me</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-PaypalME">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-5">
												<div class="form-group">
													<label>Nome da Conta</label>
													<input type="text" name="PaypalME-Account" class="form-control border-input" value="<?=$row_paypalME['key1'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>Taxa %</label>
													<input type="number" step="0.01" min="0.00" onblur="validity.valid||(value='');" name="PaypalME-taxa" class="form-control border-input" value="<?=$row_paypalME['taxa'];?>">
												</div>
											</div>
										</div>
										<!-- FIM PAYPAL.ME -->
										<!-- INICIO Ebanx -->
										<?

										$sqlEbanx = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'Ebanx'";
										$queryEbanx = mysqli_query($con, $sqlEbanx);
										$row_ebanx = mysqli_fetch_assoc($queryEbanx);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="Ebanx-ativo" name="Ebanx-ativo" <?if($row_ebanx['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="Ebanx-ativo">Ebanx</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-Ebanx">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-5">
												<div class="form-group">
													<label>API Key</label>
													<input type="text" name="Ebanx-API" class="form-control border-input" value="<?=$row_ebanx['key1'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>Taxa %</label>
													<input type="number" step="0.01" min="0.00" onblur="validity.valid||(value='');" name="Ebanx-taxa" class="form-control border-input" value="<?=$row_ebanx['taxa'];?>">
												</div>
											</div>
										</div>
										<!-- FIM Ebanx -->
										<!-- INICIO ParceladoUSA -->
										<?

										$sqlParceladoUSA = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'ParceladoUSA'";
										$queryParceladoUSA = mysqli_query($con, $sqlParceladoUSA);
										$row_ParceladoUSA = mysqli_fetch_assoc($queryParceladoUSA);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="ParceladoUSA-ativo" name="ParceladoUSA-ativo" <?if($row_ParceladoUSA['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="ParceladoUSA-ativo">ParceladoUSA</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-ParceladoUSA">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-5">
												<div class="form-group">
													<label>Publick Key</label>
													<input type="text" name="ParceladoUSA-Publickey" class="form-control border-input" value="<?=$row_ParceladoUSA['key1'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>Taxa %</label>
													<input type="number" step="0.01" min="0.00" onblur="validity.valid||(value='');" name="ParceladoUSA-taxa" class="form-control border-input" value="<?=$row_ParceladoUSA['taxa'];?>">
												</div>
											</div>
										</div>
										<!-- FIM ParceladoUSA -->
										<!-- INICIO CambioReal -->
										<?

										$sqlCambioReal = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'CambioReal'";
										$queryCambioReal = mysqli_query($con, $sqlCambioReal);
										$row_cambioreal = mysqli_fetch_assoc($queryCambioReal);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="CambioReal-ativo" name="CambioReal-ativo" <?if($row_cambioreal['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="CambioReal-ativo">CambioReal</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-CambioReal">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>APP ID - Live</label>
													<input type="text" name="CR-App-ID-Live" class="form-control border-input" value="<?=$row_cambioreal['key1'];?>">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>APP Secret - Live</label>
													<input type="text" name="CR-App-Secret-Live" class="form-control border-input" value="<?=$row_cambioreal['key2'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>Taxa %</label>
													<input type="number" step="0.01" min="0.00" onblur="validity.valid||(value='');" name="CR-taxa" class="form-control border-input" value="<?=$row_cambioreal['taxa'];?>">
												</div>
											</div>
										</div>
										<!-- FIM CambioReal -->
										<?

										$sqlWesternUnion = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'WesternUnion'";
										$queryWesternUnion = mysqli_query($con, $sqlWesternUnion);
										$row_westernunion = mysqli_fetch_assoc($queryWesternUnion);

										$tip = explode('∞', $row_westernunion['key1']);
										?>
										<!-- INICIO WesternUnion -->
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="WesternUnion-ativo" name="WesternUnion-ativo" <?if($row_westernunion['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="WesternUnion-ativo">WesternUnion</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-WesternUnion">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Nome Completo</label>
													<input type="text" name="WU-nome" class="form-control border-input" value="<?=$tip['0'];?>">
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Cidade</label>
													<input type="text" name="WU-cidade" class="form-control border-input" value="<?=$tip['1'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>Estado</label>
													<input type="text" name="WU-estado" class="form-control border-input" value="<?=$tip['2'];?>">
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<label>País</label>
													<input type="text" name="WU-pais" class="form-control border-input" value="<?=$tip['3'];?>">
												</div>
											</div>
										</div>
										<!-- FIM WesternUnion -->
										<!-- INICIO TransferWise -->
										<?

										$sqlTransferWise = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'TransferWise'";
										$queryTransferWise = mysqli_query($con, $sqlTransferWise);
										$row_transferwise = mysqli_fetch_assoc($queryTransferWise);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="TransferWise-ativo" name="TransferWise-ativo" <?if($row_transferwise['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="TransferWise-ativo">TransferWise</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-TransferWise">
											<div class="col-lg-2">
											</div>
											<div class="col-lg-5">
												<div class="form-group">
													<label>Email TransferWise</label>
													<input type="text" name="TW-email" class="form-control border-input" value="<?=$row_transferwise['key1'];?>">
												</div>
											</div>
										</div>
										<!-- FIM TransferWise -->
										<!-- INICIO Transferência Bancaria  -->
										<?

										$sqlTransferencia = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'Transferencia'";
										$queryTransferencia = mysqli_query($con, $sqlTransferencia);
										$row_transferencia = mysqli_fetch_assoc($queryTransferencia);

										$tip = explode('∞', $row_transferencia['key1']);
										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="Transferencia-ativo" name="Transferencia-ativo" <?if($row_transferencia['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="Transferencia-ativo">Transferência Bancaria</label>
												</div>
											</div>
										</div>
										<div class="row" id="FP-Transferencia">
											<div class="col-lg-3">
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Banco</label>
													<input type="text" name="TB-banco" class="form-control border-input" value="<?=$tip['0'];?>">
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Agencia</label>
													<input type="text" name="TB-agencia" class="form-control border-input" value="<?=$tip['1'];?>">
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Conta</label>
													<input type="text" name="TB-conta" class="form-control border-input" value="<?=$tip['2'];?>">
												</div>
											</div>
											<div class="col-lg-3">
											</div>
											<div class="col-lg-5">
												<div class="form-group">
													<label>Nome Completo</label>
													<input type="text" name="TB-nome" class="form-control border-input" value="<?=$tip['3'];?>">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>CPF</label>
													<input type="text" name="TB-cpf" class="form-control border-input" value="<?=$tip['4'];?>">
												</div>
											</div>
										</div>
										<!-- FIM Transferência Bancaria -->
										<!-- INICIO Pagamento Local  -->
										<?

										$sqlPgtLocal = "SELECT * FROM configFormaPagamentos WHERE TipoPagamento = 'Pagamento no Local'";
										$queryPgtLocal = mysqli_query($con, $sqlPgtLocal);
										$row_PgtLocal = mysqli_fetch_assoc($queryPgtLocal);

										?>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="PgtLocal-ativo" name="PgtLocal-ativo" <?if($row_PgtLocal['ativo']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="PgtLocal-ativo">Pagamento no Local</label>
												</div>
											</div>
										</div>
										<!-- FIM Pagamento Local -->
										<br>
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<button type="submit" class="btn btn-success btn-fill btn-wd col-lg-12 col-md-12 col-sm-12 col-xs-12">ATUALIZAR FORMAS DE PAGAMENTO</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>

							<div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="header">
									<h4 class="title">Configurações Adicionais</h4><br>
								</div>
								<div class="content">
									<form method="post" action="functions/atualiza-config-add.php">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="Cotacao-ativo" name="Cotacao-ativo" <?if($row_config['cotacao']=='1'){echo "checked";}?>>
													<label class="form-check-label" for="Cotacao-ativo">Mostrar Cotação do Dólar para Usuários</label>
												</div>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<button type="submit" class="btn btn-success btn-fill btn-wd col-lg-12 col-md-12 col-sm-12 col-xs-12">ATUALIZAR CONFIGURAÇÕES ADICIONAIS</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>


						</div>
					</div>
				</div>              
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright pull-right">
						<? include ("blocks/footer.php"); ?>
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.addNovoVideo').click(function(){
			$('#modalNovoVideo').modal('show');
		});

		$('.btnSalvaUrlVideo').click(function(){
			var url         = $('.urlVideo').val();
			var tituloVideo = $('.tituloVideo').val();

			if(url == ''){
			}else{
				$.ajax({
					url: 'functions/classConfiguracoes.php',
					type: 'POST',
					data: {
						novoVideo   : url,
						tituloVideo : tituloVideo
					},
				})
				.done(function(xhr) {
					console.log(xhr);
					var obj = $.parseJSON(xhr);
					if(obj.resp == 's'){
						$('.recebeRespostaVideo').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-success text-center">Vídeo gravado com sucesso!</div>');
						setTimeout(function(){
							location.href = 'configuracoes.php';
						}, 3000);
					}else{
						$('.recebeRespostaVideo').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger text-center">Erro ao grava novo vídeo!</div>');
						setTimeout(function(){
							$('.recebeRespostaVideo').html('');
						}, 3000);
					}
				})
				.fail(function() {
					$('.recebeRespostaVideo').html('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-danger text-center">Erro ao grava novo vídeo!</div>');
					setTimeout(function(){
						$('.recebeRespostaVideo').html('');
					}, 3000);
				});
			} 
		});
		$('.removerVideo').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: 'functions/classConfiguracoes.php',
				type: 'POST',
				data: {
					excluirVideo: id
				},
			})
			.done(function(xhr) {
				console.log(xhr);
				var obj = $.parseJSON(xhr);
				if(obj.resp == 's'){
					$('.listaVideo'+id).slideUp();
				}else{
				}
			})
			.fail(function() {
			});
		});
		$('.btnAtualizarEndereco').click(function(){
			$('.btnAtualizarEndereco').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center loadAtualizaEndereco"><i class="fa fa-spin fa-spinner fa-lg"></i></div>');
			var endereco = $('.endereco').val();
			var cidade   = $('.cidade').val();
			var estado   = $('.estado').val();
			var zipcode  = $('.zipcode').val();
			var pais     = $('.pais').val();
			var id_admin = $('.id_admin').val();
			console.log(id_admin);
			function campoBranco(campo) {
				$('.btnAtualizarEndereco').before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alertCampoBranco alert alert-danger text-center">O campo '+campo+' não pode ser vazio!</div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alertCampoBranco">&nbsp;</div>');
				setTimeout(function(){
					$('.alertCampoBranco').remove();
					$('.loadAtualizaEndereco').remove();
					$('.btnAtualizarEndereco').fadeIn();
				}, 3000);
			}
			if(endereco == ''){
				campoBranco('Endereço');
			}else if(cidade == ''){
				campoBranco('Cidade');
			}else if(estado == ''){
				campoBranco('Estado');
			}else if(zipcode == ''){
				campoBranco('Zipcode');
			}else if(pais == ''){
				campoBranco('Pais');
			}else{
				$.ajax({
					url: 'functions/classConfiguracoes.php',
					type: 'POST',
					data: {
						AtualizarEndereco: '',
						endereco :endereco,
						cidade   :cidade,
						estado   :estado,
						zipcode  :zipcode,
						pais     :pais
					},
				})
				.done(function(xhr) {
					console.log(xhr);
					var obj = $.parseJSON(xhr);
					if(obj.resp == 's'){
						$('.btnAtualizarEndereco').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center alert alert-success">Endereco atualizado com sucesso!</div>');
						setTimeout(function(){
							location.href = 'configuracoes.php';
						}, 3000);
					}else{
						$('.btnAtualizarEndereco').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center alert alert-danger ErroAtualizaEndereco">Erro ao atualizar endereço!</div>');
						setTimeout(function(){
							$('.ErroAtualizaEndereco').remove();
							$('.btnAtualizarEndereco').fadeIn();
						}, 3000);    
					}
				})
				.fail(function() {
					$('.btnAtualizarEndereco').hide().before('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center alert alert-danger ErroAtualizaEndereco">Erro ao atualizar endereço!</div>');
					setTimeout(function(){
						$('.ErroAtualizaEndereco').remove();
						$('.btnAtualizarEndereco').fadeIn();
					}, 3000);
				});
			}
		});
	});


<?
if($row_paypal['ativo'] == '1'){
	echo "$('#FP-Paypal').show();";
} else {
	echo "$('#FP-Paypal').hide();";
}
?>
<?
if($row_paypalME['ativo'] == '1'){
	echo "$('#FP-PaypalME').show();";
} else {
	echo "$('#FP-PaypalME').hide();";
}
?>
<?
if($row_ebanx['ativo'] == '1'){
	echo "$('#FP-Ebanx').show();";
} else {
	echo "$('#FP-Ebanx').hide();";
}
?>
<?
if($row_cambioreal['ativo'] == '1'){
	echo "$('#FP-CambioReal').show();";
} else {
	echo "$('#FP-CambioReal').hide();";
}
?>

<?
if($row_westernunion['ativo'] == '1'){
	echo "$('#FP-WesternUnion').show();";
} else {
	echo "$('#FP-WesternUnion').hide();";
}
?>

<?
if($row_transferwise['ativo'] == '1'){
	echo "$('#FP-TransferWise').show();";
} else {
	echo "$('#FP-TransferWise').hide();";
}
?>

<?
if($row_transferencia['ativo'] == '1'){
	echo "$('#FP-Transferencia').show();";
} else {
	echo "$('#FP-Transferencia').hide();";
}
?>

<?
if($row_ParceladoUSA['ativo'] == '1'){
	echo "$('#FP-ParceladoUSA').show();";
} else {
	echo "$('#FP-ParceladoUSA').hide();";
}
?>


$('#Paypal-ativo').click(function(){
	$('#FP-Paypal').toggle();
});

$('#PaypalME-ativo').click(function(){
	$('#FP-PaypalME').toggle();
});

$('#Ebanx-ativo').click(function(){
	$('#FP-Ebanx').toggle();
});

$('#CambioReal-ativo').click(function(){
	$('#FP-CambioReal').toggle();
});

$('#WesternUnion-ativo').click(function(){
	$('#FP-WesternUnion').toggle();
});

$('#TransferWise-ativo').click(function(){
	$('#FP-TransferWise').toggle();
});

$('#Transferencia-ativo').click(function(){
	$('#FP-Transferencia').toggle();
});

$('#ParceladoUSA-ativo').click(function(){
	$('#FP-ParceladoUSA').toggle();
});
</script>

<script type="text/javascript">
	function duplicarCampos(tipo){

		if(tipo == 'SE'){

			var clone = document.getElementById('origemExtras').cloneNode(true);
			var destino = document.getElementById('destinoExtras');
			destino.appendChild (clone);
			var camposClonados = clone.getElementsByTagName('input');
			for(i=0; i<camposClonados.length;i++){
				camposClonados[i].value = '';
			}

		}

		if(tipo == 'P'){

			var clone = document.getElementById('origem').cloneNode(true);
			var destino = document.getElementById('destino');
			destino.appendChild (clone);
			var camposClonados = clone.getElementsByTagName('input');
			for(i=0; i<camposClonados.length;i++){
				camposClonados[i].value = '';
			}

		}

		
	}
	function removerCampos(id){
		var count = $(".origem").length;
		
		if(count > 1){
			id.closest(".origem").remove();
		}

	}
</script>

<div id="modalNovoVideo" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Novo video</h4>
			</div>
			<div class="modal-body">
				<div class="recebeRespostaVideo"></div>
				<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<span >Titulo</span>
					<input type="text" class="form-control tituloVideo" style="border-radius:5px; border:#ccc solid 1px; background: #ddd;">
				</div>
				Adicione um link do youtube com o ID do vídeo no final do link. <br> Ex: https://www.youtube.com/watch?v=ID_VIDEO ou https://youtu.be/ID_VIDEO
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
				<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<span >URL</span>
					<input type="text" class="form-control urlVideo" style="border-radius:5px; border:#ccc solid 1px; background: #ddd;" value="https://youtu.be/">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-fill btnSalvaUrlVideo">Salvar</button>
			</div>
		</div>
	</div>
</div>
</html>
