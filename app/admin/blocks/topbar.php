<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <p id="saldoMenu">
                Devedores: U$ <span style="color: #8b0e00;margin-left: 6px;">(<?=substr(number_format($row_saldoDevedor['saldoDevedor'], 2, ".", ","), 1);?>)</span>
                |
                Créditos: U$ <span style="color: #008b00;margin-left: 6px;"><?=number_format($row_saldoCredor['saldoCredor'], 2, ".", ",");?></span>
            </p>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <p>
                <i class="fa fa-angle-down"></i>
                <b><?= ucwords($row_admin['nome']." - ".$row_admin['empresa']); ?></b> 
            </p>
        </a>
        <ul class="dropdown-menu">
            <li><a href="configuracoes.php">Configurações</a></li>
            <li><a href="?logout">Sair</a></li>
        </ul>
    </li>
</ul>