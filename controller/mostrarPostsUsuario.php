<?php
include 'conexaoA.php';
include 'restrito.php';
$user_id=$_SESSION['user_id'];

$sqlSelecionaPostsDoUsuario = 'SELECT *
FROM postagem
WHERE user_id= '.$user_id.'
ORDER BY  id DESC ; ';

$resSelecaoPostsDoUsuario = mysql_query($sqlSelecionaPostsDoUsuario);
if(mysql_num_rows($resSelecaoPostsDoUsuario)>0){
                    while ($post = mysql_fetch_array($resSelecaoPostsDoUsuario)) {
                        $sqlNotifiNovosComentarios="SELECT * FROM comentarios 
                            WHERE postID=".$post['id']." AND dataCriacaoUnix > ".$_SESSION['ultimoLogoutUnix']." AND userID !=$user_id AND visto=0";
                        $resNovosComentarios=  mysql_query($sqlNotifiNovosComentarios);
                        $numComentNovos=mysql_num_rows($resNovosComentarios);
                        if($numComentNovos>0){
                            $tagComentNovos="<div id=".$post['id']."  class='novosComentarios'><label> $numComentNovos</label></div>";
                        }else{
                            $tagComentNovos="";
                        }
                        echo "<div class='userPosts'>$tagComentNovos<img class='userPostsThumb' src='" . $post['thumb'] . "' onclick='navegar(" . $post['x'] . "," . $post['y'] . ")' ondblclick='return;'></div>";
                    }
}else{
    echo "<h3 style='color:white; text-shadow:0 0 15px rgba(0,0,0,0.8),0 0px 15px rgba(0,0,0,0.8);'> O que voce está esperando? vá até o menu Novo Post e cole algo na parede!</h3> ";
}
mysql_close($cn);
                    
?>
