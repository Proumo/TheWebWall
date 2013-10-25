<?php
require 'restrito.php';
require 'conexaoA.php';

$seguido_id=$_GET['id'];
$operacao=$_GET['op'];
$user=$_SESSION['user_id'];

switch ($operacao){
case 0:{
    $sqlVerificaAmizade="SELECT * FROM seguidos WHERE user_id=$user AND seguido_id=$seguido_id";
    $resVerificacao=  mysql_query($sqlVerificaAmizade);
    if(mysql_num_rows($resVerificacao)===0){

//começar uma nova amizade ou follow
    $sqlNovaAmizade="INSERT INTO  `seguidos` (
                    `id` ,
                    `user_id` ,
                    `seguido_id`
                    )
                    VALUES (
                    NULL ,  '$user',  '$seguido_id'
                    );";
    mysql_query($sqlNovaAmizade)or die(mysql_error());
  //notificar a pessoa que alguem começou a segui-lo
    $sqlInsercao="INSERT INTO `notificacoes` (`notifi_id`, `autor`,`destinatario`,`tipoNoti`,`post`)
                VALUES (NULL, '".$_SESSION['user_id']."','$seguido_id','comecouSeguir','')";
    mysql_query($sqlInsercao)or die(mysql_error());
    echo 1;
    return;}
    
    else{
        echo -1;}
};
break;
case 1:{
$sqlVerificaAmizade="SELECT * FROM seguidos WHERE user_id=$user AND seguido_id=$seguido_id";
    $resVerificacao=  mysql_query($sqlVerificaAmizade)or die(mysql_error()."verificaçao");
    if(mysql_num_rows($resVerificacao)>=1){

//descontinuar uma amizade ou unfollow
    $sqlNovaAmizade="DELETE FROM `seguidos` 
                    WHERE user_id=$user AND seguido_id=$seguido_id;";
    mysql_query($sqlNovaAmizade)or die(mysql_error()."deletando");
    
    echo 1;
    return;}
};
break;
}
mysql_close($cn);


?>
