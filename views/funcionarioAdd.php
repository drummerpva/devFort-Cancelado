<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Adicionar Funcionário</h3>
                    <div>
                        <div >
                            <span>Preencha os dados com atenção</span>
                        </div>
                        <div>
                        <?php if (!empty($msgErro)) {?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $msgErro; ?>
                            </div>
                        <?php }?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel" style="height: auto !important;">
                        <form method="POST">
                            <div class="form-inline">
                                <input type="text" class="form-control" name="nome" required placeholder="Nome" style="width:40%;">&nbsp;&nbsp;&nbsp;
                                <input type="email" class="form-control" name="usuario" required placeholder="Usuário" style="width:28%;">&nbsp;&nbsp;&nbsp;
                                <input type="password" class="form-control" name="senha" required placeholder="Senha" style="width:28%;">&nbsp;&nbsp;&nbsp;
                            </div>&nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <input type="submit" value="Cadastrar" class="btn btn-success btn-lg">
                                <a href="<?php echo BASE_URL . "funcionarios" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
