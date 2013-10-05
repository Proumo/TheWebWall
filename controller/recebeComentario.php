<?php
include 'conexaoA.php';
require 'restrito.php';

$id=mysql_real_escape_string($_POST['id']);
$texto=mysql_real_escape_string($_POST['texto']);

$palavras=explode(" ",$texto);


for ($index = 0; $index < count($palavras); $index++) {
    if($palavras[$index][0]==="@")  {
        
        $nickname=  mysql_real_escape_string($palavras[$index]);
       // incluir um metodo To LowerCase
        //consulta se o nickname existe
        $sqlConsulta="SELECT * 
                      FROM  `user` 
                      WHERE nickname='$nickname'";
        $resConsulta=  mysql_query($sqlConsulta) or die(mysql_error()."sql consulta dos nicknames");
        //se existe o usuario é notificado
        if(mysql_num_rows($resConsulta)===1){
            $row = mysql_fetch_array($resConsulta); 
             $nicknameUserId=$row['user_id'];  
            
            $sqlInsercao="INSERT INTO `notificacoes` (`notifi_id`, `autor`,`destinatario`,`tipoNoti`,`post`)
                VALUES (NULL, '".$_SESSION['user_id']."','$nicknameUserId','citouComentario','$id')";
            mysql_query($sqlInsercao)or die(mysql_error()."sql insercao notificacao");
           
            }else{ 
            }

    } 
}  


$SQLInsercaoNaTbComentarios="INSERT INTO  `comentarios` (
`id` ,
`userID` ,
`postID` ,
`dataCriacao` ,
`texto`,
`dataCriacaoUnix`
)
VALUES (
NULL ,  '".$_SESSION["user_id"]."',  '$id', 
CURRENT_TIMESTAMP ,  '$texto',".time()."
);
";

mysql_query($SQLInsercaoNaTbComentarios)or die(mysql_error());
mysql_close($cn);
?>
