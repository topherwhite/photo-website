<?php
  
  require_once("oauth2.inc.php");
  require_once("xml2array.inc.php");

  function picasa_api_url($endpoint="") {
    $uri = "https://picasaweb.google.com/data/feed/api/user/default";
    if (!empty($endpoint)) { $uri .= $endpoint; }
    $uri .= "?access=all&access_token=".oauth2_access_token();
    return $uri;
  }

  function data_cache_id($uri) {
    return md5(str_replace("&access_token=".oauth2_access_token(),"",$uri));
  }

  function picasa_fetch_data($uri,$format="xml") {
    $cache = "../cache/".data_cache_id($uri).".{$format}";
    if (!file_exists($cache)) {
      file_put_contents($cache,file_get_contents($uri));
    }
    return file_get_contents($cache);
  }

  function picasa_entries($uri,$title_namespace="",$title_filter="") {
    $entries = xml2array(picasa_fetch_data($uri,"xml"), $get_attributes=1);
    $rtrn = array();
    foreach ($entries['feed']['entry'] as $entry) {
      if ( (empty($title_namespace) && empty($title_filter))
        || (strtolower(substr($entry['title']['value'],0,1+strlen($title_namespace)+strlen($title_filter))) == strtolower("{$title_namespace}_{$title_filter}"))) {
        $rtrn[count($rtrn)] = $entry;
      }
    }
    return $rtrn;
  }

  function picasa_photo($entry) {
    return array(
      "orig"=>$entry["media:group"]["media:content"]["attr"]["url"],
      "72"=>$entry["media:group"]["media:thumbnail"][0]["attr"]["url"],
      "144"=>$entry["media:group"]["media:thumbnail"][1]["attr"]["url"],
      "288"=>$entry["media:group"]["media:thumbnail"][2]["attr"]["url"],
      "caption"=>$entry["media:group"]["media:description"]["value"],
      "filename"=>$entry["media:group"]["media:title"]["value"]
      );
  }

  function fetch_albums($title_filter="") {
    $uri = picasa_api_url()."&kind=album";
    return picasa_entries($uri,"Site",$title_filter);
  }

  function fetch_single_album($album_id) {
    $uri = picasa_api_url("/albumid/{$album_id}")."&kind=photo";
    return picasa_entries($uri);
  }

?>