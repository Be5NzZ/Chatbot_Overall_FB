<?php
$access_token = "EAAeaMmUlJQ0BAD55ZArtnWpfE8ZAMpmLLvLNeCbdjqLm28xzmLE4y7XXhmvh5zvSRbQATtiS9MaPNIQqJap9xeZBhOqvqSkupGZBMXlWqXV1XKuyW2y2DrZCjksWUl8BzZBAHvF9H0XcZAbdIxysVECyhQfwrdxdnLXZCLwfvQtInwZDZD";
$verify_token = "btoken";
$hub_verify_token = null;
if(isset($_REQUEST['hub_challenge'])) {
 $challenge = $_REQUEST['hub_challenge'];
 $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === $verify_token) {
 echo $challenge;
}
$input = json_decode(file_get_contents('php://input'), true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$message_to_reply = '';
/**
 * Some Basic rules to validate incoming messages
 */
 
//$api_key="<mLAP API KEY>";
$url = 'http://localhost:4673/WebService1.asmx/GetMessage';
$json = file_get_contents('http://localhost:4673/WebService1.asmx/GetMessage?mes='.$message);
$data = json_decode($json);
$isData=sizeof($data);

if($isData >0){
  foreach($data as $rec){
   $message_to_reply = $rec->answer;
  }
}else{
  $message_to_reply = 'ERROR';
}

//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
//Encode the array into JSON.
$jsonDataEncoded = $jsonData;
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
?>
