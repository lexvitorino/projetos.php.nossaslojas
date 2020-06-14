<?php

class CidadeController extends controller {

     function index() {
    	$usuario = new Usuario();
    	$usuario->estaLogado();
    	
        $dados = array();

        $cidade = new Cidade();
        $dados['cidades'] = $cidade->get();

        $this->loadTamplate('cidade', $dados);
    }   

    function adicionar() {
        $dados = array(
            'estado' => array()
        );

        $estado = new Estado();
        $dados['estado'] = $estado->get();

        $cidade = new Cidade();
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {

            $iduf = addslashes($_POST['iduf']);
            $nome = addslashes($_POST['nome']);
            $cidade->salvar(0, $iduf, $nome);

            header("Location: ".BASE."cidade");
        }

        $this->loadTamplate("cidade/adicionar", $dados);
    }

    function editar($id) {
        if ($id > 0) {
            $dados = array(
                'estado' => array()
            );

            $estado = new Estado();
            $dados['estado'] = $estado->get();

            $cidade = new Cidade();
            if (isset($_POST['nome']) && !empty($_POST['nome'])) {

                $iduf = addslashes($_POST['iduf']);
	            $nome = addslashes($_POST['nome']);
	            $cidade->salvar($id, $iduf, $nome);

                header("Location: ".BASE."cidade");
            }

            $dados['cidade'] = $cidade->getById($id);
            $this->loadTamplate('cidade/editar', $dados);
        } else {
            header("Location: ".BASE."cidade");
        }
    }

    function excluir($id) {
        if ($id > 0) {
            $id = addslashes($id);
            $cidade = new Cidade();
            $cidade->excluir($id);

            header("Location: ".BASE."/cidade");
        }
    }
}
