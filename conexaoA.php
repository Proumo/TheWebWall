<?php
	$server = "localhost";
	$database = "thewebwall";
	$login = "pma";
	$senha= "webwebwall";

	$cn= mysql_connect ($server, $login, $senha);
	if(!$cn){
	die('Erro ao conectar no Banco de Dados');
	}
	@mysql_select_db ($database) OR DIE ("Banco não encontrado.")
	
?>		