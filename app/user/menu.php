<script src="https://kit.fontawesome.com/259cd8b45f.js"></script>

<div class="sidebar" data-background-color="white" data-active-color="success">
    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="<?= $row_admin['faq']; ?>" class="simple-text">
                <?= $row_admin['empresa']; ?>
            </a>
        </div>
        <ul class="nav">
            <?
            if (isset($_COOKIE['id_user']) && isset($_COOKIE['_id_admin'])) {
                ?>
                <li>
                    <a href="../admin/functions/return-admin.php">
                        <i class="fa fa-reply-all fa-xs"></i>
                        <p>Voltar ao Admin</p>
                    </a>
                </li>
                <?
            }
            ?>
            <li>
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="user.php">
                    <i class="fa fa-user"></i>
                    <p>Minha Conta</p>
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
                    <p>Solicitar Envio</p>
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
            </li>-->
            <li>
                <a href="wallet.php">
                    <i class="fa fa-usd"></i>
                    <p>Wallet</p>
                </a>
            </li>
            <li>
                <a href="notifications.php">
                    <i class="fa fa-bullhorn"></i>
                    <p>Notificações</p>
                </a>
            </li>
            <!--
            <li>
                <a onclick="calcFrete()">
                    <i class="fa fa-calculator"></i>
                    <p>Calculadora de Frete</p>
                </a>
            </li>
        -->
    </ul>
</div>
</div>




<script type="text/javascript">
    function calcFrete(){
        $('#modalNovoVideo').modal('show');
    }
</script>

<div id="modalNovoVideo" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Calcular Frete</h4>
            </div>
            <div class="modal-body">
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

