<html>
    <head>
        <title>Pedido: <?php echo $info['Id']; ?></title>
        <style rel="stylesheet" type="text/css">
            body{
                margin:0;
                text-align: center;
                padding:0;
                font-family: Arial;
                font-size: 16px;
            }
            .corpo{
                width:666px;
                border: 1px solid #000;
                margin:auto;
            }
            .cliDiv,
            .rodape{
                width: 100%;
                margin:auto;
            }
            .rodape{
                font-size: 14px;
            }
            .prodTabela{
                width: 100%;
                height:288px;
                border-bottom: 1px solid #000;
            }
            .prodTabela table{
                width: 100%;
                border: 1px solid #000;
                border-collapse: collapse;
            }
            .prodTabela tr,
            .prodTabela td,
            .prodTabela th{
                border: 1px solid #000;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
                <?php
                    $parcelas = "";
                    $vlParc = 0.00;
                    if($info['pagamento'] != "A VISTA"){
                        $parcs = explode("/",$info['pagamento']);
                        $qtParc = (int) count($parcs);
                        $vlParc =  $info['valor_total'] / $qtParc;
                        for($i = 0; $i<$qtParc;$i++){
                            $parcelas .= date("d/m/Y", strtotime($info['data_saida']."+ ".trim($parcs[$i])." days"))."  -  ";
                        }
                    }else{
                        $parcelas = $info['pagamento'];
                        $vlParc = $info['valor_total'];
                    }
                ?>
            <div class="corpo">
                <div class="cliDiv">
                    <div style="text-align: left; width: 50%; float:left; ">PEDIDO: <?php echo $info['Id']; ?></div>
                    <div style="text-align: left; width: 25%; float:left;">DATA: <?php echo date("d/m/Y", strtotime($info['data_saida'])); ?></div>
                    <div style="text-align: left; width: 24%; float:left;">HORA: <?php echo date("H:m:i", strtotime($info['data_saida'])); ?></div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; width: 100%;">CLIENTE: <?php echo $info['id_cliente'] . " - " . $info['cliente']; ?></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; float:left; width: 40%;">
                    TELEFONE: <?php echo "(" . substr(intval(preg_replace("/[^0-9]/", "", $info['infoCliente']['fone'])), 0, 2) . ") " . substr(intval(preg_replace("/[^0-9]/", "", $info['infoCliente']['fone'])), 2); ?>
                    </div>
                    <div style="text-align: left; float:left;  width: 60%;">
                    VENDEDOR: <?php echo $info['id_vendedor'] . " - " . $info['vendedor']; ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; float:left; width: 60%;">
                    END: <?php echo $info['infoCliente']['logradouro']; ?>
                    </div>
                    <div style="text-align: left; float:left; width: 40%;">
                    BAIRRO: <?php echo $info['infoCliente']['bairro']; ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; float:left; width: 20%;">
                        <?php echo trim($info['infoCliente']['cep']); ?>
                    </div>
                    <div style="text-align: left; float:left; width: 28%;">
                        <?php echo $info['infoCliente']['cidade'] . " - " . $info['infoCliente']['uf']; ?>
                    </div>
                    <div style="text-align: left; float:left; width: 45%;">
                        CNPJ: <?php echo $info['infoCliente']['cnpj']; ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left;width: 100%;">
                    COND-PGTO: <?php echo $info['id_pagamento'] . " - " . $info['pagamento']; ?>
                    </div>
                </div>
                <div class="prodTabela">
                    <table>
                        <thead>
                            <tr>
                                <th>QTDE</th>
                                <th>COD</th>
                                <th>DESCRICAO</th>
                                <th>UND</th>
                                <th>VOLs</th>
                                <th>UNITARIO</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qtTotal = 0;
                            $volTotal = 0;
                            foreach ($info['items'] as $item) {
                                $qtTotal += $item['qtd'];
                                $volTotal += $item['volume'];
                                echo "<tr>";
                                    echo "<td>".$item['qtd']."</td>";
                                    echo "<td>".$item['id_produto']."</td>";
                                    echo "<td>".$item['descricao']."</td>";
                                    echo "<td align='center'>".$item['und']."</td>";
                                    echo "<td align='center'>".($item['volume'] ?? 1)."</td>";
                                    echo "<td nowrap align='right'>".number_format($item['valor_unitario'],2,",",".")."</td>";
                                    echo "<td nowrap align='right'>".number_format($item['valor_total'],2,",",".")."</td>";
                                echo "</tr>";
                            }?>
                        </tbody>
                    </table>
                </div>
                <div class="rodape">
                    <div style="text-align: left; float:left; width: 30%;">
                        &nbsp;&nbsp;<?php echo number_format($qtTotal,2,",","."); ?>
                    </div>
                    <div style="text-align: left; float:left; width: 30%;">
                        VOLUMES.: &nbsp;&nbsp;<?php echo number_format($volTotal,0,",","."); ?>
                    </div>
                    <div style="text-align: right; width: 20%;float:left;">
                        SUB-TOTAL.:R$ 
                    </div>
                    <div style="width: 20%; text-align: right;">
                        <?php echo number_format($info['valor_produtos'],2,",","."); ?>&nbsp;&nbsp;
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="rodape">
                    <div style="text-align: left; float:left; width: 18%;">
                    &nbsp;
                    </div>
                    <div style="text-align: left; float:left; width: 22%;">
                        DESP./ACRESCIMO.:R$ 
                    </div>
                    <div style="text-align: left; float:left; width: 20%; text-align:right;">
                        <?php echo number_format($info['valor_outro'],2,",","."); ?> &nbsp;&nbsp;
                    </div>
                    <div style="text-align: right; float:left; width: 20%;">
                        DESCONTO.:R$ 
                    </div>
                    <div style="text-align: left; float:left; width: 20%; text-align: right;">
                        <?php echo number_format($info['valor_desconto'],2,",","."); ?>&nbsp;&nbsp;
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="rodape">
                    <div style="text-align: left; float:left; width: 60%;">
                        &nbsp;&nbsp;VLR. PARC.:R$  <?php echo number_format($vlParc,2,",","."); ?>
                    </div>
                    <div style="text-align: right; float:left; width: 20%;">
                        TOTAL.:R$
                    </div>
                    <div style="float:left; width: 19%; text-align:right;">
                        <?php echo number_format($info['valor_total'],2,",","."); ?> 
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="rodape">
                    <div style="text-align: left; width: 100%; font-size: 12px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;PARCELAS.: <?php echo $parcelas; ?>
                    </div>
                </div>
            </div>
            <br>
            <!-- Parte 2-->
            <?php if(count($info["items"]) < 16){?>
                <div class="corpo">
                <div class="cliDiv">
                    <div style="text-align: left; width: 50%; float:left; ">PEDIDO: <?php echo $info['Id']; ?></div>
                    <div style="text-align: left; width: 25%; float:left;">DATA: <?php echo date("d/m/Y", strtotime($info['data_saida'])); ?></div>
                    <div style="text-align: left; width: 24%; float:left;">HORA: <?php echo date("H:m:i", strtotime($info['data_saida'])); ?></div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; width: 100%;">CLIENTE: <?php echo $info['id_cliente'] . " - " . $info['cliente']; ?></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; float:left; width: 40%;">
                    TELEFONE: <?php echo "(" . substr(intval(preg_replace("/[^0-9]/", "", $info['infoCliente']['fone'])), 0, 2) . ") " . substr(intval(preg_replace("/[^0-9]/", "", $info['infoCliente']['fone'])), 2); ?>
                    </div>
                    <div style="text-align: left; float:left;  width: 60%;">
                    VENDEDOR: <?php echo $info['id_vendedor'] . " - " . $info['vendedor']; ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; float:left; width: 60%;">
                    END: <?php echo $info['infoCliente']['logradouro']; ?>
                    </div>
                    <div style="text-align: left; float:left; width: 40%;">
                    BAIRRO: <?php echo $info['infoCliente']['bairro']; ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left; float:left; width: 20%;">
                        <?php echo trim($info['infoCliente']['cep']); ?>
                    </div>
                    <div style="text-align: left; float:left; width: 28%;">
                        <?php echo $info['infoCliente']['cidade'] . " - " . $info['infoCliente']['uf']; ?>
                    </div>
                    <div style="text-align: left; float:left; width: 45%;">
                        CNPJ: <?php echo $info['infoCliente']['cnpj']; ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="cliDiv">
                    <div style="text-align: left;width: 100%;">
                    COND-PGTO: <?php echo $info['id_pagamento'] . " - " . $info['pagamento']; ?>
                    </div>
                </div>
                <div class="prodTabela">
                    <table>
                        <thead>
                            <tr>
                                <th>QTDE</th>
                                <th>COD</th>
                                <th>DESCRICAO</th>
                                <th>UND</th>
                                <th>VOLs</th>
                                <th>UNITARIO</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qtTotal = 0;
                            foreach ($info['items'] as $item) {
                                $qtTotal += $item['qtd'];
                                echo "<tr>";
                                    echo "<td>".$item['qtd']."</td>";
                                    echo "<td>".$item['id_produto']."</td>";
                                    echo "<td>".$item['descricao']."</td>";
                                    echo "<td align='center'>".$item['und']."</td>";
                                    echo "<td align='center'>".($item['volume'] ?? 1)."</td>";
                                    echo "<td nowrap align='right'>".number_format($item['valor_unitario'],2,",",".")."</td>";
                                    echo "<td nowrap align='right'>".number_format($item['valor_total'],2,",",".")."</td>";
                                echo "</tr>";
                            }?>
                        </tbody>
                    </table>
                </div>
                <div class="rodape">
                    <div style="text-align: left; float:left; width: 30%;">
                    &nbsp;&nbsp;<?php echo number_format($qtTotal,2,",","."); ?>
                    </div>
                    <div style="text-align: left; float:left; width: 30%;">
                        VOLUMES.: &nbsp;&nbsp;<?php echo number_format($volTotal,0,",","."); ?>
                    </div>
                    <div style="text-align: right; width: 20%;float:left;">
                        SUB-TOTAL.:R$ 
                    </div>
                    <div style="width: 20%; text-align: right;">
                        <?php echo number_format($info['valor_produtos'],2,",","."); ?>&nbsp;&nbsp;
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="rodape">
                    <div style="text-align: left; float:left; width: 18%;">
                    &nbsp;
                    </div>
                    <div style="text-align: left; float:left; width: 22%;">
                        DESP./ACRESCIMO.:R$ 
                    </div>
                    <div style="text-align: left; float:left; width: 20%; text-align:right;">
                        <?php echo number_format($info['valor_outro'],2,",","."); ?> &nbsp;&nbsp;
                    </div>
                    <div style="text-align: right; float:left; width: 20%;">
                        DESCONTO.:R$ 
                    </div>
                    <div style="text-align: left; float:left; width: 20%; text-align: right;">
                        <?php echo number_format($info['valor_desconto'],2,",","."); ?>&nbsp;&nbsp;
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="rodape">
                    <div style="text-align: left; float:left; width: 60%;">
                        &nbsp;&nbsp;VLR. PARC.:R$  <?php echo number_format($vlParc,2,",","."); ?>
                    </div>
                    <div style="text-align: right; float:left; width: 20%;">
                        TOTAL.:R$
                    </div>
                    <div style="float:left; width: 19%; text-align:right;">
                        <?php echo number_format($info['valor_total'],2,",","."); ?> 
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="rodape">
                    <div style="text-align: left; width: 100%; font-size: 12px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;PARCELAS.: <?php echo $parcelas; ?>
                    </div>
                </div>
            </div>
        <?php }?>                   
        <script type="text/javascript">
            var BASE_URL = "<?php echo BASE_URL; ?>";
        </script>
    </body>

</html>