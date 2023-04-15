<ul class="nav navbar-nav navbar-right">

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <p>
                Wallet: U$ <?=number_format($_SESSION['saldo_wallet'], 2, ".", ",");?> 
                <? if($_SESSION['MostrarCotacao'] == '1'){ ?>
                    |
                    Dolar: R$ <?=number_format($_SESSION['USDT-BRL-Compra'], 2, ".", ",");?> 
                    <? 

                    $negativo = substr($_SESSION['USDT-BRL-Percent-Var'], 0,1);

                    if($negativo == '-'){
                        ?>
                        <span style="color: #FF0000; margin-left: 6px;">
                            <i class="fas fa-arrow-down"></i> <?=number_format($_SESSION['USDT-BRL-Percent-Var'], 2, ".", ",");?>%
                        </span>
                        <?
                    } else {
                        ?>
                        <span style="color: #008b00;margin-left: 6px;">
                            <i class="fas fa-arrow-up"></i> <?=number_format($_SESSION['USDT-BRL-Percent-Var'], 2, ".", ",");?>%
                        </span>
                        <?
                    }

                    ?>
                <? } ?>
            </p>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <p>
                <i class="fa fa-angle-down"></i>
                <?php if ($row_user['avatar'] != ""){ ?>
                    <img src="assets/img/avatar/<?= $row_user['avatar']; ?>" style="width:30px; border-radius:100%; border:0px solid #FFF; box-shadow: 1px 1px #ccc ">
                    <?php } ?>&nbsp;
                    <b><?= ucwords($row_user['nome']." ".$row_user['sobrenome']); ?></b>
                </p>
            </a>
            <ul class="dropdown-menu">
                <li><a href="user.php">Minha Conta</a></li>
                <li><a href="?logout">Sair</a></li> 
            </ul>
        </li>
    </ul>