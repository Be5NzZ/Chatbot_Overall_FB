<?php
// parameters
$hubVerifyToken = 'tk_nostra';
$accessToken = "EAAfPL4euke0BAPPNLSnA3jGEooKa8gZBqOG7E0pZB62ZA3ZBRcRVf4ZCZCVonZCHZBdu53QS413iy2cPDle6l8zrPPjDxcKW7cj9Mkmb7XDfQ8bF7Cb9AGQk8FwwhqAILZC6xue5JaBjuHiiWPv26EwUZCWO2TqJdjuBzdTozDGmqxHwZDZD";
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
  if($messageText == "����") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"�����������¤�Ѻ ?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"�����ŵԴ���",
              "payload"=>"�����ŵԴ���"
            ],
            [
              "type"=>"postback",
              "title"=>"�ʴ��ӵԪ��ͻ���पѹ",
              "payload"=> "�ʴ��ӵԪ��ͻ���पѹ"
            ],
            [
              "type"=>"postback",
              "title"=>"�ͤ�����������ͨҡ���º�ԡ���١���",
              "payload"=> "�ͤ�����������ͨҡ���º�ԡ���١���"
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
if(substr_count($messageText, '���ʴ�')) {
    $answer = "���ʴդ�Ѻ ����Һ��������������¤�Ѻ? :)";
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if($messageText == "�����ŵԴ���") {
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
if($messageText == "�ʴ��ӵԪ��ͻ���पѹ") {
    $answer = "�ͺ�س�ҡ��Ѻ ú�ǹ�ʴ������Դ��繢ͧ��ҹ����¤�Ѻ :)";
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
if($messageText == "�ͤ�����������ͨҡ���º�ԡ���١���") {
    $answer = "���ʴդ�Ѻ ����������ʹ�Թ��������ͺ�ҧ��Ѻ :)";
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