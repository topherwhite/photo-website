<?php

  header('Content-Type: image/jpeg');

  require_once("../inc/picasa.inc.php");

  if (!empty($_GET["id"])) {
    $params = explode(".",$_GET['id']);

    // get original image and resample it
    $orig = ImageCreateFromJPEG("../cache/{$params[0]}.jpg");
    $orig_x = ImagesX($orig);
    $orig_y = ImagesY($orig);
    $orig_r = $orig_x/$orig_y;
    if (empty($params[1])) { $x = $orig_x; } else { $x = intval($params[1]); }
    if (empty($params[2])) { $y = $orig_y; } else { $y = intval($params[2]); }
    if (empty($params[2]) && !empty($params[1])) {
      if ($orig_x > $orig_y) {
        $x = intval($params[1]); $y = round(intval($params[1])/$orig_r);
      } else {
        $y = intval($params[1]); $x = round(intval($params[1])*$orig_r);
      }
    }
    $final = ImageCreateTrueColor($x,$y);
    $r = $x/$y;

    $crop_w = round($r*$orig_y); if ($orig_x < $orig_y) { $crop_w = $orig_x; }
    $crop_h = round($r*$orig_x); if ($orig_y < $orig_x) { $crop_h = $orig_y; }
    $crop_x = round(($orig_x-$crop_w)/2);
    $crop_y = round(($orig_y-$crop_h)/2);

    if (($orig_x < $orig_y) && empty($params[2])) {
      $crop_h = $orig_y;
      $crop_y = 0;
    }

    ImageCopyResampled($final,$orig,0,0,$crop_x,$crop_y,$x,$y,$crop_w,$crop_h);
    ImageDestroy($orig);

    // if image is large enough, put watermark on resampled image
    if ($x > 200) {
        $mark_in = ImageCreateFromPNG("../img/app-watermark.png");
        ImageColorTransparent($mark_in, ImageColorAt($mark_in, 1, 1));
        $mark_x = ImagesX($mark_in);
        $mark_y = ImagesY($mark_in);
        $mark_width = 0.75;
        $mark_ref = $x; if ($y < $x) { $mark_ref = $y; }
        $mark_final = ImageCreateTrueColor(round($mark_ref*$mark_width),round($mark_ref*$mark_width*($mark_y/$mark_x)));
        $mark_final_x = ImagesX($mark_final);
        $mark_final_y = ImagesY($mark_final);
        ImageCopyResampled($mark_final,$mark_in,0,0,0,0,$mark_final_x,$mark_final_y,$mark_x,$mark_y);
        ImageDestroy($mark_in);
        ImageColorTransparent($mark_final, ImageColorAt($mark_final, 1, 1));
        ImageCopyMerge($final,$mark_final,$x-$mark_final_x,$y-$mark_final_y,0,0,$mark_x,$mark_y,100);
        ImageDestroy($mark_final);
    }

    // output final image
    ImageJPEG($final,"",80);
    ImageDestroy($final);
  }

  exit;

?>
