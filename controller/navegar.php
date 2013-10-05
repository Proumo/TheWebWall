<?php
require 'restrito.php';
require 'conexaoA.php';
$x=$_GET['x'];
$y=$_GET['y'];

        $ALCANCE=  mt_rand(2, 10);
        
$xmax=$x+$ALCANCE;
$xmin=$x-$ALCANCE;
$ymax=$y+$ALCANCE;
$ymin=$y-$ALCANCE;
        
   $sqlSelecaoPostsdeInteresse="SELECT x,y, numViews FROM postagem 
                                WHERE patrocinada=1
                                AND x<$xmax
                                AND x>$xmin
                                AND y<$ymax
                                AND y>$ymin
                                ORDER BY numViews ASC";
   
   $res=  mysql_query($sqlSelecaoPostsdeInteresse);
   $sqlUpdateLastView="UPDATE  `lastviews`
                       SET  `x` =  $x,
                            `y` =  $y 
                       WHERE  `user_id` =".$_SESSION['user_id'];
   mysql_query($sqlUpdateLastView)or die(mysql_error());
   mysql_close($cn);
   if(mysql_num_rows($res)<1){
       echo "<r><x>".$x."</x><y>".$y."</y></r>";
       return;
   }
   $post=  mysql_fetch_array($res);
   echo "<r><x>".$post['x']."</x><y>".$post['y']."</y></r>";
   return;
?>
