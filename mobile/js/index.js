    function navvideo(){
                      
            var target=$("#1-1");
    if(target.offset()===null||target.offset()===undefined){
        
    }
        $('#wall-viewport').scrollTo( target, 2000, {onAfter:function(){$.update();}});
        return;
    
}

function navpublico(){
            $.update();
            $.create(0,2);
            var id="#"+0+"-"+2;
            var target=$(id);
    if(target.offset()===null||target.offset()===undefined){
        
    }
        $('#wall-viewport').scrollTo( target, 2000, {onAfter:function(){$.update();}});
        return;
    
}


function navsocial(){
            $.update();
            $.create(2,0);
           
            var target=$("#2-0");
    if(target.offset()===null||target.offset()===undefined){
        
    }
        $('#wall-viewport').scrollTo( target, 2000, {onAfter:function(){$.update();}});
        return;
    
}

function navcadastro(){
            $.update();
            $.create(2,2);
           
            var target=$("#2-2");
    if(target.offset()===null||target.offset()===undefined){
        
    }
        $('#wall-viewport').scrollTo( target, 2000, {onAfter:function(){$.update();}});
        return;
    
}

