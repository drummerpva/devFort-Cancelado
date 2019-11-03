<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Manutenção de Emitentes</h3>
                    <div>
                        <div class="float-left">
                            <a href="<?php echo BASE_URL . "emitentes/add"; ?>" class="btn btn-success">Inserir Novo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="400px" onclick="ordenaEmitentes('razao_social');" style="cursor:pointer;">RAZÃO SOCIAL</th>
                                    <th width="100px">CNPJ</th>
                                    <th onclick="ordenaEmitentes('cidade');" style="cursor:pointer;">CIDADE</th>
                                    <th wdith="30px" onclick="ordenaEmitentes('uf');" style="cursor:pointer;">UF</th>
                                    <th>FONE</th>
                                    <th width="200px">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($emitentesList as $emit) {
                                    $fone = intval(preg_replace("/[^0-9]/", "", $emit['fone']));
                                    if ($fone == 0) {
                                        $fone = "";
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $emit['razao_social']; ?></td>
                                        <td data-mask="<?php echo (strlen($emit['cnpj']) < 12) ? "000.000.000-00" : "00.000.000/0000-00"; ?>"><?php echo $emit['cnpj']; ?></td>
                                        <td><?php echo $emit['cidade']; ?></td>
                                        <td><?php echo $emit['uf']; ?></td>
                                        <td data-mask="<?php echo (strlen($fone) < 11) ? "(00) 0000-0000" : "(00) 0.0000-0000"; ?>"><?php echo $fone; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?php echo BASE_URL . "emitentes/edit/" . $emit['Id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="<?php echo BASE_URL . "emitentes/del/" . $emit['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                                        </td>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="paginationRolavel">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $paginas; $i++) {?>
                                <li class="page-item <?php echo ($i == $pagina) ? " disabled" : ""; ?>"><a class="page-link" href="<?php echo BASE_URL . "emitentes/?p=" . $i . "&ordem=" . $ordem; ?>"><?php echo $i; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
