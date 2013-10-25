<?php
include 'conexaoA.php';
include 'restrito.php';


$id=$_POST['id'];
$sqlVerificacao="SELECT * FROM comentarios WHERE userID=".$_SESSION['user_id']." AND id=$id";

$resVerfifica=  mysql_query($sqlVerificacao)or die(mysql_error());
if(mysql_num_rows($resVerfifica)===1){
    
$sql="DELETE FROM comentarios WHERE id=$id";
mysql_query($sql);

}else{
   
    echo -1;
}
mysql_close($cn);

?>
