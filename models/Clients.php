<?php
class Clients extends Model
{

    public function findClients($q)
    {
        $array = [];
        $cnpj = preg_replace("/[^0-9]/", "", $q);
        $sql = $this->db->prepare("SELECT Id, nome FROM clientes WHERE Id = :id OR nome LIKE :n OR cnpj = :cnpj OR cidade LIKE :c ORDER BY nome");
        $sql->bindValue(":id", $q);
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
            $sql = $this->db->prepare("SELECT * FROM clientes ORDER BY $ordem LIMIT :o, :l ");
        } else {
            $sql = $this->db->prepare("SELECT * FROM clientes ORDER BY nome LIMIT :o, :l ");
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
        $sql = $this->db->query("SELECT COUNT(1) as c FROM clientes");
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
    public function add($nome, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $vendedor, $obs)
    {
        $sql = $this->db->prepare("INSERT INTO clientes (nome, cnpj, logradouro, bairro, cidade, uf, cep, ie, fone, id_vendedor, obs, data_cadastro) VALUES(:nome, :cnpj, :logradouro, :bairro, :cidade, :uf, :cep, :ie, :fone, :id_vendedor, :obs, NOW())");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":cnpj", $cnpj);
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
        $sql = $this->db->prepare("DELETE FROM clientes WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getById($id)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM clientes WHERE Id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

    public function getCidadeList()
    {
        $array = [];
        $sql = $this->db->query("SELECT DISTINCT cidade FROM clientes ORDER BY cidade ASC");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getEstadoList()
    {
        $array = [];
        $sql = $this->db->query("SELECT DISTINCT uf FROM clientes ORDER BY uf ASC");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getVendedorList()
    {
        $array = [];
        $sql = $this->db->query("SELECT DISTINCT id_vendedor,
                                (SELECT nome FROM vendedores WHERE vendedores.Id = clientes.id_vendedor) as vendedor FROM clientes WHERE id_vendedor != 0 ORDER BY vendedor ASC");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getClientesByVendedor($ven)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM clientes WHERE id_vendedor = :ven ORDER BY cidade, nome");
        $sql->bindValue(":ven", $ven);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getClientesByCidade($cid)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT *,
                                   (SELECT nome FROM vendedores WHERE vendedores.Id = clientes.id_vendedor) as vendedor FROM clientes WHERE cidade = :cid ORDER BY vendedor, nome");
        $sql->bindValue(":cid", $cid);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getClientesByUf($uf)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT *,
                                   (SELECT nome FROM vendedores WHERE vendedores.Id = clientes.id_vendedor) as vendedor FROM clientes WHERE uf = :uf ORDER BY uf, cidade, nome");
        $sql->bindValue(":uf", $uf);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
    public function getAllClientes()
    {
        $array = [];
        $sql = $this->db->prepare("SELECT *,
                                   (SELECT nome FROM vendedores WHERE vendedores.Id = clientes.id_vendedor) as vendedor
                                    FROM clientes ORDER BY uf, cidade, nome");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


}
