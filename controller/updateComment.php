<?php
require 'restrito.php';
require 'conexaoA.php';
$postID=$_POST['id'];
$sqlUpdateComment="UPDATE  `comentarios` SET  `visto` =  '1' WHERE  `comentarios`.`postID` =$postID;";
mysql_query($sqlUpdateComment);
mysql_close($cn);
?>
