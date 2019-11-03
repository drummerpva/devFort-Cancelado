<html>
    <head>
        <title>Pedidos Recicla - Login</title>
        <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo BASE_URL; ?>assets/css/login.css" rel="stylesheet" />
    </head>
    <body>
    <div class="formLogin">
        <form method="POST">
        <h2>Acesso ao Sistema</h2>
        <?php if (!empty($msgErro)) {?>
            <div class="alert alert-danger" role="alert">
                <?php echo $msgErro; ?>
            </div>
        <?php }?>
        <div class="form-group">
            <label for="exampleInputEmail1">Usuário</label>
            <input required type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Insira o usuário" name="login">
            <small id="emailHelp" class="form-text text-muted">Não compartilhe seus dados de acesso com ninguém.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input  required type="password" class="form-control"  name="pass" id="exampleInputPassword1" placeholder="Senha">
        </div>

        <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

        <script src="<?php echo BASE_URL; ?>assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/script.js" type="text/javascript"></script>
    </body>

</html>