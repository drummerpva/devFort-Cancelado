<?php
class reportController extends controller
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
        header("Location: " . BASE_URL);
    }

    public function clientes()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();

        $c = new Clients();

        $dados['cidades'] = $c->getCidadeList();
        $dados['estados'] = $c->getEstadoList();
        $dados['vendedores'] = $c->getVendedorList();

        $this->loadTemplate("reportClientes", $dados);
    }
    public function vendedores()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();

        $v = new Vendedores();

        $dados['estados'] = $v->getEstadoList();

        $this->loadTemplate("reportVendedores", $dados);
    }
    public function comissoes()
    {
        $dados = [];
        $dados['userName'] = $this->user->getName();

        $v = new Vendedores();

        $dados['vendedores'] = $v->getNameList();

        $this->loadTemplate("reportComissoes", $dados);
    }
    public function printClientes()
    {
        $c = new Clients();
        if (!empty($_POST['vendedor'])) {
            $ven = addslashes($_POST['vendedor']);
            $v = new Vendedores();
            $data['vendedor'] = $v->getById($ven);
            $data["lista"] = $c->getClientesByVendedor($ven);
            ob_start();
            $this->loadView("reportClientesVendedor", $data);
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit;
        }
        if (!empty($_POST['cidade'])) {
            $cid = addslashes($_POST['cidade']);
            $data['cidade'] = $cid;
            $data["lista"] = $c->getClientesByCidade($cid);
            ob_start();
            $this->loadView("reportClientesCidade", $data);
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit;
        }
        if (!empty($_POST['estado'])) {
            $uf = addslashes($_POST['estado']);
            $data['uf'] = $uf;
            $data["lista"] = $c->getClientesByUf($uf);
            ob_start();
            $this->loadView("reportClientesUf", $data);
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit;
        }
        $data['total'] = $c->getTotal();
        $data["lista"] = $c->getAllClientes();
        //ob_start();
        $this->loadView("reportClientesAll", $data);
        //$html = ob_get_contents();
        //ob_end_clean();
        //$mpdf = new \Mpdf\Mpdf();
        //$mpdf->WriteHTML($html);
        //$mpdf->Output();
        exit;

    }
    public function printVendedores()
    {
        $v = new Vendedores();
        if (!empty($_POST['estado'])) {
            $uf = addslashes($_POST['estado']);
            $data['uf'] = $uf;
            $data["lista"] = $v->getVendedoresByUf($uf);
            ob_start();
            $this->loadView("reportVendedoresUf", $data);
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit;
        }
        $data['total'] = $v->getTotal();
        $data["lista"] = $v->getAllVendedores();
        ob_start();
        $this->loadView("reportVendedoresAll", $data);
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;

    }
    public function printComissoes()
    {
        if (!empty($_POST['vendedor'])) {
            $v = new Vendas();
            $vendedor = new Vendedores();
            $ven = addslashes($_POST['vendedor']);
            $data1 = $_POST['data1']." 00:00:00";
            $data2 = $_POST['data2']." 23:59:59";
            $data['dataInicial'] = $data1;
            $data['dataFinal'] = $data2;
            $data['dadosVendedor'] = $vendedor->getById($ven);
            $data["lista"] = $v->getFechaComissao($ven, $data1, $data2);
            $data["totais"] = $v->getFechaComissaoTotais($ven, $data1, $data2);
            $nomePdf = "comissao_".$data['dadosVendedor']['nome']."_".date("d-m-Y",strtotime($data1))."_".date("d-m-Y",strtotime($data2)).".pdf";
            ob_start();
            $this->loadView("reportFechaComissoes", $data);
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output($nomePdf,\Mpdf\Output\Destination::INLINE);
            exit;
        }
        header("Location: ".BASE_URL."report/comissoes");
        exit;
    }

    function print($id) {
        if (!empty($_GET['pr'])) {
            header("Location: " . BASE_URL . "vendas/print/" . $id);
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

            $this->loadView('vendaPrint', $dados);
        } else {
            header("Location: " . BASE_URL . "produtos");
            exit;
        }
    }

}
