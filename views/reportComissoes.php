<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Relatório de Comissões</h3>
                </div>
                <div class="card-body">
                    <form target="_blank"  class="form-inline" action="<?php echo BASE_URL."report/printComissoes";?>" method="POST">
                        <div class="float-left" style="width:40%">
                            <select  required name="vendedor" class="form-control">
                                <option value="">Selecione um Vendedor</option>
                                <?php foreach($vendedores as $ven){
                                    if($ven['nome'] != ""){?>
                                        <option value="<?php echo $ven['Id']?>"><?php echo $ven['nome']?></option>
                                <?php } }?>
                            </select>
                        </div>
                        <div class="float-left" style="width:22% ">
                            <input  value="<?php echo date("Y-m-d",strtotime("-30 days"));?>" title="Data Inicial" required name="data1" class="form-control" type="date">
                        </div>
                        <div class="float-left" style="width:22% ">
                            <input  value="<?php echo date("Y-m-d");?>" title="Data Final" required name="data2" class="form-control" type="date">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Gerar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
