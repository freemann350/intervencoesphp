<?php //db conn

	$sv = "localhost";

	$user = "root";

	$pw = "";

	$db = "intervencoes_db";



	$con = new mysqli($sv, $user, $pw, $db);



	if ($con->connect_error) {

		die("Erro de Ligação:" . $con->connect_error);

	}

	return true;