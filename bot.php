<?php

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('DmeTxctmIRhMZkN9HXYRKN6a4iiSy+bAK86dHqxQ5L6GQZpOSIWfnj3xKDdqkvGDKivRIKFmtS43Xfw8uZfsNN/6kg/qiCZt2yF7Ve0+3YfAvsD4gCA+GqI0Vo9MTZVMsUDenNMta5m6itAVgcFl/AdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '4d2466fe67c5096d309d0ac512c245e7']);


$response = $bot->replyText('<reply token>', 'hello!');
?>