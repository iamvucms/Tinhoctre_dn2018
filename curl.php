<?php
error_reporting(0);
function cURL_html($url,$data=false){
	    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Accept:application/json, text/javascript, */*; q=0.01";
    $head[] = "Content-Type:application/x-www-form-urlencoded;application/json;charset=UTF-8";
    $head[] = "X-Requested-With:XMLHttpRequest";
    $head[] = "Referer:https://www.leetliker.com/auto-liker.html";
    $head[] = "Accept-Language:en-US,en;q=0.8";
    $head[] = "Origin:https://www.leetliker.com";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_ENCODING, '');    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    if($data){
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
    }
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    $page = curl_exec($ch);
    curl_close($ch);
	return $page;
}
$a = cURL_html('https://www.leetliker.net/ajax/auth/session.json','session_token={"session_key":"5.ghkmAJwAIpoh0w.1524644605.5-100016709977275","uid":100016709977275,"secret":"0ec50a9b3ec9d8728bb536de278bd32d","access_token":"EAAAAUaZA8jlABANCD9r2O4bkQKbFQsJxOY1TMvCRBK3ZAjfTxlK1V4upslnKOzXLQwRVPe7o2agctfqa2RDo98ZCsEIb7lEoeSc1fwKrrbuYT82hPegAvTpdgAvgzlaYSb2qcYZCKqOhFUcdEUoND49Tnk1nm1wRMdPY4ftjSdZArsTZAVLCQr","machine_id":"_TrgWr2Dg_TEFtwwxqFa6TW0","session_cookies":[{"name":"c_user","value":"100016709977275","expires":"Thu, 25 Apr 2019 08:23:25 GMT","expires_timestamp":1556180605,"domain":".facebook.com","path":"\/","secure":true},{"name":"xs","value":"5:ghkmAJwAIpoh0w:2:1524644605:15176:6177","expires":"Thu, 25 Apr 2019 08:23:25 GMT","expires_timestamp":1556180605,"domain":".facebook.com","path":"\/","secure":true,"httponly":true},{"name":"fr","value":"0hPoQeAREsmjKqnqj.AWU-XSNi1L933bkG2l9gW8UT3rA.Ba3xp7.uk.Frg.0.0.Ba4Dr9.AWUAMnM4","expires":"Thu, 25 Apr 2019 08:23:25 GMT","expires_timestamp":1556180605,"domain":".facebook.com","path":"\/","secure":true,"httponly":true},{"name":"datr","value":"_TrgWr2Dg_TEFtwwxqFa6TW0","expires":"Fri, 24 Apr 2020 08:23:25 GMT","expires_timestamp":1587716605,"domain":".facebook.com","path":"\/","secure":true,"httponly":true}],"confirmed":true,"identifier":"devv.systems","user_storage_key":"df196e5d9ca7d606e9c1578bac2609ddda053d7c286c69ca7f4bc74a9a8a9809"}');
$b = json_decode(cURL_html('https://www.leetliker.net/api/posts/',false),true);
$id = $b[posts][0][id];
echo $b[posts][0][id].'  '.$b[posts][0][text];
echo '</br>';
echo $c = cURL_html('https://www.leetliker.net/ajax/send_likes/','limit=250&post_id='.$id);

