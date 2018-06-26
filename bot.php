<?php
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// include composer autoload
require_once 'vendor/autoload.php';
 
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");
 
///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
 
// เชื่อมต่อกับ LINE Messaging API
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('DmeTxctmIRhMZkN9HXYRKN6a4iiSy+bAK86dHqxQ5L6GQZpOSIWfnj3xKDdqkvGDKivRIKFmtS43Xfw8uZfsNN/6kg/qiCZt2yF7Ve0+3YfAvsD4gCA+GqI0Vo9MTZVMsUDenNMta5m6itAVgcFl/AdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4d2466fe67c5096d309d0ac512c245e7']);
 
// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$content = file_get_contents('php://input');
 
// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$events = json_decode($content, true);
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $typeMessage = $events['events'][0]['message']['type'];
    $userMessage = $events['events'][0]['message']['text'];
    switch ($typeMessage){
        case 'text':
            switch ($userMessage) {
                case (strstr($userMessage, "สนใจ") OR strstr($userMessage, "น่าสนใจ")):
                    // กำหนด action 4 ปุ่ม 4 ประเภท
                    $actionBuilder = array(
                        new MessageTemplateActionBuilder(
                            'ไปเที่ยวกัน',// ข้อความแสดงในปุ่ม
                            'เที่ยวไหนดี' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ),
                        new MessageTemplateActionBuilder(
                            'หาไรกินกันไหม',// ข้อความแสดงในปุ่ม
                            'กินไรรรร' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ),
                        new MessageTemplateActionBuilder(
                            'รูปน้องหมา',// ข้อความแสดงในปุ่ม
                            'รูป' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ),
                        new MessageTemplateActionBuilder(
                            'Video',// ข้อความแสดงในปุ่ม
                            'Video' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                        ),  
                    );
                    $imageUrl = 'https://www.img.in.th/images/2457764ef43d1fb1dffdc577a982c2a6.jpg';
                    $replyData = new TemplateMessageBuilder('Button Template',
                        new ButtonTemplateBuilder(
                                'button template builder', // กำหนดหัวเรื่อง
                                'Please select', // กำหนดรายละเอียด
                                $imageUrl, // กำหนด url รุปภาพ
                                $actionBuilder  // กำหนด action object
                        )
                    );              
                break;
                case (strstr($userMessage, "Contact")):
                    $textReplyMessage = "NOSTRA Hotline Service
(66)2 266 9940
 nostrahotline@cdg.co.th";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                    break;
                case (strstr($userMessage, "Video")):
                    $picThumbnail = 'https://www.img.in.th/images/2457764ef43d1fb1dffdc577a982c2a6.th.jpg';
                    $videoUrl = "https://www.youtube.com/watch?v=_GYak5psQXs";                
                    $replyData = new VideoMessageBuilder($videoUrl,$picThumbnail);
                    break;
                case (strstr($userMessage, "รูป")):
                    $replyData = new TemplateMessageBuilder('Image Carousel',
                        new ImageCarouselTemplateBuilder(
                            array(
                                new ImageCarouselColumnTemplateBuilder(
                                    'https://www.img.in.th/images/f3fc9546aad56230bc6df1de4c643830.jpg',
                                ),
                                new ImageCarouselColumnTemplateBuilder(
                                    'https://www.img.in.th/images/6a06f00bd80753d12a18b35432957ee2.jpg',

                                )                                       
                            )
                        )
                    );
                    break;  
                    $picFullSize = 'https://www.img.in.th/images/2457764ef43d1fb1dffdc577a982c2a6.jpg';
                    $picThumbnail = 'https://www.img.in.th/images/2457764ef43d1fb1dffdc577a982c2a6.th.jpg';
                    $replyData = new ImageMessageBuilder($picFullSize,$picThumbnail);
                    break;
                case (strstr($userMessage, "เหงา")):
                    $textReplyMessage = "ไม่คุย!";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                    break;              
                case (strstr($userMessage, "เที่ยว")):
                    $textReplyMessage = "https://map.nostramap.com/NostraMap/?layer/midyear2018,feed/th";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                    break;
                case (strstr($userMessage, "กิน")):
                    $textReplyMessage = "https://map.nostramap.com/NostraMap/?layer/wongnai,feed/th";
                    $replyData = new TextMessageBuilder($textReplyMessage);
                    break;
                case (strstr($userMessage, "ที่ตั้ง")):
                    $placeName = "GlobeTech";
                    $placeAddress = "92/44 ชั้น 16 อาคารสาธรธานี 2 ถนนสาทรเหนือ แขวงสีลม เขตบางรัก กรุงเทพฯ 10500";
                    $latitude = 13.723475;
                    $longitude = 100.530398;
                    $replyData = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);  
                    break;
            }
            break;
        default:
            $textReplyMessage = "Test TEst";
            $replyData = new TextMessageBuilder($textReplyMessage);
            break;  
    }
}
//l ส่วนของคำสั่งตอบกลับข้อความ
$response = $bot->replyMessage($replyToken,$replyData);
?>
