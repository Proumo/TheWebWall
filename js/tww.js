window.onclose=function(){
                  $.get("controller/logout.php");
                  
              }
var loader="<div class='well loaderContainer'><img class='loader' src='images/loader.gif'></div>";



function mostrarPerfil(id){
    $("#postInfoContent").html(loader).load("controller/mostrarPerfil.php?id="+id);
    if($("#postInfo").is(":hidden")){
        $("#postInfo").show();
    }
}
function buscarInfoVideo(){}

function amigosUsuario(){
    $("#folksContainer").html(loader).load("controller/mostrarAmigos.php");
}
function editarFotoPerfil(){
    $("#postInfoContent").html(loader).load("controller/editarPerfilForm.php");
    if($("#postInfo").is(":hidden")){
        $("#postInfo").show();
    }
}
function seguir(id,$btn){
    $.get("controller/seguir.php",
            {op:0,id:id},
            function(){amigosUsuario();});
     $($btn).html("<i class='icon-thumbs-up'></i>Seguindo</div>");
  
}
function unfollow(id){
    $.get("controller/seguir.php",
            {op:1,id:id},
            function(){amigosUsuario();
                       mostrarPerfil(id);
            });
  
}
function showConfirmation(){
   
    $("#msgPost").show("slow");
}
function searchPeople(){
    var key= $("#searchKey").val();
    
    if(key==""){
        return;
    }
    $.ajax({
        type:"post",
        url:"controller/procurarUsuariosHTML.php",
        data:{key:key},
        dataType:"html",
        success:function(html){
            if($("#postInfo").is(":hidden")){
            $("#postInfoContent").html(loader).html(html);
            $("#postInfo").show("slow")
    }else{
            $("#postInfo").hide("slow");
            $("#postInfoContent").html(loader).html(html);
            $("#postInfo").show("slow");
    }}
    });
    
}


function carregar(x,y){
    if(!$("#postInfo").is(":hidden")){
     $("#postInfo").hide("slow");   
    }
    $("#wall").load("wall.php?x="+x+"&y="+y);
    
}

function postsUsuario(){
    $("#meusPosts").html(loader).load("controller/mostrarPostsUsuario.php");
}
function amigosUsuario(){
    $("#folksContainer").html(loader).load("controller/mostrarAmigos.php");
}
function navegar(x,y,id){
   if(id){
     $.get("controller/atualizaNotifi.php?id="+id);
           $("#notificacoesContainer").load("controller/mostrarNotifi.php");
           $("#numNotifi").load("controller/mostrarNotifi.php?num=1");

   }
    
    
    if(!$("#postInfo").is(":hidden")){
     $("#postInfo").hide("slow");   
    }
    $.ajax({
                           type: "GET",
                           url: "controller/navegar.php?x="+x+"&y="+y,
                           dataType: "text",
                           success: function(xml) {
                                    xml=$.trim(xml);
                                    xml=$.parseXML(xml);
                                    $(xml).find('r').each(function(){
                                                  var x1=$(this).find('x').text();
                                                  var y1=$(this).find('y').text();
                                                  
                                                   x1= parseInt(x1,10);
                                                   y1= parseInt(y1,10);
                                                   
                                                  
                                                   var id1="#"+x1+"-"+y1;
                                                   $.create(x1,y1);
                                                   var target1=$(id1);
                                                   while(target1.offset()===null||target1.offset()===undefined){
                                                      $.create(x1,y1);
                                                     target1=$(id1);
                                                   }
                                                   $('#demo2_viewport').scrollTo( target1, 2000, {onAfter:function(){$.update()}});
                   
                                                  var id2="#"+x+"-"+y;
                                                  $.create(x,y);
                                                  var target2=$(id2);
                                                  while(target2.offset()===null||target2.offset()===undefined){
                                                    $.create(x,y);
                                                    target2=$(id2);
                                                   }
                                                   
                                                   $('#demo2_viewport').scrollTo( target2, 1000, {onAfter:function(){$.update()}});    
                                                        
                                                       
                                           });
                                     }
                         });  
              
            
        return;
    
}
 function closeDivPosts(){
     $("#faixaInferior").hide("slow",function(){$("#faixaInferior").html("");});
 }

function removerComentario(id,idPost){
    
    $.post("controller/removerComentario.php",{"id":id},function(){
        alert ("seu comentario foi removido!");
        $("#postInfoContent").html(loader).load("controller/mostrarInfo.php?id="+idPost);
        }, null);
    
}
function showInformation(id){
    
    $("#postInfoContent").html(loader).load("controller/mostrarInfo.php?id="+id);
    $("#postInfo").show("slow");
    
    $("#meusPosts").find(".userPosts").find("#"+id).fadeOut("slow");
    $.post("controller/updateComment.php", {id:id});
    return true;
    
}
function enviarComentario(id){
    var texto=$("#texto").val();
    if(texto==""){
        return null;
    }
    $.ajax({
        type: "POST",
        url: "controller/recebeComentario.php",
        data:{'id':id, 'texto':texto},
        dataType:"text",
        success:function(){
             $("#postInfoContent").html(loader).load("controller/mostrarInfo.php?id="+id);
            
        }
    })
   return true; 
}


function imgError(image){
                         image.onerror = "";
                         image.src = "images/404.png";
                         return true;
            }

            $(document).ready(function() {
              $("#feedback").click(function(){
                  $("#postInfoContent").html('<h3>Ajude-nos a melhorar!</h3><iframe src="https://docs.google.com/forms/d/1bdf02ohht6yc4ZFCBomxPN2NjRXncVLY8vS-9jSmXy4/viewform?embedded=true" width="620" height="400" frameborder="0" marginheight="0" marginwidth="0">Carregando...</iframe>');
                 if($("#postInfo").is(":hidden")){
                    $("#postInfo").show();}
              });

              
          
              $("#notificacoesContainer").load("controller/mostrarNotifi.php");
                        $("#numNotifi").load("controller/mostrarNotifi.php?num=1");
             /* $("#userInfoCard").mouseover(function () {
                    if ($("#moveControl:first").is(":hidden")) {
                    $("#moveControl").slideDown("slow");}
            });
            $(".leftmenu").mouseout(function () {
                    $("#moveControl").slideUp("slow");
            });*/
          
            $("#fechar").click(function(){
             $("#postInfo").hide("slow",function(){$("#postInfoContent").html("");});
            });
            
              
             $("#meuspoststitulo").click(function () {
                    postsUsuario();
                    if ($("#meusPosts:first").is(":hidden")) {
                    $("#meusPosts").slideDown("slow");
                        if (!$('#novopostDiv').is(":hidden")) {
                               $("#novopostDiv").slideUp("slow");
                        }
                        if (!$('#folks').is(":hidden")) {
                               $("#folks").slideUp("slow");
                        }
                        if (!$('#notificacoes').is(":hidden")) {
                               $("#notificacoes").slideUp("slow");
                        }
                      
                    } else {
                    $("#meusPosts").slideUp('slow');
                    }
                        }); 
              $("#novoposttitulo").click(function () {
                    if ($("#novopostDiv:first").is(":hidden")) {
                    $("#novopostDiv").slideDown("slow");
                        if (!$('#meusPosts').is(":hidden")) {
                               $("#meusPosts").slideUp("slow");
                        }
                        if (!$('#folks').is(":hidden")) {
                               $("#folks").slideUp("slow");
                        }
                        if (!$('#notificacoes').is(":hidden")) {
                               $("#notificacoes").slideUp("slow");
                        }
                    } else {
                    $("#novopostDiv").slideUp('slow');
                    }
                        }); 
                        
                        
                   $("#folkstitulo").click(function () {
                    if ($("#folks:first").is(":hidden")) {    
                    amigosUsuario();
                    $("#folks").slideDown("slow");
                    if (!$('#novopostDiv').is(":hidden")) {
                               $("#novopostDiv").slideUp("slow");
                        }
                    if (!$('#meusPosts').is(":hidden")) {
                               $("#meusPosts").slideUp("slow");
                        }
                    if (!$('#notificacoes').is(":hidden")) {
                               $("#notificacoes").slideUp("slow");
                        }
                    } else {
                    $("#folks").slideUp('slow');
                    }
                        });
                        
                    $("#notifititulo").click(function () {
                    if ($("#notificacoes:first").is(":hidden")) {    
                        $("#notificacoesContainer").load("controller/mostrarNotifi.php");
                        $("#numNotifi").load("controller/mostrarNotifi.php?num=1");
                        $("#notificacoes").slideDown("slow");
                        
                        
                    if (!$('#novopostDiv').is(":hidden")) {
                               $("#novopostDiv").slideUp("slow");
                        }
                    if (!$('#meusPosts').is(":hidden")) {
                               $("#meusPosts").slideUp("slow");
                        }
                    if (!$('#folks').is(":hidden")) {
                               $("#folks").slideUp("slow");
                        }
                    } else {
                    $("#notificacoes").slideUp('slow');
                    }
                        });
             
            })
            
            


