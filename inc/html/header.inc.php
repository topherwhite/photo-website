<?php
  require_once("../inc/app.inc.php");
  $width = 800;
?>
  <a href="../menu/">
    <div class="title-bar" style="width:<?php echo $width; ?>px;background-image:url(../img/text.php?str=36_<?php echo $width; ?>_cccccc_000000_<?php echo str_replace(" ","+",$GLOBALS['app_title']); ?>);"></div>  
  </a>

  <div class="contentII" style="width:<?php echo $width; ?>px;">
      <ul id="sdt_menu" class="sdt_menu" style="margin-top:0px;">
        
        <li>
          <a href="#">
            <img src="../lib/menu/images/2.jpg" alt=""/>
            <span class="sdt_active"></span>
            <span class="sdt_wrap">
              <span class="sdt_link">About me</span>
              <span class="sdt_descr">Artist Bio</span>
            </span>
          </a>
        </li>

        <li>
          <a href="#">
            <img src="../lib/menu/images/2.jpg" alt=""/>
            <span class="sdt_active"></span>
            <span class="sdt_wrap">
              <span class="sdt_link">Portfolio</span>
              <span class="sdt_descr">Artist Bio</span>
            </span>
          </a>
        </li>

      </ul>
  </div>