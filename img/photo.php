<?php

  header('Content-Type: image/jpeg');

  require_once("../inc/picasa.inc.php");

  if (!empty($_GET["id"])) {
    $mark["orig"] = ImageCreateFromPNG("../img/logo-photo-website.png");
    $orig["img"] = ImageCreateFromJPEG("../cache/{$_GET['id']}.jpg");
    $orig["x"] = ImagesX($orig["img"]);
    $orig["y"] = ImagesY($orig["img"]);
    $mark["out"] = ImageCreateTrueColor(round($orig["x"]/2),round($orig["x"]/2)*(ImagesY($mark["orig"])/ImagesX($mark["orig"])));
    $mark["x"] = ImagesX($mark["out"]);
    $mark["y"] = ImagesY($mark["out"]);
    ImageCopyResampled($mark["out"],$mark["orig"],0,0,0,0,$mark["x"],$mark["y"],ImagesX($mark["orig"]),ImagesY($mark["orig"]));
    ImageCopyMerge($orig["img"],$mark["out"],$orig["x"]-$mark["x"],$orig["y"]-$mark["y"],0,0,$mark["x"],$mark["y"],50);
    ImageJPEG($orig["img"],"",80);
    ImageDestroy($orig["img"]);
  }

  exit;

?>
