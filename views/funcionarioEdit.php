<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editando Funcionario</h3>
                    <div>
                        <div >
                            <span>Preencha os dados com atenção</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel" style="height: auto !important;">
                        <form method="POST">
                            <div class="form-inline">
                                <input type="text" class="form-control" name="nome" required placeholder="Nome" style="width:40%;" value="<?php echo $info['nome'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="email" class="form-control" name="usuario" required placeholder="Usuário" style="width:28%;" value="<?php echo $info['usuario'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="password" class="form-control" name="senha" placeholder="Senha" style="width:28%;" >&nbsp;&nbsp;&nbsp;
                            </div>&nbsp;&nbsp;&nbsp;
                            <div>
                                <div class="form-group float-left">
                                    <input type="submit" value="Salvar" class="btn btn-success btn-lg">
                                    <a href="<?php echo BASE_URL . "funcionarios" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                                </div>
                                <div class="float-right">
                                <a href="<?php echo BASE_URL . "funcionarios/del/" . $info['Id'] ?>" onclick="return confirm('Deseja Realmente Exluir?');" class="btn btn-danger btn-lg">Excluir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>