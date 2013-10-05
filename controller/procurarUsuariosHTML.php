<?php
require_once 'conexaoA.php';
require 'restrito.php';

if(!isset($_POST['key'])||$_POST['key']===""){
    echo "deu pau";
}else{
    $entrada=$_POST['key'];
}
$chaves=explode(" ", $entrada);
$sqlSelecionaUsuarios="SELECT * FROM user WHERE ";

for($i=0;$i<=count($chaves)-1;$i++){
    $chave=$chaves[$i];
    $sqlSelecionaUsuarios.="firstName LIKE '%".$chave."%' OR lastName LIKE '%".$chave."%' OR nickname LIKE '%".$chave."%' OR email LIKE '%".$chave."%'";
    if(count($chaves)>1&& $i<count($chaves)-1){
        $sqlSelecionaUsuarios.=" OR ";
    }
}

$resSelecionaUsuario=  mysql_query($sqlSelecionaUsuarios)or die(mysql_error());


mysql_close($cn);
?>
<div class="searchHeader">
    <h2>Resultados da Pesquisa por " <?php echo $chave?>" :</h2>
</div>
<?php
if(mysql_num_rows($resSelecionaUsuario)==0){
   ?> 
   <p>Nao foram encontrados usuarios</p>
<?php

}else{
?>
   <div class="searchResultContainer">
    <?php
while ($usuario = mysql_fetch_array($resSelecionaUsuario)) {
     if($usuario["user_id"]===$_SESSION["user_id"]){//verifica se o usuario encontrado na busca é o proprio usuario logado
         ?>
     <div class='userInfo userInfoAutor well'><img class='friendImg' src='<?php echo $usuario['image']; ?>'>
       <?php echo $usuario['firstName']; ?> <?php echo $usuario['lastName']; echo ' (eu)';?>
       <label id="userCountry"><?php echo $usuario['country'] ?></label>
     </div>
    <?php
     }else{
         require 'conexaoA.php';
         $sqlVerificaAmizade="SELECT * FROM seguidos WHERE user_id=".$_SESSION['user_id']." AND seguido_id=".$usuario['user_id'].";";
         $resVerificacao=  mysql_query($sqlVerificaAmizade)or die(mysql_error());
            if(mysql_num_rows($resVerificacao)>=1){
               $ehamigo=1;   
            }else{
               $ehamigo=0;
            }
            mysql_close($cn);
         
         
     ?>
   <div class='userInfo userInfoAutor well'><img class='friendImg' src='<?php echo $usuario['image']; ?>'>
       <?php echo $usuario['firstName']; ?> <?php echo $usuario['lastName']; ?>
       <label id="userCountry"><?php echo $usuario['country'] ?></label>
       <label id="userNickname"><?php echo $usuario['nickname'] ?></label>
       
       <div class='btn btn-mini' onclick= $.showPosts(<?php echo $usuario['user_id']; ?>)>
       <i class='icon-picture'></i>Posts</div>
       
       <?php  if($ehamigo===1){?>
           <div class='btn btn-mini'>
           <i class='icon-thumbs-up'></i>Seguindo</div>
   </div>
               <?php }else{  ?>
           <div class='btn btn-mini' onclick=seguir(<?php echo $usuario['user_id']; ?>,this)>
           <i class='icon-user'></i>Seguir</div>
   </div>
                      <?php
            }
            }
         
   ?>
   
    <?php }


}

?>
   
   </div>