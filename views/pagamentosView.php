<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Manutenção de Formas de Pagamento</h3>
                    <div>
                        <div class="float-left">
                            <a href="<?php echo BASE_URL . "pagamentos/add"; ?>" class="btn btn-success">Inserir Novo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>DESCRIÇÃO</th>
                                    <th width="200px">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pagamentosList as $pag) {?>
                                    <tr>
                                        <td><?php echo $pag['descricao']; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?php echo BASE_URL . "pagamentos/edit/" . $pag['Id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="<?php echo BASE_URL . "pagamentos/del/" . $pag['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                                        </td>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="paginationRolavel">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $paginas; $i++) {?>
                                <li class="page-item <?php echo ($i == $pagina) ? " disabled" : ""; ?>"><a class="page-link" href="<?php echo BASE_URL . "pagamentos/?p=" . $i . "&ordem=" . $ordem; ?>"><?php echo $i; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
