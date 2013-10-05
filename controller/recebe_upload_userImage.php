

<?php
require  "restrito.php";
require 'canvas.php';
require 'conexaoA.php';
// Pasta onde o arquivo vai ser salvo

$_UP['pasta'] = '../images/users/';

$_UP['pastaThumb'] = '../images/users/thumbnails/';

// Tamanho máximo do arquivo (em Bytes)

$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

 

// Array com as extensões permitidas

$_UP['extensoes'] = array('jpg', 'png', 'gif');

 // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)

$_UP['renomeia'] = true;

// Array com os tipos de erros de upload do PHP

$_UP['erros'][0] = 'Não houve erro';

$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';

$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';

$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';

$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

 

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro

if ($_FILES['arquivo']['error'] != 0) {

die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);

exit; // Para a execução do script

}

 

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

 

// Faz a verificação da extensão do arquivo

$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

if (array_search($extensao, $_UP['extensoes']) === false) {

echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";

}

 

// Faz a verificação do tamanho do arquivo

else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {

echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";

}

 

// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta

else {

// Primeiro verifica se deve trocar o nome do arquivo

if ($_UP['renomeia'] == true) {

// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg

$nome_final = $_SESSION["user_id"].time().'.'.$extensao;

} else {

// Mantém o nome original do arquivo

$nome_final = $_FILES['arquivo']['name'];

}

 

// Depois verifica se é possível mover o arquivo para a pasta escolhida

if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {

// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo

$thumb= new canvas($_UP['pasta'] . $nome_final);

$largura	= 60;
$altura		= 70;


	$thumb->redimensiona($largura,$altura,'proporcional');
        $thumb->grava($_UP['pastaThumb'].$nome_final);
    


$sqlUpdateFoto="UPDATE  `user`
    SET  `image` =  '"."images/users/thumbnails/".$nome_final."',
    `imageGrande`='"."images/users/".$nome_final."'
    WHERE  `user`.`user_id` =".$_SESSION['user_id'].";";
mysql_query($sqlUpdateFoto)or die(mysql_error());
$_SESSION['userImageURL']= "images/users/thumbnails/".$nome_final;
header("location:../home.php");
mysql_close($cn);
} else {

// Não foi possível fazer o upload, provavelmente a pasta está incorreta

echo "Não foi possível enviar o arquivo, tente novamente";

}

 

}

 

?>
