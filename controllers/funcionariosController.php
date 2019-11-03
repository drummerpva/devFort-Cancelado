<?php
class funcionariosController extends controller
{

    private $user;

    public function __construct()
    {
        $this->user = new Users();
        if (!$this->user->verifyLogin()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

    public function index()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();

        $f = new Funcionarios();
        $offset = 0;
        $limit = 9;
        $total = $f->getTotal();
        $dados['pagina'] = 1;
        if (!empty($_GET['p'])) {
            $dados['pagina'] = intval($_GET['p']);
        }
        $offset = ($dados['pagina'] * $limit) - $limit;
        $ordem = "nome";
        if (!empty($_GET['ordem'])) {
            $ordem = $_GET['ordem'];
        }
        $dados['ordem'] = $ordem;
        $dados['paginas'] = ceil($total / $limit);
        $dados['funcionariosList'] = $f->getList($limit, $offset, $ordem);

        $this->loadTemplate('funcionariosView', $dados);
    }
    public function add()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();
        if (!empty($_POST['nome'])) {
            $nome = strtoupper(trim(addslashes($_POST['nome'])));
            $usuario = strtolower($_POST['usuario']);
            $senha = md5($_POST['senha']);

            $f = new Funcionarios();
            if (!$f->funcionarioExists($usuario)) {
                $f->add($nome, $usuario, $senha);
                header("Location: " . BASE_URL . "funcionarios");
                exit;
            } else {
                header("Location: " . BASE_URL . "funcionarios/add?er=1");
                exit;
            }

        }

        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "Usuário já cadastrado, por favor verifique na lista de cadastrados";
        }

        $this->loadTemplate('funcionarioAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $f = new Funcionarios();
            if (!empty($_POST['nome'])) {
                $nome = strtoupper(trim(addslashes($_POST['nome'])));
                $f->edit($id, $nome);
                if (!empty($_POST['senha'])) {
                    $senha = md5($_POST['senha']);
                    $f->updatePass($senha, $id);
                }
                header("Location: " . BASE_URL . "funcionarios");
                exit;

            }
            if (!empty($_GET['er'])) {
                $dados['msgErro'] = "Usuário já cadastrado, por favor verifique na lista de cadastrados";
            }
            $dados['info'] = $f->getById($id);

            $this->loadTemplate('funcionarioEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "funcionarios");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $f = new Funcionarios();
            $f->del($id);
        }
        header("Location: " . BASE_URL . "funcionarios");
        exit;
    }

}
