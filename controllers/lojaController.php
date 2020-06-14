<?php

class LojaController extends controller {

    public function index() {
        $usuario = new Usuario();
        $usuario->estaLogado();
        
        $dados = array();

        $loja = new Loja();
        $dados['lojas'] = $loja->get();

        $this->loadTamplate('loja', $dados);
    }

    function adicionar() {
        $dados = array(
            'estado' => array(),
            'cidade' => array(),
            'tipo' => array()
        );

        $estado = new Estado();
        $dados['estado'] = $estado->get();

        $cidade = new Cidade();
        $dados['cidade'] = $cidade->get();

        $tipoLoja = new TipoLoja();
        $dados['tipo'] = $tipoLoja->get();

        $loja = new Loja();
        if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
            $codigo = addslashes($_POST['codigo']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $urlmapa = addslashes($_POST['urlmapa']);
            $horarioatendimento = addslashes($_POST['horarioatendimento']);
            $cep = addslashes($_POST['cep']);
            $logradouro = addslashes($_POST['logradouro']);
            $numero = addslashes($_POST['numero']);
            $complemento = addslashes($_POST['complemento']);
            $bairro = addslashes($_POST['bairro']);
            $idcidade = addslashes($_POST['idcidade']);  
            $iduf = addslashes($_POST['iduf']);            
            $idtipoloja = addslashes($_POST['idtipoloja']);            
            $zona = addslashes($_POST['zona']);              
            $lat = addslashes($_POST['lat']);            
            $lng = addslashes($_POST['lng']);  
            $loja->salvar(0, $codigo, $nome, $telefone, $urlmapa, $horarioatendimento, 
                           $cep, $logradouro, $numero, $complemento, $bairro, $idcidade, $iduf, $idtipoloja, $zona, $lat, $lng);

            header("Location: ".BASE."loja");
        }

        $this->loadTamplate("loja/adicionar", $dados);
    }

    function editar($id) {
        if ($id > 0) {
            $dados = array(
                'estado' => array(),
                'cidade' => array(),
                'tipo' => array()
            );

            $estado = new Estado();
            $dados['estado'] = $estado->get();

            $tipoLoja = new TipoLoja();
            $dados['tipo'] = $tipoLoja->get();

            $loja = new Loja();
            if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
                $codigo = addslashes($_POST['codigo']);
                $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $urlmapa = addslashes($_POST['urlmapa']);
                $horarioatendimento = addslashes($_POST['horarioatendimento']);
                $cep = addslashes($_POST['cep']);
                $logradouro = addslashes($_POST['logradouro']);
                $numero = addslashes($_POST['numero']);
                $complemento = addslashes($_POST['complemento']);
                $bairro = addslashes($_POST['bairro']);
                $idcidade = addslashes($_POST['idcidade']);  
                $iduf = addslashes($_POST['iduf']);            
                $idtipoloja = addslashes($_POST['idtipoloja']);     
                $zona = addslashes($_POST['zona']);       
                $lat = addslashes($_POST['lat']);            
                $lng = addslashes($_POST['lng']);  
                $loja->salvar($id, $codigo, $nome, $telefone, $urlmapa, $horarioatendimento, 
                               $cep, $logradouro, $numero, $complemento, $bairro, $idcidade, $iduf, $idtipoloja, $zona, $lat, $lng);

                header("Location: ".BASE."loja");
            }

            $dados['loja'] = $loja->getById($id);

            $cidade = new Cidade();
            $dados['cidade'] = $cidade->get();

            $this->loadTamplate('loja/editar', $dados);
        } else {
            header("Location: ".BASE."loja");
        }
        
    }

    function excluir($id) {
        if ($id > 0) {
            $id = addslashes($id);
            $loja = new Loja();
            $loja->excluir($id);

            header("Location: ".BASE."/loja");
        }
    }
    
}
