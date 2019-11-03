<?php
class clientesController extends controller
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

        $c = new Clients();
        $offset = 0;
        $limit = 30;
        $total = $c->getTotal();
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
        $dados['clientsList'] = $c->getList($limit, $offset, $ordem);

        $this->loadTemplate('clientesView', $dados);
    }
    public function add()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();
        if (!empty($_POST['nome'])) {
            $nome = strtoupper(trim(addslashes($_POST['nome'])));
            $cnpj = preg_replace("/[^0-9]/", '', $_POST['cnpj']);
            $logradouro = strtoupper(trim(addslashes($_POST['logradouro'])));
            $bairro = strtoupper(trim(addslashes($_POST['bairro'])));
            $cidade = strtoupper(trim(addslashes($_POST['cidade'])));
            $uf = trim(addslashes($_POST['uf']));
            $cep = trim(addslashes($_POST['cep']));
            $ie = trim(addslashes($_POST['ie']));
            $fone = trim(addslashes($_POST['fone']));
            $vendedor = trim(addslashes($_POST['vendedor']));
            $obs = strtoupper(trim(addslashes($_POST['obs'])));

            $c = new Clients();
            if (!$c->clientExists($cnpj)) {
                $c->add($nome, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $vendedor, $obs);
                header("Location: " . BASE_URL . "clientes");
                exit;
            } else {
                header("Location: " . BASE_URL . "clientes/add?er=1");
                exit;
            }

        }

        $v = new Vendedores();
        $dados['vendedores'] = $v->getNameList();
        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "CNPJ já cadastrado, por favor verifique na lista de cadastrados";
        }

        $this->loadTemplate('clienteAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $c = new Clients();
            if (!empty($_POST['nome'])) {
                $nome = strtoupper(trim(addslashes($_POST['nome'])));
                $logradouro = strtoupper(trim(addslashes($_POST['logradouro'])));
                $bairro = strtoupper(trim(addslashes($_POST['bairro'])));
                $cidade = strtoupper(trim(addslashes($_POST['cidade'])));
                $uf = trim(addslashes($_POST['uf']));
                $cep = trim(addslashes($_POST['cep']));
                $ie = trim(addslashes($_POST['ie']));
                $fone = trim(addslashes($_POST['fone']));
                $vendedor = trim(addslashes($_POST['vendedor']));
                $obs = strtoupper(trim(addslashes($_POST['obs'])));

                $c->edit($id, $nome, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $vendedor, $obs);
                header("Location: " . BASE_URL . "clientes");
                exit;

            }

            $v = new Vendedores();
            $dados['vendedores'] = $v->getNameList();
            if (!empty($_GET['er'])) {
                $dados['msgErro'] = "CNPJ já cadastrado, por favor verifique na lista de cadastrados";
            }

            $dados['info'] = $c->getById($id);

            $this->loadTemplate('clienteEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "clientes");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $c = new Clients();
            $c->del($id);
        }
        header("Location: " . BASE_URL . "clientes");
        exit;
    }

}
