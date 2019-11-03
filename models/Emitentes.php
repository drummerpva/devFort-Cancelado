<?php
class Emitentes extends Model
{

    public function findClients($q)
    {
        $array = [];
        $cnpj = preg_replace("/[^0-9]/", "", $q);
        $sql = $this->db->prepare("SELECT Id, razao_social FROM emitentes WHERE nome LIKE :n OR cnpj = :cnpj OR cidade LIKE :c ORDER BY nome");
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
        $ordens = ["razao_social", "cidade", "uf"];
        if (in_array($ordem, $ordens)) {
            $sql = $this->db->prepare("SELECT * FROM emitentes ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM emitentes ORDER BY razao_social LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM emitentes");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function clientExists($cnpj)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id FROM emitentes WHERE cnpj LIKE :c");
        $sql->bindValue(":c", "%" . $cnpj);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }

        return $retorno;
    }
    public function add($nome, $fantasia, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $email, $obs)
    {
        $sql = $this->db->prepare("INSERT INTO emitentes (razao_social, nome_fantasia, cnpj, logradouro, bairro, cidade, uf, cep, ie, fone, email, obs) VALUES(:nome, :fantasia, :cnpj, :logradouro, :bairro, :cidade, :uf, :cep, :ie, :fone, :email, :obs)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":fantasia", $fantasia);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function edit($id, $nome, $fantasia, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $email, $obs)
    {
        $sql = $this->db->prepare("UPDATE emitentes SET razao_social = :nome, nome_fantasia = :fantasia, logradouro = :logradouro, bairro = :bairro, cidade = :cidade, uf = :uf, cep = :cep, ie = :ie, fone = :fone, email = :email, obs = :obs WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":fantasia", $fantasia);
        $sql->bindValue(":logradouro", $logradouro);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":obs", $obs);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM emitentes WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM emitentes WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

}
