<?php
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));
    
	$server = $url["host"];; //localhost
	$database = substr($url["path"],1);//thewebwall
	$login = $url["user"];//root
	$senha= $url["pass"];//root

	$cn= mysql_connect ($server, $login, $senha);
	if(!$cn){
	die('Erro ao conectar no Banco de Dados');
	}
	@mysql_select_db ($database) OR DIE ("Banco não encontrado.");
	
?>		