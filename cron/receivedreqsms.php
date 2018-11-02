<?php
error_reporting(0);
if($_GET['action']=='getsmsbody' && $_GET['mess_id']){
	include('../admincc.php');
	$a = new mys();
	$b= $a->query('select activies_today,name from users_pw where mess_id="'.trim($_GET['mess_id']).'"');
	$array = json_decode(urldecode($b[0][activies_today]),true);
	$messages='{
 "messages": [{"text": "Hello '.$b[0][name].'"},';
	for($i=0;$i<count($array);$i++){
		if($i==count($array)-1){
			$messages.='{"text": "'.$array[$i][time].': '.$array[$i][action].'"}';
			break;
		}
		$messages.='{"text": "'.$array[$i][time].': '.$array[$i][action].'"},';
	}
	$messages .= ']}';
	echo $messages;
}
?>