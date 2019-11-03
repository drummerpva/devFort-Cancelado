<?php
class loginController extends controller
{

    private $user;

    public function __construct()
    {
        $this->user = new Users();

    }

    public function index()
    {
        if ($this->user->verifyLogin()) {
            header("Location: " . BASE_URL);
            exit;
        }
        $dados = [
            'msgErro' => '',
        ];
        if (!empty($_POST['login'])) {
            $login = addslashes($_POST['login']);
            $pass = md5($_POST['pass']);
            if ($this->user->login($login, $pass)) {
                header("Location: " . BASE_URL);
                exit;
            } else {
                header("Location: " . BASE_URL . "login/?er=lg");
                exit;
            }
        }
        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "Usuário e/ou senha inválidos";
        }

        $this->loadView('login', $dados);
    }
    public function logOut()
    {
        $this->user->logOut();
        header("Location: " . BASE_URL);
        exit;
    }

}
