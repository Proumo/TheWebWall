<?php
include 'conexaoA.php';
include '../model/class.XMLresponse.php';

$x=$_GET['x'];
$y=$_GET['y'];

$sql="SELECT
       id,
       url, 
       tipo,
       numViews
    FROM postagem 
    WHERE postagem.x='$x' AND postagem.y='$y'";
$resultado= mysql_query($sql) or die(mysql_error());


while($row=mysql_fetch_assoc($resultado)) {
    $url = $row['url'];
    $tipo= $row['tipo'];
    $id=$row['id'];
    $numViews=$row['numViews'];
    $num1=$numViews+1;
    
     $sqlUpdateNumViews="UPDATE  `postagem` SET  `numViews` =  '$num1' WHERE  `postagem`.`id` =$id;";
        mysql_query($sqlUpdateNumViews)or die(mysql_error());
        
        
    
       
        
        $responseXML= new XMLresponse();
        $responseXML->start();
        $responseXML->command(
                array(
                      "tagPost" => $url, 
                      "id"=>$id,
                      "tipo"=>$tipo,
                      "numViews"=>$numViews
                    ));
        $responseXML->end();
        $responseXML->terminar();
        
        echo $responseXML;
        
       
        
    
}
mysql_close($cn);

?>