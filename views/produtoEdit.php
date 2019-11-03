<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editando Produto</h3>
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
                                <input type="text" class="form-control" name="nome" required placeholder="Descrição" style="width:99%;" value="<?php echo $info['descricao'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="und" placeholder="Unidade" style="width:19%;" value="<?php echo $info['und'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="qtd" maxlength="13" placeholder="Quantidade" style="width:39%;" value="<?php echo $info['qtd'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="valor" maxlength="13" placeholder="Valor" style="width:39%;" value="<?php echo $info['valor'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div>
                                <div class="form-group float-left">
                                    <input type="submit" value="Salvar" class="btn btn-success btn-lg">
                                    <a href="<?php echo BASE_URL . "produtos" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                                </div>
                                <div class="float-right">
                                <a href="<?php echo BASE_URL . "produtos/del/" . $info['Id'] ?>" onclick="return confirm('Deseja Realmente Exluir?');" class="btn btn-danger btn-lg">Excluir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>