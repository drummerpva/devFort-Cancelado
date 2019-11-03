<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editando Pedido</h3>
                    <div>
                        <div >
                            <span>Preencha os dados com atenção</span>
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
                        <form method="POST" onsubmit="return atualizaPedido(this);">
                            <div class="card">
                                <div class="card-header" style="height:35px;line-height:35px;padding:5px;">
                                    <h5>Dados do Pedido</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-inline">
                                        <input type="hidden" name="vendaId" value="<?php echo $info['Id'];?>">
                                        <input value="<?php echo $info['vendedor'];?>" type="text" id="buscaVendaVendedor" required data-type="findVendedores" style="width:49%;" placeholder="Vendedor" autocomplete="off" class="form-control">&nbsp;&nbsp;&nbsp;
                                        <input value="<?php echo $info['id_vendedor'];?>" type="hidden" name="vendedorId">
                                        <input value="<?php echo $info['cliente'];?>" type="text" id="buscaVendaCliente" required data-type="findClients" style="width:49%;" placeholder="Cliente" autocomplete="off" class="form-control">&nbsp;&nbsp;&nbsp;
                                        <input value="<?php echo $info['id_cliente'];?>" type="hidden" name="clienteId">
                                    </div>
                                    <div class="form-inline">
                                        <input value="<?php echo number_format($info['valor_outro'],2,",",".");?>" type="text" class="form-control" name="outroValor" placeholder="Outro Valor à Cobrar" style="width:24%;">&nbsp;&nbsp;&nbsp;
                                        <input value="<?php echo number_format($info['valor_desconto'],2,",",".");?>" type="text" class="form-control" name="descontoValor" placeholder="Desconto" style="width:24%;">&nbsp;&nbsp;&nbsp;
                                        <input value="<?php echo number_format($info['valor_produtos'],2,",",".");?>" type="text" class="form-control" name="produtosValor" title="Valor dos Produtos" disabled placeholder="Valor dos Produtos" style="width:24%;">&nbsp;&nbsp;&nbsp;
                                        <input value="<?php echo number_format($info['valor_total'],2,",",".");?>" type="text" class="form-control" name="totalValor" title="Valor Total" disabled required placeholder="Valor Total" style="width:24%;">&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="form-inline">
                                        <textarea type="text" class="form-control" name="outroDescricao" placeholder="Descrição do Valor adicional" style="width:24%;"><?php echo $info['descricao_outro'];?></textarea>&nbsp;&nbsp;&nbsp;
                                        <textarea type="text" class="form-control" name="descontoDescricao" placeholder="Descrição do desconto" style="width:24%;"><?php echo $info['descricao_desconto'];?></textarea>&nbsp;&nbsp;&nbsp;
                                        <textarea name="obs" class="form-control" style="width:49%; " placeholder="Observações..."><?php echo $info['obs'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header" style="height:35px;line-height:35px;padding:5px;">
                                    <h5>Itens do Pedido</h5>
                                </div>
                                <div class="card-body">
                                    <div>  
                                        <fieldset>
                                            <legend style="font-size: 18px;">Adicionar Produto</legend>
                                            <div class="float-left" style="width:50%;">
                                                <input type="text" id="addProd" class="form-control" title="Busque aqui os produtos para adicionar" data-type="findVendaProdutos" placeholder="Buscar Produtos" autocomplete='off'/>
                                            </div>
                                            <div class="float-right" style="width:30%;">
                                                <input value="<?php echo $info['pagamento'];?>" type="text" id="buscaVendaPagamentos" required data-type="findVendaPagamentos" title="Forma de Pagamento" placeholder="Buscar Forma de Pagamento" autocomplete="off" class="form-control">&nbsp;&nbsp;&nbsp;
                                                <input value="<?php echo $info['id_pagamento'];?>" type="hidden" name="pagamentoId">
                                            </div>
                                        </fieldset>
                                    </div><br>
                                    <div style="height:20vh; overflow-y:auto;">
                                        <table class="table table-hover" id="tabelaProdutos">
                                            <thead>
                                                <tr>
                                                    <th>DESCRICAO</th>
                                                    <th style="width:70px;">UND</th>
                                                    <th style="width:70px;">QTDE</th>
                                                    <th>Valor Unit.</th>
                                                    <th>Volume</th>
                                                    <th>Sub-Total</th>
                                                    <th>Excluir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="form-group float-left">
                                <input type="submit" value="Salvar/Imprimir" class="btn btn-success btn-lg">
                                <a href="<?php echo BASE_URL . "vendas" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-success btn-lg" href="<?php echo BASE_URL . "vendas/print/".$info['Id'] ?>" target="_blank">Imprimir</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL."assets/js/produtos.js"?>" type="text/javascript"></script>
<script type="text/javascript">
<?php
foreach($info['items'] as $item){?>
    produtos.setItem(<?php echo $item['id_produto'];?>,'<?php echo $item['descricao'];?>',"<?php echo $item['und'];?>",<?php echo $item['qtd'];?>,<?php echo $item['volume'] ?? 1;?>,<?php echo $item['valor_unitario'];?>);
<?php }?>
$("input[name=produtosValor]").val(produtos.getTotal().toLocaleString('pt-BR')).trigger("change");
</script>