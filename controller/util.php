<?php
function timestampToArray($timeStamp){
           $timeStamp= explode(" ",$timeStamp);
           
           $data= explode("-",$timeStamp[0]);           
           $hora= explode(":",$timeStamp[1]);
            $resposta['ano']=$data[0];
            $resposta['mes']=$data[1];
            $resposta['dia']=$data[2];
            $resposta['hora']=$hora[0];
            $resposta['minuto']=$hora[1]; 
            $resposta['segundo']=$hora[2]; 
            return $resposta;
           }
           
           
?>
