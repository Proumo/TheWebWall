<?PHP
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

class xmlResponse
{

  function start()
  {
   
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo "\n <response>\n";
  }

  function command($params=array(), $encoded=array())
  {
    if($params) {
      foreach($params as $key => $val) {
        echo "    <$key>$val</$key>\n";
      }
    }
    if($encoded) {
      foreach($encoded as $key => $val) {
        echo "    <$key><![CDATA[$val]]></$key>\n";
      }
    }
    
  }
  function juntar($string){
      echo $string."\n";
  }
  function end()
  {
    echo "</response>\n";
   
  }
  function terminar(){
      exit;
  }
}
?>
