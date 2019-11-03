<?php
class vendedoresController extends controller
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

        $v = new Vendedores();
        $offset = 0;
        $limit = 30;
        $total = $v->getTotal();
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
        $dados['vendedoresList'] = $v->getList($limit, $offset, $ordem);

        $this->loadTemplate('vendedoresView', $dados);
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
            $comissaoM = explode(",", trim(addslashes($_POST['comissao'])));
            $comissao = (float) $comissaoM[0] . "." . $comissaoM[1];
            $obs = strtoupper(trim(addslashes($_POST['obs'])));
            $v = new Vendedores();
            if (!$v->vendedorExists($cnpj)) {
                $v->add($nome, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $comissao, $obs);
                header("Location: " . BASE_URL . "vendedores");
                exit;
            } else {
                header("Location: " . BASE_URL . "vendedores/add?er=1");
                exit;
            }

        }

        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "CNPJ já cadastrado, por favor verifique na lista de cadastrados";
        }

        $this->loadTemplate('vendedorAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $v = new Vendedores();
            if (!empty($_POST['nome'])) {
                $nome = strtoupper(trim(addslashes($_POST['nome'])));
                $logradouro = strtoupper(trim(addslashes($_POST['logradouro'])));
                $bairro = strtoupper(trim(addslashes($_POST['bairro'])));
                $cidade = strtoupper(trim(addslashes($_POST['cidade'])));
                $uf = trim(addslashes($_POST['uf']));
                $cep = trim(addslashes($_POST['cep']));
                $ie = trim(addslashes($_POST['ie']));
                $fone = trim(addslashes($_POST['fone']));
                $comissaoM = explode(",", trim(addslashes($_POST['comissao'] ?? "0,00")));
                $comissao = (float) $comissaoM[0] . "." . $comissaoM[1];
                $obs = strtoupper(trim(addslashes($_POST['obs'])));

                $v->edit($id, $nome, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $comissao, $obs);
                header("Location: " . BASE_URL . "vendedores");
                exit;

            }

            if (!empty($_GET['er'])) {
                $dados['msgErro'] = "CNPJ já cadastrado, por favor verifique na lista de cadastrados";
            }

            $dados['info'] = $v->getById($id);

            $this->loadTemplate('vendedorEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "vencedores");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $v = new Vendedores();
            $v->del($id);
        }
        header("Location: " . BASE_URL . "vendedores");
        exit;
    }

}
