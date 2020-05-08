<?php
 
 $ch = curl_init("https://fcm.googleapis.com/fcm/send");
 //The device token.
 $token = "dvIE84qb3aY:APA91bGj8Hb25IHrLBN0-lhJr-DP7iM7JqYu9rKqOKEA2lb6f-R-EAe8mmK_QzWAyMXYQeX-hxnitkosUYJFju6ZG9hUu__wAnpV-9esXf7S344WmERF4OKghlJGF8kOrZyPkZNQUFG-"; //token here
//  $token = "edLhLsyAJiY:APA91bESt0PuBhNh0_dE5o0ziPTLR_13oNJQzxK6bQ-QEH3M32aLrVWohYozQKgPISnu2cN5owayGC8MQpC-_sszqVp0UsWwdAPvIT5Q4Mm8Yv8554vuxtOoS6Eeq7dcvJOVhpN0FA0v"; //token here

// $token = "/topics/all";
//Title of the Notification.
 $title = "Zakario";
 //Body of the Notification.
 $body = "Manusia Paling Tampan di Dunia";
 //Creating the notification array.
 $notification = array('title' =>$title , 'text' => $body,'sound' => 'default');
 //This array contains, the token and the notification. The 'to' attribute stores the token.
//  $arrayToSend = array('to' => '/topics/TopicToListen', 'notification' => $notification,'priority'=>'high');
$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
 //Generating JSON encoded string form the above array.
 $json = json_encode($arrayToSend);
 //Setup headers:
 $headers = array();
 $headers[] = 'Content-Type: application/json';
//  $headers[] = 'Authorization: key= AAAAJhjC6I8:APA91bGLQmQVRmpKnM6xkignvc2bLoLSeaxQBmBqefN27bWB5bnCyAnQae4KoPw_4RHAFL2vVWkiePpjR8RMAge9Ii2d1HzNVB8mTRv53Q64nbjNvjO550Kvc5COOXQJm9fV5l8rJMWo';
 $headers[] = 'Authorization: key= AAAAHUoc7b4:APA91bHaVS11p_e2QZbfFC1RQIJed1BkOOybFhkv12BdvCUhHtB8bZkE_D14qKeoKsVkZ0IOcPNYfCF1afqRJ7yDsuEvfNdQPf-2-putkdGWfri0PdYsnQApU0qcx6xhuDPideXQl1Fh'; // key here
  // key here
 //Setup curl, add headers and post parameters.
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
 curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
 curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
 //Send the request
 $response = curl_exec($ch);
 //Close request
 curl_close($ch);
 return $response;
 
?>