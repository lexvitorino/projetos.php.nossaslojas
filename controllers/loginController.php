<?php

class LoginController extends controller {
    
    public function index() {
        $dados = array();

        if (isset($_POST['login']) && !empty($_POST['login'])) {
            if (isset($_POST['senha']) && !empty($_POST['senha'])) {
                $login = addslashes($_POST['login']);
                $senha = md5(addslashes($_POST['senha']));

                $usuario = new Usuario();
                if ($usuario->isExists($login, $senha)) {
                	$_SESSION['lgpanel'] = $usuario->getByLogin($login);
                    header("Location: ".BASE);
                } else {
                    $dados['erros'] = 'Login ou Senha não conferem!';
                }
            }
        }

        $this->loadView("login", $dados);
    }
    
    public function logout() {
        unset($_SESSION['lgpanel']);
        header("Location: ".BASE."login");
    }
    
}
