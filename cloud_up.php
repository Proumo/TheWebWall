<?php

    require 'cloudinary/Cloudinary.php';
    require 'cloudinary/Uploader.php';
    require 'cloudinary/Api.php';
    
    \Cloudinary::config(array( 
        "cloud_name" => "hxasx9ldn", 
        "api_key" => "893558381195987", 
        "api_secret" => "5O80V2hJMzCFodM9-utRc1KgJ4Y" 
    ));
    
    function exe_update_backup($url_antiga, $url_nova){
        require_once 'controller/conexaoA.php';
        
        //$sql_update_backup = "UPDATE `postagem` SET `url` = '$novo_nome' WHERE `url` = '$nome_antigo' ";
        $sql_update_backup = "UPDATE `postagem` SET `url` = '$url_nova' WHERE `url` = '$url_antiga'";
        echo "novo nome: $url_nova e nome antigo: $url_antiga" . "<br>";
        echo $sql_update_backup . "<br>";
        $retorno = mysql_query($sql_update_backup);
        
        var_dump($retorno); echo "<br>";
        var_dump($cn);
	die();
        
        mysql_close($cn);
    }
    
    function up_cloud($url){
        $ref_img_up = \Cloudinary\Uploader::upload("images/posts/". $url);

        //var_dump($ref_img_up);
        return $ref_img_up;
    }
    
    function exec_up($url_antiga) {
        $img_instance = up_cloud($url_antiga);
        $url_nova = substr($img_instance["url"], 49, strlen($img_instance["url"]));
        exe_update_backup($url_antiga, $url_nova);
    }

    $diretorio = 'images/posts';
    $dadosDiretorio = opendir($diretorio); 
    $qtdImgReal = 0;
    $qtdImgIrreal = 0;

    require_once 'controller/conexaoA.php';
    while($imagem = readdir($dadosDiretorio)){
        if($imagem == "." || $imagem == "..") continue;
        //echo '<img src="' . $diretorio . $imagem . '" width="200">' . "\n";
        $extensao = substr($imagem, strlen($imagem)-4);

        if($extensao == ".png" || $extensao == ".jpg" || $extensao == ".gif") {
            $imagem = trim($imagem);
            
            $sql = "SELECT * FROM `postagem` WHERE `url` LIKE '$imagem' ";
    
            $retorno = mysql_query($sql) or die(mysql_error());
            $array = mysql_fetch_array($retorno);

            if($array) echo $imagem . " - <strong>OK</strong> <br>";
            else unlink($diretorio."/".$imagem); //se a imagem não tiver no banco ela é deletada
            
            /*
            exec_up($imagem);
            if($count<1) $count++;
            else break;
             * 
             */
        }
    }
    mysql_close($cn);
    
    echo "<br>Quantidade de imgs inuteis: $qtdImgIrreal<br>";
    echo "<br>Quantidade de imgs uteis: $qtdImgReal<br>";
?>
