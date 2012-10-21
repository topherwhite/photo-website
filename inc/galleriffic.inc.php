<?php
  
  require_once("picasa.inc.php");

  function galleriffic_album($title,$size=500,$height=0) {

    $html = "<div class=\"navigation-container\">"
        ."<div id=\"thumbs\" class=\"navigation\">"
        ."<a class=\"pageLink prev\" style=\"visibility:hidden;\" href=\"#\" title=\"Prev\"></a>"
      ."<ul class=\"thumbs noscript\">";

    $albums = fetch_albums($title);
    foreach ($albums as $a) {
      $images = fetch_single_album($a["gphoto:id"]["value"]);
      foreach ($images as $i) {
        $html .= galleriffic_photo(picasa_photo($i),$size,$height);
      }
    }

    $html .= "</ul>"
      ."<a class=\"pageLink next\" style=\"visibility:hidden;\" href=\"#\" title=\"Next\"></a>"
      ."</div>"
      ."</div>"

      ."<div class=\"content\" style=\"display:none;\">"
        ."<div class=\"slideshow-container\">"
          ."<div id=\"controls\" class=\"controls\"></div>"
          ."<div id=\"loading\" class=\"loader\"></div>"
          ."<div id=\"slideshow\" class=\"slideshow\"></div>"
          ."<div class=\"slideshow-mask mask-circle\"></div>"
        ."</div>"
        ."<div id=\"caption\" class=\"caption-container\">"
          ."<div class=\"photo-index\"></div>"
        ."</div>"
      ."</div>"
      ."<div style=\"clear:both;\"></div>"
      ;

    return $html;
  }

  function galleriffic_photo($entry,$size,$height=0) {
    $caption = str_replace("\"","\\\"",$entry["caption"]);
    $orig = "../img/photo.php?id={$entry['id']}.{$size}"; if (!empty($height)) { $orig .= ".{$height}"; }
    $thmb = "../img/photo.php?id={$entry['id']}.75.75";
    picasa_fetch_data($entry["orig"],"jpg");
    $html = "<li>"
            ."<a class=\"thumb\" name=\"{$entry['id']}\" href=\"{$orig}\" title=\"{$caption}\">"
              ."<img src=\"{$thmb}\" alt=\"{$caption}\" />"
            ."</a>"
            ."<div class=\"caption\">"
              ."<div class=\"image-title\">{$entry['caption']}</div>"
              ."<div class=\"image-desc\">{$entry['filename']}</div>"
              ."<div class=\"download\">"
                ."<a href=\"javascript:alert('Pay with Stripe')\">Order High-Quality Print</a>"
              ."</div>"
            ."</div>"
            ."</li>";
    return $html;
  }

?>