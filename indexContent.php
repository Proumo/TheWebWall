<?php
require 'lang/en-US.php';
$cordenada = $_GET["c"];

switch ($cordenada) {
    case 00:
        ?><div class="container">
            
            <h1 id="welcome"><?php echo MENSAGEM_BOAS_VINDAS_INDEX;?></h1>
            <div class="descricao apresentacao"><?php echo DESCRICAO_INDEX; ?></div>
            <img id="cartaz" src="images/0-0.png">
            <button id="videoButton" class="btn btn-large btn-inverse btnVideo" onclick="navvideo();"> <?php echo ASSISTA_AO_VIDEO_INDEX; ?></button>
        </div>

        <?php
        break;
        return;
    case 02:
        ?><div class="container">
            
            <h1 id="welcome"><?php echo PUBLICO_E_UNICO_TITULO_INDEX ?></h1>
            <div class="descricao unico"><?php echo PUBLICO_E_UNICO_P1_INDEX?> 
                <div class="descricao regjoeBloq"><?php echo PUBLICO_E_UNICO_P2_INDEX;?></div>
            </div>
            
            <img class="regjoe" src="images/regjoe.png">
            <button class="btn btn-large btnSocial btn-success" onclick="navsocial()"><?php echo SOCIAL; ?><i class="icon-thumbs-up icon-white"></i>
                <i class="icon-thumbs-up icon-white"></i> <i class="icon-thumbs-up icon-white"></i>
            </button>
        </div>

        <?php
        break;
        return;
    case 11:
        ?><div class="containerVideo">
            <div class="video">
                <iframe width="700" height="400" src="http://www.youtube.com/embed/JYYJZYn_sqQ" frameborder="0" >
                
                </iframe> 
               <button id="publicoButton" class="btn btn-large btnPublico" onclick="navpublico();"> <?php echo UM_LOCAL_PUBLICO_UNICO_PERGUNTA_INDEX ?></button> 
            </div>
        </div>

        <?php
        break;
        return;
    case 20:
        ?><div class="container">
            
            <h1 id="welcome"><?php echo MENTES_CRIATIVAS_TITULO_INDEX?></h1>
            <div class="descricao unico"><?php echo MENTES_CRIATIVAS_P1_INDEX?> 
                    <div class="descricao regjoeBloq"><?php echo MENTES_CRIATIVAS_P2_INDEX?></div>
            </div>
            
            <img class="regjoe" src="images/-2-1.png">
            <button class="btn btn-large btnCadastro btn-info" onclick="navcadastro()"><?php echo CADASTRE_SE?>  
            </button>
        </div>

        <?php
        break;
        return;
    case 22:
        ?><div class="container">
            <div class="descricao cadastro">
                <form id="form" method="post" action="controller/cadastrar.php">
	
	<h1 id="welcome"><?php echo CADASTRE_SE?></h1>
            
            
            <img class="imgCadastro" src="images/0-1.png">
            
        <label for="email" ><?php echo EMAIL?></label> 
	<input id="email" name="email" type="email" onchange="checarEmail()" required /> 
         <label for="nickname" ><?php echo APELIDO?></label> 
        <div class="input-prepend">
        <span class="add-on">@</span>       
        <input id="nickname" name="nickname" type="text" onchange="checarNick()" required /> 
        <label for="firstName"><?php echo PRIMEIRO_NOME?></label> 
        <input id="firstName" name= "firstName" type="text" required/>
        <label for="lastName"><?php echo SOBRENOME?></label> 
        <input id="lastName" name= "lastName" type="text" required />
	<label for="password"><?php echo SENHA?></label>
        <input id="password" name= "password" type="password" required/>
	<label for="passwordConf"><?php echo CONFIRME_SENHA?></label>
        <input id="passwordConf" type="password" required/>
	
        <label for="country"> <?php echo SELECIONE_SEU_PAIS?></label>
	<select class="element select medium" id="country" name="country"  required> 
	<option value="" selected="selected"></option>
	<option value="Afghanistan" >Afghanistan</option>
	<option value="Albania" >Albania</option>
	<option value="Algeria" >Algeria</option>
	<option value="Andorra" >Andorra</option>
	<option value="Antigua and Barbuda" >Antigua and Barbuda</option>
	<option value="Argentina" >Argentina</option>
	<option value="Armenia" >Armenia</option>
	<option value="Australia" >Australia</option>
	<option value="Austria" >Austria</option>
	<option value="Azerbaijan" >Azerbaijan</option>
	<option value="Bahamas" >Bahamas</option>
	<option value="Bahrain" >Bahrain</option>
	<option value="Bangladesh" >Bangladesh</option>
	<option value="Barbados" >Barbados</option>
	<option value="Belarus" >Belarus</option>
	<option value="Belgium" >Belgium</option>
	<option value="Belize" >Belize</option>
	<option value="Benin" >Benin</option>
	<option value="Bhutan" >Bhutan</option>
	<option value="Bolivia" >Bolivia</option>
	<option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
	<option value="Botswana" >Botswana</option>
	<option value="Brazil" >Brazil</option>
	<option value="Brunei" >Brunei</option>
	<option value="Bulgaria" >Bulgaria</option>
	<option value="Burkina Faso" >Burkina Faso</option>
	<option value="Burundi" >Burundi</option>
	<option value="Cambodia" >Cambodia</option>
	<option value="Cameroon" >Cameroon</option>
	<option value="Canada" >Canada</option>
	<option value="Cape Verde" >Cape Verde</option>
        <option value="Central African Republic" >Central African Republicoption></option>
	<option value="Chad" >Chad</option>
	<option value="Chile" >Chile</option>
	<option value="China" >China</option>
	<option value="Colombia" >Colombia</option>
	<option value="Comoros" >Comoros</option>
	<option value="Congo" >Congo</option>
	<option value="Costa Rica" >Costa Rica</option>
	<option value="C�te d'Ivoire" >C�te d'Ivoire</option>
	<option value="Croatia" >Croatia</option>
	<option value="Cuba" >Cuba</option>
	<option value="Cyprus" >Cyprus</option>
	<option value="Czech Republic" >Czech Republic</option>
	<option value="Denmark" >Denmark</option>
	<option value="Djibouti" >Djibouti</option>
	<option value="Dominica" >Dominica</option>
	<option value="Dominican Republic" >Dominican Republic</option>
	<option value="East Timor" >East Timor</option>
	<option value="Ecuador" >Ecuador</option>
	<option value="Egypt" >Egypt</option>
	<option value="El Salvador" >El Salvador</option>
	<option value="Equatorial Guinea" >Equatorial Guinea</option>
	<option value="Eritrea" >Eritrea</option>
	<option value="Estonia" >Estonia</option>
	<option value="Ethiopia" >Ethiopia</option>
	<option value="Fiji" >Fiji</option>
	<option value="Finland" >Finland</option>
	<option value="France" >France</option>
	<option value="Gabon" >Gabon</option>
	<option value="Gambia" >Gambia</option>
	<option value="Georgia" >Georgia</option>
	<option value="Germany" >Germany</option>
	<option value="Ghana" >Ghana</option>
	<option value="Greece" >Greece</option>
	<option value="Grenada" >Grenada</option>
	<option value="Guatemala" >Guatemala</option>
	<option value="Guinea" >Guinea</option>
	<option value="Guinea-Bissau" >Guinea-Bissau</option>
	<option value="Guyana" >Guyana</option>
	<option value="Haiti" >Haiti</option>
	<option value="Honduras" >Honduras</option>
	<option value="Hong Kong" >Hong Kong</option>
	<option value="Hungary" >Hungary</option>
	<option value="Iceland" >Iceland</option>
	<option value="India" >India</option>
	<option value="Indonesia" >Indonesia</option>
	<option value="Iran" >Iran</option>
	<option value="Iraq" >Iraq</option>
	<option value="Ireland" >Ireland</option>
	<option value="Israel" >Israel</option>
	<option value="Italy" >Italy</option>
	<option value="Jamaica" >Jamaica</option>
	<option value="Japan" >Japan</option>
	<option value="Jordan" >Jordan</option>
	<option value="Kazakhstan" >Kazakhstan</option>
	<option value="Kenya" >Kenya</option>
	<option value="Kiribati" >Kiribati</option>
	<option value="North Korea" >North Korea</option>
	<option value="South Korea" >South Korea</option>
	<option value="Kuwait" >Kuwait</option>
	<option value="Kyrgyzstan" >Kyrgyzstan</option>
	<option value="Laos" >Laos</option>
	<option value="Latvia" >Latvia</option>
	<option value="Lebanon" >Lebanon</option>
	<option value="Lesotho" >Lesotho</option>
	<option value="Liberia" >Liberia</option>
	<option value="Libya" >Libya</option>
	<option value="Liechtenstein" >Liechtenstein</option>
	<option value="Lithuania" >Lithuania</option>
	<option value="Luxembourg" >Luxembourg</option>
	<option value="Macedonia" >Macedonia</option>
	<option value="Madagascar" >Madagascar</option>
	<option value="Malawi" >Malawi</option>
	<option value="Malaysia" >Malaysia</option>
	<option value="Maldives" >Maldives</option>
	<option value="Mali" >Mali</option>
	<option value="Malta" >Malta</option>
	<option value="Marshall Islands" >Marshall Islands</option>
	<option value="Mauritania" >Mauritania</option>
	<option value="Mauritius" >Mauritius</option>
	<option value="Mexico" >Mexico</option>
	<option value="Micronesia" >Micronesia</option>
	<option value="Moldova" >Moldova</option>
	<option value="Monaco" >Monaco</option>
	<option value="Mongolia" >Mongolia</option>
	<option value="Montenegro" >Montenegro</option>
	<option value="Morocco" >Morocco</option>
	<option value="Mozambique" >Mozambique</option>
	<option value="Myanmar" >Myanmar</option>
	<option value="Namibia" >Namibia</option>
	<option value="Nauru" >Nauru</option>
	<option value="Nepal" >Nepal</option>
	<option value="Netherlands" >Netherlands</option>
	<option value="New Zealand" >New Zealand</option>
	<option value="Nicaragua" >Nicaragua</option>
	<option value="Niger" >Niger</option>
	<option value="Nigeria" >Nigeria</option>
	<option value="Norway" >Norway</option>
	<option value="Oman" >Oman</option>
	<option value="Pakistan" >Pakistan</option>
	<option value="Palau" >Palau</option>
        <option value="Panama" >Panama</option>
	<option value="Papua New Guinea" >Papua New Guinea</option>
	<option value="Paraguay" >Paraguay</option>
	<option value="Peru" >Peru</option>
	<option value="Philippines" >Philippines</option>
	<option value="Poland" >Poland</option>
	<option value="Portugal" >Portugal</option>
	<option value="Puerto Rico" >Puerto Rico</option>
	<option value="Qatar" >Qatar</option>
	<option value="Romania" >Romania</option>
	<option value="Russia" >Russia</option>
	<option value="Rwanda" >Rwanda</option>
	<option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option>
	<option value="Saint Lucia" >Saint Lucia</option>
	<option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option>
	<option value="Samoa" >Samoa</option>
	<option value="San Marino" >San Marino</option>
	<option value="Sao Tome and Principe" >Sao Tome and Principe</option>
	<option value="Saudi Arabia" >Saudi Arabia</option>
	<option value="Senegal" >Senegal</option>
	<option value="Serbia and Montenegro" >Serbia and Montenegro</option>
	<option value="Seychelles" >Seychelles</option>
	<option value="Sierra Leone" >Sierra Leone</option>
	<option value="Singapore" >Singapore</option>
	<option value="Slovakia" >Slovakia</option>
	<option value="Slovenia" >Slovenia</option>
	<option value="Solomon Islands" >Solomon Islands</option>
	<option value="Somalia" >Somalia</option>
	<option value="South Africa" >South Africa</option>
	<option value="Spain" >Spain</option>
	<option value="Sri Lanka" >Sri Lanka</option>
	<option value="Sudan" >Sudan</option>
	<option value="Suriname" >Suriname</option>
	<option value="Swaziland" >Swaziland</option>
	<option value="Sweden" >Sweden</option>
	<option value="Switzerland" >Switzerland</option>
	<option value="Syria" >Syria</option>
	<option value="Taiwan" >Taiwan</option>
	<option value="Tajikistan" >Tajikistan</option>
	<option value="Tanzania" >Tanzania</option>
	<option value="Thailand" >Thailand</option>
	<option value="Togo" >Togo</option>
	<option value="Tonga" >Tonga</option>
	<option value="Trinidad and Tobago" >Trinidad and Tobago</option>
	<option value="Tunisia" >Tunisia</option>
	<option value="Turkey" >Turkey</option>
	<option value="Turkmenistan" >Turkmenistan</option>
	<option value="Tuvalu" >Tuvalu</option>
	<option value="Uganda" >Uganda</option>
	<option value="Ukraine" >Ukraine</option>
	<option value="United Arab Emirates" >United Arab Emirates</option>
	<option value="United Kingdom" >United Kingdom</option>
	<option value="United States" >United States</option>
	<option value="Uruguay" >Uruguay</option>
	<option value="Uzbekistan" >Uzbekistan</option>
	<option value="Vanuatu" >Vanuatu</option>
	<option value="Vatican City" >Vatican City</option>
	<option value="Venezuela" >Venezuela</option>
	<option value="Vietnam" >Vietnam</option>
	<option value="Yemen" >Yemen</option>
	<option value="Zambia" >Zambia</option>
	<option value="Zimbabwe" >Zimbabwe</option>

	</select>

        <button  class="btn btn-large btn-success btnEnviar" type="submit" value="Submit" > <?php echo ENVIAR?></button>
	</form>	
        </div>
        </div>
        <?php
        break;
        return;
    
    default:
        ?><div class="container"></div>

        <?php
        break;
        return;
}
?>
