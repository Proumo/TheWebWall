<?php
session_start();
if(isset($_SESSION['user_id']))
  header("location:home.php");
else{}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>The Web Wall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="css/styleMobile.css" rel="stylesheet" media="screen">
    <style>
        #wall ._tile {
                            background-image:url("images/fundo1.1.jpg");}
    </style>
  </head>
  <body>
		<header>
			<div class="navbar-inverse navbar-static-top barra">
			  <div class="navbar-inner">
                              <button class="btn btn-large btn-success btnCadastrese" onclick="navcadastro()">Cadastre-se!</button>
                            <div class="navbar-form login">
                                <form class="form-horizontal"  method="POST" action="controller/login.php">
                                <input type="email" name="email" placeholder="email" required>
                                <input type="password" name="password" placeholder="senha" required>
                                <input class="btn btn-info btnSignin" type="submit" value="Sign In" />
                            </form>
                            </div>
                            </div>
			  
			</div>
			
		</header>
		<section class="container">
                    <h1 id="tituloMaster">The Web Wall </h1>
                    <div id="wall-viewport">
                        
                    <div id="wall">
                        
                    </div>
                    </div>
		</section>
		<footer>
		</footer>
      <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo-min.js"></script>  
    <script type="text/javascript" src="js/jquery.infinitedrag.js"></script>
    <script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script> var tile_options = {
                                width : 960,
                                height : 534,
                                start_col :0,
                                start_row :0,
                                range_col: [0, 3],
			        range_row: [0, 3],
            oncreate :function($element,col,row){ $element.load("indexContent.php?c="+col+row)}    
        };
        jQuery.infinitedrag("#wall", {},tile_options); </script>
    
    
  </body>
</html>
