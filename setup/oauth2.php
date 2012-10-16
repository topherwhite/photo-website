<?php
  
  if (empty($_GET['code']) && (empty($_GET['client_id']) || empty($_GET['client_secret']))) {

    $id = ""; if (!empty($_GET['client_id'])) { $id = $_GET['client_id']; }
    $secret = ""; if (!empty($_GET['client_secret'])) { $secret = $_GET['client_secret']; }

    echo "<form method='get' action='' style='font-size:18px;'>"
      ."<br />"
        ."<label for='client_id'>OAuth Client ID:</label>"
        ."<input type='text' size='50' style='font-size:18px;margin-left:10px;' name='client_id' value='{$id}' />"
      ."<br />"
        ."<label for='client_secret'>OAuth Client Secret:</label>"
        ."<input type='text' size='50' style='font-size:18px;margin-left:10px;' name='client_secret' value='{$secret}' />"
      ."<br /><br /><input type='submit' style='font-size:18px;' value='Set OAuth Keys' />"
      ."</form>";
    die();

  } elseif (!empty($_GET['client_id']) && !empty($_GET['client_secret'])) {
    file_put_contents("client_id.txt", $_GET['client_id']);
    file_put_contents("client_secret.txt", $_GET['client_secret']);
  }

  $redirect_uri = "http://photo-website.me/photo-website/setup/oauth2.php";
  $client_id = file_get_contents("client_id.txt");
  $client_secret = file_get_contents("client_secret.txt");

  if (!empty($_GET['code'])) {

    $fields = array("redirect_uri"=>$redirect_uri, "client_id"=>$client_id, "client_secret"=>$client_secret, "grant_type"=>"authorization_code", "code"=>$_GET['code']);
    $curl_opt = array( CURLOPT_URL=>"https://accounts.google.com/o/oauth2/token", CURLOPT_TIMEOUT=>10, CURLOPT_FAILONERROR=>1, 
      CURLOPT_NOPROGRESS=>true, CURLOPT_NOPROGRESS=>true, CURLOPT_RETURNTRANSFER=>true, CURLOPT_POSTFIELDS=>$fields );
    $curl = curl_init();
    curl_setopt_array($curl, $curl_opt);
    $creds = json_decode(curl_exec($curl));
    curl_close($curl);

    $oauth2_creds = "<?php"
                ."\n\$oauth_client_id = \"{$client_id}\";"
                ."\n\$oauth_client_secret = \"{$client_secret}\";"
                ."\n\$oauth_access_token = \"{$creds->access_token}\";"
                ."\n\$oauth_refresh_token = \"{$creds->refresh_token}\";"
                ."\n\$oauth_token_expiration = ".(@mktime() + $creds->expires_in).";"
                ."\n?>";

    file_put_contents("../inc/oauth2_creds.inc.php",$oauth2_creds);
    unlink("client_id.txt");
    unlink("client_secret.txt");

  } else {

    echo "<a href=\"https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=offline&scope=https://picasaweb.google.com/data/&client_id={$client_id}&approval_prompt=force&redirect_uri={$redirect_uri}\""
      ." style=\"\""
      .">Authorize Picasa Access</a>";

  }


?>