<?php
require 'conexaoA.php';
require 'restrito.php';
if(isset($_GET['id'])){
$id=$_GET['id'];

$sqlBuscaInfo="SELECT * FROM user WHERE user_id=$id";
$result=  mysql_query($sqlBuscaInfo)or die(mysql_error());
$row=  mysql_fetch_array($result);
$userFirstName = $row['firstName'];
$userLastName = $row['lastName'];
$userCountry = $row['country'];
$userImageURL = $row['image'];
$userNickname = $row['nickname'];
$user_id=$row['user_id'];

$sqlBuscaPosts="SELECT * 
FROM postagem
WHERE user_id  =$id
ORDER BY  dataPost DESC ;";
$posts=  mysql_query($sqlBuscaPosts)or die(mysql_error());
mysql_close($cn);


?>


<i class="icon-remove close" id="fecharPostsLista" onclick="closeDivPosts()"></i>
        <img class="userImg" src="<?php echo $userImageURL; ?>">
        <label id="userName"><?php echo $userFirstName?> <?php echo $userLastName?></label>
        <label id="userNickname"><?php echo $userNickname?></label>
        <label id="userNumPosts"> (<?php echo mysql_num_rows($posts);?>) posts</label>
        <div class='btn btn-mini' onclick= mostrarPerfil(<?php echo $user_id ?>)>
           <i class='icon-user'></i>Perfil</div>
        <div class="postsContainerInferior">
       <?php  
       if(mysql_num_rows($posts)===0){
           echo "<p>Não foram encontradas postagens deste usuário</p> ";
       }else{
        while ($post=mysql_fetch_array($posts)){
            if($post['dataPostUnix']>=$_SESSION['ultimoLogoutUnix']){
                $tagNovo="<div class='novoMarca'><label>Novo!</labe></div>";
            }else{
                $tagNovo="";
            }
                
            ?>
          
            <div class='userPosts'><?php echo $tagNovo;?>
                <img class='userPostsThumb' src='<?php echo $post['thumb']; ?>' onclick="navegar(<?php echo $post['x'];?>,<?php echo $post['y'];?>)">
                    </div>
           
      <?php }}?>
        
        </div>




<?php }else return "erro: URL invalida";


?>
