<?php
class Funcionarios extends Model
{

    public function getList($limit, $offset, $ordem)
    {
        $array = [];
        $ordens = ["nome", "usuario"];
        if (in_array($ordem, $ordens)) {
            $sql = $this->db->prepare("SELECT * FROM funcionarios ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM funcionarios ORDER BY nome LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM funcionarios");
        $sql = $sql->fetch();
        return $sql['c'];
    }
    public function updatePass($senha, $id)
    {
        $sql = $this->db->prepare("UPDATE funcionarios SET senha = :s WHERE Id = :id");
        $sql->bindValue(":s", $senha);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    public function funcionarioExists($usuario)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id FROM funcionarios WHERE usuario = :u");
        $sql->bindValue(":u", $usuario);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }

        return $retorno;
    }
    public function add($nome, $usuario, $senha)
    {
        $sql = $this->db->prepare("INSERT INTO funcionarios (nome, usuario, senha) VALUES(:nome, :usuario, :senha)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":usuario", $usuario);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
    }
    public function edit($id, $nome)
    {
        $sql = $this->db->prepare("UPDATE funcionarios SET nome = :nome WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->execute();
    }
    public function del($id)
    {
        $sql = $this->db->prepare("DELETE FROM funcionarios WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM funcionarios WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

}
