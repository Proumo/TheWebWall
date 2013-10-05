<?php
require_once 'conexaoA.php';
require 'restrito.php';
$entrada=$_GET['key'];

$chaves=explode(" ", $entrada);
$sqlSelecionaUsuarios="SELECT * FROM user WHERE ";

for($i=0;$i<=count($chaves)-1;$i++){
    $chave=$chaves[$i];
    $sqlSelecionaUsuarios.="firstName LIKE '%".$chave."%' OR lastName LIKE '%".$chave."%' OR email LIKE '%".$chave."%'";
    if(count($chaves)>1&& $i<count($chaves)-1){
        $sqlSelecionaUsuarios.=" OR ";
    }
}



$resSelecionaUsuario=  mysql_query($sqlSelecionaUsuarios)or die(mysql_error());
mysql_close($cn);
$XMLresPesquisa='<?xml version="1.0" encoding="ISO-8859-1"?><response>';
if(mysql_num_rows($resSelecionaUsuario)==0){
    $XMLresPesquisa.="Nao foram encontrados usuarios";
}

while ($usuario = mysql_fetch_array($resSelecionaUsuario)) {
    $XMLresPesquisa.="<usuario>\n<firstName>".$usuario['firstName']."</firstName>\n";
    $XMLresPesquisa.="<lastName>".$usuario['lastName']."</lastName>\n";
    $XMLresPesquisa.="<country>".$usuario['country']."</country>\n";
    $XMLresPesquisa.="<image>".$usuario['image']."</image>\n</usuario>\n";
}
$XMLresPesquisa.="</response>";

$XMLresPesquisaTR=trim($XMLresPesquisa);
echo $XMLresPesquisaTR;


?>
