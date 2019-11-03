<?php
class vendasController extends controller
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

        $v = new Vendas();
        $offset = 0;
        $limit = 30;
        $total = $v->getTotal();
        $dados['pagina'] = 1;
        if (!empty($_GET['p'])) {
            $dados['pagina'] = intval($_GET['p']);
        }
        $offset = ($dados['pagina'] * $limit) - $limit;
        $ordem = "data_emissao";
        if (!empty($_GET['ordem'])) {
            $ordem = $_GET['ordem'];
        }
        $dados['ordem'] = $ordem;
        $dados['paginas'] = ceil($total / $limit);
        $dados['vendasList'] = $v->getList($limit, $offset, $ordem);

        $this->loadTemplate('vendasView', $dados);
    }
    public function add()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();
        $this->loadTemplate('vendaAdd', $dados);
    }
    public function edit($id)
    {
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $v = new Vendas();
            $dados['info'] = $v->getById($id);
            $dados['info']['items'] = $v->getItems($id);

            $this->loadTemplate('vendaEdit', $dados);
        } else {
            header("Location: " . BASE_URL . "produtos");
            exit;
        }
    }
    public function print($id)
    {
        if(!empty($_GET['pr'])){
            header("Location: ".BASE_URL."vendas/print/".$id);
            exit;
        }
        if (!empty($id)) {
            $dados = [];
            $dados['userName'] = $this->user->getName();
            $v = new Vendas();
            $dados['info'] = $v->getById($id);
            $dados['info']['items'] = $v->getItems($id);
            $c = new Clients();
            $dados['info']['infoCliente'] = $c->getById($dados['info']['id_cliente']);
            ob_start();
            $this->loadView('vendaPrint', $dados);
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit;
        } else {
            header("Location: " . BASE_URL . "produtos");
            exit;
        }
    }
    public function del($id)
    {
        if (!empty($id)) {
            $v = new Vendas();
            $v->del($id);
        }
        header("Location: " . BASE_URL . "vendas");
        exit;
    }

}
