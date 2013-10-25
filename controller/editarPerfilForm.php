<?php
require 'restrito.php';
?>
<form method="post" action="controller/recebe_upload_userImage.php" enctype="multipart/form-data">

	<label class="control-label" for="arquivo">Altere sua imagem do perfil</label>
                            
                                <input type="file" name="arquivo" id="arquivo" >     

        <button  class="btn btn-small btn-success btnEnviar" type="submit" value="Submit" > Salvar </button>
	</form>	
       

