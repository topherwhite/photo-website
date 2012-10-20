<?php
  
  require_once("../inc/app.inc.php");
  require_once("../inc/picasa.inc.php");
  require_once("../inc/galleriffic.inc.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="google-site-verification" content="<?php echo $GLOBALS['app_google_site_verification']; ?>" />
<style>
</style>
<title><?php echo $GLOBALS['app_title']; ?></title>
<link rel="stylesheet" type="text/css" href="../lib/css-reset.css"></link>
<link rel="stylesheet" type="text/css" href="../lib/galleriffic/basic.css"></link>
<link rel="stylesheet" type="text/css" href="../lib/galleriffic/galleriffic-5.css"></link>
<link rel="stylesheet" type="text/css" href="../lib/galleriffic/black.css"></link>
<link rel="stylesheet" type="text/css" href="../css/styles.css"></link>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../lib/galleriffic/jquery.galleriffic.js"></script>
<script src="../lib/galleriffic/jquery.history.js"></script>
<script src="../lib/galleriffic/jquery.opacityrollover.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
</head>
<body>
  <div id="page">
    <div id="container">
      <h1><a href="index.html">Galleriffic</a></h1>
      <h2>Alternate layout using custom previous/next page controls</h2>

      <div class="navigation-container">
        <div id="thumbs" class="navigation">
          <a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>

          <ul class="thumbs noscript">

<?php
  $albs = fetch_albums("Slideshow");
  foreach ($albs as $alb) {
    $imgs = fetch_single_album($alb["gphoto:id"]["value"]);
    foreach ($imgs as $img) {
      $i = picasa_photo($img);
      picasa_fetch_data($i["orig"],"jpg");
      echo galleriffic_photo($i);
    }
  }
?>


          </ul>

          <a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>

        </div>
      </div>

      <div class="content">
        <div class="slideshow-container">
          <div id="controls" class="controls"></div>
          <div id="loading" class="loader"></div>
          <div id="slideshow" class="slideshow"></div>
        </div>
        <div id="caption" class="caption-container">
          <div class="photo-index"></div>
        </div>
      </div>

      <div style="clear: both;"></div>

    </div>
  </div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("<?php echo $GLOBALS['app_google_analytics']; ?>");
pageTracker._trackPageview();
</script>
</body>
</html>