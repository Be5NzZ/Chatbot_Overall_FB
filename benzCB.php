<?php
// parameters
$hubVerifyToken = 'tk_benztest';
$accessToken = "EAAeaMmUlJQ0BAD55ZArtnWpfE8ZAMpmLLvLNeCbdjqLm28xzmLE4y7XXhmvh5zvSRbQATtiS9MaPNIQqJap9xeZBhOqvqSkupGZBMXlWqXV1XKuyW2y2DrZCjksWUl8BzZBAHvF9H0XcZAbdIxysVECyhQfwrdxdnLXZCLwfvQtInwZDZD";
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
