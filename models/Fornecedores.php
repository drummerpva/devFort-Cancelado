<?php
class Fornecedores extends Model
{

    public function findFornecedores($q)
    {
        $array = [];
        $cnpj = preg_replace("/[^0-9]/", "", $q);
        $sql = $this->db->prepare("SELECT Id, nome FROM fornecedores WHERE nome LIKE :n OR cnpj = :cnpj OR cidade LIKE :c ORDER BY nome");
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
            $sql = $this->db->prepare("SELECT * FROM fornecedores ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM fornecedores ORDER BY nome LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM fornecedores");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function fornecedorExists($cnpj)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id FROM fornecedores WHERE cnpj LIKE :c");
        $sql->bindValue(":c", "%" . $cnpj);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }

        return $retorno;
    }
    public function add($nome, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $celular, $obs)
    {
        $sql = $this->db->prepare("INSERT INTO fornecedores (nome, cnpj, logradouro, bairro, cidade, uf, cep, ie, fone, celular, obs) VALUES(:nome, :cnpj, :logradouro, :bairro, :cidade, :uf, :cep, :ie, :fone, :celular, :obs)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":celular", $celular);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function edit($id, $nome, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $celular, $obs)
    {
        $sql = $this->db->prepare("UPDATE fornecedores SET nome = :nome, logradouro = :logradouro, bairro = :bairro, cidade = :cidade, uf = :uf, cep = :cep, ie = :ie, fone = :fone, celular = :celular, obs = :obs WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":celular", $celular);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM fornecedores WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM fornecedores WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

}
