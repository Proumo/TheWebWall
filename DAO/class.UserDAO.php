<?php


class UserDAO {
    
public static function create($user){
    include '../controller/conexaoA.php';
    $firstName=$user->getFirstNAme();
    $lastName=$user->getLastName();
    $email=$user->getEmail();
    $password=md5($user->getPassword());// criptografia MD5 para o Password
    $country=$user->getCountry();

$SQLInsercaoNaTbUser="INSERT INTO `user` (
`user_id` ,
`firstName` ,
`lastName` ,
`email` ,
`password` ,
`country`
)
VALUES (
NULL ,  '$firstName',  '$lastName',  '$email',  '$password',  '$country');";

mysql_query($SQLInsercaoNaTbUser) or die(mysql_error());

/*$SQLInsercaoNaTbLastView="INSERT INTO `lastViews` (
`idLastViews` ,
`user_id` ,
`post_id`
)
VALUES (
NULL ,  'NULL',  '1'
);";//inserçao na tabela LastView que seta como primeira postagem a ser mostrada a postagem de ID 1
mysql_query($SQLInsercaoNaTbLastView)or die(mysql_error());*/
mysql_close($cn);
}


 public static function alreadyThere($user){
     include '../controller/conexaoA.php'; 
     $email=$user->getEmail();
    $SQLVerifiqueDuplicidade="SELECT * FROM user WHERE email='$email'";
    $resultadoDaVerificacao=  mysql_query($SQLVerifiqueDuplicidade)or die(mysql_error());
if(mysql_num_rows($resultadoDaVerificacao)!=0){
    return TRUE;}
    else{
    return FALSE;
    }
    mysql_close($cn);
 } 
 
 public static function update($old,$new){
     
    $SQLUpdateUser="UPDATE `user` SET `firstName` ='$new->firstName', `lastName` = '$new->lastName', `email` = '$new->email', `country` = '$new->country' WHERE `user`.`user_id` = '$old->user_id';";
     
     
 }
 
 public static function startSession($email,$password){
     include'../controller/conexaoA.php';
  $password=md5($password);
     
 $sql="SELECT * FROM user WHERE email='$email' AND password='$password'";
 $resultado=mysql_query($sql) or die(mysql_error());
 $row=mysql_fetch_array($resultado);
 mysql_close($cn);
 if (mysql_num_rows($resultado)==1){
     session_start();
     $_SESSION['user_id']= $row["user_id"];
     $_SESSION['userImageURL']=$row['image'];
     $_SESSION['firstName']=$row['firstName'];
     $_SESSION['country']=$row['country'];
     $_SESSION['lastName']=$row['lastName'];
     }

    }

    
}

?>
