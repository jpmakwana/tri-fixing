<?php
session_start();
date_default_timezone_set("Asia/Kolkata");

class curlFunctions
{
  private $baseurl = 'https://maps.googleapis.com/maps/api/place/textsearch/json?';

  public function curl($url, $method = "GET", $payload = null, $header_content = null)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->baseurl . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION,  CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }
  public function session($res_headers)
  {
    $headers_indexed_array = explode("\r\n", $res_headers);
    foreach ($headers_indexed_array as $header) {

      $x_token = "x-token";
      if (substr($header, 0, strlen($x_token)) == $x_token) {
        // $x_token_value = str_replace($x_token.": ","",$header);
        //echo "x-token: ".$x_token_value;
        $x_token_value = $header;
      }
      $x_ref_token = "x-refresh-token";
      if (substr($header, 0, strlen($x_ref_token)) == $x_ref_token) {
        // $x_ref_token_value = str_replace($x_ref_token.": ","",$header);
        //  echo "x-refresh-token: ".$x_ref_token_value;
        $x_ref_token_value = $header;
      }
    }
    $_SESSION['x-token'] = $x_token_value;
    $_SESSION['x-refresh-token'] = $x_ref_token_value;
  }
}
