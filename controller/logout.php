<?php
include 'conexaoA.php';
include 'restrito.php';
$now=time();
if(isset($_SESSION['user_id'])){
    $sqlVerificaSeJaExiste="SELECT * FROM ultimologout WHERE user_id=".$_SESSION['user_id'];
    $resVerificacao=  mysql_query($sqlVerificaSeJaExiste)or die(mysql_error());
    if(mysql_num_rows($resVerificacao)>=1){
        $sqlUpdateUltimoLogin="UPDATE  `ultimologout`
            SET  `ultimoLogout` =  CURRENT_TIMESTAMP,
            `ultimoLogoutUnix` =$now 
            WHERE  `ultimologout`.`user_id` =".$_SESSION['user_id'].";";
        mysql_query($sqlUpdateUltimoLogin)or die(mysql_error());
        mysql_close($cn);
    }else{
        $SQLInsercao="INSERT INTO  `ultimologout` (
                        `user_id` ,
                        `ultimoLogout`,
                        `ultimoLogoutUnix`
                        )
                        VALUES (
                        ".$_SESSION['user_id'].", 
                        CURRENT_TIMESTAMP,
                        $now
                        );";
        mysql_query($SQLInsercao)or die(mysql_error());
        mysql_close($cn);  
    }
    
}
session_destroy();
mysql_close($cn);
      header("Location:../index.php");

?>
