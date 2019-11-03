<?php
class emitentesController extends controller
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

        $e = new Emitentes();
        $offset = 0;
        $limit = 30;
        $total = $e->getTotal();
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
        $dados['emitentesList'] = $e->getList($limit, $offset, $ordem);

        $this->loadTemplate('emitentesView', $dados);
    }
    public function add()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();
        if (!empty($_POST['nome'])) {
            $nome = strtoupper(trim(addslashes($_POST['nome'])));
            $fantasia = strtoupper(trim(addslashes($_POST['fantasia'])));
            $cnpj = preg_replace("/[^0-9]/", '', $_POST['cnpj']);
            $logradouro = strtoupper(trim(addslashes($_POST['logradouro'])));
            $bairro = strtoupper(trim(addslashes($_POST['bairro'])));
            $cidade = strtoupper(trim(addslashes($_POST['cidade'])));
            $uf = trim(addslashes($_POST['uf']));
            $cep = trim(addslashes($_POST['cep']));
            $ie = trim(addslashes($_POST['ie']));
            $fone = trim(addslashes($_POST['fone']));
            $email = trim(addslashes($_POST['email']));
            $obs = strtoupper(trim(addslashes($_POST['obs'])));

            $e = new Emitentes();
            if (!$e->clientExists($cnpj)) {
                $e->add($nome, $fantasia, $cnpj, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $email, $obs);
                header("Location: " . BASE_URL . "emitentes");
                exit;
            } else {
                header("Location: " . BASE_URL . "emitentes/add?er=1");
                exit;
            }

        }

        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "CNPJ já cadastrado, por favor verifique na lista de cadastrados";
        }

        $this->loadTemplate('emitenteAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $e = new emitentes();
            if (!empty($_POST['nome'])) {
                $nome = strtoupper(trim(addslashes($_POST['nome'])));
                $fantasia = strtoupper(trim(addslashes($_POST['fantasia'])));
                $logradouro = strtoupper(trim(addslashes($_POST['logradouro'])));
                $bairro = strtoupper(trim(addslashes($_POST['bairro'])));
                $cidade = strtoupper(trim(addslashes($_POST['cidade'])));
                $uf = trim(addslashes($_POST['uf']));
                $cep = trim(addslashes($_POST['cep']));
                $ie = trim(addslashes($_POST['ie']));
                $fone = trim(addslashes($_POST['fone']));
                $email = trim(addslashes($_POST['email']));
                $obs = strtoupper(trim(addslashes($_POST['obs'])));

                $e->edit($id, $nome, $fantasia, $logradouro, $bairro, $cidade, $uf, $cep, $ie, $fone, $email, $obs);
                header("Location: " . BASE_URL . "emitentes");
                exit;

            }

            $dados['info'] = $e->getById($id);

            $this->loadTemplate('emitenteEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "emitentes");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $e = new Emitentes();
            $e->del($id);
        }
        header("Location: " . BASE_URL . "emitentes");
        exit;
    }

}
