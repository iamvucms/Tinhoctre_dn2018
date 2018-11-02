<?php

function send_noti($mess_id,$http,$text,$text1='',$text2=''){
$bot_id='5a20f77ce4b07eb9f9866f0f';
$block_id='5ad9893ee4b0f33e60797397';
$chatfuel_token='JYZZLTA7vvNuqpnX2RG5ZXu7gqpWJoypYp9lF4Nru0NAvzrHE5E2sfy752uEjNc6';
$url = "https://api.chatfuel.com/bots/$bot_id/users/$mess_id/send?chatfuel_token=$chatfuel_token&chatfuel_block_id=$block_id";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 40000);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json' 
    ));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,'{"url":"'.$http.'","text":"'.$text.'","text1":"'.$text1.'","text2":"'.$text2.'"}');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
return $result = curl_exec($ch);
curl_close($ch);
	}






