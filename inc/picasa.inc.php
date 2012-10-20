<?php
  
  require_once("oauth2.inc.php");
  require_once("xml2array.inc.php");

  function picasa_api_url($endpoint="") {
    $uri = "https://picasaweb.google.com/data/feed/api/user/default";
    if (!empty($endpoint)) { $uri .= $endpoint; }
    $uri .= "?access=all&access_token=".oauth2_access_token();
    return $uri;
  }

  function picasa_data($uri,$title_namespace="") {
    $entries = xml2array(file_get_contents($uri), $get_attributes=1);
    $rtrn = array();
    foreach ($entries['feed']['entry'] as $entry) {
      if (empty($title_namespace) || (strtolower(substr($entry['title']['value'],0,1+strlen($title_namespace))) == strtolower($title_namespace)."_")) {
        $rtrn[count($rtrn)] = $entry;
      }
    }
    return $rtrn;
  }

  function fetch_albums() {
    
    $uri = picasa_api_url()."&kind=album";
    return picasa_data($uri,$title_namespace="Site");
  }

  function fetch_single_album($album_id) {
    $uri = picasa_api_url("/albumid/{$album_id}")."&kind=photo";
    return picasa_data($uri);
  }


?>