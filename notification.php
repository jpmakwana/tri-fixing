<?php
	
class Notification
{
    function send($token,$msg,$status=null)
    {
        $arrNotification= array();          
        $arrNotification["title"] = "inDetail";
        $arrNotification["type"] = $status;
        // $arrNotification["status"] = $status;
        $arrNotification["body"] =$msg;
        $arrNotification["sound"] = "default";
    
        $url = 'https://fcm.googleapis.com/fcm/send';
     
        $fields = array(
            'to' => $token,
            'notification' => $arrNotification,
            'data' => $arrNotification
        );
        
        
      // Firebase API Key
      $headers = array('Authorization:key=AAAAUvNbhKY:APA91bGmWFcigSoHE4hT3bHLrG6ESc4JKcpEegoi758lGGotlMzmxY9HEYw_QO34U9yuxcySiiezjV9voXcOi-CTB1VtUiR7U8CDyVm8rmurOsQsuK5y9ULRbbwGo3sfJ-YO_tBT8K3P','Content-Type:application/json');
     // Open connection
      $ch = curl_init();
      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      if ($result === FALSE) {
          die('Curl failed: ' . curl_error($ch));
      }
      curl_close($ch);
      
   }
}
