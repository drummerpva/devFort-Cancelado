<?php
class produtosController extends controller
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

        $p = new Produtos();
        $offset = 0;
        $limit = 30;
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
        $dados['produtosList'] = $p->getList($limit, $offset, $ordem);

        $this->loadTemplate('produtosView', $dados);
    }
    public function add()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();
        if (!empty($_POST['nome'])) {
            $nome = strtoupper(trim(addslashes($_POST['nome'])));
            $qtdM = explode(",", trim(str_replace(".", "", $_POST['qtd'] ?? "0,00")));
            $qtd = (float) $qtdM[0] . "." . $qtdM[1];
            $valorM = explode(",", trim(str_replace(".", "", $_POST['valor'] ?? "0,00")));
            $valor = (float) $valorM[0] . "." . $valorM[1];
            $und = strtoupper(trim(addslashes($_POST['und'])));

            $p = new Produtos();
            $p->add($nome, $qtd, $valor, $und);
            header("Location: " . BASE_URL . "produtos");
            exit;

        }
        $this->loadTemplate('produtoAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $p = new Produtos();
            if (!empty($_POST['nome'])) {
                $nome = strtoupper(trim(addslashes($_POST['nome'])));
                $qtdM = explode(",", trim(str_replace(".", "", $_POST['qtd'] ?? "0,00")));
                $qtd = (float) $qtdM[0] . "." . $qtdM[1];
                $valorM = explode(",", trim(str_replace(".", "", $_POST['valor'] ?? "0,00")));
                $valor = (float) $valorM[0] . "." . $valorM[1];
                $und = strtoupper(trim(addslashes($_POST['und'])));

                $p->edit($id, $nome, $qtd, $valor, $und);
                header("Location: " . BASE_URL . "produtos");
                exit;
            }
            $dados['info'] = $p->getById($id);

            $this->loadTemplate('produtoEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "produtos");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $p = new Produtos();
            $p->del($id);
        }
        header("Location: " . BASE_URL . "produtos");
        exit;
    }

}
