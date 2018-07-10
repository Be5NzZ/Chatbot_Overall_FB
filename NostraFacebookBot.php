<?php
  // parameters
  $hubVerifyToken = 'nostra_bot';
  $accessToken = "EAAYju4X7cmsBADyejANb3T2ifUVdY6On8h9mzK885iGKdC4ZBt3RjCOinl5s1alkoutvrlsd5JJDYrcQjeKrjGIxZB3wM0RYZCUDyE7DZA5hL9K5OcNecsQRZA2J8MEFTjvMAIyrLkpaN97Px7h7DYcEFYHrCKZAqIdwduCfsxxVe0yTVtZAXQJ";
  
  // check token at setup
  if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
    echo $_REQUEST['hub_challenge'];
    exit;
  }
  // handle bot's anwser
  $input = json_decode(file_get_contents('php://input'), true);
  $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
  $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
  $payload = $input['entry'][0]['messaging'][0]['postback']['payload'];
  
  if (!empty($payload)) {
    $messageText = $payload;
  }
  $response = null;

  //set Message
  if($messageText == "hi") {
      $answer = "Hello";
      //send message to facebook bot
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
    ];
  }

  if($messageText == "ข้อมูลติดต่อ (Contact Information)") {
      $answer = "NOSTRA Hotline Service
Tel : (66)2 266 9940
E-mail : nostrahotline@cdg.co.th";
      //send message to facebook bot
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
      ];
  }

  if($messageText == "แสดงความคิดเห็นเกี่ยวกับแอปพลิเคชัน (Application Feedback)") {
      $answer = "ขอบคุณมากครับ รบกวนแสดงความคิดเห็นของท่านได้เลยครับ :)";
      //send message to facebook bot
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
      ];
  }

  if($messageText == "ค้นหาสถานที่ (Search on NOSTRA Map)") {
      $answer = "https://map.nostramap.com/";
      //send message to facebook bot
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
      ];
  }

  //Picture
  if($messageText == "vid") {  
    $answer = ["attachment"=>[
        "type"=>"video",
        "payload"=>[
          "url"=>"https://www.facebook.com/NOSTRAMap/videos/1098390336937977/",
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }

  $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  if(!empty($input)){
  $result = curl_exec($ch);
  }
  curl_close($ch);
?>
