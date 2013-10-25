<?php
echo "<label style='display:none'>";
require_once "restrito.php";
include '../model/class.Post.php';
include '../model/class.User.php';
require 'canvas.php';
// Pasta onde o arquivo vai ser salvo

$_UP['pasta'] = '../images/posts/';
$_UP['pastaThumb'] = '../images/posts/thumbnails/';
$_UP['pastaAcessoThumb']="images/posts/thumbnails/";
$_UP['pastaAcessoPost']="images/posts/";
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

die("</label>Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);

exit; // Para a execução do script

}

 

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

 

// Faz a verificação da extensão do arquivo
$string=$_FILES['arquivo']['name'];
$ponto=".";
$extensao = strtolower(end(explode($ponto,$string)));

if (array_search($extensao, $_UP['extensoes']) === false) {

echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";

}

 

// Faz a verificação do tamanho do arquivo

else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {

echo "</label>O arquivo enviado é muito grande, envie arquivos de até 2Mb.";

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
if($_FILES['arquivo']['size']>=1024*600){
    $red=1;
}else{
    $red=0;
}
 

// Depois verifica se é possível mover o arquivo para a pasta escolhida

if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {

// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
if($red===1){
$imagem=new canvas($_UP['pasta'] . $nome_final);
$imagem->redimensiona(800,800,"proporcional");
$imagem->grava($_UP['pasta'] . $nome_final);

}

$post=new Post();
$post->setUrl($_UP['pastaAcessoPost'] . $nome_final);
$author=new User();
$author->setUser_id($_SESSION['user_id']);
$post->setAuthor($author);
$post->setDescription($_POST['descricao']);
$post->setTitle($_POST['titulo']);
$thumb= new canvas($_UP['pasta'].$nome_final);

$largura	= 70;
$altura		= 70;


	$thumb->redimensiona($largura,$altura,'proporcional');
    $thumb->grava($_UP['pastaThumb'] . "thumb".$nome_final);
$post->setThumb($_UP['pastaAcessoThumb'] . "thumb".$nome_final);


$post->colarNaParede();
echo '</label><p>Congrats! check it out into My Posts menu</p>';
} else {

// Não foi possível fazer o upload, provavelmente a pasta está incorreta

echo "</label>Não foi possível enviar o arquivo, tente novamente";

}

 

}

 

?>
