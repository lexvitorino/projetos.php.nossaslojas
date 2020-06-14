<html>
    <head>
        <meta charset="utf-8">
        <title>Painel - Titulo Nossa Loja</title>
        <link rel="stylesheet" href="/painel/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/painel/assets/css/tamplate.css" />
    </head>
    <body>
        <div class="login">
            <form method="POST">
                <h2>Login</h2>
                <?php if (!empty($erros)): ?>
                    <div class="alert alert-warning" role="alert"><?php echo $erros ?></div>
                <?php endif; ?>
                <label class="sr-only">Usuário</label>
                <input type="text" class="form-control" name="login" placeholder="Usuário" required="" autofocus="">
                <label class="sr-only">Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="Senha" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>            
        </div>    
    </body>
</html>