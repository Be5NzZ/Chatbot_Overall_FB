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

  if($messageText == "สอบถาม") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"What do you want to do next?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"Contact",
              "payload"=>"Contact"
            ],
            [
              "type"=>"postback",
              "title"=>"Picture",
              "payload"=> "picture"
            ],
            [
              "type"=>"postback",
              "title"=>"More",
              "payload"=> "more"
            ]
          ]
        ]
        ]];
        $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
  ];
  }

  if($messageText == "more") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"What do you want to do next?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"Video",
              "payload"=>"video"
            ],
            [
              "type"=>"postback",
              "title"=>"File",
              "payload"=> "file"
            ],
            [
              "type"=>"postback",
              "title"=>"More Template",
              "payload"=> "more template"
            ]
          ]
        ]
        ]];
        $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
  ];
  }


if($messageText == "picture") {  
    $answer = ["attachment"=>[
        "type"=>"image",
        "payload"=>[
          "url"=>"https://www.img.in.th/images/2457764ef43d1fb1dffdc577a982c2a6.jpg",
          "is_reusable"=> true
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }

if($messageText == "video") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"open_graph",
          "elementsl"=>[
            "url"=>"https://youtu.be/tt2k8PGm-TI"
          ]
        ]
    ]];
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
    ];
  }

  if($messageText == "file") {  
      $answer = ["attachment"=>[
          "type"=>"file",
          "payload"=>[
            "url"=>"https://drive.google.com/open?id=1DOhq5GQOg9Ff2MNeWP9ghG4LUWco35k3"
          ]
      ]];
      $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => $answer
      ];
    }
    //set Message
  if($messageText == "Start") {
      $answer = "Go Go Go!";
      //send message to facebook bot
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
    ];
  }

    if($messageText == "Contact") {
      $answer = "NOSTRA Hotline Service
(66)2 266 9940
 nostrahotline@cdg.co.th";
      //send message to facebook bot
    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
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
