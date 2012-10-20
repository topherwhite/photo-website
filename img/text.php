<?php

header('Content-Type: image/png');

require_once "../inc/imgtxt.inc.php";

$str = explode("_",$_GET['str']);
$txt['siz'] = $str[0];
$txt['wd'] = $str[1];
$txt['clr'] = $str[2];
$txt['bgc'] = $str[3];
$txt['msg'] = str_replace("*"," ",$str[4]);

$imgQual = 1;

$txt['ht'] = intval($txt['siz']) + 32;

$txt['x'] = 10;
$txt['y'] = $txt['ht'] - 22;

$mkImg = new putTxtOnImg();

$mkImg->Message($txt['msg']);

$mkImg->Angle(0);

$mkImg->Font("../inc/papyrus");

$mkImg->FontSize($txt['siz']);

$mkImg->Coordinate($txt['x'],$txt['y']);

$mkImg->Colors($txt['clr']);

$mkImg->WriteTXT($txt['ht'],$txt['wd'],$txt['bgc'],$imgQual);

?>
