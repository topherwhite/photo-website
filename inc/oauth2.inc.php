<?php

  function oauth2_access_token() {

    require("oauth2_creds.inc.php");

    $token = $oauth_access_token;

    if (@mktime() >= $oauth_token_expiration) {

      $fields = array("client_id"=>$oauth_client_id, "client_secret"=>$oauth_client_secret,
        "grant_type"=>"refresh_token", "refresh_token"=>$oauth_refresh_token);
      $curl_opt = array( CURLOPT_URL=>"https://accounts.google.com/o/oauth2/token", CURLOPT_TIMEOUT=>10, CURLOPT_FAILONERROR=>1, 
        CURLOPT_NOPROGRESS=>true, CURLOPT_NOPROGRESS=>true, CURLOPT_RETURNTRANSFER=>true, CURLOPT_POSTFIELDS=>$fields );
      $curl = curl_init();
      curl_setopt_array($curl, $curl_opt);
      $creds = json_decode(curl_exec($curl));
      curl_close($curl);

      $oauth2_creds = "<?php"
            ."\n\$oauth_client_id = \"{$oauth_client_id}\";"
            ."\n\$oauth_client_secret = \"{$oauth_client_secret}\";"
            ."\n\$oauth_user_name = \"{$oauth_user_name}\";"
            ."\n\$oauth_access_token = \"{$creds->access_token}\";"
            ."\n\$oauth_refresh_token = \"{$oauth_refresh_token}\";"
            ."\n\$oauth_token_expiration = ".(@mktime() + $creds->expires_in).";"
            ."\n?>";

      file_put_contents("inc/oauth2_creds.inc.php",$oauth2_creds);

      $token = $creds->access_token;

    }

    return $token;
  }

  function oauth2_user_name() {
    require("oauth2_creds.inc.php");
    return $oauth_user_name;
  }

?>