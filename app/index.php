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
      <?php echo galleriffic_album("Portfolio"); ?>
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