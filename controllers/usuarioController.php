<?php

class UsuarioController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $usuario = new Usuario();
        $dados['usuarios'] = $usuario->get();

        $this->loadTamplate('usuario', $dados);
    }

    public function adicionar() {
        $dados = array();

        $usuario = new Usuario();
        if (isset($_POST['login']) && !empty($_POST['login'])) {
            $login = addslashes($_POST['login']);
            $senha1 = addslashes($_POST['senha1']);
            $senha2 = addslashes($_POST['senha2']);

            if ($senha1 === $senha2 && !empty($senha1)) {
                $usuario->salvar(0, $login, md5($senha1));

                header("Location: usuario");
            } else {
                $dados['erros'] = 'Senhas não conferem';
            }
        }

        $this->loadTamplate('usuario/adicionar', $dados);
    }

    public function editar($id) {
        $dados = array();
        if ($id > 0) {

            $usuario = new Usuario();
            if (isset($_POST['login']) && !empty($_POST['login'])) {
                $login = addslashes($_POST['login']);
                $senha1 = addslashes($_POST['senha1']);
                $senha2 = addslashes($_POST['senha2']);

                if ($senha1 === $senha2 && !empty($senha1)) {
                    $usuario->salvar($id, $login, md5($senha1));

                    header("Location: /painel/usuario");
                } else {
                    $dados['erros'] = 'Senhas não conferem';
                }
            }

            $dados['usuario'] = $usuario->getById($id);
            $this->loadTamplate('usuario/editar', $dados);
        } else {
            header("Location: usuario");
        }
    }

    public function delete($id) {
        if ($id > 0) {
            $usuario = new Usuario();
            $usuario->delete($id);

            header("Location: usuario");
        }
    }

}
