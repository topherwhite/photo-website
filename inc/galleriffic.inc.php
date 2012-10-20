<?php

  function galleriffic_photo($entry) {

    $caption = str_replace("\"","\\\"",$entry["caption"]);

    $orig = "../img/photo.php?id={$entry['id']}";
    $thmb = "../img/photo.php?id={$entry['id']}.75.75";

    $html = "<li>"
            
            ."<a class=\"thumb\" name=\"{$entry['id']}\" href=\"{$orig}\" title=\"{$caption}\">"
              ."<img src=\"{$thmb}\" alt=\"{$caption}\" />"
            ."</a>"

            ."<div class=\"caption\">"
              ."<div class=\"image-title\">{$entry['caption']}</div>"
          //    ."<div class=\"image-desc\">{$entry['caption']}</div>"
              ."<div class=\"download\">"
                ."<a href=\"javascript:alert('download')\">Download Original</a>"
              ."</div>"
            ."</div>"

            ."</li>";

    return $html;
  }

?>