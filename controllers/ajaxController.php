<?php
header('Access-Control-Allow-Origin: *'); 

class ajaxController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        $this->loadView('ajax', $dados);
    }

    public function getEstados() {
        $dados = array();

        $estado = new Estado();
        $dados['estados'] = $estado->get();

        echo json_encode($dados);
    }

    public function getCidades() {
        $dados = array();

        if (isset($_POST['siglauf']) && !empty($_POST['siglauf'])) {
            $siglauf = addslashes($_POST['siglauf']);    
            
            $cidade = new Cidade();
            $dados['cidades'] = $cidade->getBySiglaUf($siglauf);
        }

        echo json_encode($dados);
    }

    public function getTipos() {
        $dados = array();

        $tipoLoja = new TipoLoja();
        $dados['tipos'] = $tipoLoja->get();

        echo json_encode($dados);
    }

    public function getLojas() {
        $dados = array();

        if (isset($_POST['iduf']) && !empty($_POST['iduf'])) {
            $iduf = addslashes($_POST['iduf']);

            $idtipoloja = 0;
            if (isset($_POST['idtipoloja']) && !empty($_POST['idtipoloja'])) {
                $idtipoloja = addslashes($_POST['idtipoloja']);    
            }    

            $idcidade = 0;
            if (isset($_POST['idcidade']) && !empty($_POST['idcidade'])) {
                $idcidade = addslashes($_POST['idcidade']);    
            }

            $zona = '';
            if (isset($_POST['zona']) && !empty($_POST['zona'])) {
                $zona = addslashes($_POST['zona']);    
            }

            $loja = new Loja();
            $dados['lojas'] = $loja->getPerSite($idcidade, $iduf, $idtipoloja, $zona, 0, 0, 0);    
        }   

        echo json_encode($dados);
    }

}
