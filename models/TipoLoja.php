<?php

class TipoLoja extends model {

	public function __construct() {
		parent::__construct();
	} 

	public function get() {
		$array = array();

		$sql = "SELECT * FROM tipoloja";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function getById($id) {
		$array = array();

		$sql = "SELECT * FROM tipoloja WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function salvar($id, $nome) {
        if ($id > 0) {
            $sql = "UPDATE tipoloja SET nome = '$nome' WHERE Id = '$id'";
        } else {
            $sql = "INSERT INTO tipoloja SET nome = '$nome'";
        }
        $sql = $this->db->query($sql);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function excluir($id) {
        $sql = "DELETE FROM tipoloja WHERE id = '$id'";
        $this->db->query($sql);
    }
	
}

