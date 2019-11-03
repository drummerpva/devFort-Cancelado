<?php
class ajaxController extends Controller
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
    public function findClients()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $c = new Clients();
            $clients = $c->findClients($q);
            foreach ($clients as $cli) {
                $data[] = [
                    "Id" => $cli['Id'],
                    "nome" => $cli['nome'],
                    "link" => BASE_URL . "clientes/edit/" . $cli['Id'],
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function findFornecedores()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $f = new Fornecedores();
            $fornecedores = $f->findFornecedores($q);
            foreach ($fornecedores as $forn) {
                $data[] = [
                    "Id" => $forn['Id'],
                    "nome" => $forn['nome'],
                    "link" => BASE_URL . "fornecedores/edit/" . $forn['Id'],
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function findVendedores()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $v = new Vendedores();
            $vendedores = $v->findVendedores($q);
            foreach ($vendedores as $ven) {
                $data[] = [
                    "Id" => $ven['Id'],
                    "nome" => $ven['nome'],
                    "link" => BASE_URL . "vendedores/edit/" . $ven['Id'],
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function findProdutos()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $p = new Produtos();
            $produtos = $p->findProdutos($q);
            foreach ($produtos as $prod) {
                $data[] = [
                    "Id" => $prod['Id'],
                    "nome" => $prod['descricao'],
                    "link" => BASE_URL . "produtos/edit/" . $prod['Id'],
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function findVendas()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $v = new Vendas();
            $vendas = $v->findVendas($q);
            foreach ($vendas as $ven) {
                $data[] = [
                    "Id" => $ven['Id'],
                    "cliente" => $ven['cliente'],
                    "data" => date("d/m/Y",strtotime($ven['data_emissao'])),
                    "valor" => number_format($ven['valor_total'],2,",","."),
                    "link" => BASE_URL . "vendas/edit/" .$ven['Id'],
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function findVendaProdutos()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $p = new Produtos();
            $produtos = $p->findProdutos($q);
            foreach ($produtos as $prod) {
                $data[] = [
                    "Id" => $prod['Id'],
                    "nome" => $prod['descricao'],
                    "und" => $prod['und'],
                    "valor" => (float)$prod['valor']
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function findVendaPagamentos()
    {
        $data = [];
        if (!empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $p = new Pagamentos();
            $pagamentos = $p->findPagamentos($q);
            foreach ($pagamentos as $pags) {
                $data[] = [
                    "Id" => $pags['Id'],
                    "descricao" => $pags['descricao']
                ];
            }
        }
        echo json_encode($data);
        exit;
    }
    public function insereCabecalhoVenda(){
        $data = [];
        if(!empty($_POST['vendedor'])){
            $vendedor = addslashes($_POST['vendedor']);
            $cliente = addslashes($_POST['cliente']);
            $pagamento = addslashes($_POST['pagamento']);
            $outroValor = (Double) ($_POST['outroValor']);
            $descontoValor = (Double) ($_POST['descontoValor']);
            $produtosValor = (Double) ($_POST['produtosValor']);
            $total = (Double) ($_POST['total']);
            $outroDescricao = addslashes($_POST['outroDescricao']);
            $descontoDescricao = addslashes($_POST['descontoDescricao']);
            $obs = addslashes($_POST['obs']);
            $v =  new Vendas();
            $data["idV"] = $v->add($this->user->getId(), $vendedor, $cliente, $pagamento, $outroValor, $descontoValor, $produtosValor, $total, $outroDescricao, $descontoDescricao, $obs);
        }
        echo json_encode($data);
        exit;
    }
    public function atualizaCabecalhoVenda(){
        $data = [];
        if(!empty($_POST['vendedor'])){
            $idVenda = addslashes($_POST['idVenda']);
            $vendedor = addslashes($_POST['vendedor']);
            $cliente = addslashes($_POST['cliente']);
            $pagamento = addslashes($_POST['pagamento']);
            $outroValor = (Double) ($_POST['outroValor']);
            $descontoValor = (Double) ($_POST['descontoValor']);
            $produtosValor = (Double) ($_POST['produtosValor']);
            $total = (Double) ($_POST['total']);
            $outroDescricao = addslashes($_POST['outroDescricao']);
            $descontoDescricao = addslashes($_POST['descontoDescricao']);
            $obs = addslashes($_POST['obs']);
            $v =  new Vendas();
            $data["status"] = $v->update($idVenda, $this->user->getId(), $vendedor, $cliente, $pagamento, $outroValor, $descontoValor, $produtosValor, $total, $outroDescricao, $descontoDescricao, $obs);
        }
        echo json_encode($data);
        exit;
    }
    public function insereProdutoVenda(){
        $data = [];
        if(!empty($_POST['idV'])){
            $idVenda = addslashes($_POST['idV']);
            $idProduto = addslashes($_POST['idP']);
            $qtd = (Double)addslashes($_POST['qtd']);
            $vol = (Int)addslashes($_POST['vol']);
            $valorUnitario = (Double) ($_POST['valor']);
            $valorTotal = (Double) ($qtd * $valorUnitario);
            $v =  new Vendas();
            $data["idVP"] = $v->addProduto($idVenda, $idProduto, $qtd, $vol, $valorUnitario, $valorTotal);
        }
        echo json_encode($data);
        exit;
    }
    public function limpaProdutoVenda(){
        $data = [];
        if(!empty($_POST['idVenda'])){
            $idVenda = addslashes($_POST['idVenda']);
            $v =  new Vendas();
            $data["idVenda"] = $v->limpaProdutos($idVenda);
        }
        echo json_encode($data);
        exit;
    }
}
