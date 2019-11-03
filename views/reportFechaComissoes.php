<html>
    <head>
        <title>Fechamento de Comissão</title>
        <style rel="stylesheet" type="text/css">
        body{
                margin:0;
                text-align: center;
                padding:0;
                font-family: Arial;
                font-size: 14px;
            }
            .corpo{
                width:666px;
                margin:auto;
            }
            .items{
                margin-top: 5px;
                margin-left: 10px;
                margin-bottom: 5px;
                border-bottom: 2px dotted #BBB;
                text-align: left;
                overflow: hidden;
            }
        </style>
    </head>
    <body>
        <?php
            $totGeral = 0.00;
            $totGeral = $totais['totProd'] - $totais['descProd'];
            $comissaoCorreta = (Double) $dadosVendedor['comissao'];
            if($comissaoCorreta > 10){
                $comissaoCorreta = (int) str_replace(".","",$comissaoCorreta);
                $comissaoCorreta = "0.".$comissaoCorreta;    
            }else{
                $comissaoCorreta = (int) str_replace(".","",$comissaoCorreta);
                $comissaoCorreta = "0.0".$comissaoCorreta;
            }
            
            $comissaoCorreta = (Double)$comissaoCorreta;
        
        ?>
        <div class="corpo">
            <h2>Fechamento de Comissão</h2>
            <div style="text-align:left; float:left; width:60%">
                &nbsp;&nbsp;&nbsp;&nbsp;VENDEDOR: <b><?php echo $dadosVendedor['nome']; ?></b>
            </div>
            <div style="text-align:left; float:left">
                &nbsp;&nbsp;&nbsp;&nbsp;COMISSAO: <b><?php echo number_format($dadosVendedor['comissao'],2,",",".")."%"; ?></b>
            </div>
            <div style="clear:both"></div>
            <div style="text-align:left; float:left; width: 50%;">
                &nbsp;&nbsp;&nbsp;&nbsp;TOTAL VENDAS: <b><?php echo "R$ ".number_format($totais['totProd'],2,",","."); ?></b>
            </div>
            <div style="text-align:left; float:left width: 49%;">
                &nbsp;&nbsp;&nbsp;&nbsp;TOTAL DE DESCONTOS: <b><?php echo number_format($totais['descProd'],2,",","."); ?></b>
            </div>
            <div style="clear:both;"></div>
            <div style="text-align:right; float:right">
                &nbsp;&nbsp;&nbsp;&nbsp;TOTAL GERAL: <b><?php echo "R$ ".number_format($totGeral,2,",","."); ?></b>
            </div>
            <div style="clear:both;"></div>
            <div style="text-align:left; float:left; width: 50%;">
                &nbsp;&nbsp;&nbsp;&nbsp;DE: <b><?php echo date("d/m/Y", strtotime($dataInicial)); ?></b>
                &nbsp;&nbsp;ATÉ&nbsp;&nbsp;<b><?php echo date("d/m/Y", strtotime($dataFinal)); ?></b>
            </div>
            <div style="text-align:left; float:left; width: 47%;">
                &nbsp;&nbsp;&nbsp;&nbsp;VALOR DA COMISSÃO: <b><?php echo "R$ ".number_format($totGeral*$comissaoCorreta,2,",","."); ?></b>
                
            </div>
            <div style="border-bottom: 2px solid #777; clear:both;"></div>
            <?php 
                foreach($lista as $l){
                ?>
                <div class="items">
                    <div>
                        <div style="float:left; width: 70%"><b>PEDIDO NRO: </b> <?php echo $l['Id'];?></div>
                        <div style="float:left; width: 29%"><b>DATA: </b> <?php echo date("d/m/Y", strtotime($l['data_emissao']));?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left; width: 95%"><b>CLIENTE: </b> <?php echo $l['id_cliente']." - ".$l['cliente'];?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left; width: 55%"><b>VALOR TOTAL PRODUTOS: </b> <?php echo "R$ ".number_format($l['valor_produtos'],2,",",".");?></div>
                        <div style="float:left; width: 44%"><b>VALOR DOS DESCONTOS: </b> <?php echo "R$ ".number_format($l['valor_desconto'],2,",",".");?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left; width: 40%"><b>VALOR TOTAL: </b> <?php echo "R$ ".number_format(($l['valor_produtos']-$l['valor_desconto']),2,",",".");?></div>
                        <div style="float:left; width: 55%"><b>VALOR DA COMISSÂO: </b> <?php echo "R$ ".number_format(($l['valor_produtos']-$l['valor_desconto'])*$comissaoCorreta,2,",",".");?></div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            <?php }?>

        </div>

    </body>

</html>