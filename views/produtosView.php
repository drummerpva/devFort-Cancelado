<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Manutenção de Produtos</h3>
                    <div>
                        <div class="float-left">
                            <a href="<?php echo BASE_URL . "produtos/add"; ?>" class="btn btn-success">Inserir Novo</a>
                        </div>
                        <div class="float-right">
                            <input type="text" id="buscaProduto" data-type="findProdutos" placeholder="Bucar por Produtos" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="400px">DESCRIÇÃO</th>
                                    <th width="40px">UND</th>
                                    <th wdith="100px" >QUANTIDADE</th>
                                    <th>VALOR</th>
                                    <th width="200px">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produtosList as $prod) {?>
                                    <tr>
                                        <td><?php echo $prod['descricao']; ?></td>
                                        <td><?php echo $prod['und']; ?></td>
                                        <td data-mask="#.##0,00"><?php echo $prod['qtd']; ?></td>
                                        <td data-mask="#.##0,00"><?php echo $prod['valor']; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?php echo BASE_URL . "produtos/edit/" . $prod['Id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="<?php echo BASE_URL . "produtos/del/" . $prod['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paginationRolavel">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $paginas; $i++) {?>
                                <li class="page-item <?php echo ($i == $pagina) ? " disabled" : ""; ?>"><a class="page-link" href="<?php echo BASE_URL . "produtos/?p=" . $i . "&ordem=" . $ordem; ?>"><?php echo $i; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
