<?php


class PostDAO {
public static function colarNaParede( Post $post){
    
include "../controller/conexaoA.php";
include "../controller/restrito.php";
$urlPost=$post->getUrl();
$authorID=$post->getAuthor()->getUser_id();
$thumb=$post->getThumb();
$descricao=$post->getDescription();
$titulo=$post->getTitle();

$insertPost= "INSERT INTO  `postagem` (
`id` ,
`user_id` ,
`x` ,
`y` ,
`url` ,
`tipo` ,
`descricao` ,
`titulo` ,
`thumb`,
`dataPostUnix`
)
VALUES (
    NULL ,'$authorID',NULL, NULL,'$urlPost','imagem','$descricao','$titulo','$thumb',".time()."
    );";



    mysql_query($insertPost)or die(mysql_error()."inserir postagem");
 
    $post->setId(mysql_insert_id());   
    $postId=$post->getId();
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
                VALUES (NULL, '".$_SESSION['user_id']."','$nicknameUserId','citouDescricao','".$post->getId()."')";
            mysql_query($sqlInsercao)or die(mysql_error()."sql insercao notificacao");
            
            }else{ 
            }

    } 
}  


$resMaxX=mysql_query("SELECT MAX(ABS(x)) FROM postagem") or die (mysql_error());
$resMaxY=mysql_query("SELECT MAX(ABS(y)) FROM postagem") or die (mysql_error());

$mX=  mysql_fetch_assoc($resMaxX);
$mY=  mysql_fetch_assoc($resMaxY);

$maxX=$mX['MAX(ABS(x))'];
$maxY=$mY['MAX(ABS(y))'];

if($maxX==NULL ||$maxY==NULL){
        $maxX==0;
        $maxY==0;
    }
$tentativas=0;
do{
$rX=mt_rand(0, $maxX);
$rY=mt_rand(0, $maxY);

$sinalX=mt_rand(0,1);
$sinalY=mt_rand(0,1);

if($sinalX==0){
}else{
    $rX*= -1;
}
if($sinalY==0){
}else{
    $rY*= -1;
}

$verifiqueEspaco="SELECT url FROM postagem WHERE x='$rX' AND y='$rY'";
$resVer=  mysql_query($verifiqueEspaco) or die(mysql_error());
if($tentativas>$maxX*$maxY){
    $maxX+=1;
    $maxY+=1;
}
$tentativas+=1;
}while(mysql_num_rows($resVer)!=0);

$sqlUpdateCordenada="UPDATE `postagem` SET  `x` =  '$rX',
`y` =  '$rY' WHERE  `postagem`.`id` =".$post->getId();
mysql_query($sqlUpdateCordenada)or die("falha update cordenada");
 
mysql_close($cn);

}

public static function buscar($post){
    
    include '../controller/conexaoA.php';
    include '../model/class.User.php';
    

$x=$post->getX();
$y=$post->getY();

$sql="SELECT
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
       image
    FROM postagem 
    INNER JOIN user ON postagem.user_id=user.user_id 
    WHERE postagem.x='$x' AND postagem.y='$y'";
$resultado= mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($resultado)==0){
    mysql_close($cn);
    return NULL;
}else{
$post= new Post();
while($row=mysql_fetch_assoc($resultado)) {
    $post->setUrl($row['url']);
    $post->setType($row['tipo']);
    $post->setNumViews($row['numViews']);
    $post->setDataPost($row['dataPost']);
    $post->setDescription($row['descricao']);
    $post->setTitle($row['titulo']);
    $post->setId($row['id']);
    $author= new User();
    $author->setFirstName($row['firstName']);  
    $author->setLastName($row['lastName']);
    $author->setCountry($row['country']);
    $author->setImage($row['image']);
    $post->setAuthor($author);
    
    }
  mysql_close($cn);
  return $post;
    }
 
 }

public static function updateViews($post){
    
    include '../controller/conexaoA.php';
    $num=$post->getNumViews();
    $post->setNumViews($num+=1);// atualiza o numero de vizualizaçaoes da postagem
    $newNum=$post->getNumViews();
    $id=$post->getId();
    $atualizeViews="UPDATE `postagem` SET  `numViews` =  '$newNum' WHERE  `postagem`.`id` =$id;";
    mysql_query($atualizeViews);
    
    mysql_close($cn);
   
        
}


    




}

?>
