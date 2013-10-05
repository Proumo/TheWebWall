<?php
require 'restrito.php';
require 'conexaoA.php';

$id=$_GET['id'];

$sql="UPDATE `notificacoes` 
    SET `visto` = '1' 
    WHERE `notificacoes`.`notifi_id` =$id
    AND destinatario=".$_SESSION['user_id'];

mysql_query($sql)or die(mysql_error());
mysql_close($cn);

?>