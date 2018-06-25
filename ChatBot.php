<?php
    $accessToken = "Lq8/yqdrOY4yfgWeUAP2rFojWCVox5J2FwhyxRYbQ6quFzDcc8chiA/hdHferUNPKivRIKFmtS43Xfw8uZfsNN/6kg/qiCZt2yF7Ve0+3Yeo+99ke6oEd1Cb5/GcwNDDnfKTIptA1wGdBU+8bmZIPwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    
    $message = $arrayJson['events'][0]['message']['text'];
    switch($message) {
        case "Hi":    
        case "ดีจ้า":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "ไปเที่ยวกัน":
        case "เที่ยวไหนดี":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "https://map.nostramap.com/NostraMap/?layer/midyear2018,feed/th";
            $arrayPostData['messages'][1]['type'] = "text";
            $arrayPostData['messages'][1]['text'] = "https://map.nostramap.com/NostraMap/?layer/sea2018,feed/th";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "หิว":
        case "กินข้าวกัน":
        case "กินไรดี":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "https://map.nostramap.com/NostraMap/?layer/wongnai,feed/th";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "ดูหนังกัน":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "https://www.sfcinemacity.com/showtime/cinema/9924";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "คิดถึง":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "คิดถึงเหมือนกัน";
            $arrayPostData['messages'][1]['type'] = "sticker";
            $arrayPostData['messages'][1]['packageId'] = "1";
            $arrayPostData['messages'][1]['stickerId'] = "2";
            replyMsg($arrayHeader,$arrayPostData);
            break;
        case "test":
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "template";
            $arrayPostData['messages'][0]['altText'] = "This Template";
            $arrayPostData['messages'][0]['template'] = array("type"=> "buttons",
                                                              "thumbnailImageUrl"=> "https://example.com/bot/images/image.jpg",
                                                              "imageAspectRatio"=> "rectangle",
                                                              "imageSize"=> "cover",
                                                              "imageBackgroundColor"=> "#FFFFFF",
                                                              "title"=> "Menu",
                                                              "text"=> "Please select",
                                                              "defaultAction"=> {
                                                                  "type"=> "uri",
                                                                  "label"=> "View detail",
                                                                    "uri"=> "http://example.com/page/123");
            replyMsg($arrayHeader,$arrayPostData);
            break;
        default:
            $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "พิมพ์ให้ถูกซิ!!!";
            replyMsg($arrayHeader,$arrayPostData);
            break;
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>