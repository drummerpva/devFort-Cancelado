<?php
class Vendedores extends Model
{
    public function getNameList()
    {
        $array = [];
        $sql = $this->db->prepare("SELECT Id, nome FROM vendedores ORDER BY nome ASC");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function findVendedores($q)
    {
        $array = [];
        $cnpj = preg_replace("/[^0-9]/", "", $q);
        $sql = $this->db->prepare("SELECT Id, nome FROM vendedores WHERE nome LIKE :n OR cnpj = :cnpj OR cidade LIKE :c ORDER BY nome");
        $sql->bindValue(":n", "%" . $q . "%");
        $sql->bindValue(":c", "%" . $q . "%");
        $sql->bindValue(":cnpj", $cnpj);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getList($limit, $offset, $ordem)
    {
        $array = [];
        $ordens = ["nome", "cidade", "uf"];
        if (in_array($ordem, $ordens)) {
            $sql = $this->db->prepare("SELECT * FROM vendedores ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM vendedores ORDER BY nome LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM vendedores");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function vendedorExists($cnpj)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id FROM vendedores WHERE cnpj LIKE :c");
        $sql->bindValue(":c", "%" . $cnpj);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }

        return $retorno;
    }
    public function add($nome, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $comissao, $obs)
    {
        $sql = $this->db->prepare("INSERT INTO vendedores (nome, cnpj, logradouro, bairro, cidade, uf, cep, ie, fone, comissao, obs) VALUES(:nome, :cnpj, :logradouro, :bairro, :cidade, :uf, :cep, :ie, :fone, :comissao, :obs)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":comissao", $comissao);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function edit($id, $nome, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $comissao, $obs)
    {
        $sql = $this->db->prepare("UPDATE vendedores SET nome = :nome, logradouro = :logradouro, bairro = :bairro, cidade = :cidade, uf = :uf, cep = :cep, ie = :ie, fone = :fone, comissao = :comissao, obs = :obs WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":comissao", $comissao);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM vendedores WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM vendedores WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    public function getEstadoList()
    {
        $array = [];
        $sql = $this->db->query("SELECT DISTINCT uf FROM vendedores ORDER BY uf ASC");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getVendedoresByUf($uf)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM vendedores WHERE uf = :uf ORDER BY uf, cidade, nome");
        $sql->bindValue(":uf", $uf);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getAllVendedores()
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM vendedores ORDER BY uf, cidade, nome");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}
