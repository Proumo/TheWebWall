<?php
require  'conexaoA.php';
require  'restrito.php';

$sqlSelecionaAmigos = "SELECT
    image,
    firstName,
    lastName,
    image,
    user.user_id,
    nickname
FROM  `user`
INNER JOIN seguidos ON seguidos.seguido_id = user.user_id
WHERE seguidos.user_id =" . $_SESSION['user_id'];

$resAmigos = mysql_query($sqlSelecionaAmigos) or die(mysql_error());
if(mysql_num_rows($resAmigos)>0){
                    while ($amigo = mysql_fetch_array($resAmigos)) {
                        $amigoid = $amigo['user_id'];
                        $sqlNumPostsNovos="SELECT id FROM postagem 
                                           WHERE user_id=$amigoid 
                                           AND dataPostUnix >".$_SESSION['ultimoLogoutUnix'];
                        $resNumPostNovos=  mysql_query($sqlNumPostsNovos);
                        $numPostsNovos=  mysql_num_rows($resNumPostNovos);
                        if($numPostsNovos<=0){
                            $tagPostsNovos="";
                        }else{
                            $tagPostsNovos="<div class='novosPosts'><label> $numPostsNovos</label></div>";
                        }
                        echo "<div class='userInfo1 well'>
                            <img class='friendImg' src='". $amigo['image'] . "'>
                            <label>".$amigo['firstName']." ".$amigo['lastName']."</label>
                                    ".$amigo['nickname']."
                                    <div class='btn btn-small' onclick= $.showPosts(" . $amigoid . ")>
                                        <i class='icon-picture'></i>Posts$tagPostsNovos</div>
                                        <div class='btn btn-small' onclick= mostrarPerfil(" . $amigoid . ")>
                                        <i class='icon-user'></i>Perfil</div>'
                                       
                                        </div>
                                        </div>
                                        ";
                    }
                    
                    }else{
                        echo "<h3 style='color:white; text-shadow:0 0 15px rgba(0,0,0,0.8),0 0px 15px rgba(0,0,0,0.8);'> Voce ainda nao segue alguém. Busque um novo amigo aqui embaixo!</h3>";
                    }
                    mysql_close($cn);
?>

