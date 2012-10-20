<?php

  function oauth2_access_token() {

    require("oauth2_creds.inc.php");

    $token = $GLOBALS['oauth_access_token'];

    if (@mktime() >= $GLOBALS['oauth_token_expiration']) {

      $fields = array("client_id"=>$GLOBALS['oauth_client_id'], "client_secret"=>$GLOBALS['oauth_client_secret'],
        "grant_type"=>"refresh_token", "refresh_token"=>$GLOBALS['oauth_refresh_token']);
      $curl_opt = array( CURLOPT_URL=>"https://accounts.google.com/o/oauth2/token", CURLOPT_TIMEOUT=>10, CURLOPT_FAILONERROR=>1, 
        CURLOPT_NOPROGRESS=>true, CURLOPT_NOPROGRESS=>true, CURLOPT_RETURNTRANSFER=>true, CURLOPT_POSTFIELDS=>$fields );
      $curl = curl_init();
      curl_setopt_array($curl, $curl_opt);
      $creds = json_decode(curl_exec($curl));
      curl_close($curl);

      $oauth2_creds = "<?php"
            ."\n\$GLOBALS['oauth_client_id'] = \"{$GLOBALS['oauth_client_id']}\";"
            ."\n\$GLOBALS['oauth_client_secret'] = \"{$GLOBALS['oauth_client_secret']}\";"
            ."\n\$GLOBALS['oauth_user_name'] = \"{$GLOBALS['oauth_user_name']}\";"
            ."\n\$GLOBALS['oauth_access_token'] = \"{$creds->access_token}\";"
            ."\n\$GLOBALS['oauth_refresh_token'] = \"{$GLOBALS['oauth_refresh_token']}\";"
            ."\n\$GLOBALS['oauth_token_expiration'] = ".(@mktime() + $creds->expires_in).";"
            ."\n?>";

      file_put_contents("inc/oauth2_creds.inc.php",$oauth2_creds);

      $token = $creds->access_token;

    }

    return $token;
  }

?>