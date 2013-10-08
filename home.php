<?php
require 'controller/restrito.php'; //validaçao de login
require 'lang/pt-BR.php';
if(isset($_GET['x'])){
$x=  intval($_GET['x']);

}
else {
$x=0;
}
if(isset($_GET['y'])){
$y= intval($_GET['y']);

}
else {
$y=0;
}
?>

<!DOCTYPE html >
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $THE_WEB_WALL?></title>
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="css/geral.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.infinitedrag.js"></script> 
        <script type="text/javascript" src="js/jquery.scrollTo-1.4.3.1.js"></script> 
        <script type="text/javascript" src="js/jquery.ajax.js"></script>
        <script type="text/javascript" src="js/jquery.kinetic.min.js"></script>
        <script type="text/javascript" src="js/tww.js"></script>
        <script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
             

        </head>

        <body >
            <div id="wall">
            </div>


            <div  id="faixaInferior" class="inferior well btn-custom"> 

            </div>
            <div class="btn  btn-lateral"><i class="icon-thumbs-up"></i> O que você está achando do site?</div>
            <div id="postInfo" class=" postInfoFrame btn-custom">
                <i class="icon-remove close" id="fechar"></i>
                <div id="postInfoContent">             

                </div></div>
            <div class="leftmenu btn-custom">


                <div id="userInfoCard"class="userInfo well">
                    <div class="userImgBkgd" onclick="editarFotoPerfil()" ontouchend="editarFotoPerfil()"><img class="userImg" src="<?php echo $_SESSION['userImageURL'] ?>" ></img></div>
                    <label id="userName"><?php echo $_SESSION['firstName'];
    echo ' ' . $_SESSION['lastName']; ?></label>
                    <label id="userCountry"><?php echo $_SESSION['country'] ?></label>
                    <a class="btn btn-mini btn-control" href="controller/logout.php">
                        <i class="icon-off"></i> <?php echo $SAIR?></a>
                    
                </div>
               <!-- <div id="moveControl" class="moveControl btn-custom">
                    <div class="btn btnMove up" id="up"><i class="icon-chevron-up"></i></div>
                    <div class="btn btnMove left" id="left"><i class="icon-chevron-left"></i></div>
                    <div class="btn btnMove down" id="down"><i class="icon-chevron-down"></i></div>

                    <div class="btn btnMove right" id="right"><i class="icon-chevron-right"></i></div>
                </div>-->
               
               <div id="notifititulo" class="titulosecao btn-block btn ">
                      <?php echo $_SESSION['nickname'];?> <div id="numNotifi"></div>
                </div>
                <div id="notificacoes">
                    <div id="notificacoesContainer" class="folksContainer">
                    
                    </div>
                </div>  
                <div id="meuspoststitulo" class="titulosecao btn-block btn">
                    <i class="icon-picture"></i> <?php echo $MEUS_POSTS?>
                </div>
                <div id="meusPosts">
                    
                </div>
                <div id="novoposttitulo" class="titulosecao btn-block btn">
                    <i class="icon-edit"></i> <?php echo $NOVO_POST?>
                </div>
                <div id="novopostDiv" class="well">
                    
                  <ul class="nav nav-tabs">
                    <li><a href="#imagem" data-toggle="tab"><?php echo $IMAGEM ?></a></li>
                    
                   
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane active" id="imagem">
                     <div id="formNewPost">
                        <form  action="controller/recebe_upload.php" method="post" enctype="multipart/form-data" onsubmit="showConfirmation()" target="upload_target">
                        <div class="control-group">
                            <label class="control-label" for="titulo"><?php echo $TITULO?></label>
                            <div class="controls">
                                <input type="text" name="titulo" id="titulo"required></input>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="descricao"><?php echo $DESCRICAO?> (opcional)</label>
                            <div class="controls">
                                <textarea type="text" name="descricao" id="descricao"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="arquivo"><?php echo $ARQUIVO?></label>
                            <div class="controls">
                                <input type="file" name="arquivo" id="arquivo" required>
                            </div>
                        </div>

                        <input  class="btn btn-mini" type="submit" value="<?php echo $ENVIAR?>"></input></form>
                        <iframe id="upload_target" name="upload_target"  style="width:100%;height:200px;border:0px solid #fff;"> </iframe>
                        </div>
                </div>
                      
                  
                    </div>
                    
                    
                  </div>  
                    
                <div id="folkstitulo" class="titulosecao btn-block btn ">
                    <i class="icon-user"></i> <?php echo $AMIGOS?>
                </div>
                <div id="folks">
                    <div id="folksContainer"class="folksContainer">
                    
                    </div>
                    <div class="folksSearch">
                             
                            <input type="text" id="searchKey" placeholder="<?php echo $BUSQUE_AMIGOS?>">
                            <button onclick="searchPeople()"><i class="icon-search"></i></button>
                            <label><?php echo $EX_BUSQUE_AMIGOS?></label>
                    </div>
            </div>
            


        </div>
        
    </body>
    <script>$(document).ready(function(){
            carregar(<?php echo $x;?>,<?php echo $y; ?>);  
         });</script> 
</html>