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

   if($messageText == "more template") {  
    $answer = ["attachment"=>[
        "type"=>"template",
        "payload"=>[
          "template_type"=>"button",
          "text"=>"What do you want to do next?",
          "buttons"=>[
            [
              "type"=>"postback",
              "title"=>"Generic Template",
              "payload"=>"generic"
            ],
            [
              "type"=>"postback",
              "title"=>"List Template",
              "payload"=> "list"
            ],
            [
              "type"=>"postback",
              "title"=>"Reciept Template",
              "payload"=> "reciept"
            ]
          ]
        ]
        ]];
        $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => $answer
  ];
  }

  //Generic Template
  if($messageText == "generic"){
     $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"generic",
        "elements"=>[
          [
            "title"=>"Welcome to NOSTRA Map",
            "item_url"=>"http://www.nostramap.com/about/company/",
            "image_url"=>"https://www.img.in.th/images/6a06f00bd80753d12a18b35432957ee2.jpg",
            "subtitle"=>"NOSTRA MAP THE MAP YOU CAN TRUST.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://www.nostramap.com/",
                "title"=>"View Website"
              ]             
            ]
          ]
        ]
      ]
    ]];
     $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer 
];}

//List Template
if($messageText == "list"){
  $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"list",
        "elements"=>[
          [
             "title"=> "NOSTRA",
                    "image_url"=> "https://www.img.in.th/images/6a06f00bd80753d12a18b35432957ee2.jpg",
                    "subtitle"=> "See all our Products",
                    "default_action"=> [
                        "type"=> "web_url",
                        "url"=> "http://www.nostramap.com/business/",                       
                        "webview_height_ratio"=> "tall",
                        // "messenger_extensions"=> true,
                        // "fallback_url"=> "https://peterssendreceiveapp.ngrok.io/"
                    ],
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://www.nostramap.com/business/",
                "title"=>"View Website"
              ],
            ]
          ],
            [
            "title"=>"Welcome to Peter\'s Hats",
            "item_url"=>"http://www.nostramap.com/business/",
            "image_url"=>"https://www.img.in.th/images/6a06f00bd80753d12a18b35432957ee2.jpg",
            "subtitle"=>"NOSTRA MAP THE MAP YOU CAN TRUST.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://www.nostramap.com/business/",
                "title"=>"View Website"
              ],
            ]
          ],
            [
            "title"=>"Welcome to Peter\'s Hats",
            "item_url"=>"http://www.nostramap.com/business/",
            "image_url"=>"https://www.img.in.th/images/6a06f00bd80753d12a18b35432957ee2.jpg",
            "subtitle"=>"NOSTRA MAP THE MAP YOU CAN TRUST.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://www.nostramap.com/business/",
                "title"=>"View Website"
              ],
            ]
          ]
        ]
      ]
    ]];
  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => $answer
];}

//Picture
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

  if ($accessToken) {
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
