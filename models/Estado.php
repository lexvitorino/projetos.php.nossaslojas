<?php

class Estado extends model {

	public function __construct() {
		parent::__construct();
	} 

	public function get() {
		$array = array();

		$sql = "SELECT * FROM estado ORDER BY nome";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function getById($id) {
		$array = array();

		$sql = "SELECT * FROM estado WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function salvar($id, $sigla, $nome, $flagzona) {
        if ($id > 0) {
            $sql = "UPDATE estado SET nome = '$nome', sigla = '$sigla', flagzona = '$flagzona' WHERE Id = '$id'";
        } else {
            $sql = "INSERT INTO estado SET sigla = '$sigla', nome = '$nome', flagzona = '$flagzona'";
        }

        $sql = $this->db->query($sql);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function excluir($id) {
        $sql = "DELETE FROM estado WHERE id = '$id'";
        $this->db->query($sql);
    }
	
}

