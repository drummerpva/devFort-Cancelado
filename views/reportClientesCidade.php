<html>
    <head>
        <title>Relatório de Cliente do Cidade:  <?php echo $cidade; ?></title>
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
        <div class="corpo">
            <h2>Relatório dos Clientes por Vendedor</h2>
            <div style="text-align:left;">
                &nbsp;&nbsp;&nbsp;&nbsp;CIDADE: <b><?php echo $cidade; ?></b>
            </div>
            <div style="text-align:left; border-bottom: 2px solid #777; ">
                &nbsp;&nbsp;&nbsp;&nbsp;DATA: <b><?php echo date("d/m/Y"); ?></b>
            </div>
            <?php 
                $vendedor = "";
                foreach($lista as $l){
                if($vendedor != $l["vendedor"]){
                    $vendedor = $l["vendedor"];
                    echo "<br><div>VENDEDOR: <b>".$vendedor."</b></div>";
                }
                $fone =  (int) preg_replace("/[^0-9]/","",$l['fone']);
                ?>

                <div class="items">
                    <div>
                        <div style="float:left; width: 70%"><b>NOME: </b> <?php echo $l['Id']." - ".$l['nome']?></div>
                        <div style="float:left;"><b>CNPJ: </b> <?php echo $l['cnpj']?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left; width: 55%"><b>END: </b> <?php echo $l['logradouro']?></div>
                        <div style="float:left; width: 44%"><b>BAIRRO: </b> <?php echo $l['bairro']?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left; width: 30%"><b>IE: </b> <?php echo $l['ie']?></div>
                        <div style="float:left; width: 70%"><b>FONE: </b> <?php echo "(".substr($fone,0,2).") ".substr($fone,2)?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left; width: 100%"><b>OBS: </b> <?php echo $l['obs']?></div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            <?php }?>

        </div>

    </body>

</html>