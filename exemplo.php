<?
// Faz o include do arquivo da Classe PHP
include('mobile_device_detect.php');

// Redireciona todos os acessos via Celular e Smartphone
// para o endere�o http://www.webartz.com.br/mobile/ e os
// acessos via plataformas e navegadores de desktop, que �
// o �ltimo par�metro, colocamos �false�, para ele carregar
// est� p�gina normalmente.

mobile_device_detect(true,true,true,true,true,true,'http://www.webartz.com.br/mobile/',false);
?>