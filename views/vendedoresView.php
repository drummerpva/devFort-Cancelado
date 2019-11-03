<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Manutenção de Vendedores</h3>
                    <div>
                        <div class="float-left">
                            <a href="<?php echo BASE_URL . "vendedores/add"; ?>" class="btn btn-success">Inserir Novo</a>
                        </div>
                        <div class="float-right">
                            <input type="text" id="buscaVendedor" data-type="findVendedores" placeholder="Bucar por Vendedores (Nome/Razão Social, CNPJ ou Cidade)" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="400px" onclick="ordenaVendedores('nome');" style="cursor:pointer;">NOME / RAZÃO SOCIAL</th>
                                    <th width="100px">CNPJ</th>
                                    <th onclick="ordenaVendedores('cidade');" style="cursor:pointer;">CIDADE</th>
                                    <th wdith="30px" onclick="ordenaVendedores('uf');" style="cursor:pointer;">UF</th>
                                    <th>FONE</th>
                                    <th width="200px">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vendedoresList as $ven) {
                                    $fone = intval(preg_replace("/[^0-9]/", "", $ven['fone']));
                                    if ($fone == 0) {
                                        $fone = "";
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $ven['nome']; ?></td>
                                        <td data-mask="<?php echo (strlen($ven['cnpj']) < 12) ? "000.000.000-00" : "00.000.000/0000-00"; ?>"><?php echo $ven['cnpj']; ?></td>
                                        <td><?php echo $ven['cidade']; ?></td>
                                        <td><?php echo $ven['uf']; ?></td>
                                        <td data-mask="<?php echo (strlen($fone) < 11) ? "(00) 0000-0000" : "(00) 0.0000-0000"; ?>"><?php echo $fone; ?></td>
                                        <td style="text-align:center;">
                                            <a href="<?php echo BASE_URL . "vendedores/edit/" . $ven['Id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="<?php echo BASE_URL . "vendedores/del/" . $ven['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                                        </td>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="paginationRolavel">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $paginas; $i++) {?>
                                <li class="page-item <?php echo ($i == $pagina) ? " disabled" : ""; ?>"><a class="page-link" href="<?php echo BASE_URL . "vendedores/?p=" . $i . "&ordem=" . $ordem; ?>"><?php echo $i; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
