<?php
class Vendas extends Model
{

    public function findVendas($q)
    {
        $array = [];
        //$cnpj = preg_replace("/[^0-9]/", "", $q);
        $sql = $this->db->prepare("SELECT Id, data_emissao, valor_total,
        (SELECT nome FROM clientes WHERE clientes.Id = vendas_c.id_cliente) as cliente FROM vendas_c WHERE Id = :id");
        $sql->bindValue(":id",$q);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getFechaComissao($ven, $data1, $data2){
        $array = [];
        $sql = $this->db->prepare("SELECT *,
                                   (SELECT nome FROM clientes WHERE clientes.Id = vendas_c.id_cliente) as  cliente,
                                   (SELECT descricao FROM pagamentos WHERE pagamentos.Id = vendas_c.id_pagamento) as pagamento
                                   FROM vendas_c WHERE id_vendedor = :ven AND data_emissao BETWEEN :d1 AND :d2 ORDER BY data_emissao ASC");
        $sql->bindValue(":ven", $ven);
        $sql->bindValue(":d1", $data1);
        $sql->bindValue(":d2", $data2);
        $sql->execute();
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getFechaComissaoTotais($ven, $data1, $data2){
        $array = [];
        $sql = $this->db->prepare("SELECT 
                                   SUM(valor_produtos) as totProd,
                                   SUM(valor_desconto) as descProd
                                   FROM vendas_c WHERE id_vendedor = :ven AND data_emissao BETWEEN :d1 AND :d2");
        $sql->bindValue(":ven", $ven);
        $sql->bindValue(":d1", $data1);
        $sql->bindValue(":d2", $data2);
        $sql->execute();
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }
    public function getList($limit, $offset, $ordem)
    {
        $array = [];
        $ordens = ["data_emissao", "valor_total", "uf"];
        if (in_array($ordem, $ordens)) {
            $sql = $this->db->prepare("SELECT *,
            (SELECT nome FROM vendedores WHERE vendedores.Id = vendas_c.id_vendedor ) as vendedor,
            (SELECT nome FROM clientes WHERE clientes.Id = vendas_c.id_cliente) as cliente
            FROM vendas_c ORDER BY $ordem DESC LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT *,
            (SELECT nome FROM vendedor WHERE vendas_c.id_vendedor = vendedor.Id) as vendedor,
            (SELECT nome FROM clientes WHERE clientes.Id = vendas_c.id_cliente) as cliente,
            FROM vendas_c ORDER BY data_emissao DESC LIMIT :o, :l ");
        }
        $sql->bindValue(":l", $limit, PDO::PARAM_INT);
        $sql->bindValue(":o", $offset, PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getTotal()
    {
        $sql = $this->db->query("SELECT COUNT(1) as c FROM vendas_c");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function clientExists($cnpj)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id FROM clientes WHERE cnpj LIKE :c");
        $sql->bindValue(":c", "%" . $cnpj);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }

        return $retorno;
    }
    public function add($user, $vendedor, $cliente, $pagamento, $outroValor, $descontoValor, $produtosValor, $total, $outroDescricao, $descontoDescricao, $obs)
    {
        $sql = $this->db->prepare("INSERT INTO vendas_c (id_funcionario, id_vendedor, id_cliente, id_pagamento, data_emissao, data_saida, valor_produtos, valor_desconto, valor_outro, valor_total, descricao_desconto, descricao_outro, obs, status) VALUES(:func, :ven, :cli, :pag,NOW(), NOW(), :vlProd, :vlDesc, :vlOut, :vlTot, :descDesc, :descOut, :obs, 'E')");
        $sql->bindValue(":func", $user);
        $sql->bindValue(":ven", $vendedor);
        $sql->bindValue(":cli", $cliente);
        $sql->bindValue(":pag", $pagamento);
        $sql->bindValue(":vlProd", $produtosValor);
        $sql->bindValue(":vlDesc", $descontoValor);
        $sql->bindValue(":vlOut", $outroValor);
        $sql->bindValue(":vlTot", $total);
        $sql->bindValue(":descDesc", $descontoDescricao);
        $sql->bindValue(":descOut", $outroDescricao);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
        return $this->db->lastInsertId();
    }
    public function update($idVenda, $user, $vendedor, $cliente, $pagamento, $outroValor, $descontoValor, $produtosValor, $total, $outroDescricao, $descontoDescricao, $obs)
    {
        $sql = $this->db->prepare("UPDATE vendas_c SET id_funcionario = :func, id_vendedor = :ven, id_cliente = :cli, id_pagamento = :pag, valor_produtos = :vlProd, valor_desconto = :vlDesc, valor_outro = :vlOut, valor_total = :vlTot, descricao_desconto = :descDesc, descricao_outro = :descOut, data_saida = NOW(), obs = :obs, status = 'A' WHERE Id = :id");
        $sql->bindValue(":id", $idVenda);
        $sql->bindValue(":func", $user);
        $sql->bindValue(":ven", $vendedor);
        $sql->bindValue(":cli", $cliente);
        $sql->bindValue(":pag", $pagamento);
        $sql->bindValue(":vlProd", $produtosValor);
        $sql->bindValue(":vlDesc", $descontoValor);
        $sql->bindValue(":vlOut", $outroValor);
        $sql->bindValue(":vlTot", $total);
        $sql->bindValue(":descDesc", $descontoDescricao);
        $sql->bindValue(":descOut", $outroDescricao);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
        return $idVenda;
    }
    public function addProduto($idVenda, $idProduto, $qtd, $vol, $valorUnitario, $valorTotal)
    {
        $sql = $this->db->prepare("INSERT INTO vendas_d (id_vendas_c, id_produto, qtd, volume, valor_unitario, valor_total) VALUES(:ven, :prod, :qtd, :vol, :vlUnit, :vlTotal)");
        $sql->bindValue(":ven", $idVenda);
        $sql->bindValue(":prod", $idProduto);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":vol", $vol);
        $sql->bindValue(":vlUnit", $valorUnitario);
        $sql->bindValue(":vlTotal", $valorTotal);
        $sql->execute();
        return $this->db->lastInsertId();
    }
    public function limpaProdutos($idVenda)
    {
        $sql = $this->db->prepare("DELETE FROM vendas_d WHERE id_vendas_c = :id");
        $sql->bindValue(":id", $idVenda);
        $sql->execute();
        return $idVenda;
    }
    public function edit($id, $nome, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $vendedor, $obs)
    {
        $sql = $this->db->prepare("UPDATE clientes SET nome = :nome, logradouro = :logradouro, bairro = :bairro, cidade = :cidade, uf = :uf, cep = :cep, ie = :ie, fone = :fone, id_vendedor = :id_vendedor, obs = :obs WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":id_vendedor", $vendedor, PDO::PARAM_INT);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM vendas_d WHERE id_vendas_c = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $sql = $this->db->prepare("DELETE FROM vendas_c WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT *,
        (SELECT nome FROM vendedores WHERE vendedores.Id = vendas_c.id_vendedor) as vendedor,
        (SELECT nome FROM clientes WHERE clientes.Id = vendas_c.id_cliente) as cliente,
        (SELECT descricao FROM pagamentos WHERE pagamentos.Id = vendas_c.id_pagamento) as pagamento
        FROM vendas_c WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();

        }
        return $array;
    }
    public function getItems($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT *,
                                  (SELECT descricao FROM produtos WHERE produtos.Id = vendas_d.id_produto) as descricao,
                                  (SELECT und FROM produtos WHERE produtos.Id = vendas_d.id_produto) as und
                                  FROM vendas_d WHERE id_vendas_c = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

}
