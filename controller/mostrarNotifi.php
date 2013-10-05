<?php
require 'conexaoA.php';
require 'restrito.php';
if(isset($_GET['num'])){
    $sql1="SELECT * FROM notificacoes 
    WHERE destinatario=".$_SESSION['user_id'].
    " AND visto = 0 ORDER BY visto,dataN DESC";

$resSql1=  mysql_query($sql1)or die(mysql_error());
$resposta=mysql_num_rows($resSql1);
mysql_close($cn);
if($resposta===0)
    $resposta="";
else{}
    echo $resposta;
    return;
}

$sql="SELECT * FROM notificacoes 
    INNER JOIN user ON autor=user.user_id
    WHERE destinatario=".$_SESSION['user_id'].
    " ORDER BY visto,dataN DESC";

$resSqlGeral=  mysql_query($sql);

while ($row = mysql_fetch_array($resSqlGeral)) {
if($row['tipoNoti']==="citouComentario"){
    $sql="SELECT x, y, notifi_id, image, firstName, lastName, dataN FROM notificacoes 
    INNER JOIN user ON autor=user.user_id
    INNER JOIN postagem ON postagem.id=notificacoes.post
    WHERE destinatario=".$_SESSION['user_id'].
    " AND tipoNoti='citouComentario'
    ORDER BY visto,dataN DESC";

   $resSql=  mysql_query($sql)or die(mysql_error()."citouComentario ");
   while ($row1 = mysql_fetch_array($resSql)) {
       
   
    echo '<div class="notificacaoContainer well" onclick="navegar('.$row1['x'].','.$row1['y'].','.$row1['notifi_id'].')">
          <img class="friendImg" src="'. $row1['image'] . '">
          '.$row1['firstName'].' '.$row1['lastName'].' citou voce em um comentario.
          <label>'.$row1['dataN'].'</label>
         </div>';}
    
}elseif ($row['tipoNoti']==="citouDescricao") {
    $sql="SELECT x,y,notifi_id,thumb,firstName,lastName,titulo,dataN FROM notificacoes 
    INNER JOIN user ON autor=user.user_id
    INNER JOIN postagem ON postagem.id=notificacoes.post
    WHERE destinatario=".$_SESSION['user_id'].
    " AND tipoNoti='citouDescricao'
    ORDER BY visto,dataN DESC";

    $resSql=  mysql_query($sql)or die(mysql_error()."citouDescricao");;
    while ($row2 = mysql_fetch_array($resSql)) {
        
    
    echo '<div class="notificacaoContainer well" onclick="navegar('.$row2['x'].','.$row2['y'].','.$row2['notifi_id'].')">
          <img class="friendImg" src="'. $row2['thumb'] . '">
          '.$row2['firstName'].' '.$row2['lastName'].' citou voce na postagem "'.$row2['titulo'].'" dele.
          <label>'.$row2['dataN'].'</label>
         </div>';
    }
    
    } elseif ($row['tipoNoti']==="comecouSeguir") {
    
    echo '<div class="notificacaoContainer well" onclick="mostrarPerfil('.$row["autor"].')">
          <img class="friendImg" src="'. $row['image'] . '">
          '.$row['firstName'].' '.$row['lastName'].' ('.$row['nickname'].') começou a te seguir!
          <label>'.$row['dataN'].'</label>    
         </div>';  
    }      
    
}
mysql_close($cn);
?>
