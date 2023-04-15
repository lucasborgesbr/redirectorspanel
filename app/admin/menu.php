
<script src="https://kit.fontawesome.com/259cd8b45f.js"></script>

<div class="sidebar" data-background-color="white" data-active-color="success" style="overflow-x: hidden;">
    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->
   <div class="sidebar-wrapper">


    <div class="logo">
        <a href="" class="simple-text">
            <?= $row_admin['empresa']; ?>
        </a>
    </div>
    <ul class="nav">
        <li>
            <a href="dashboard.php">
                <i class="fa fa-dashboard"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="users.php">
                <i class="fa fa-users"></i>
                <p>Clientes</p>
            </a>
        </li>
        <li>
            <a href="redirecionamento.php">
                <i class="fas fa-truck-loading"></i>
                <p>Caixas a Caminho</p>
            </a>
        </li>
        <li>
            <a href="caixas.php">
                <i class="fa fa-gift"></i>
                <p>Caixas</p>
            </a>
        </li>
        <li>
            <a href="produtos.php">
                <i class="fa fa-gamepad"></i>
                <p>Produtos</p>
            </a>
        </li>
        <li>
            <a href="envios.php">
                <i class="fa fa-paper-plane"></i>
                <p>Envios</p>
            </a>
        </li>
        <!--<li>
            <a href="compras.php">
                <i class="fa fa-shopping-basket"></i>
                <p>Compras Assistidas</p>
            </a>
        </li>
        <? if($row_config['habilitarLoja'] == '1'){ ?>
            <li>
                <a href="produtosLoja.php">
                    <i class="fa fa-shopping-cart"></i>
                    <p>Produtos Loja</p>
                </a>
            </li>
        <? } ?>-->
        <li>
            <a href="notifications.php">
                <i class="fa fa-bullhorn"></i>
                <p>Notificações</p>
            </a>
        </li>
        <li>
            <a href="relatorios.php">
               <!-- <a href="#">-->
                <i class="fa fa-bar-chart"></i>
                <p>Relatórios</p>
            </a>
        </li>
        <li>
            <a href="wallet.php">
                <i class="fa fa-usd"></i>
                <p>Wallet</p>
            </a>
        </li>
        <li>
            <a href="configuracoes.php">
                <i class="fa fa-cog"></i>
                <p>Configurações</p>
            </a>
        </li>
<!--        <li>
            <a href="https://www.tidiochat.com/chat/rrangmvxqcspfbcgjbtmag4ewbaarvxt" target="_blank">
                <i class="fa fa-comments"></i>
                <p>Support</p>
            </a>
        </li>-->
        
    </ul>
</div>
</div>