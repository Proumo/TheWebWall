<?php
include 'conexaoA.php';
include 'util.php';
require 'restrito.php';

if (isset($_GET['x']) && isset($_GET['y'])) {
    $x = $_GET['x'];
    $y = $_GET['y'];

    $sql = "SELECT
       id,
       url, 
       tipo, 
       numViews,
       dataPost,
       descricao,
       titulo,
       firstName,
       lastName,
       country,
       image,
       user.user_id,
       nickname
    FROM postagem 
    INNER JOIN user ON postagem.user_id=user.user_id 
    WHERE postagem.x='$x' AND postagem.y='$y'";
} elseif (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT
       id,
       url, 
       tipo, 
       numViews,
       dataPost,
       descricao,
       titulo,
       firstName,
       lastName,
       country,
       user.user_id,
       image,
       nickname
       
    FROM postagem 
    INNER JOIN user ON postagem.user_id=user.user_id 
    WHERE postagem.id='$id'";
    
} else {
    return "erro!";
}


$resultado = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($resultado)) {
    $url = $row['url'];
    $tipo = $row['tipo'];
    $numViews = $row['numViews'];
    $dataPost = $row['dataPost'];
    $descricao = $row['descricao'];
    $userFirstName = $row['firstName'];
    $userLastName = $row['lastName'];
    $userCountry = $row['country'];
    $userImageURL = $row['image'];
    $titulo = $row['titulo'];
    $id = $row['id'];
    $user_id= $row['user_id'];
    $nickname= $row['nickname'];
}

$sqlcomentarios = "SELECT *
                 FROM  `comentarios` 
                 INNER JOIN user ON comentarios.userID=user.user_id
                 WHERE postID=$id ORDER BY dataCriacao DESC";

$resultadoComentarios = mysql_query($sqlcomentarios) or die(mysql_error());

$sqlVerificaAmizade="SELECT * FROM seguidos WHERE user_id=".$_SESSION['user_id']." AND seguido_id=$user_id";
    $resVerificacao=  mysql_query($sqlVerificaAmizade)or die(mysql_error());
    if(mysql_num_rows($resVerificacao)>=1){
     $ehamigo=1;   
    }else{
        $ehamigo=0;
    }

$sqlHashTags="SELECT * 
FROM  `postagenstemhashtags`
INNER JOIN hashtags ON postagenstemhashtags.hashTagId=hashtags.id
WHERE postId=$id";
 $resultadoHashtags=  mysql_query($sqlHashTags)or die(mysql_error());
mysql_close($cn);
?>




<div class="tituloPost"><label><?php echo $titulo; ?></label></div>

<div class="argumentoContainer1"> 
    <div id="imagePostInfoBackground">
        <img class="imagePostInfo" onerror="imgError(this);" src="<?php echo $url ?>">
        <?php if($_SESSION['user_id']==$user_id){?>
        <div id="btnEditarPost"class="btn btn-custom btn-editarPost"><i class="icon-up icon-white"></i></div>    
        <?php }?>
    </div>

    <div class="descricao"><text><?php echo $descricao; ?></text></div>
    <?php if(mysql_num_rows($resultadoHashtags)===0){}else{?>
    <span>Tags:</span>
        <?php
        while ($tag = mysql_fetch_array($resultadoHashtags)) {
        ?>
    <button class="btn btn-mini"  onclick="$.pesqHash(<?php echo $tag['hashTagId'];?>)"><?php echo $tag['hashtag']." ";?> </button>
        <?php
        }
        
        }
        ?>
   
    <span class="numViews"><?php echo $numViews; ?> views</span>
</div>

<div class="argumentoContainer">
    <?php if($user_id===$_SESSION["user_id"]){
         ?>
     <div class='userInfo well'>
         <div class="userImgBkgd"><img class='userImg' src='<?php echo $userImageURL; ?>'></div>
       <label id="userName"><?php echo $userFirstName; ?> <?php echo $userLastName; echo ' (eu)';?></label>
       <label id="userNickname"><?php echo $nickname; ?></label>
       <label id="userCountry"><?php echo $userCountry ?></label>
   </div>
    <?php } else{ ?>
    <div class="userInfo well">
        <img class="userImg" src="<?php echo $userImageURL; ?>">
        <label id="userName"><?php echo $userFirstName . " " . $userLastName; ?></label>
        <label id="userCountry"><?php echo $userCountry ?></label>
        <label id="userNickname"><?php echo $nickname; ?></label>
        <div class='btn btn-mini' onclick= $.showPosts(<?php echo $user_id ?>)>
           <i class='icon-picture'></i>Ver Posts</div>
       <div class='btn btn-mini' onclick= mostrarPerfil(<?php echo $user_id ?>)>
           <i class='icon-user'></i>Perfil</div>
           <?php if($ehamigo===0){?>
        <div class='btn btn-mini' onclick=seguir(<?php echo $user_id ?>,this)>
            <i class='icon-user'></i>Seguir</div>
           <?php }else{?>
        <div class='btn btn-mini'>
            <i class='icon-thumbs-up'></i>Seguindo</div>
           <?php }?>
    </div>
 <?php } ?>
    <div class="comentariosContainer">
        <div class="comentario well">
            <img src="<?php echo $_SESSION['userImageURL']; ?>">
            <input type="text" id="texto" placeholder="Comente!" required>
            <input  type="button" class="btn btn-mini" value="Comentar" onclick="enviarComentario(<?php echo $id ?>);">
        </div>
<?php
while ($comentario = mysql_fetch_array($resultadoComentarios)) {
    $dataCriacao = $comentario['dataCriacao'];


    $resp = timestampToArray($dataCriacao);
    
    ?>
            <div class="comentario well">
                <?php if($_SESSION['user_id']==$comentario['userID']){?>
                <i class="icon-remove close" onclick="removerComentario(<?php echo $comentario['id'];?>,<?php echo $id;?>);"></i>
                <?php }?>
                <img src="<?php echo $comentario['image'] ?>" onclick="mostrarPerfil(<?php echo $comentario['user_id']?>)">
                <label ><?php echo $comentario['firstName'] . " " . $comentario['lastName'] . " " ?></label>
                <div class="comentarioTexto"><?php echo $comentario['texto'] ?></div>
                <label><?php echo $dataCriacao; ?></label>
            </div>

            <?php
        }
        ?>


    </div>
</div>
