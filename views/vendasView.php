<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Pedidos</h3>
                    <div>
                        <div class="float-left">
                            <a href="<?php echo BASE_URL . "vendas/add"; ?>" class="btn btn-success">Inserir Novo</a>
                        </div>
                        <div class="float-right">
                            <input type="text" id="buscaVenda" data-type="findVendas" placeholder="Bucar por Pedido" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tableRolavel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>PEDIDO</th>
                                    <th width="200px">VENDEDOR</th>
                                    <th width="200px">CLIENTE</th>
                                    <th onclick="ordenaVendas('data_emissao');" style="cursor:pointer;">EMISSÃO</th>
                                    <th wdith="30px" onclick="ordenaVendas('valor_total');" style="cursor:pointer;">TOTAL</th>
                                    <th width="180px">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vendasList as $ven) {?>
                                    <tr>
                                        <td><?php echo $ven['Id']; ?></td>
                                        <td><?php echo $ven['vendedor']; ?></td>
                                        <td><?php echo $ven['cliente']; ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($ven['data_emissao'])); ?></td>
                                        <td nowrap ><?php echo "R$ ".number_format($ven['valor_total'],2,",","."); ?></td>
                                        <td nowrap style="text-align:center;">
                                            <a href="<?php echo BASE_URL . "vendas/edit/" . $ven['Id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="<?php echo BASE_URL . "vendas/del/" . $ven['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                                            <a target="_blank" href="<?php echo BASE_URL . "vendas/print/" . $ven['Id'] ?>" class="btn btn-success btn-sm" >Imprimir</a>
                                        </td>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="paginationRolavel">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $paginas; $i++) {?>
                                <li class="page-item <?php echo ($i == $pagina) ? " disabled" : ""; ?>"><a class="page-link" href="<?php echo BASE_URL . "vendas/?p=" . $i . "&ordem=" . $ordem; ?>"><?php echo $i; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
