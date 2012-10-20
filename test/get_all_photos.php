<?php
  
  require_once("../inc/picasa.inc.php");
  
  $albs = fetch_albums("Slideshow");
  foreach ($albs as $alb) {
    $imgs = fetch_single_album($alb["gphoto:id"]["value"]);
    foreach ($imgs as $img) {
      $i = picasa_photo($img);
      picasa_fetch_data($i["orig"],"jpg");
      echo "<br />".data_cache_id($i["orig"]);
    }
  }

?>