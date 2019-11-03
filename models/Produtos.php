<?php
class Produtos extends Model
{
    public function getNameList()
    {
        $array = [];
        $sql = $this->db->prepare("SELECT Id, nome FROM produtos ORDER BY nome ASC");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function findProdutos($q)
    {
        $array = [];
        $cnpj = preg_replace("/[^0-9]/", "", $q);
        $sql = $this->db->prepare("SELECT Id, descricao, valor, und FROM produtos WHERE descricao LIKE :n ORDER BY descricao");
        $sql->bindValue(":n", "%" . $q . "%");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getList($limit, $offset, $ordem)
    {
        $array = [];
        $ordens = ["descricao"];
        if (in_array($ordem, $ordens)) {
            $sql = $this->db->prepare("SELECT * FROM produtos ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM produtos ORDER BY descricao LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM produtos");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function add($nome, $qtd, $valor, $und)
    {
        $sql = $this->db->prepare("INSERT INTO produtos (descricao, qtd, valor, und) VALUES(:descricao, :qtd, :valor, :und)");
        $sql->bindValue(":descricao", $nome);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":und", $und);
        $sql->execute();
    }
    public function edit($id, $nome, $qtd, $valor, $und)
    {
        $sql = $this->db->prepare("UPDATE produtos SET descricao = :descricao, qtd = :qtd, valor = :valor, und = :und WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":descricao", $nome);
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":und", $und);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM produtos WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM produtos WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
}
