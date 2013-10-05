<?php
 include 'conexaoA.php';
 
 $sql="SELECT * FROM user WHERE  password='".md5($_POST["password"])."' AND email='".$_POST["email"]."'";
 $resultado=mysql_query($sql) or die(mysql_error());
 $row=mysql_fetch_array($resultado);
 if (mysql_num_rows($resultado)==1){
     $sqlUltimoLogout="SELECT * FROM ultimologout WHERE user_id=".$row["user_id"];
     $resUltimo=mysql_query($sqlUltimoLogout)or die(mysql_error());
     $ultimoLogin=  mysql_fetch_array($resUltimo);
     session_start();
     $_SESSION["user_id"]= $row["user_id"];
     $_SESSION["email"]=$_POST["email"];
     $_SESSION["firstName"]=$row["firstName"];
     $_SESSION['lastName']=$row['lastName'];
     $_SESSION['country']=$row['country'];
     $_SESSION['userImageURL']=$row['image'];
     $_SESSION['ultimoLogoutUnix']=$ultimoLogin['ultimoLogoutUnix'];
     $_SESSION['nickname']=$row['nickname'];
     
     
     $SQLRetornoDaLastView="SELECT x,y FROM lastviews WHERE user_id=".$_SESSION["user_id"];
     
     $resutadoLastView=mysql_query($SQLRetornoDaLastView)or die(mysql_error());
     $res=mysql_fetch_array($resutadoLastView);
   
     
     
     $urlEnc="Location:../home.php?x=".$res['x']."&y=".$res['y'];
     header($urlEnc);
     mysql_close($cn);
 }else {
 echo "Your login information is not correct!";
 mysql_close($cn);
 header("Location:../index.php");
 }

?>