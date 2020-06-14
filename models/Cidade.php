<?php

class Cidade extends model {

	public function __construct() {
		parent::__construct();
	} 

	public function get() {
		$array = array();

		$sql = "SELECT c.*, e.sigla as estado FROM cidade c INNER JOIN estado e ON e.id = c.iduf ORDER BY c.nome";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function getById($id) {
		$array = array();

		$sql = "SELECT * FROM cidade WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getByIdUf($iduf) {
		$array = array();

		$sql = "SELECT * FROM cidade WHERE iduf = '$iduf'";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function getBySiglaUf($siglauf) {
		$array = array();

		$sql = "SELECT cidade.*, estado.sigla FROM cidade inner join estado on estado.id = cidade.iduf WHERE estado.sigla = '$siglauf' ORDER BY cidade.nome";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function salvar($id, $iduf, $nome) {
        if ($id > 0) {
            $sql = "UPDATE cidade SET iduf = '$iduf', nome = '$nome' WHERE Id = '$id'";
        } else {
            $sql = "INSERT INTO cidade SET iduf = '$iduf', nome = '$nome'";
        }
        $sql = $this->db->query($sql);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function excluir($id) {
        $sql = "DELETE FROM cidade WHERE id = '$id'";
        $this->db->query($sql);
    }
	
}

