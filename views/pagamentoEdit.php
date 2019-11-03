<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editando Forma de Pagamento</h3>
                    <div>
                        <div >
                            <span>Coloque dias separados por barra( / ) Ex: 10/20/30</span>
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
                            <input type="text" class="form-control" name="descricao" required placeholder="Prazo de Pagamento (10/20/30)" value="<?php echo $info['descricao']?>" style="width:99%;">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div>
                                <div class="form-group float-left">
                                    <input type="submit" value="Salvar" class="btn btn-success btn-lg">
                                    <a href="<?php echo BASE_URL . "pagamentos" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                                </div>
                                <div class="float-right">
                                <a href="<?php echo BASE_URL . "pagamentos/del/" . $info['Id'] ?>" onclick="return confirm('Deseja Realmente Exluir?');" class="btn btn-danger btn-lg">Excluir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>