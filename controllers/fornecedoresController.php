<?php
class fornecedoresController extends controller
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

        $f = new Fornecedores();
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
        $dados['fornecedoresList'] = $f->getList($limit, $offset, $ordem);

        $this->loadTemplate('fornecedoresView', $dados);
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
            $celular = trim(addslashes($_POST['celular']));
            $obs = strtoupper(trim(addslashes($_POST['obs'])));

            $f = new Fornecedores();
            if (!$f->fornecedorExists($cnpj)) {
                $f->add($nome, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $celular, $obs);
                header("Location: " . BASE_URL . "fornecedores");
                exit;
            } else {
                header("Location: " . BASE_URL . "fornecedores/add?er=1");
                exit;
            }

        }

        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "CNPJ já cadastrado, por favor verifique na lista de cadastrados";
        }

        $this->loadTemplate('fornecedorAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $f = new Fornecedores();
            if (!empty($_POST['nome'])) {
                $nome = strtoupper(trim(addslashes($_POST['nome'])));
                $logradouro = strtoupper(trim(addslashes($_POST['logradouro'])));
                $bairro = strtoupper(trim(addslashes($_POST['bairro'])));
                $cidade = strtoupper(trim(addslashes($_POST['cidade'])));
                $uf = trim(addslashes($_POST['uf']));
                $cep = trim(addslashes($_POST['cep']));
                $ie = trim(addslashes($_POST['ie']));
                $fone = trim(addslashes($_POST['fone']));
                $celular = trim(addslashes($_POST['celular']));
                $obs = strtoupper(trim(addslashes($_POST['obs'])));

                $f->edit($id, $nome, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $celular, $obs);
                header("Location: " . BASE_URL . "fornecedores");
                exit;
            }

            $dados['info'] = $f->getById($id);

            $this->loadTemplate('fornecedorEdit', $dados);
            exit;
        } else {
            header("Location: " . BASE_URL . "fornecedores");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $f = new Fornecedores();
            $f->del($id);
        }
        header("Location: " . BASE_URL . "fornecedores");
        exit;
    }

}
