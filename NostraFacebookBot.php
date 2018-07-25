<?php
  // parameters
  $hubVerifyToken = 'nostra_bot';
  $accessToken = "EAAfPL4euke0BAJfDmxZAsOI4FqcMWhZA67KDkQ9ftuel1FrsoeeLEJNQn7IZBw8JEuDWvFS0cyZBIvZBlGQZBZCzfnWulvGkTDB3uDOw3FhSDSzDQODmQwZCl0OK1vRzh9hQN36IE0MZA7v6lFIzNIAkZATG5Sy2epqmyKJng1lndrAn6UvUFGYJ9k";
  
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
  if($messageText == "hi" OR "สวัสดี") {
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"Can i help u?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"Contact Information",
              "payload"=>"Contact Information"
            ],
            [
              "type"=>"postback",
              "title"=>"Application Feedback",
              "payload"=> "Application Feedback"
            ],
            [
              "type"=>"web_url",
              "url"=>"https://map.nostramap.com/",
              "title"=>"Search on NOSTRA Map"
            ]
          ]
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }

  if($messageText == "help" OR "menu" OR "เมนู") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"Can i help u?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"Contact Information",
              "payload"=>"Contact Information"
            ],
            [
              "type"=>"postback",
              "title"=>"Application Feedback",
              "payload"=> "Application Feedback"
            ],
            [
              "type"=>"web_url",
              "url"=>"https://map.nostramap.com/",
              "title"=>"Search on NOSTRA Map"
            ]
          ]
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }

//   if($messageText == "ข้อมูลติดต่อ (Contact Information)") {
//       $answer = "NOSTRA Hotline Service
// Tel : (66)2 266 9940
// E-mail : nostrahotline@cdg.co.th";
//       //send message to facebook bot
//       $response = [
//         'recipient' => [ 'id' => $senderId ],
//         'message' => [ 'text' => $answer ]
//       ];
//   }

  if(substr_count($messageText, 'Contact')) {
      $answer = "NOSTRA Hotline Service
Tel : (66)2 266 9940
E-mail : nostrahotline@cdg.co.th";
      //send message to facebook bot
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
      ];
  }

  if(substr_count($messageText, 'Feedback')) {
      $answer = "ขอบคุณมากครับ รบกวนแสดงความคิดเห็นของท่านได้เลยครับ :)";
      //send message to facebook bot
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
      ];
  }

//   if(substr_count($messageText, 'Search')) {
//       $answer = "https://map.nostramap.com/";
//       //send message to facebook bot
//       $response = [
//         'recipient' => [ 'id' => $senderId ],
//         'message' => [ 'text' => $answer ]
//       ];
//   }

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
