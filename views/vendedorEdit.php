<div class="telaPrincipal">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editando Vendedor</h3>
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
                                <input type="text" class="form-control" name="nome" required placeholder="Nome ou Razão Social" style="width:70%;" value="<?php echo $info['nome'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="cnpjE" data-mask="<?php echo (strlen($info['cnpj']) < 12) ? "000.000.000-00" : "00.000.000/0000-00"; ?>" disabled placeholder="CNPJ ou CPF" style="width:28%;" value="<?php echo $info['cnpj'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="logradouro" placeholder="Endereço: Rua, Nº - Complemento" style="width:60%;" value="<?php echo $info['logradouro'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="bairro" placeholder="Bairro" style="width:38%;" value="<?php echo $info['bairro'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="cidade" placeholder="Cidade" style="width:60%;" value="<?php echo $info['cidade'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <select name="uf" class="form-control" style="width:20%;">
                                    <option value="">UF</option>
                                    <option value="AC" <?php echo ($info['uf'] == "AC") ? "selected" : ""; ?>>Acre</option>
                                    <option value="AL" <?php echo ($info['uf'] == "AL") ? "selected" : ""; ?>>Alagoas</option>
                                    <option value="AP" <?php echo ($info['uf'] == "AP") ? "selected" : ""; ?>>Amapá</option>
                                    <option value="AM" <?php echo ($info['uf'] == "AM") ? "selected" : ""; ?>>Amazonas</option>
                                    <option value="BA" <?php echo ($info['uf'] == "BA") ? "selected" : ""; ?>>Bahia</option>
                                    <option value="CE" <?php echo ($info['uf'] == "CE") ? "selected" : ""; ?>>Ceará</option>
                                    <option value="DF" <?php echo ($info['uf'] == "DF") ? "selected" : ""; ?>>DF</option>
                                    <option value="ES" <?php echo ($info['uf'] == "ES") ? "selected" : ""; ?>>Espirito Santo</option>
                                    <option value="GO" <?php echo ($info['uf'] == "GO") ? "selected" : ""; ?>>Goias</option>
                                    <option value="MA" <?php echo ($info['uf'] == "MA") ? "selected" : ""; ?>>Maranhão</option>
                                    <option value="MT" <?php echo ($info['uf'] == "MT") ? "selected" : ""; ?>>Mato Grosso</option>
                                    <option value="MS" <?php echo ($info['uf'] == "MS") ? "selected" : ""; ?>>Mato Groso do Sul</option>
                                    <option value="MG" <?php echo ($info['uf'] == "MG") ? "selected" : ""; ?>>Minas Gerais</option>
                                    <option value="PA" <?php echo ($info['uf'] == "PA") ? "selected" : ""; ?>>Pará</option>
                                    <option value="PB" <?php echo ($info['uf'] == "PB") ? "selected" : ""; ?>>Paraíba</option>
                                    <option value="PE" <?php echo ($info['uf'] == "PE") ? "selected" : ""; ?>>Pernambuco</option>
                                    <option value="PI" <?php echo ($info['uf'] == "PI") ? "selected" : ""; ?>>Piauí</option>
                                    <option value="PR" <?php echo ($info['uf'] == "PR") ? "selected" : ""; ?>>Paraná</option>
                                    <option value="RJ" <?php echo ($info['uf'] == "RJ") ? "selected" : ""; ?>>Rio de Janeiro</option>
                                    <option value="RN" <?php echo ($info['uf'] == "RN") ? "selected" : ""; ?>>Rio Grande do Norte</option>
                                    <option value="RO" <?php echo ($info['uf'] == "RO") ? "selected" : ""; ?>>Rondônia</option>
                                    <option value="RR" <?php echo ($info['uf'] == "RR") ? "selected" : ""; ?>>Roraima</option>
                                    <option value="RS" <?php echo ($info['uf'] == "RS") ? "selected" : ""; ?>>Rio Grande so Sul</option>
                                    <option value="SC" <?php echo ($info['uf'] == "SC") ? "selected" : ""; ?>>Santa Catarina</option>
                                    <option value="SE" <?php echo ($info['uf'] == "SE") ? "selected" : ""; ?>>Sergipe</option>
                                    <option value="SP" <?php echo ($info['uf'] == "SP") ? "selected" : ""; ?>>São Paulo</option>
                                    <option value="TO" <?php echo ($info['uf'] == "TO") ? "selected" : ""; ?>>Tocantins</option>
                                </select>&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control" name="cep" placeholder="CEP" style="width:17%;" value="<?php echo $info['cep'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                            </div>
                            <?php {
                                $fone = intval(preg_replace("/[^0-9]/", "", $info['fone']));
                                if ($fone == 0) {
                                    $fone = "";
                                }
                            }?>
                            <div class="form-inline">
                                <input type="text" class="form-control" name="ie" placeholder="Inscrição Estadual" style="width:35%;" value="<?php echo $info['ie'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="tel" class="form-control" name="fone" data-mask="<?php echo (strlen($fone) < 11) ? "(00) 0000-0000" : "(00) 0.0000-0000"; ?>" placeholder="Telefone" style="width:38%;" value="<?php echo $fone ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                                <input type="tel" class="form-control" name="comissao" placeholder="Comissão" style="width:24%;" value="<?php echo $info['comissao'] ?? ""; ?>">&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="form-group">
                                <textarea name="obs" class="form-control" style="width:99%; min-height:10vh;" placeholder="Observações: Fone extra, contato e etc..."> <?php echo $info['obs'] ?? ""; ?></textarea>&nbsp;&nbsp;&nbsp;
                            </div>
                            <div>
                                <div class="form-group float-left">
                                    <input type="submit" value="Salvar" class="btn btn-success btn-lg">
                                    <a href="<?php echo BASE_URL . "vendedores" ?>" class="btn btn-danger btn-lg">Cancelar</a>
                                </div>
                                <div class="float-right">
                                <a href="<?php echo BASE_URL . "vendedores/del/" . $info['Id'] ?>" onclick="return confirm('Deseja Realmente Exluir?');" class="btn btn-danger btn-lg">Excluir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>