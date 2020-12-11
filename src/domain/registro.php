<?php

	class Registro {
		var $id_registro;
		var $tipo;
		var $placa;
		var $entrada;
		var $saida;
		var $valor;
		var $data_registro;

		function getIdRegistro(){
			return $this->id_registro;
		}
		function setIdRegistro($id_registro){
			$this->id_registro = $id_registro;
		}

		function getTipo(){
			return $this->tipo;
		}
		function setTipo($tipo){
			$this->tipo = $tipo;
		}

		function getPlaca(){
			return $this->placa;
		}
		function setPlaca($placa){
			$this->placa = $placa;
		}

		function getEntrada(){
			return $this->entrada;
		}
		function setEntrada($entrada){
			$this->entrada = $entrada;
		}

		function getSaida(){
			return $this->saida;
		}
		function setSaida($saida){
			$this->saida = $saida;
		}

		function getValor(){
			return $this->valor;
		}
		function setValor($valor){
			$this->valor = $valor;
		}

		function getDataRegistro(){
			return $this->data_registro;
		}
		function setDataRegistro($data_registro){
			$this->data_registro = $data_registro;
		}
	}

	class RegistroDAO {
		function create($registro) {
			$result = array();
			$tipo = $registro->getTipo();
			$placa = $registro->getPlaca();
			$entrada =  $registro->getEntrada();
			$saida =  $registro->getSaida();
			$valor =  $registro->getValor();
			$data_registro =  $registro->getDataRegistro();
			$query = "INSERT INTO registro VALUES (DEFAULT,'$tipo', '$placa', '$entrada', '$saida', '$valor', '$data_registro')";
			try {
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result = $registro;
				}else{
					$result["erro"] = "Erro ao adicionar veiculo"; 
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function readAll() {
			$result = array();
			$query = "SELECT * FROM registro";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				while($row = $resultSet->fetchObject()){
					$registro = new Registro();
					$registro->setIdRegistro($row->id_registro);
					$registro->setTipo($row->tipo);
					$registro->setPlaca($row->placa);
					$registro->setEntrada($row->entrada);
					$registro->setSaida($row->saida);
					$registro->setValor($row->valor);
					$registro->setDataRegistro($row->data_registro);
					$result[] = $registro;		
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($id_registro) {
			$result = array();
			$query = "SELECT * FROM registro where id_registro = '$id_registro'";
			try {
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
					while($row = $resultSet->fetchObject()){
						$registro = new Registro();
						$registro->setIdRegistro($row->id_registro);
						$registro->setTipo($row->tipo);
						$registro->setPlaca($row->placa);
						$registro->setEntrada($row->entrada);
						$registro->setSaida($row->saida);
						$registro->setValor($row->valor);
						$registro->setDataRegistro($row->data_registro);
						$result[] = $registro;	
				}
			}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($veiculo) {
			$result = array();
			$id_registro = $veiculo->getIdRegistro();
			$tipo = $veiculo->getTipo();
			$placa = $veiculo->getPlaca();
			$entrada = $veiculo->getEntrada();
			$saida = $veiculo->getSaida();
			$valor = $veiculo->getValor();
			$data_registro = $veiculo->getDataRegistro();
			$query = "UPDATE registro SET tipo = '$tipo', placa = '$placa', entrada ='$entrada', saida = '$saida', valor = '$valor', data_registro = '$data_registro' WHERE id_registro = $id_registro";
			try {
				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);
				if($status->execute()){
					$result[] = $veiculo;
				} else {
					$result["erro"] = "Nao foi possivel atualizar os dados";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($id_registro) {
			$result = array();
			$query = "DELETE FROM registro WHERE id_registro = $id_registro";
			try {
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "veiculo excluido com sucesso";
				} else {
					$result["erro"] = "Veiculo nao excluido";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	}
