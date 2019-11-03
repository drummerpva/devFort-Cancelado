<html>
    <head>
        <title>Sistema de Pedidos Recicla Brasil</title>
        <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo BASE_URL; ?>assets/css/estilos.css" rel="stylesheet" />
        <script src="<?php echo BASE_URL; ?>assets/js/jquery.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
                <div class="navLeft">
                    <!-- Brand -->
                    <a class="navbar-brand float-left" href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL . "assets/images/logo.png" ?>" width="100px;" alt="Recicla Brasil"></a>

                    <!-- Links -->
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL . "vendas"; ?>">Pedidos</a>
                        </li>

                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                Cadastros
                        </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo BASE_URL . "clientes"; ?>">Clientes</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "emitentes"; ?>">Emitentes</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "pagamentos"; ?>">Formas de Pagamento</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "fornecedores"; ?>">Fornecedores</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "funcionarios"; ?>">Funcionarios</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "produtos"; ?>">Produtos</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "vendedores"; ?>">Vendedores</a>
                            </div>
                        </li>
                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop2" data-toggle="dropdown">
                                Relatórios
                        </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo BASE_URL . "report/clientes"; ?>">Clientes</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "report/vendedores"; ?>">Vendedores</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL . "report/comissoes"; ?>">Comissões</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="navRight">
                    <div class="userName">
                        <span class="text-muted float-right"><?php echo $viewData['userName'] ?? ""; ?></span>
                    </div>
                    <div class="logOut">
                        <a href="<?php echo BASE_URL . "login/logOut" ?>" >Sair</a>
                    </div>
                </div>
            </nav>
        </div>
            <?php $this->loadViewInTemplate($viewName, $viewData);?>
    </div>
        <script type="text/javascript">
            var BASE_URL = "<?php echo BASE_URL;?>";
        </script>
        <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/script.js" type="text/javascript"></script>
    </body>

</html>