<?php

class Loja extends model {

	public function __construct() {
		parent::__construct();
	} 

	public function get() {
		$array = array();

		$sql = "SELECT * FROM loja order by codigo";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function getPerSite($idcidade, $iduf, $idtipoloja, $zona, $distancia, $latOri, $lngOri) {
		$array = array();

		if (!empty($latOri) && !empty($lngOri))  {
			$sql = "SELECT loja.*, 
			               cidade.nome as cidade, 
			               estado.sigla as estado, 
			               tipoloja.nome as tipoloja, 
			               Geo($latOri,$lngOri,loja.lat,loja.lng) as distancia
			        FROM loja 
			        	inner join cidade on cidade.id = loja.idcidade 
			        	inner join estado on estado.id = loja.iduf 
			        	inner join tipoloja on tipoloja.id = loja.idtipoloja 
			        WHERE 1 = 1";
		} else {
			$sql = "SELECT loja.*, 
			               cidade.nome as cidade, 
			               estado.sigla as estado, 
			               tipoloja.nome as tipoloja 
			        FROM loja 
			        	inner join cidade on cidade.id = loja.idcidade 
			        	inner join estado on estado.id = loja.iduf 
			        	inner join tipoloja on tipoloja.id = loja.idtipoloja 
			        WHERE 1 = 1";
		}
		
		if ($idcidade > 0 && $idcidade != '') {
			$sql = $sql." and loja.idcidade = '$idcidade'";
		}
		
		if ($iduf != '') {
			$sql = $sql." and estado.sigla = '$iduf'";
		}
		
		if ($idtipoloja > 0 && $idtipoloja != '') {
			$sql = $sql." and idtipoloja = '$idtipoloja'";
		}
		
		if ($zona != '') {
			$sql = $sql." and loja.zona = '$zona'";
		}

		if ($distancia > 0 && !empty($lngOri) && !empty($latOri) && $latOri <> 0 && $lngOri <> 0)  {
			$sql = $sql." and Geo($latOri,$lngOri,loja.lat,loja.lng) <= $distancia";
		}

		if ($distancia > 0 && !empty($lngOri) && !empty($latOri) && $latOri <> 0 && $lngOri <> 0)  {
			$sql = $sql." order by Geo($latOri,$lngOri,loja.lat,loja.lng)";
			$sql = $sql." LIMIT 5";
		} else {
			$sql = $sql." order by loja.codigo";
		}
		
		//echo $sql; exit;

		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	} 

	public function getById($id) {
		$array = array();

		$sql = "SELECT * FROM loja WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function salvar($id, $codigo, $nome, $telefone, $urlmapa, $horarioatendimento, 
		                   $cep, $logradouro, $numero, $complemento, $bairro, $idcidade, $iduf, $idtipoloja, $zona,
		                   $lat, $lng) {
        if ($id > 0) {
            $sql = "UPDATE loja SET codigo = '$codigo', nome = '$nome', telefone = '$telefone', urlmapa = '$urlmapa', horarioatendimento = '$horarioatendimento', "
            ."cep = '$cep', numero = '$numero', complemento = '$complemento', bairro = '$bairro', idcidade = '$idcidade', iduf = '$iduf', logradouro = '$logradouro', idtipoloja = '$idtipoloja', zona = '$zona', lat = $lat, lng = $lng WHERE Id = '$id'";
        } else {
             $sql = "INSERT INTO loja SET codigo = '$codigo', nome = '$nome', telefone = '$telefone', urlmapa = '$urlmapa', horarioatendimento = '$horarioatendimento', "
            ."cep = '$cep', numero = '$numero', complemento = '$complemento', bairro = '$bairro', idcidade = '$idcidade', iduf = '$iduf', logradouro = '$logradouro', idtipoloja = '$idtipoloja', zona = '$zona', lat = $lat, lng = $lng";
        }

        $sql = $this->db->query($sql);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function excluir($id) {
        $sql = "DELETE FROM loja WHERE id = '$id'";
        $this->db->query($sql);
    }
	
}

