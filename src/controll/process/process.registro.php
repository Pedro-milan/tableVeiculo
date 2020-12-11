<?php

	require("../../domain/connection.php");
	require("../../domain/Registro.php");

	class RegistroProcess {
		var $rd;

		function doGet($arr){
			$rd = new RegistroDAO();
			if($arr["id_registro"]=="0"){
				$sucess = $rd->readAll();
			}else{
				$sucess = $rd->read($arr["id_registro"]);
			}
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$rd = new RegistroDAO();
			$veiculo = new Registro();
			$veiculo->setTipo($arr["tipo"]);
			$veiculo->setPlaca($arr["placa"]);
			$veiculo->setEntrada($arr["entrada"]);
			$veiculo->setSaida($arr["saida"]);
			$veiculo->setValor($arr["valor"]);
			$veiculo->setDataRegistro($arr["data_registro"]);
			$status = $rd->create($veiculo);
			if(is_object($status)){
				http_response_code(201);
				echo '{"mensagem":"Veiculo cadastrado com sucesso"}';
			} else {
				echo json_encode($status);
			}
		}


		function doPut($arr){
			$rd = new RegistroDAO();
			$registro = new Registro();
			$registro->setIdRegistro($arr["id_registro"]);
			$registro->setTipo($arr["tipo"]);
			$registro->setPlaca($arr["placa"]);
			$registro->setEntrada($arr["entrada"]);
			$registro->setSaida($arr["saida"]);
			$registro->setValor($arr["valor"]);
			$registro->setDataRegistro($arr["data_registro"]);
			$status = $rd->update($registro);
			if(is_object($status)){
				echo '{"mensagem":"Veiculo alterado com sucesso"}';
			} else {
				echo json_encode($status);
			}
		}


		function doDelete($arr){
			$rd = new RegistroDAO();
			$status = $rd->delete($arr["id_registro"]);
			http_response_code(200);
			echo json_encode($status);
		}
	}