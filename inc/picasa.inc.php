<?php
  
  function fetch_albums() {
    require("oauth2.inc.php");
    require("xml2array.inc.php");
    $access_token = oauth2_access_token();
    $uri = "https://picasaweb.google.com/data/feed/api/user/default?kind=album&access=private&access_token={$access_token}";
    $obj = xml2array(file_get_contents($uri), $get_attributes=1);
    
    return $obj['feed']['entry'];
  }

  function fetch_single_album($album_id) {
    require("oauth2.inc.php");
    require("xml2array.inc.php");
    $access_token = oauth2_access_token();
    $uri = "https://picasaweb.google.com/data/feed/api/user/default/albumid/{$album_id}?kind=photo&access=private&access_token={$access_token}";
    $obj = xml2array(file_get_contents($uri), $get_attributes=1);
    
    return $obj;
  }


?>