<?php
// parameters
$hubVerifyToken = 'tk_benztest';
$accessToken = "EAAeaMmUlJQ0BADgDkUU2Aj5wzlnGCyl2jqPy1q5vSTrGavypUZCwUspvVDjwp3OowEvoZAboMuoZAcKUondJNwD9b8KYWTt1fB2fSBrPfKMjRCZBMmuuhdgditcQUOQzKG2IHVbrR0zGDYnLRbwOJPb1gDWDYEayEWX1Cn6BEAZDZD";
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
  if($messageText == "menu") {  
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
              "type"=>"postback",
              "title"=>"Contact Admin",
              "payload"=> "Contact Admin"
            ]
          ]
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }
  if($messageText == "嗔官") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"琳托涿闼楠枨陇醚� ?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"㈤土倥翟吹柰",
              "payload"=>"㈤土倥翟吹柰"
            ],
            [
              "type"=>"postback",
              "title"=>"崾揣び翟嵬痪旁啶�",
              "payload"=> "崾揣び翟嵬痪旁啶�"
            ],
            [
              "type"=>"postback",
              "title"=>"⑼で伊锹嗨抛通摇借衣好浴颐刨·橐",
              "payload"=> "⑼で伊锹嗨抛通摇借衣好浴颐刨·橐"
            ]
          ]
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }
  if($messageText == "help") {  
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
              "type"=>"postback",
              "title"=>"Contact Admin",
              "payload"=> "Contact Admin"
            ]
          ]
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }
//set Message
if($messageText == "hi") {
    $answer = "Hello! What can I do for you?";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "hello") {
    $answer = "Hello! What can I do for you?";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if(substr_count($messageText, '是咽凑')) {
    $answer = "是咽凑っ押 淞璺靡呵枰琳托涿闼楠枨陇醚�? :)";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "㈤土倥翟吹柰") {
    $answer = "NOSTRA Hotline Service
Tel : (66)2 266 9940
E-mail : nostrahotline@cdg.co.th
Website : http://www.nostramap.com/";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "Contact Information") {
    $answer = "NOSTRA Hotline Service
Tel : (66)2 266 9940
E-mail : nostrahotline@cdg.co.th
Website : http://www.nostramap.com/";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "崾揣び翟嵬痪旁啶�") {
    $answer = "⑼氦爻烈·醚� 煤∏贯蚀Г且沥源嗨绻⑼Х枰逛撮嗯陇醚� :)";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "Application Feedback") {
    $answer = "Please comment your feedback below :)";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "⑼で伊锹嗨抛通摇借衣好浴颐刨·橐") {
    $answer = "是咽凑っ押 琳托涿闼獒痛猎躬枨锣伺淄洪咬っ押 :)";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "Contact Admin") {
    $answer = "Hello! What can i do for you ? :)";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
//send message to facebook bot
// $response = [
//     'recipient' => [ 'id' => $senderId ],
//     'message' => [ 'text' => $answer ]
// ];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);
?>
