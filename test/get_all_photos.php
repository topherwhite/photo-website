<?php
  
  require_once("../inc/picasa.inc.php");
  
  $albs = fetch_albums("Slideshow");
  foreach ($albs as $alb) {
    $imgs = fetch_single_album($alb["gphoto:id"]["value"]);
    foreach ($imgs as $img) {
      $i = picasa_photo($img);
      echo $i["orig"]."<br />";
      picasa_image_data($i["orig"]);
    }
  }

?>