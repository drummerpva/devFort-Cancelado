<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Relatórios de Clientes</h3>
                </div>
                <div class="card-body">
                    <div class="col-sm-4 float-left">
                        <div class="card">
                            <div class="card-header">
                                <h5>Relatório por Vendedor</h5>
                            </div>
                            <div class="card-body text-center">
                                <form target="_blank" action="<?php echo BASE_URL."report/printClientes";?>" method="POST">
                                    <select  required name="vendedor" class="form-control">
                                        <option value="">Selecione um Vendedor</option>
                                        <?php foreach($vendedores as $ven){
                                            if($ven['vendedor'] != ""){?>
                                                <option value="<?php echo $ven['id_vendedor']?>"><?php echo $ven['vendedor']?></option>
                                        <?php } }?>
                                    </select>
                                    <br><br>
                                    <button type="submit" class="btn btn-primary btn-lg">Gerar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 float-left">
                        <div class="card">
                            <div class="card-header">
                                <h5>Relatório por Cidade</h5>
                            </div>
                            <div class="card-body text-center">
                                <form target="_blank" action="<?php echo BASE_URL."report/printClientes";?>" method="POST">
                                    <select  required name="cidade" class="form-control">
                                        <option value="">Selecione uma Cidade</option>
                                        <?php foreach($cidades as $cid){
                                            if($cid['cidade'] != ""){?>
                                                <option value="<?php echo $cid['cidade']?>"><?php echo $cid['cidade']?></option>
                                        <?php } }?>
                                    </select>
                                    <br><br>
                                    <button class="btn btn-primary btn-lg">Gerar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 float-left">
                        <div class="card">
                            <div class="card-header">
                                <h5>Relatório por Estado</h5>
                            </div>
                            <div class="card-body text-center">
                                <form target="_blank" action="<?php echo BASE_URL."report/printClientes";?>" method="POST">
                                    <select required name="estado" class="form-control">
                                        <option value="">Selecione um Estado</option>
                                        <?php foreach($estados as $est){
                                            if($est['uf'] != ""){?>
                                                <option value="<?php echo $est['uf']?>"><?php echo $est['uf']?></option>
                                        <?php } }?>
                                    </select>
                                    <br><br>
                                    <button class="btn btn-primary btn-lg">Gerar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 float-left">&nbsp;</div>
                    <div class="col-sm-12 float-left">
                        <div class="card">
                            <div class="card-header">
                                <h5>Relatório de Todos</h5>
                            </div>
                            <div class="card-body text-center">
                                <button class="btn btn-success btn-lg" onclick=" window.open(BASE_URL+'report/printClientes');">Todos os Clientes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
