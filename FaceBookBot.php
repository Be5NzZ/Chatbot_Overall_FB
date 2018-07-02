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
  if($messageText == "hi" OR $messageText == "Hi") {
      $answer = "Hello";
  }

  //send message to facebook bot
   $response = [
     'recipient' => [ 'id' => $senderId ],
     'message' => [ 'text' => $answer ]
   ];
   
    //quick_reply
    $answer = ["timestamp"=>1458692752478,
               "message"=> [
                 "mid"=> "mid.1457764197618:41d102a3e1ae206a38",
                 "text"=> "hello, world!",
                 "quick_reply": [
                   "payload": "USER_DEFINED_PAYLOAD"
                 ]
               ]
      ]
//   if($messageText == "more") {  
//     $answer = ["attachment"=>[
//         "type"=>"template",
//         "payload"=>[
//           "template_type"=>"button",
//           "text"=>"What do you want to do next?",
//           "buttons"=>[
//             [
//               "type"=>"web_url",
//               "url"=>"https://petersapparel.parseapp.com",
//               "title"=>"Show Website"
//             ],
//             [
//               "type"=>"postback",
//               "title"=>"Start Chatting",
//               "payload"=>"USER_DEFINED_PAYLOAD"
//             ]
//           ]
//         ]
//     ]];
//     $response = [
//       'recipient' => [ 'id' => $senderId ],
//       'message' => $answer
//     ];
//   }

  $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  if(!empty($input)){
  $result = curl_exec($ch);
  }

  curl_close($ch);
?>
