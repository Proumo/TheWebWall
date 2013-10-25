<?php
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));
	$server = "us-cdbr-east-04.cleardb.com";// $url["host"];; //localhost
	$database = "heroku_5474d455d463b0d"; // substr($url["path"],1);//thewebwall
	$login = "bd91fc1bd9f73f"; // $url["user"];//root
	$senha= "d5ac723d"; //$url["pass"];//root

	$cn= mysql_connect ($server, $login, $senha);
	if(!$cn){
	die('Erro ao conectar no Banco de Dados');
	}
	@mysql_select_db ($database) OR DIE ("Banco não encontrado.");

?>

<?php
/*
	$server = "mysql2.000webhost.com";
	$database = "a2834759_webwall";
	$login = "a2834759_admin";
	$senha= "zarrefandre123";

	$cn= mysql_connect ($server, $login, $senha);
	if(!$cn){
	die('Erro ao conectar no Banco de Dados');
	}
	mysql_select_db ($database) OR DIE ("Banco não encontrado.")
*/	
?>		