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
$response = null;

//set Message
if($messageText == "hi") {
    $answer = "Hello! What can I do for you?";
}

if($messageText == "hello") {
    $answer = "Hello! What can I do for you?";
}

if(substr_count($messageText, 'สวัสดี')) {
    $answer = "สวัสดีครับ ไม่ทราบว่ามีอะไรให้ช่วยครับ? :)";
}

if($messageText == "ข้อมูลติดต่อ") {
    $answer = "NOSTRA Hotline Service
Tel : (66)2 266 9940
E-mail : nostrahotline@cdg.co.th
Website : http://www.nostramap.com/";
}

if($messageText == "แสดงคำติชมแอปพลิเคชัน") {
    $answer = "ขอบคุณมากครับ รบกวนแสดงความคิดเห็นของท่านได้เลยครับ :)";
}

if($messageText == "ขอความช่วยเหลือจากฝ่ายบริการลูกค้า") {
    $answer = "แจ้งปัญหาหรือสอบถามเพิ่มเติมได้เลยครับ :)";
}

//send message to facebook bot
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];

$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);
?>
