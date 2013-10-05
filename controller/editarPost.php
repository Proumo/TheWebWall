<?php
require 'restrito.php';
require 'conexaoA.php';
//verifica a autenticidade do pedido de ediçao
$postId=mysql_real_escape_string($_POST['id']);
$sqlVerifica="SELECT * FROM postagem WHERE user_id=".$_SESSION['user_id']." AND id=".$postId;
$resVerificacao=  mysql_query($sqlVerifica);
if(mysql_num_rows($resVerificacao)===1){
//faz o update ou delete
$op=$_POST['op'];
switch ($op) {
    case "titulo":{
        $sqlUpdateTitulo="";
        mysql_query($sqlUpdateTitulo);
    }


        break;
    
    
    
    case'desc':{
        $descricao=$_POST['novaDesc'];
        $palavras=  explode(" ",$descricao);
            for ($index = 0; $index < count($palavras); $index++) {
                if($palavras[$index][0]==="#")  {
                    $hashTag=  mysql_real_escape_string($palavras[$index]);
                   //$hashTag incluir um metodo To LowerCase
                    //consulta se a hashtag ja existe
                    $sqlConsulta="SELECT * 
                                  FROM  `hashtags` 
                                  WHERE hashtag='$hashTag'";
                    $resConsulta=  mysql_query($sqlConsulta) or die(mysql_error()."sql consulta das hashtags");
                    //se ela nao existe ainda ela é persistida
                    if(mysql_num_rows($resConsulta)===0){
                        $sqlInsercao="INSERT INTO `hashtags` (`id`, `hashtag`) VALUES (NULL, '$hashTag')";
                        mysql_query($sqlInsercao)or die(mysql_error()."sql insercao hashtag");
                        $hashTagId=  mysql_insert_id();
                        }else{ //se ela existe é verificado se ele ja esta associada a postagem, se não é associada.

                        $hashExistente=  mysql_fetch_array($resConsulta);
                        $hashTagId=$hashExistente['id'];
                        }
                    //persistencia do relacionamento postagem hashtag
                    $sqlHashtagPost="INSERT INTO  `postagenstemhashtags` (
                                        `id` ,
                                        `postId` ,
                                        `hashTagId`
                                        )
                                        VALUES (
                                        NULL ,  '$postId',  '$hashTagId'
                                        );";
                    mysql_query($sqlHashtagPost)or die(mysql_error());
                } 
                if($palavras[$index][0]==="@")  {

                    $nickname=  mysql_real_escape_string($palavras[$index]);
                   // incluir um metodo To LowerCase
                    //consulta se o nickname existe
                    $sqlConsulta="SELECT user_id 
                                  FROM  `user` 
                                  WHERE nickname='$nickname'";
                    $resConsulta=  mysql_query($sqlConsulta) or die(mysql_error()."sql consulta dos nicknames");
                    //se existe o usuario é notificado
                    if(mysql_num_rows($resConsulta)===1){
                        $row = mysql_fetch_array($resConsulta); 
                         $nicknameUserId=$row['user_id'];  

                        $sqlInsercao="INSERT INTO `notificacoes` (`notifi_id`, `autor`,`destinatario`,`tipoNoti`,`post`)
                            VALUES (NULL, '".$_SESSION['user_id']."','$nicknameUserId','citouDescricao','".$postId."')";
                        mysql_query($sqlInsercao)or die(mysql_error()."sql insercao notificacao");

                        }else{ 
                        }

                } 
            }  
        $sqlUpdateDesc="UPDATE  `postagem` 
                        SET  `descricao` =  '$descricao'
                        WHERE  `postagem`.`id` =$postId;";
        mysql_query($sqlUpdateDesc);
    }
        break;
    
    
        
        
        
        
        
    case 'imagem':{}
        break;
    
    
    
    
    case "del":{//deleta as relaçoes que o pst tinha com outras entidades no banco
        $sqlDelPost="DELETE FROM postagem WHERE id=$postId AND user_id=".$_SESSION['user_id'].";
                     DELETE FROM postagenstemhashtags WHERE postId=$postId;
                     DELETE FROM notificacoes WHERE post=$postId;
                     DELETE FROM comentarios WHERE postID=$postId;";
        mysql_query($sqlDelPost);
        }
        break;
    default:
        break;
}
$novoTitulo;

$novaImagem;  
    



}else{
    //falhou a autenticaçao
}
?>
