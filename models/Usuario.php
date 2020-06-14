<?php

class Usuario extends model {

	public function __construct() {
		parent::__construct();
	} 

    public function get() {
        $array = array();

        $sql = "SELECT * FROM usuario";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    } 

    public function getByLogin($login) {
        $array = array();
        $login = addslashes($login);
        
        $sql = "SELECT id, login FROM usuario WHERE login = '$login'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        
        return $array;
    }

	public function estaLogado() {
		if (!isset($_SESSION['lgpanel']) || empty($_SESSION['lgpanel'])) {
			header("Location: ".BASE."login");
			exit;
		}
	}

	public function isExists($login, $senha) {
        $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id) {
        $array = array();

        $sql = "SELECT * FROM usuario WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function salvar($id, $login, $senha) {
        if ($id > 0) {
            $sql = "UPDATE usuario SET login = '$login', senha = '$senha' WHERE Id = '$id'";
        } else {
            $sql = "INSERT INTO usuario SET login = '$login', senha = '$senha'";
        }
        $sql = $this->db->query($sql);
        $id = $this->db->lastInsertId();
        return $id;
    }
	
}

