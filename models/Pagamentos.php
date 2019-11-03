<?php
class Pagamentos extends Model
{
    public function findPagamentos($q)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT Id, descricao FROM pagamentos WHERE descricao LIKE :n ORDER BY descricao");
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
            $sql = $this->db->prepare("SELECT * FROM pagamentos ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM pagamentos ORDER BY descricao LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM pagamentos");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function pagamentoExists($desc)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id FROM pagamentos WHERE descricao = :c");
        $sql->bindValue(":c", $desc);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }

        return $retorno;
    }
    public function add($desc)
    {
        $sql = $this->db->prepare("INSERT INTO pagamentos (descricao) VALUES(:desc)");
        $sql->bindValue(":desc", $desc);
        $sql->execute();
    }
    public function edit($id, $desc)
    {
        $sql = $this->db->prepare("UPDATE pagamentos SET descricao = :desc WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":desc", $desc);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM pagamentos WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM pagamentos WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

}
