<?php
  
  require_once("../inc/picasa.inc.php");
  
  $albs = fetch_albums();

  foreach ($albs as $i=>$v) {
    
    $imgs = fetch_single_album($v["gphoto:id"]["value"]);
    foreach ($imgs as $i_=>$v_) {
      var_dump($v_);
      echo "<br /><br /><br />";
    }
  }

?>