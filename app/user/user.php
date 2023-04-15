<?php 
require ("functions/functions.php");
?>
<!doctype html>
<html lang="en">
<head>
    <head>
      <meta http-equiv='Pragma' content='no-cache'>
      <meta http-equiv='Expires' content='-1'>
      <meta http-equiv='CACHE-CONTROL' content='NO-CACHE'>
      <meta charset="utf-8" />
      <link rel="apple-touch-icon" sizes="76x76" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
      <link rel="icon" type="image/png" sizes="96x96" href="https://solutionsbox.com.br/wp-content/uploads/2020/04/sb_thumb-e1587685067849.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>SIB | Minha Conta</title>
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
                    <a class="navbar-brand" href="#">Minha Conta</a>
                </div>
                <div class="collapse navbar-collapse">
                    <? include 'blocks/menu-flutuante.php'; ?>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div >

                        <!--div class="card">
                            <div class="content">
                                <?php if (isset($_GET['ok'])): ?>
                                    <div class="alert alert-success text-center" id="alert-success">
                                  <span><a href="#" onclick="sumirsuccess()" class="pull-right"><i class="fa fa-close" style="color:#fff;"></i></a></span>
                                  Parabéns! Seu arquivo foi enviado com sucesso.
                                </div>
                                <?php endif ?>
                                <?php if (isset($_GET['nope'])): ?>
                                    <div class="alert alert-danger text-center" id="alert-danger">
                                  <span><a href="#" onclick="sumirdanger()" class="pull-right"><i class="fa fa-close" style="color: #fff;"></i></a></span>
                                  Ops! Seu arquivo é maior que o limite ou a extensão não é permitida.
                                </div>
                                <?php endif ?>
                                <-div class="header">
                                    <h4 class="title text-center">Verificação de Conta <?php if ($row_user['status'] == "new"): ?>
                                      <span class="badge badge-danger" style="background: #F00; padding:7px 10px;">Conta Não Verificada</span><br>
                                  <?php endif ?>
                                  <?php if ($row_user['status'] == "ativo"): ?>
                                      <span class="badge badge-danger" style="background: #090; padding:7px 10px;">Conta Verificada</span><br>
                                  <?php endif ?></h4>
                                </div>
                                <br>
                                <p>Se sua conta ainda não foi verificada você terá algumas restrições no uso de nossos serviços. Portanto, verifique sua conta enviando os seguintes documentos:</p><br>
                                <ul>
                                    <li>RG, CPF ou CNH com ambos os números</li>
                                    <li>Comprovante de endereço (conta de luz, água, telefone, etc.)</li>
                                    <li>Formulário 1583 da USPS (correios americanos), preencha online <a href="https://about.usps.com/forms/ps1583.pdf" target="_blank">aqui</a> e salve como pdf.</li>
                                </ul>
                                <p>OBS: Os arquivos não devem ser maiores que 200KB e serão aceitos apenas as extensões PNG, JPG e PDF.</p>
                                <div class="text-center">
                                    <form method="post" enctype="multipart/form-data" action="functions/acrescenta-doc.php">
                                    <label class="btn btn-fill btn-wd btn-success btn-file">
                                        CARREGAR DOCUMENTO <input type="file" name="doc" style="display: none;">
                                    </label><br>
                                    <button type="submit" class="btn btn-fill btn-wd btn-success">ENVIAR</button>
                                </form>
                                </div>
                            </div>
                        </div-->
                        <div class="col-lg-4 col-md-5">
                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="content">
                                    <form method="post" action="functions/atualiza-senha.php">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <h4 class="title">Atualização de Senha</h4><br>
                                                <div class="form-group">
                                                    <label>Nova Senha</label>
                                                    <input type="password" name="nova-senha" class="form-control border-input" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirma Senha</label>
                                                    <input type="password" name="conf-senha" class="form-control border-input" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-8 col-md-7">
                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header">
                                    <h4 class="title">Dados Pessoais</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="functions/atualiza-dados.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Imagem</label>
                                                    <input type="file" name="avatar" class="form-control border-input" placeholder="Imagem">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control border-input" placeholder="Nome" name="nome" value="<?=$row_user['nome']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sobrenome</label>
                                                    <input type="text" class="form-control border-input" placeholder="Sobrenome" name="sobrenome" value="<?=$row_user['sobrenome'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Telefone/WhatsApp</label>
                                                    <input type="phone" class="form-control border-input" placeholder="(55) 5555-5555" name="telefone" value="<?=$row_user['telefone']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control border-input" placeholder="meu@email.com" name="email" value="<?=$row_user['email']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>CPF <a href="#" data-toggle="tooltip" title="Conforme resolução da Receita Federal, apartir de 1º de Janeiro de 2020, todas as encomendas internacionais devem conter o CPF do destinatário"><i class="fa fa-question-circle"></i></a></label>
                                                    <input type="text" id="cpf" name="cpf" class="form-control border-input MaskCPF" placeholder="000.000.000-00" name="cpf" value="<?=$row_user['cpf']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-fill btn-wd">ATUALIZAR</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>

                        <!-- card mostra enderecos -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header">
                                    <h4 class="title">Endereços Cadastrados</h4>
                                </div>
                                <div class="content">
                                    <?php if ($row_endereco['idendereco'] != ""){ ?>
                                        <div class="table-responsive">
                                            <table class="table">

                                                <tr>
                                                    <th>Endereço</th>
                                                    <th class="hidden-xs hidden-sm">Bairro</th>
                                                    <th class="hidden-xs hidden-sm">Complemento</th>
                                                    <th class="hidden-xs hidden-sm">Cidade/Estado</th>
                                                    <th class="hidden-xs hidden-sm">País</th>
                                                    <th class="hidden-xs hidden-sm">CEP</th>
                                                    <th></th>
                                                </tr>
                                                <? do{ ?>
                                                    <tr>
                                                        <td><?=$row_endereco['rua'].", ".$row_endereco['numero'] ; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?=$row_endereco['bairro']; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?=$row_endereco['complemento']; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?=$row_endereco['cidade']."/".$row_endereco['estado']; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?=$row_endereco['pais']; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?=$row_endereco['cep']; ?></td>    
                                                        <td>
                                                            <a href="functions/deleta-endereco.php?id=<?=$row_endereco['idendereco'];?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash" ></i>Excluir</a>
                                                            <!--<a href="functions/editar-endereco.php?id=<?=$row_endereco['idendereco'];?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-pencil"></i>Editar</a>-->
                                                        </td>
                                                    </tr>
                                                <? }while($row_endereco = mysqli_fetch_assoc($query_select_endereco)); ?>
                                                
                                            </table>
                                        </div>
                                    <? } else{echo "Nenhum endereço cadastrado.";} ?>
                                </div>
                            </div>
                        </div>


                        <!-- card enderecos -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header">
                                    <h4 class="title">Acrescentar Endereços</h4>
                                </div>
                                <div class="content">

                                    <form method="post" action="functions/acrescenta-endereco.php">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>País</label>
                                                    <select name="pais" class="form-control border-input paisEndereco" onchange="habilitaCEP();">
                                                        <option value="" hidden>Escolha o País</option>
                                                        <optgroup>
                                                          <option value="USA">USA</option>
                                                          <option value="Brazil">Brasil</option>
                                                      </optgroup>
                                                      <optgroup>
                                                          <option value="Afghanistan">Afghanistan</option>
                                                          <option value="Albania">Albania</option>
                                                          <option value="Algeria">Algeria</option>
                                                          <option value="Andorra">Andorra</option>
                                                          <option value="Angola">Angola</option>
                                                          <option value="Anguilla">Anguilla</option>
                                                          <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                          <option value="Argentina">Argentina</option>
                                                          <option value="Armenia">Armenia</option>
                                                          <option value="Aruba">Aruba</option>
                                                          <option value="Ascension">Ascension</option>
                                                          <option value="Australia">Australia</option>
                                                          <option value="Austria">Austria</option>
                                                          <option value="Azerbaijan">Azerbaijan</option>
                                                          <option value="Bahamas">Bahamas</option>
                                                          <option value="Bahrain">Bahrain</option>
                                                          <option value="Bangladesh">Bangladesh</option>
                                                          <option value="Barbados">Barbados</option>
                                                          <option value="Belarus">Belarus</option>
                                                          <option value="Belgium">Belgium</option>
                                                          <option value="Belize">Belize</option>
                                                          <option value="Benin">Benin</option>
                                                          <option value="Bermuda">Bermuda</option>
                                                          <option value="Bhutan">Bhutan</option>
                                                          <option value="Bolivia">Bolivia</option>
                                                          <option value="Bonaire, Sint Eustatius, and Saba">Bonaire, Sint Eustatius, and Saba</option>
                                                          <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option>
                                                          <option value="Botswana">Botswana</option>
                                                          <option value="British Virgin Islands">British Virgin Islands</option>
                                                          <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                          <option value="Bulgaria">Bulgaria</option>
                                                          <option value="Burkina Faso">Burkina Faso</option>
                                                          <option value="Burma">Burma</option>
                                                          <option value="Burundi">Burundi</option>
                                                          <option value="Cambodia">Cambodia</option>
                                                          <option value="Cameroon">Cameroon</option>
                                                          <option value="Canada">Canada</option>
                                                          <option value="Cape Verde">Cape Verde</option>
                                                          <option value="Cayman Islands">Cayman Islands</option>
                                                          <option value="Central African Republic">Central African Republic</option>
                                                          <option value="Chad">Chad</option>
                                                          <option value="Chile">Chile</option>
                                                          <option value="China">China</option>
                                                          <option value="Colombia">Colombia</option>
                                                          <option value="Comoros">Comoros</option>
                                                          <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                                          <option value="Congo, Republic of the">Congo, Republic of the</option>
                                                          <option value="Costa Rica">Costa Rica</option>
                                                          <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                                          <option value="Croatia">Croatia</option>
                                                          <option value="Cuba">Cuba</option>
                                                          <option value="Curacao">Curacao</option>
                                                          <option value="Cyprus">Cyprus</option>
                                                          <option value="Czech Republic">Czech Republic</option>
                                                          <option value="Denmark">Denmark</option>
                                                          <option value="Djibouti">Djibouti</option>
                                                          <option value="Dominica">Dominica</option>
                                                          <option value="Dominican Republic">Dominican Republic</option>
                                                          <option value="Ecuador">Ecuador</option>
                                                          <option value="Egypt">Egypt</option>
                                                          <option value="El Salvador">El Salvador</option>
                                                          <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                          <option value="Eritrea">Eritrea</option>
                                                          <option value="Estonia">Estonia</option>
                                                          <option value="Ethiopia">Ethiopia</option>
                                                          <option value="Falkland Islands">Falkland Islands</option>
                                                          <option value="Faroe Islands">Faroe Islands</option>
                                                          <option value="Fiji">Fiji</option>
                                                          <option value="Finland">Finland</option>
                                                          <option value="France">France</option>
                                                          <option value="French Guiana">French Guiana</option>
                                                          <option value="French Polynesia">French Polynesia</option>
                                                          <option value="Gabon">Gabon</option>
                                                          <option value="Gambia">Gambia</option>
                                                          <option value="Georgia, Republic of">Georgia, Republic of</option>
                                                          <option value="Germany">Germany</option>
                                                          <option value="Ghana">Ghana</option>
                                                          <option value="Gibraltar">Gibraltar</option>
                                                          <option value="Great Britain and Northern Ireland">Great Britain and Northern Ireland</option>
                                                          <option value="Greece">Greece</option>
                                                          <option value="Greenland">Greenland</option>
                                                          <option value="Grenada">Grenada</option>
                                                          <option value="Guadeloupe">Guadeloupe</option>
                                                          <option value="Guatemala">Guatemala</option>
                                                          <option value="Guinea">Guinea</option>
                                                          <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                          <option value="Guyana">Guyana</option>
                                                          <option value="Haiti">Haiti</option>
                                                          <option value="Honduras">Honduras</option>
                                                          <option value="Hong Kong">Hong Kong</option>
                                                          <option value="Hungary">Hungary</option>
                                                          <option value="Iceland">Iceland</option>
                                                          <option value="India">India</option>
                                                          <option value="Indonesia">Indonesia</option>
                                                          <option value="Iran">Iran</option>
                                                          <option value="Iraq">Iraq</option>
                                                          <option value="Ireland">Ireland</option>
                                                          <option value="Israel">Israel</option>
                                                          <option value="Italy">Italy</option>
                                                          <option value="Jamaica">Jamaica</option>
                                                          <option value="Japan">Japan</option>
                                                          <option value="Jordan">Jordan</option>
                                                          <option value="Kazakhstan">Kazakhstan</option>
                                                          <option value="Kenya">Kenya</option>
                                                          <option value="Kiribati">Kiribati</option>
                                                          <option value="Korea, Democratic Peoples Republic of (North Korea)">Korea, Democratic Peoples Republic of (North Korea)</option>
                                                          <option value="Korea, Republic of (South Korea)">Korea, Republic of (South Korea)</option>
                                                          <option value="Kosovo, Republic of">Kosovo, Republic of</option>
                                                          <option value="Kuwait">Kuwait</option>
                                                          <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                          <option value="Laos">Laos</option>
                                                          <option value="Latvia">Latvia</option>
                                                          <option value="Lebanon">Lebanon</option>
                                                          <option value="Lesotho">Lesotho</option>
                                                          <option value="Liberia">Liberia</option>
                                                          <option value="Libya">Libya</option>
                                                          <option value="Liechtenstein">Liechtenstein</option>
                                                          <option value="Lithuania">Lithuania</option>
                                                          <option value="Luxembourg">Luxembourg</option>
                                                          <option value="Macao">Macao</option>
                                                          <option value="Macedonia, Republic of">Macedonia, Republic of</option>
                                                          <option value="Madagascar">Madagascar</option>
                                                          <option value="Malawi">Malawi</option>
                                                          <option value="Malaysia">Malaysia</option>
                                                          <option value="Maldives">Maldives</option>
                                                          <option value="Mali">Mali</option>
                                                          <option value="Malta">Malta</option>
                                                          <option value="Martinique">Martinique</option>
                                                          <option value="Mauritania">Mauritania</option>
                                                          <option value="Mauritius">Mauritius</option>
                                                          <option value="Mexico">Mexico</option>
                                                          <option value="Moldova">Moldova</option>
                                                          <option value="Mongolia">Mongolia</option>
                                                          <option value="Montenegro">Montenegro</option>
                                                          <option value="Montserrat">Montserrat</option>
                                                          <option value="Morocco">Morocco</option>
                                                          <option value="Mozambique">Mozambique</option>
                                                          <option value="Namibia">Namibia</option>
                                                          <option value="Nauru">Nauru</option>
                                                          <option value="Nepal">Nepal</option>
                                                          <option value="Netherlands">Netherlands</option>
                                                          <option value="New Caledonia">New Caledonia</option>
                                                          <option value="New Zealand">New Zealand</option>
                                                          <option value="Nicaragua">Nicaragua</option>
                                                          <option value="Niger">Niger</option>
                                                          <option value="Nigeria">Nigeria</option>
                                                          <option value="Norway">Norway</option>
                                                          <option value="Oman">Oman</option>
                                                          <option value="Pakistan">Pakistan</option>
                                                          <option value="Panama">Panama</option>
                                                          <option value="Papua New Guinea">Papua New Guinea</option>
                                                          <option value="Paraguay">Paraguay</option>
                                                          <option value="Peru">Peru</option>
                                                          <option value="Philippines">Philippines</option>
                                                          <option value="Pitcairn Island">Pitcairn Island</option>
                                                          <option value="Poland">Poland</option>
                                                          <option value="Portugal">Portugal</option>
                                                          <option value="Qatar">Qatar</option>
                                                          <option value="Reunion">Reunion</option>
                                                          <option value="Romania">Romania</option>
                                                          <option value="Russia">Russia</option>
                                                          <option value="Rwanda">Rwanda</option>
                                                          <option value="Saint Helena">Saint Helena</option>
                                                          <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                          <option value="Saint Lucia">Saint Lucia</option>
                                                          <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                          <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                          <option value="Samoa">Samoa</option>
                                                          <option value="San Marino">San Marino</option>
                                                          <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                          <option value="Saudi Arabia">Saudi Arabia</option>
                                                          <option value="Senegal">Senegal</option>
                                                          <option value="Serbia, Republic of">Serbia, Republic of</option>
                                                          <option value="Seychelles">Seychelles</option>
                                                          <option value="Sierra Leone">Sierra Leone</option>
                                                          <option value="Singapore">Singapore</option>
                                                          <option value="Sint Maarten">Sint Maarten</option>
                                                          <option value="Slovak Republic (Slovakia)">Slovak Republic (Slovakia)</option>
                                                          <option value="Slovenia">Slovenia</option>
                                                          <option value="Solomon Islands">Solomon Islands</option>
                                                          <option value="Somalia">Somalia</option>
                                                          <option value="South Africa">South Africa</option>
                                                          <option value="Spain">Spain</option>
                                                          <option value="Sri Lanka">Sri Lanka</option>
                                                          <option value="Sudan">Sudan</option>
                                                          <option value="Suriname">Suriname</option>
                                                          <option value="Swaziland">Swaziland</option>
                                                          <option value="Sweden">Sweden</option>
                                                          <option value="Switzerland">Switzerland</option>
                                                          <option value="Syrian Arab Republic (Syria)">Syrian Arab Republic (Syria)</option>
                                                          <option value="Taiwan">Taiwan</option>
                                                          <option value="Tajikistan">Tajikistan</option>
                                                          <option value="Tanzania">Tanzania</option>
                                                          <option value="Thailand">Thailand</option>
                                                          <option value="Timor-Leste, Democratic Republic of">Timor-Leste, Democratic Republic of</option>
                                                          <option value="Togo">Togo</option>
                                                          <option value="Tonga">Tonga</option>
                                                          <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                          <option value="Tristan da Cunha">Tristan da Cunha</option>
                                                          <option value="Tunisia">Tunisia</option>
                                                          <option value="Turkey">Turkey</option>
                                                          <option value="Turkmenistan">Turkmenistan</option>
                                                          <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                          <option value="Tuvalu">Tuvalu</option>
                                                          <option value="Uganda">Uganda</option>
                                                          <option value="Ukraine">Ukraine</option>
                                                          <option value="United Arab Emirates">United Arab Emirates</option>
                                                          <option value="Uruguay">Uruguay</option>
                                                          <option value="Uzbekistan">Uzbekistan</option>
                                                          <option value="Vanuatu">Vanuatu</option>
                                                          <option value="Vatican City">Vatican City</option>
                                                          <option value="Venezuela">Venezuela</option>
                                                          <option value="Vietnam">Vietnam</option>
                                                          <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                                          <option value="Yemen">Yemen</option>
                                                          <option value="Zambia">Zambia</option>
                                                          <option value="Zimbabwe">Zimbabwe</option>
                                                      </optgroup>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                            <div class="form-group">
                                                <label>CEP ou Zipcode</label>
                                                <input type="text" class="form-control border-input MaskCEP" placeholder="Cep" name="cep" id="cep" onblur="buscaCEPMask();" disabled>
                                                <small>Seu CEP / Zipcode será pesquisado automaticamente.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Endereço 1</label>
                                                <input type="text" name="rua" class="form-control border-input endereco" placeholder="Rua, Avenida, Praça, etc." disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="text" class="form-control border-input numero" placeholder="Número" name="numero" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Endereço 2</label>
                                                <input type="text" class="form-control border-input complemento" placeholder="apto 12, fundos, etc" name="complemento" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Bairro</label>
                                                <input type="text" class="form-control border-input bairro" placeholder="Bairro" name="bairro" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input type="text" class="form-control border-input cidade" placeholder="Cidade" name="cidade" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <input type="text" class="form-control border-input estado" placeholder="Estado" name="estado" disabled>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-fill btn-wd">ACRESCENTAR</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
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
            <div class="copyright pull-left">
                <? include ("blocks/translations.php"); ?>  
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
<!-- <script src="assets/js/chartist.min.js"></script> -->
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="assets/js/demo.js"></script> -->
<script type="text/javascript">
    function sumirsuccess(){
        var este = document.getElementById('alert-success');
        este.style.display = "none";
    }
    function sumirdanger(){
        var este = document.getElementById('alert-danger');
        este.style.display = "none";
    }
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script type="text/javascript">

    function xmlToJson(xml) {

        var obj = {};

        if (xml.nodeType == 1) { 
            if (xml.attributes.length > 0) {
                obj["@attributes"] = {};
                for (var j = 0; j < xml.attributes.length; j++) {
                    var attribute = xml.attributes.item(j);
                    obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
                }
            }
        } else if (xml.nodeType == 3) {
            obj = xml.nodeValue;
        }

        if (xml.hasChildNodes()) {
            for(var i = 0; i < xml.childNodes.length; i++) {
                var item = xml.childNodes.item(i);
                var nodeName = item.nodeName;
                if (typeof(obj[nodeName]) == "undefined") {
                    obj[nodeName] = xmlToJson(item);
                } else {
                    if (typeof(obj[nodeName].push) == "undefined") {
                        var old = obj[nodeName];
                        obj[nodeName] = [];
                        obj[nodeName].push(old);
                    }
                    obj[nodeName].push(xmlToJson(item));
                }
            }
        }
        return obj;
    };


    function habilitaCEP(){
        if($('.paisEndereco').val() == ''){
            $("#cep").attr('disabled','disabled');
        } else {
            $("#cep").removeAttr('disabled');
        }
    }

    function buscaCEPMask(){

        $('.endereco').val(null);
        $('.bairro').val(null);
        $('.cidade').val(null);
        $('.estado').val(null);
        $('.numero').val(null);
        $('.complemento').val(null);

        $('.endereco').attr('disabled','disabled');
        $('.bairro').attr('disabled','disabled');
        $('.cidade').attr('disabled','disabled');
        $('.estado').attr('disabled','disabled');
        $('.numero').attr('disabled','disabled');
        $('.complemento').attr('disabled','disabled');

        if($('.paisEndereco').val() == 'USA'){
            var zipcode = $('#cep').val();
            var userid = "433STORE2182"; 
            var url = "https://secure.shippingapis.com/ShippingAPI.dll";
            var data =
            {
              "API" : "CityStateLookup",
              "XML" : "<CityStateLookupRequest USERID=\"" + userid + "\"> \
              <ZipCode ID='0'> \
              <Zip5>" + zipcode + "</Zip5> \
              </ZipCode> \
              </CityStateLookupRequest>"
          };

          $.post(url, data)
          .done(function(xyz) {
            console.log(xyz);
            var resultado = xmlToJson(xyz);
            console.log(resultado);

            $('.cidade').val(resultado.CityStateLookupResponse.ZipCode.City["#text"]);
            $('.estado').val(resultado.CityStateLookupResponse.ZipCode.State["#text"]);

            $(".endereco").removeAttr('disabled');
            $('.cidade').removeAttr('disabled');
            $('.estado').removeAttr('disabled');
            $('.complemento').removeAttr('disabled');

        });

      }else if($('.paisEndereco').val() == 'Brazil'){

        var cepbruto = $('#cep').val();
        var cep = cepbruto.replace(/\D/g, '');
        var urlCep = 'https://viacep.com.br/ws/'+cep+'/json';

        $.getJSON(urlCep, function( data ) {
            $('.endereco').val(data.logradouro);
            $('.bairro').val(data.bairro);
            $('#cep').val(data.cep);
            $('.cidade').val(data.localidade);
            $('.estado').val(data.uf);


            $('.endereco').removeAttr('disabled');
            $('.bairro').removeAttr('disabled');
            $('#cep').removeAttr('disabled');
            $('.cidade').removeAttr('disabled');
            $('.estado').removeAttr('disabled');
            $('.numero').removeAttr('disabled');
            $('.complemento').removeAttr('disabled');
            
        });
    } else {
        $('.endereco').removeAttr('disabled');
        $('.bairro').removeAttr('disabled');
        $('#cep').removeAttr('disabled');
        $('.cidade').removeAttr('disabled');
        $('.estado').removeAttr('disabled');
        $('.numero').removeAttr('disabled');
        $('.complemento').removeAttr('disabled');
    }
}

$("input.MaskCPF")
.focusout(function (event) {  
    var target, cpf, element;  
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
    cpf = target.value.replace(/\D/g, '');
    console.log(cpf);
    element = $(target);  
    element.unmask();  
    if(cpf.length >= 11) {  
      element.mask("999.999.999-99");  
  }  
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

</script>

</html>
