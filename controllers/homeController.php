<?php

class HomeController extends controller {
    
    public function index() {
    	$usuario = new Usuario();
    	$usuario->estaLogado();
    	
        $dados = array();

        $this->loadTamplate('/home', $dados);
    }
    
}
