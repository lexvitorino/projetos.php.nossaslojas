<?php

class tipoLojaController extends controller {

     function index() {
    	$usuario = new Usuario();
    	$usuario->estaLogado();
    	
        $dados = array();

        $tipoLoja = new TipoLoja();
        $dados['tipoLojas'] = $tipoLoja->get();

        $this->loadTamplate('tipoLoja', $dados);
    }   

    function adicionar() {
        $dados = array();

        $tipoLoja = new TipoLoja();
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $tipoLoja->salvar(0, $nome);

            header("Location: ".BASE."tipoLoja");
        }

        $this->loadTamplate("tipoLoja/adicionar", $dados);
    }

    function editar($id) {
        $dados = array();
        if ($id > 0) {

            $tipoLoja = new TipoLoja();
            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	            $nome = addslashes($_POST['nome']);
	            $tipoLoja->salvar($id, $nome);

                header("Location: ".BASE."tipoLoja");
            }

            $dados['tipoLoja'] = $tipoLoja->getById($id);
            $this->loadTamplate('tipoLoja/editar', $dados);
        } else {
            header("Location: ".BASE."tipoLoja");
        }
    }

    function excluir($id) {
        if ($id > 0) {
            $id = addslashes($id);
            $tipoLoja = new TipoLoja();
            $tipoLoja->excluir($id);

            header("Location: ".BASE."/tipoLoja");
        }
    }
}
