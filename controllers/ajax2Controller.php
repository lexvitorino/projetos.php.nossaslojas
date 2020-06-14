<?php
header('Access-Control-Allow-Origin: *'); 

class ajax2Controller extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        $this->loadView('ajax2', $dados);
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

        $iduf = '';
        if (isset($_POST['iduf']) && !empty($_POST['iduf'])) {
            $iduf = addslashes($_POST['iduf']);
        }

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

        $distancia = 0;
        if (isset($_POST['distancia']) && !empty($_POST['distancia'])) {
            $distancia = addslashes($_POST['distancia']);    
        }

        $latOri = '';
        if (isset($_POST['latOri']) && !empty($_POST['latOri'])) {
            $latOri = addslashes($_POST['latOri']);    
        }

        $lngOri = '';
        if (isset($_POST['lngOri']) && !empty($_POST['lngOri'])) {
            $lngOri = addslashes($_POST['lngOri']);    
        }

        $loja = new Loja();
        $dados['lojas'] = $loja->getPerSite($idcidade, $iduf, $idtipoloja, $zona, $distancia, $latOri, $lngOri);    

        echo json_encode($dados);
    }

}
