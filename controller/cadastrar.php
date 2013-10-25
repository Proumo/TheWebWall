<?php
include 'conexaoA.php';
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
$email=$_POST["email"];
$password=md5($_POST["password"]);// criptografia MD5 para o Password
$country=$_POST["country"];
$nickname="@".$_POST['nickname'];

$SQLVerifiqueDuplicidade="SELECT * FROM user WHERE email='$email'";
$resultadoDaVerificacao=  mysql_query($SQLVerifiqueDuplicidade)or die(mysql_error());
if(mysql_num_rows($resultadoDaVerificacao)!=0){
    echo "This email adress is already registered on The Web Wall, please try using another email acconunt";
    mysql_close($cn);
}else{

$SQLInsercaoNaTbUser="INSERT INTO  `user` (
`user_id` ,
`firstName` ,
`lastName` ,
`email` ,
`nickname`,
`password` ,
`country`
)
VALUES (
NULL ,  '$firstName',  '$lastName',  '$email', '$nickname',  '$password',  '$country');";

mysql_query($SQLInsercaoNaTbUser) or die(mysql_error());
if($_SESSION['user_id']){
session_destroy();}
session_start();
$_SESSION['user_id']=  mysql_insert_id()or die("erro de login, por favor volte a pagina principal e faça seu login");

$sql="SELECT * FROM user WHERE  user_id=".$_SESSION['user_id'];
 $resultado=mysql_query($sql) or die(mysql_error());
 $row=mysql_fetch_array($resultado);
 if (mysql_num_rows($resultado)==1){
     $_SESSION["user_id"]= $row["user_id"];
     $_SESSION["email"]=$_POST["email"];
     $_SESSION["password"]=$_POST["password"];
     $_SESSION["firstName"]=$row["firstName"];
     $_SESSION['lastName']=$row['lastName'];
     $_SESSION['country']=$row['country'];
     $_SESSION['userImageURL']=$row['image'];
     $_SESSION['nickname']=$row['nickname'];
     
     }
$SQLInsercaoNaTbLastView="INSERT INTO  `lastViews` (
`idLastViews` ,
`user_id` ,
`x`,
`y`
)
VALUES (
NULL ,  ".$_SESSION['user_id'].",  0, 0
);";//inserçao na tabela LastView que seta como primeira postagem a ser mostrada a postagem de ID 1
mysql_query($SQLInsercaoNaTbLastView)or die(mysql_error());
$now=time();
$SQLInsercao="INSERT INTO  `ultimologout` (
                        `user_id` ,
                        `ultimoLogout`,
                        `ultimoLogoutUnix`
                        )
                        VALUES (
                        ".$_SESSION['user_id'].", 
                        CURRENT_TIMESTAMP,
                         ".$now."
                        );";
        mysql_query($SQLInsercao)or die(mysql_error());
        $_SESSION['ultimoLogoutUnix']=$now;

mysql_close($cn);
header("location:../home.php");
}


?>