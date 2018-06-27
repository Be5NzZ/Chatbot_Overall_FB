<?php
  // parameters
  $hubVerifyToken = 'tk_nom_sod';
  $accessToken = "EAAbHInA6V4kBANAZCPWtdl020HcGVNlZBZAHSddhfYQmcapPNdIZCmcIZAbH0rQqon8nyuZCWR2eKRieyA3w5Syn9n97pPKyZCgrLXefPPCZB4G43LEW3XDYupu2iyMkfpgVq9pZATRBRxA5CH71e0IKpQSdZA9o6CZAq0ymYizzkwDo2i2nH3ckFTL";
  // check token at setup
  if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
    echo $_REQUEST['hub_challenge'];
    exit;
  }
  // handle bot's anwser
  $input = json_decode(file_get_contents('php://input'), true);
  $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
  $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
  $response = null;
  //set Message
//   if($messageText == "hi") {
//       $answer = "Hello";
//   }
//   //send message to facebook bot
//   $response = [
//       'recipient' => [ 'id' => $senderId ],
//       'message' => [ 'text' => $answer ]
//   ];
  
  if($messageText == "Hello") {  
      $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"Can i help you?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"Contact Info",
              "payload"=>"USER_DEFINED_PAYLOAD"
            ],
            [
              "type"=>"postback",
              "title"=>"Product",
              "payload"=>"USER_DEFINED_PAYLOAD"
            ]
          ]
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
