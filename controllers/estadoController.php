<?php

class EstadoController extends controller {

     function index() {
    	$usuario = new Usuario();
    	$usuario->estaLogado();
    	
        $dados = array();

        $estado = new Estado();
        $dados['estados'] = $estado->get();

        $this->loadTamplate('estado', $dados);
    }   

    function adicionar() {
        $dados = array();

        $estado = new Estado();
        if (isset($_POST['sigla']) && !empty($_POST['sigla'])) {
            $sigla = addslashes($_POST['sigla']);
            $nome = addslashes($_POST['nome']);
            $flagzona = addslashes($_POST['flagzona']);
            $estado->salvar(0, $sigla, $nome, $flagzona);

            header("Location: ".BASE."estado");
        }

        $this->loadTamplate("estado/adicionar", $dados);
    }

    function editar($id) {
        $dados = array();
        if ($id > 0) {

            $estado = new Estado();
            if (isset($_POST['sigla']) && !empty($_POST['sigla'])) {
                $sigla = addslashes($_POST['sigla']);
	            $nome = addslashes($_POST['nome']);
                $flagzona = addslashes($_POST['flagzona']);
                $estado->salvar($id, $sigla, $nome, $flagzona);

                header("Location: ".BASE."estado");
            }

            $dados['estado'] = $estado->getById($id);

            $this->loadTamplate('estado/editar', $dados);
        } else {
            header("Location: ".BASE."estado");
        }
    }

    function excluir($id) {
        if ($id > 0) {
            $id = addslashes($id);
            $estado = new Estado();
            $estado->excluir($id);

            header("Location: ".BASE."/estado");
        }
    }
}
