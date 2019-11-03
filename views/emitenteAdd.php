<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Adicionar Emitente</h3>
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
                        <form method="POST">
                            <div class="form-inline">
                                <input type="text" class="form-control" name="nome" required placeholder="Razão Social" style="width:70%;">&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="cnpj" required placeholder="CNPJ"  style="width:28%;">
                            </div>&nbsp;&nbsp;&nbsp;
                            <div class="form-inline">
                                <input type="text" class="form-control" name="fantasia" placeholder="Nome Fantasia" style="width:99%;">
                            </div>&nbsp;&nbsp;&nbsp;
                            <div class="form-inline">
                                <input type="text" class="form-control" name="logradouro" placeholder="Endereço: Rua, Nº - Complemento" style="width:60%;">&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="bairro" placeholder="Bairro" style="width:38%;">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="cidade" placeholder="Cidade" style="width:60%;">&nbsp;&nbsp;&nbsp;
                                <select name="uf" class="form-control" style="width:20%;">
                                    <option value="" selected disabled>UF</option><option value="AC">Acre</option><option value="AL">Alagoas</option><option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option><option value="BA">Bahia</option><option value="CE">Ceará</option><option value="DF">DF</option>
                                    <option value="ES">Espirito Santo</option><option value="GO">Goias</option><option value="MA">Maranhão</option><option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Groso do Sul</option><option value="MG">Minas Gerais</option><option value="PA">Pará</option><option value="PB">Paraíba</option>
                                    <option value="PE">Pernambuco</option><option value="PI">Piauí</option><option value="PR">Paraná</option><option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option><option value="RO">Rondônia</option><option value="RR">Roraima</option><option value="RS">Rio Grande so Sul</option>
                                    <option value="SC">Santa Catarina</option><option value="SE">Sergipe</option><option value="SP">São Paulo</option><option value="TO">Tocantins</option>
                                </select>&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="cep" placeholder="CEP" style="width:17%;">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="ie" placeholder="Inscrição Estadual" style="width:35%;">&nbsp;&nbsp;&nbsp;
                                <input type="tel" class="form-control" name="fone" placeholder="Telefone" style="width:24%;">&nbsp;&nbsp;&nbsp;
                                <input type="email" class="form-control" name="email" placeholder="Email" style="width:38%;">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-group">
                                <textarea name="obs" class="form-control" style="width:99%; min-height:10vh;" placeholder="Observações: Fone extra, contato e etc..."></textarea>&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Cadastrar" class="btn btn-success btn-lg">
                                <a href="<?php echo BASE_URL . "emitentes" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>