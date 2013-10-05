<?php
require "restrito.php";
require 'conexaoA.php';
$id=$_GET['id'];

$sqlSelecionaTudoUsuario="SELECT * FROM user WHERE user_id=$id";
$resSql=  mysql_query($sqlSelecionaTudoUsuario);
if(mysql_num_rows($resSql)<1){
    echo 'OPS! Usuário Não Encontrado!';
    return;
}
$sqlVerificaAmizade="SELECT * FROM seguidos WHERE user_id=".$_SESSION['user_id']." AND seguido_id=$id";
    $resVerificacao=  mysql_query($sqlVerificaAmizade)or die(mysql_error());
    if(mysql_num_rows($resVerificacao)>=1){
     $ehamigo=1;   
    }else{
        $ehamigo=0;
    }
$sqlPessoasEuSigo="SELECT
    image,
    firstName,
    lastName,
    image,
    user.user_id,
    nickname
FROM  `user`
INNER JOIN seguidos ON seguidos.seguido_id = user.user_id
WHERE seguidos.user_id =$id";

$resAmigos=  mysql_query($sqlPessoasEuSigo)or die(mysql_error());

$usuario=  mysql_fetch_array($resSql);

?>
<div class="tituloPost"><label><?php echo $usuario['firstName']." ".$usuario['lastName'] ?></label></div>

<div class="argumentoContainer1"> 
    <div id="imagePostInfoBackground">
        <img class="imagePostInfo" onerror="imgError(this);" src="<?php echo $usuario['imageGrande'] ?>">
        <?php if($_SESSION['user_id']==$usuario['user_id']){?>
        <div id="btnEditarPost"class="btn btn-custom btn-editarPost"><i class="icon-edit icon-white"></i></div>    
        <?php }?>
    </div>

    <div class="descricao"><h3>Sobre mim:</h3><text><?php echo "um pouco sobre mim"; ?></text></div>
    
</div>
<div class="argumentoContainer">
    <h3>Pessoas que sigo</h3>
     <div class='pessoasQueSigoContainer'>
         
             <?php while ($row = mysql_fetch_array($resAmigos)) {?>
             <div class='userPosts'>
             <img class='userPostsThumb' src='<?php echo $row['image']?>' onclick='mostrarPerfil(<?php echo $row['user_id'];?>)' ondblclick='return;'>
             </div>
              <?php }?> 
     </div>
   
   
        <div class='btn btn-mini' onclick= $.showPosts(<?php echo $usuario['user_id'] ?>)>
           <i class='icon-picture'></i>Ver Posts</div>
       
        <?php if($usuario['user_id']===$_SESSION['user_id']){} elseif($ehamigo===0){?>
        <div class='btn btn-mini' onclick=seguir(<?php echo $usuario['user_id'] ?>,this)>
            <i class='icon-user'></i>Seguir</div>
           <?php }else{?>
        <div class='btn btn-mini'>
            <i class='icon-thumbs-up'></i>Seguindo</div>
            <div class='btn btn-mini' onclick= unfollow(<?php echo $usuario['user_id'] ?>)>
                                        <i class='icon-eye-close'></i></div>
           <?php }?>
           
           
            
         
          
    </div>
