<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Adicionar Forma de Pagamento</h3>
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
                                <input type="text" class="form-control" name="descricao" required placeholder="Prazo de Pagamento (10/20/30)" style="width:99%;">&nbsp;&nbsp;&nbsp;
                            </div>&nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <input type="submit" value="Cadastrar" class="btn btn-success btn-lg">
                                <a href="<?php echo BASE_URL . "pagamentos" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
