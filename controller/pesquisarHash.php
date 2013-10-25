<?php
require 'restrito.php';
require 'conexaoA.php';

$idHash=$_GET['id'];

$sqlPesquisaHashTag="SELECT *  FROM postagem 
                     INNER JOIN postagenstemhashtags ON postagem.id=postagenstemhashtags.postId
                     INNER JOIN hashtags ON hashtags.id=postagenstemhashtags.hashTagId
                     WHERE postagenstemhashtags.hashTagId=$idHash;";
$resultadoPesquisaHashTag=mysql_query($sqlPesquisaHashTag);
$sqlNomeHash="SELECT hashtag FROM hashtags WHERE id=$idHash";
$resultadoNomeHash=  mysql_query($sqlNomeHash);
$hashtag = mysql_fetch_array($resultadoNomeHash);
mysql_close($cn);
?>
<i class="icon-remove close" id="fecharPostsLista" onclick="closeDivPosts()"></i>
        
        <h3 id="userName"><?php echo $hashtag['hashtag'];?></h3>
        
        <div class="postsContainerInferior">
            
       <?php  while ($post=mysql_fetch_array($resultadoPesquisaHashTag)){ ?>
          
    <div class='userPosts'><img class='userPostsThumb' src='<?php echo $post['thumb']; ?>' onclick="navegar(<?php echo $post['x'];?>,<?php echo $post['y'];?>)">
    </div>
           
      <?php }?>
        
        </div>

