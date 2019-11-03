<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Manutenção de Funcionários</h3>
                    <div>
                        <div class="float-left">
                            <a href="<?php echo BASE_URL . "funcionarios/add"; ?>" class="btn btn-success">Inserir Novo</a>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="400px" onclick="ordenaFuncionarios('nome');" style="cursor:pointer;">NOME</th>
                                    <th onclick="ordenaFuncionarios('usuario');" style="cursor:pointer;">USUARIO</th>
                                    <th width="200px">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($funcionariosList as $func) {
                                ?>
                                    <tr>
                                        <td><?php echo $func['nome']; ?></td>
                                        <td><?php echo $func['usuario']; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?php echo BASE_URL . "funcionarios/edit/" . $func['Id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="<?php echo BASE_URL . "funcionarios/del/" . $func['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                                        </td>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="paginationRolavel">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $paginas; $i++) {?>
                                <li class="page-item <?php echo ($i == $pagina) ? " disabled" : ""; ?>"><a class="page-link" href="<?php echo BASE_URL . "funcionarios/?p=" . $i . "&ordem=" . $ordem; ?>"><?php echo $i; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
