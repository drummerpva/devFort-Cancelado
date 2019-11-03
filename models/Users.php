<?php
class Users extends Model
{
    private $id;

    public function verifyLogin()
    {
        if (!empty($_SESSION['lgRecicla'])) {
            $this->id = $_SESSION['lgRecicla'];
            return true;
        } else {
            return false;
        }
    }

    public function login($user, $pass)
    {
        $retorno = false;
        $sql = $this->db->prepare("SELECT Id, nome FROM funcionarios WHERE usuario = :u AND senha = :p AND status = 'A'");
        $sql->bindValue(":u", $user);
        $sql->bindValue(":p", $pass);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $_SESSION['lgRecicla'] = $sql['Id'];
            $this->id = $sql['Id'];
            $this->name = $sql['nome'];
            $retorno = true;
        }

        return $retorno;
    }
    public function logOut()
    {
        unset($_SESSION['lgRecicla']);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        $name = "";
        $sql = $this->db->prepare("SELECT nome FROM funcionarios WHERE Id = ?");
        $sql->execute([$this->getId()]);
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $name = $sql['nome'];
        }

        return $name;
    }
}
