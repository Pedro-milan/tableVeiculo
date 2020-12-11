<?php

	require("../process/process.registro.php");

	include("configs.php");

	$rp = new RegistroProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$rp->doGet($_GET);
			break;

		case "POST":
			$rp->doPost($_POST);
			break;

		case "PUT":
			$rp->doPut($_PUT);
			break;

		case "DELETE":
			$rp->doDelete($_DELETE);
			break;
	}