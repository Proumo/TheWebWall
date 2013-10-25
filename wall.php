

                    <script type="text/javascript">      
                        $(document).ready(function() {
                            
                            var tile_options = {
                                width : 866,
                                height : 859,
                                start_col :-10000,
                                start_row :-10000,
                                oncreate :function($element,col,row){$.tileContent($element,col,row)}    
                                };
        jQuery.infinitedrag("#demo2_wall", {}, tile_options);
        $("#demo2_viewport").kinetic();
        var x=<?php
                if (isset($_GET['x'])) {
                echo intval($_GET['x']);
                }else
                echo 0;
                ?>;
        var y=<?php
                if (isset($_GET['y'])) {
                echo intval($_GET['y']);
                }else
                echo 0;
                ?>;
        var idCont= "#"+x+"-"+y;
        while($(idCont).offset()===undefined){
          $.create(x,y);
          var targ=$(idCont);
        }
        $('#demo2_viewport').scrollTo( targ, 2, {onAfter:function(){$.update()}});
        
    });
                    </script>

                    <style type="text/css">
                        #demo2_wall ._tile {
                            background-image:url("images/fundo1.1.jpg");}

                    </style>

                   

                        <div id="demo2_viewport">
                            <div id="demo2_wall"></div>
                        </div>
                   