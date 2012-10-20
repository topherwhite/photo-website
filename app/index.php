<?php
  
  require_once("../inc/galleriffic.inc.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once("../inc/html/head.inc.php"); ?>
</head>
<body>
  
  <div id="page">
    <div id="container">
      <?php echo galleriffic_album("Portfolio"); ?>
    </div>
  </div>

<?php require_once("../inc/html/footer.inc.php"); ?>
</body>
</html>