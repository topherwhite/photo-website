<?php
  
  require_once("../inc/galleriffic.inc.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once("../inc/html/head.inc.php"); ?>
<script type="text/javascript">
  var slideShowAutoStart = false;
  var slideShowEnableHistory = true;
  var slideShowTransitionDuration = 1000;
  var slideShowFrameDuration = 4000;
</script>
</head>
<body>
  
  <?php require_once("../inc/html/header.inc.php"); ?>

  <div id="page">
    <div id="container" class="photo-website-album">
      <?php echo galleriffic_album("Portfolio",500); ?>
    </div>
  </div>

<?php require_once("../inc/html/footer.inc.php"); ?>
</body>
</html>