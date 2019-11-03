<?php
class pagamentosController extends controller
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

        $p = new Pagamentos();
        $offset = 0;
        $limit = 9;
        $total = $p->getTotal();
        $dados['pagina'] = 1;
        if (!empty($_GET['p'])) {
            $dados['pagina'] = intval($_GET['p']);
        }
        $offset = ($dados['pagina'] * $limit) - $limit;
        $ordem = "descricao";
        if (!empty($_GET['ordem'])) {
            $ordem = $_GET['ordem'];
        }
        $dados['ordem'] = $ordem;
        $dados['paginas'] = ceil($total / $limit);
        $dados['pagamentosList'] = $p->getList($limit, $offset, $ordem);

        $this->loadTemplate('pagamentosView', $dados);
    }
    public function add()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();
        if (!empty($_POST['descricao'])) {
            $descricao = strtoupper(trim(addslashes($_POST['descricao'])));
            $p = new Pagamentos();
            if (!$p->pagamentoExists($descricao)) {
                $p->add($descricao);
                header("Location: " . BASE_URL . "pagamentos");
                exit;
            } else {
                header("Location: " . BASE_URL . "pagamentos/add?er=1");
                exit;
            }
        }
        if (!empty($_GET['er'])) {
            $dados['msgErro'] = "Pagamento já cadastrado, por favor verifique na lista de cadastrados";
        }

        $this->loadTemplate('pagamentoAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $p = new Pagamentos();
            if (!empty($_POST['descricao'])) {
                $descricao = strtoupper(trim(addslashes($_POST['descricao'])));
                if (!$p->pagamentoExists($descricao)) {
                    $p->edit($id, $descricao);
                    header("Location: " . BASE_URL . "pagamentos");
                    exit;
                } else {
                    header("Location: " . BASE_URL . "pagamentos/edit/" . $id . "/?er=1");
                    exit;
                }
            }
            if (!empty($_GET['er'])) {
                $dados['msgErro'] = "Pagamento já cadastrado, por favor verifique na lista de cadastrados";
            }
            $dados['info'] = $p->getById($id);

            $this->loadTemplate('pagamentoEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "pagamentos");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $p = new Pagamentos();
            $p->del($id);
        }
        header("Location: " . BASE_URL . "pagamentos");
        exit;
    }

}
