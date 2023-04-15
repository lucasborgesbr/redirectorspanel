
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Estrutura para tabela `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `idadmin` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cep` varchar(30) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `criado` timestamp NOT NULL,
  `faq` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletos`
--

CREATE TABLE IF NOT EXISTS `boletos` (
  `idBoleto` int(11) NOT NULL,
  `source` varchar(60) NOT NULL,
  `idSource` int(11) NOT NULL,
  `idParc` varchar(60) NOT NULL,
  `authcodeParc` varchar(60) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tipo` varchar(5) NOT NULL,
  `pendente` tinyint(1) NOT NULL DEFAULT '1',
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixas`
--

CREATE TABLE IF NOT EXISTS `caixas` (
  `idcaixa` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `remetente` varchar(200) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `tracking` varchar(100) DEFAULT NULL,
  `imagem1` varchar(100) DEFAULT NULL,
  `imagem2` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `criado` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinhoLoja`
--

CREATE TABLE IF NOT EXISTS `carrinhoLoja` (
  `idItemCarrinho` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idProdutoLoja` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `idcompra` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `cor` varchar(200) NOT NULL,
  `tamanho` varchar(200) NOT NULL,
  `link` varchar(300) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `quantidade` int(5) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `criado` timestamp DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comprovantes`
--

CREATE TABLE IF NOT EXISTS `comprovantes` (
  `idComprovante` int(30) NOT NULL,
  `idEnvio` int(30) DEFAULT NULL,
  `comprovante` varchar(100) DEFAULT NULL,
  `opPagamento` varchar(30) DEFAULT NULL,
  `codPagamento` varchar(30) DEFAULT NULL,
  `idtran` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configFormaPagamentos`
--

CREATE TABLE IF NOT EXISTS `configFormaPagamentos` (
  `idFormaPagamento` int(11) NOT NULL,
  `TipoPagamento` varchar(60) NOT NULL,
  `key1` varchar(200) NOT NULL,
  `key2` varchar(200) NOT NULL,
  `taxa` float(10,2) DEFAULT NULL,
  `sandbox` tinyint(1) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configPesos`
--

CREATE TABLE IF NOT EXISTS `configPesos` (
  `idPeso` int(11) NOT NULL,
  `pesoMin` float(10,2) NOT NULL,
  `pesoMax` float(10,2) NOT NULL,
  `vlrPeso` float(10,2) NOT NULL,
  `tipoValor` varchar(50) DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configServicosExtras`
--

CREATE TABLE IF NOT EXISTS `configServicosExtras` (
  `idServicosExtras` int(11) NOT NULL,
  `descServico` varchar(200) NOT NULL,
  `vlrServico` float(10,2) NOT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Configuracoes`
--

CREATE TABLE IF NOT EXISTS `Configuracoes` (
  `CodConfiguracoes` int(11) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `Endereco` text NOT NULL,
  `version` varchar(30) NOT NULL,
  `nomeEmpresa` varchar(150) NOT NULL,
  `contato` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `cotacao` tinyint(1) NOT NULL DEFAULT '1',
  `ePacket` tinyint(1) NOT NULL DEFAULT '0',
  `habilitarLoja` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `docs`
--

CREATE TABLE IF NOT EXISTS `docs` (
  `iddoc` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `criado` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE IF NOT EXISTS `enderecos` (
  `idendereco` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `envios`
--

CREATE TABLE IF NOT EXISTS `envios` (
  `idenvio` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `conteudo` mediumtext,
  `usps` decimal(10,2) DEFAULT NULL,
  `taxapgto` decimal(10,2) DEFAULT NULL,
  `taxaservico` decimal(10,2) DEFAULT NULL,
  `taxaextras` decimal(10,2) DEFAULT NULL,
  `servicosextrasdesc` mediumtext NOT NULL,
  `taxaarmazenamento` decimal(10,2) DEFAULT NULL,
  `pesototal` varchar(10) NOT NULL,
  `vlrDesconto` decimal(10,2) DEFAULT NULL,
  `valortotal` decimal(10,2) DEFAULT NULL,
  `valorReal` decimal(10,2) DEFAULT NULL,
  `endereco` mediumtext,
  `formapgto` varchar(20) DEFAULT NULL,
  `formaenvio` varchar(20) DEFAULT NULL,
  `declaracao` mediumtext NOT NULL,
  `valordeclaradofinal` varchar(50) NOT NULL,
  `cpfPagador` varchar(15) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tracking` varchar(200) NOT NULL,
  `codigopgto` varchar(500) NOT NULL,
  `cpf` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE IF NOT EXISTS `notificacoes` (
  `idnotificacao` int(11) NOT NULL,
  `conteudo` mediumtext,
  `titulo` varchar(100) DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `observacoes`
--

CREATE TABLE IF NOT EXISTS `observacoes` (
  `idObs` int(11) NOT NULL,
  `idEnvio` int(11) NOT NULL,
  `txObs` varchar(60) NOT NULL,
  `dtObs` datetime NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `idproduto` int(11) NOT NULL,
  `idcaixa` int(11) DEFAULT NULL,
  `iduser` int(5) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `imagem1` varchar(100) NOT NULL,
  `imagem2` varchar(100) NOT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `quantidade` int(5) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtosLoja`
--

CREATE TABLE IF NOT EXISTS `produtosLoja` (
  `idProdutoLoja` int(11) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `codigo` varchar(100) NOT NULL,
  `valor` float(10,2) NOT NULL,
  `peso` float(10,2) NOT NULL,
  `qtd` int(11) DEFAULT NULL,
  `descricao` mediumtext NOT NULL,
  `imagem` varchar(600) NOT NULL,
  `tamanho` tinyint(1) DEFAULT NULL,
  `tamanhoDisponivel` varchar(60) DEFAULT NULL,
  `prontaEntrega` tinyint(1) NOT NULL DEFAULT '0',
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `available` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `redirecionamento`
--

CREATE TABLE IF NOT EXISTS `redirecionamento` (
  `id` int(11) NOT NULL,
  `loja` varchar(200) NOT NULL,
  `tracking` varchar(100) NOT NULL,
  `numerocaixas` int(11) NOT NULL,
  `suite` int(10) NOT NULL,
  `valorcompra` float(10,2) NOT NULL,
  `comprovante` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacaoWallet`
--

CREATE TABLE IF NOT EXISTS `transacaoWallet` (
  `idtran` int(11) NOT NULL,
  `idwallet` int(11) NOT NULL,
  `recebe` float DEFAULT NULL,
  `paga` float DEFAULT NULL,
  `dtTran` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipoTran` varchar(150) NOT NULL,
  `motivoRecarga` varchar(60) DEFAULT NULL,
  `status` varchar(60) NOT NULL,
  `idComprovante` int(11) NOT NULL,
  `opPagamento` varchar(60) NOT NULL,
  `vlrReal` float(10,2) DEFAULT NULL,
  `idcompragrupo` int(11) DEFAULT NULL,
  `cpfPagador` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `sobrenome` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `criado` timestamp DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT NULL,
  `codAcesso` varchar(8) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `cpf` varchar(15) NOT NULL,
  `IPAddr` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Videos`
--

CREATE TABLE IF NOT EXISTS `Videos` (
  `CodVideo` int(11) NOT NULL,
  `TituloVideo` tinytext NOT NULL,
  `Url` tinytext NOT NULL,
  `DataEnvaiado` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
  `idwallet` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `saldo` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idadmin`);

--
-- Índices de tabela `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`idBoleto`);

--
-- Índices de tabela `caixas`
--
ALTER TABLE `caixas`
  ADD PRIMARY KEY (`idcaixa`);

--
-- Índices de tabela `carrinhoLoja`
--
ALTER TABLE `carrinhoLoja`
  ADD PRIMARY KEY (`idItemCarrinho`);

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idcompra`);

--
-- Índices de tabela `comprovantes`
--
ALTER TABLE `comprovantes`
  ADD PRIMARY KEY (`idComprovante`);

--
-- Índices de tabela `configFormaPagamentos`
--
ALTER TABLE `configFormaPagamentos`
  ADD PRIMARY KEY (`idFormaPagamento`);

--
-- Índices de tabela `configPesos`
--
ALTER TABLE `configPesos`
  ADD PRIMARY KEY (`idPeso`);

--
-- Índices de tabela `configServicosExtras`
--
ALTER TABLE `configServicosExtras`
  ADD PRIMARY KEY (`idServicosExtras`);

--
-- Índices de tabela `Configuracoes`
--
ALTER TABLE `Configuracoes`
  ADD PRIMARY KEY (`CodConfiguracoes`);

--
-- Índices de tabela `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`iddoc`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`idendereco`);

--
-- Índices de tabela `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`idenvio`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`idnotificacao`);

--
-- Índices de tabela `observacoes`
--
ALTER TABLE `observacoes`
  ADD PRIMARY KEY (`idObs`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idproduto`);

--
-- Índices de tabela `produtosLoja`
--
ALTER TABLE `produtosLoja`
  ADD PRIMARY KEY (`idProdutoLoja`);

--
-- Índices de tabela `redirecionamento`
--
ALTER TABLE `redirecionamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `transacaoWallet`
--
ALTER TABLE `transacaoWallet`
  ADD PRIMARY KEY (`idtran`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- Índices de tabela `Videos`
--
ALTER TABLE `Videos`
  ADD PRIMARY KEY (`CodVideo`);

--
-- Índices de tabela `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`idwallet`);


--
-- AUTO_INCREMENT de tabelas apagadas
--




--
-- Tabela truncada antes do insert `admins`
--

TRUNCATE TABLE `admins`;
--
-- Despejando dados para a tabela `admins`
--

INSERT INTO `admins` (`idadmin`, `logo`, `empresa`, `nome`, `email`, `telefone`, `senha`, `endereco`, `cidade`, `estado`, `cep`, `pais`, `status`, `criado`, `faq`) VALUES
(1, '', '__nomeEmpresa', '__nomeAdmin', '__emailAdmin', '', '__senhaAdmin', '', '', '', '', '', 'ativo', '2020-05-26', ''),
(99, '', 'Solutionsbox', 'Solutionsbox Admin', 'contato@solutionsbox.com.br', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', 'ativo', '2020-05-26', '');

-- --------------------------------------------------------


--
-- Tabela truncada antes do insert `configFormaPagamentos`
--

TRUNCATE TABLE `configFormaPagamentos`;
--
-- Despejando dados para a tabela `configFormaPagamentos`
--

INSERT INTO `configFormaPagamentos` (`idFormaPagamento`, `TipoPagamento`, `key1`, `key2`, `taxa`, `sandbox`, `data`, `ativo`) VALUES
(1, 'Paypal', '', '', 7.00, 0, '2020-05-26 00:00:00', 0),
(2, 'Paypal.me', '', '', 7.00, 0, '2020-05-26 00:00:00', 0),
(3, 'Ebanx', '', '', 3.00, 0, '2020-05-26 00:00:00', 0),
(4, 'CambioReal', '', '', 0.00, 0, '2020-05-26 00:00:00', 0),
(5, 'WesternUnion', '', '', 0.00, 0, '2020-05-26 00:00:00', 0),
(6, 'TransferWise', '', '', 0.00, 0, '2020-05-26 00:00:00', 0),
(7, 'Transferencia', '', '', 0.00, 0, '2020-05-26 00:00:00', 0),
(8, 'ParceladoUSA', '', '', 0.00, 0, '2020-05-26 00:00:00', 0),
(9, 'Pagamento no Local', '', '', 0.00, 0, '2020-05-26 00:00:00', 0);

-- --------------------------------------------------------


--
-- Tabela truncada antes do insert `Configuracoes`
--

TRUNCATE TABLE `Configuracoes`;
--
-- Despejando dados para a tabela `Configuracoes`
--

INSERT INTO `Configuracoes` (`CodConfiguracoes`, `logo`, `Endereco`, `version`, `nomeEmpresa`, `contato`, `link`, `cotacao`, `habilitarLoja`) VALUES
(1, '', '', '4.0', '__nomeEmpresa', '__emailContato', '__linkSistema', 1, 0);

-- --------------------------------------------------------

--
-- Tabela truncada antes do insert `users`
--

TRUNCATE TABLE `users`;
--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`iduser`, `avatar`, `nome`, `sobrenome`, `telefone`, `email`, `status`, `senha`, `criado`, `ativo`, `codAcesso`, `type`) VALUES
(1, '', 'user', 'Teste Solutionsbox', '61995902131', 'user@solutionsbox.com.br', 'active', 'e10adc3949ba59abbe56e057f20f883e', '2020-05-26', 1, NULL, NULL);

-- --------------------------------------------------------



--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `caixas`
--
ALTER TABLE `caixas`
  MODIFY `idcaixa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comprovantes`
--
ALTER TABLE `comprovantes`
  MODIFY `idComprovante` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configPesos`
--
ALTER TABLE `configPesos`
  MODIFY `idPeso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configServicosExtras`
--
ALTER TABLE `configServicosExtras`
  MODIFY `idServicosExtras` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Configuracoes`
--
ALTER TABLE `Configuracoes`
  MODIFY `CodConfiguracoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `docs`
--
ALTER TABLE `docs`
  MODIFY `iddoc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `envios`
--
ALTER TABLE `envios`
  MODIFY `idenvio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `idnotificacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `observacoes`
--
ALTER TABLE `observacoes`
  MODIFY `idObs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redirecionamento`
--
ALTER TABLE `redirecionamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transacaoWallet`
--
ALTER TABLE `transacaoWallet`
  MODIFY `idtran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Videos`
--
ALTER TABLE `Videos`
  MODIFY `CodVideo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `wallet`
--
ALTER TABLE `wallet`
  MODIFY `idwallet` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

