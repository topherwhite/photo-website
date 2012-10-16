<?php

  function oauth2_access_token() {

    require("oauth2_creds.inc.php");

    $token = $oauth_access_token;

    if (@mktime() >= $oauth_token_expiration) {
      $token = "expired";

      $oauth2_creds = "<?php"
            ."\n\$oauth_client_id = \"{$oauth_client_id}\";"
            ."\n\$oauth_client_secret = \"{$oauth_client_secret}\";"
            ."\n\$oauth_access_token = \"{$oauth_access_token}\";"
            ."\n\$oauth_refresh_token = \"{$oauth_refresh_token}\";"
            ."\n\$oauth_token_expiration = {$oauth_token_expiration};"
            ."\n?>";

      file_put_contents("inc/oauth2_creds.inc.php",$oauth2_creds);
    }

    return $token;
  }

?>