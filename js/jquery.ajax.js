(function($){
    
 $.ir = function(x,y){
    var id=x+"-"+y;
    var target=$('#demo2_wall').find(id);
    $('#demo2_viewport').scrollTo( target, 5000, {onAfter:function(){$.update();}});
 }

    

$.tileContent=function($element,col,row){
   
                        $.ajax({
                           type: "GET",
                           url: "controller/buscar.php?x="+col+"&y="+row,
                           dataType: "text",
                           success: function(xml) {
                                      xml=$.trim(xml);
                                      xml=$.parseXML(xml);
                                       $(xml).find('response').each(function(){
                                                 var tipo=$(this).find('tipo').text();
                                                 var url = $(this).find('tagPost').text();
                                                 var id = $(this).find('id').text();
                                                
                                                  if(tipo=='imagem'){
                                                    
                                                    var tag="<img class='postagem' onerror='imgError(this);' ondblclick='showInformation("+id+");'  src='"+url+"'>";
                                                    $element.html(tag);
                                                    }
                                                  else if(tipo=='video'){
                                                         var tag='<iframe id='+col+'-'+row+' class="postagem" width="700" height="500" src="http://www.youtube.com/embed/'+url+'?rel=0" frameborder="0" ></iframe>';
                                                         $element.html(tag);
                                                    }
    
                                           });
                                     }
                         });
                     return;   
                    }
            
  
  $.showPosts= function(id){
      $("#faixaInferior").load("controller/mostrarCartao.php?id="+id).show("slow");
  }
  
  $.pesqHash=function(id){
    $("#faixaInferior").load("controller/pesquisarHash.php?id="+id).show("slow");  
  }


})(jQuery);
