<html>
    <head>
        <meta charset="utf-8">
        <title>Painel Administrativo</title>
        <link rel="stylesheet" href="<?php echo BASE; ?>assets/css/normalize.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BASE; ?>assets/css/organico.css">
        <link rel="stylesheet" href="<?php echo BASE; ?>assets/css/estilos.css">
    </head>
    <body>
        <div class="container">
            <nav class="linha nav">
                <div class="nav hamburguer">
                    <img src="<?php echo BASE; ?>assets/images/menu.png" width="25" height="25" alt="icone menu">
                </div>
                <div class="quatro colunas">
                    <img src="<?php echo BASE; ?>assets/images/logo.png" alt="logo" class="nav logo">
                </div>
                <div class="oito colunas nav menu">
                    <a href="<?php echo BASE;?>" class="nav link"><li>Home</li></a>
                    <a href="<?php echo BASE;?>estado" class="nav link"><li>Estado</li></a>  
                    <a href="<?php echo BASE;?>cidade" class="nav link"><li>Cidade</li></a>
                    <a href="<?php echo BASE;?>loja" class="nav link"><li>Loja</li></a>
                    <a href="<?php echo BASE;?>tipoLoja" class="nav link"><li>Tipo de Loja</li></a>
                    <a href="<?php echo BASE;?>usuario" class="nav link"><li>Usuário</li></a>
                    <a href="login/logout" class="nav link"><li>Sair</li></a>
                </div>
            </nav>
        </div>

        <header class="header">
            <div class="container">
                <div class="linha">
                    <div class="doze colunas">
                        <?php $this->loadViewInTamplate($viewName, $viewData); ?>
                    </div>
                </div>
            </div>
        </header> 

		<script>var url = <?php echo BASE; ?></script>
        <script>
            window.addEventListener('DOMContentLoaded', function(e) {
                document.querySelector('.nav.hamburguer')
                  .addEventListener('click', function(e) {
                    document.querySelector('.nav.menu').classList.toggle('aberto');
                }, false);
            }, false);
        </script>    
    </body>
</html>