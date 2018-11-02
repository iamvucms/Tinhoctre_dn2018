<?php
error_reporting(0);
ob_start();
include('./controller.php');
$a = new mys();



















//recived mess_id
if($_GET[act]=='upmess'){
    extract($_GET);
    
    $check = $a->query("select mess_id,id_user from users where id_user='".trim($id_user)."'");
    
    if($check[0][id_user]==''){
        echo '{
 "messages": [
   {"text": "Vui lòng kiểm tra lại chúng tôi không tìm được id tương ứng.Xin cảm ơn!"}
}';
    }elseif($check[0][mess_id]==''){
        $a->query("update users set mess_id='".trim($mess_id)."' where id_user='".$id_user."'");
        echo '{
 "messages": [
   {"text": "Bạn đã cập nhận thành công địa chỉ nhận thông báo! Xin cảm ơn"}
}';
    }  
    
}
if($_GET[act]=='checkmess' ){
    extract($_GET);
    $check = $a->query("select mess_id from users where id_user='".trim($id_user)."'");
    if($check[0][mess_id]!==''){
        echo 'OK';
    }
}
if($_POST[act]=='postbai'){
    rerand:$idbaiviet = rand(100000,999999);
    $check = $a->query("select idbaiviet from baiviet where idbaiviet='".$idbaiviet."'");
    if(count($check)>=1){
        goto rerand;
    }
    $content = $_POST['content'];
    $mail = $_POST[is_mail];
    $mess = $_POST[is_mess];
    if($mail!=='on') $mail = 'off';
    if($mess !=='on') $mess = 'off';
    if($_FILES[pic]){
        $resumeFile = $_FILES['pic']['tmp_name'];
	$fileSize = $_FILES['pic']['size'];
	$fileType = $_FILES['pic']['type'];
	$fileError = $_FILES['pic']['error'];
	

	 $fileSavePath = 'images/'.$idbaiviet.'.jpg';	
	if (is_uploaded_file($resumeFile))
	{
		if (!move_uploaded_file($resumeFile,$fileSavePath))
		{
			
			
		}
	}
	$a->query("INSERT INTO baiviet (idbaiviet,is_mess,is_mail,content,image,tacgia,time,lop,id_poster) VALUES ('$idbaiviet','$mess','$mail','".nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'))."','$fileSavePath','".$_POST[tacgia]."',now(),'".$_POST[lop]."','".$_POST[id_user]."')
");
    ignore_user_abort(1);
set_time_limit(0);
header('Location: ./home.php?idscroll='.$idbaiviet.'');
flush();

    if($mess!=='off'){
        include('./cron/send_mess.php');
        $lop = $_POST[lop];
        $mess_ar = $a->query("select mess_id from users where lop='$lop' and (type='1' or type='1*' or type='4')");
        $token = $a->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
        for($i=0;$i<count($mess_ar);$i++){
            $mess_id=$mess_ar[$i][mess_id];
            send_mess($token,$mess_id,'https://dev-v.systems/home.php?idscroll='.$idbaiviet,"Thông báo: Lớp:". explode('_',$lop)[0].'/'.explode('_',$lop)[1]." có một bài viết mới từ ".$_POST[tacgia]."","Nội dung: $content",'Cảm ơn!');
        }
    }
    if($mail!=='off'){
        include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
         $lop = $_POST[lop];
         $maillist = $a->query("select email,name from users where lop='$lop' and (type='1' or type='1*' or type='4')");
        
         for($i =0;$i<count($maillist);$i++){
            $email = $maillist[$i][email];
             $name = $maillist[$i][name];

            sendmail($mail,$email,$name,$mFrom,$mPass,"Thông báo: Lớp:". explode('_',$lop)[0].'/'.explode('_',$lop)[1]." có một bài viết mới từ ".$_POST[tacgia]."","Nội dung: $content",'https://dev-v.systems/home.php?idscroll='.$idbaiviet);
         }


    }
//phia duoi eo chay -_-
       	
	makeFileSafe($fileSavePath);
        
    }
    
    
    ///
    

        function makeFileSafe($filePath)
        {
            $fP = @fopen($filePath,'r+');
            if (!$fP)
            {
                return "Could not read file";
            }
            $contents = fread($fP,filesize($filePath));
            $contents = strip_tags($contents);
            rewind($fP);
            fwrite($fP,$contents);
            fclose($fP);
            return $contents;
        }
}
if($_GET[act]=='delete_post'){
    $idpost = $_GET[idbaiviet];
    $a->query("delete from baiviet where idbaiviet='".$idpost."'");
    unlink('images/'.$idpost.'.jpg');
        echo 'OK';
    $ids = $a->query("select idbaiviet from baiviet order by id ASC");
    for($i=1;$i<=count($ids);$i++){
        
        $a->query("update baiviet set id=$i where idbaiviet='".$ids[$i-1][idbaiviet]."'");
    }
    $a->query("ALTER TABLE baiviet AUTO_INCREMENT = 1");
    
    
}
if($_GET[act]=='comment_post'){
    extract($_GET);
    $old = $a->query("select binhluan from baiviet where idbaiviet='".$idbaiviet."' ");
    $old = json_decode(urldecode($old[0][binhluan]),true);
   
    $old[]= ['who'=>$who,'nd'=>$nd];
    $old= urlencode(json_encode($old));
    $a->query("update baiviet set binhluan='".$old."' where idbaiviet='".$idbaiviet."'");
    //send
    echo 'OK';
    include('./cron/send_mess.php');
    $id_user = $a->query("select id_poster from baiviet where idbaiviet='$idbaiviet'")[0][id_poster];
    $get = $a->query("select mess_id,lop,email,name from users where id_user='$id_user'");
    $mess_id = $get[0][mess_id];
    $lop = $get[0][lop];
    $token = $a->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
    send_mess($token,$mess_id,'https://dev-v.systems/home.php?idscroll='.$idbaiviet,"Thông báo: $who đã bình luận về bài viết của bạn trong nhóm lớp ". explode('_',$lop)[0].'/'.explode('_',$lop)[1]."","Nội dung: $nd",'Xin cảm ơn!');
     include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$get[0][email],$get[0][name],$mFrom,$mPass,"Thông báo: $who đã bình luận về bài viết của bạn trong nhóm lớp ". explode('_',$lop)[0].'/'.explode('_',$lop)[1]."","Nội dung: $nd",'https://dev-v.systems/home.php?idscroll='.$idbaiviet);
    
}
if($_POST[act]=='update_info'){
    extract($_POST);
    if($tintuc_truong=='') $tintuc_truong = 'off';
    if($tintuc_lop=='') $tintuc_lop='off';
    if(count($a->query("select email from users where email='$email'"))<1 ||$email==$email_cu){
    $a->query("update users set email='$email',password='$password',tintuc_truong='$tintuc_truong',tintuc_lop='$tintuc_lop' where email='$email_cu'");
    header("location: ./home.php?page=setting&error=0");
        exit();
    }elseif($email!==$email_cu){
        header("location: ./home.php?page=setting&error=email_used");
    }else{
        header("location: ./home.php?page=setting&error=0");
    }
}
if($_POST[act]=='update_hs'){
    extract($_POST);
    if(count($a->query("select email from users where email='$email'"))>=1 && $email !==$email_cu || count($a->query("select sdt from users where sdt='$sdt'"))>=1 && $sdt!==$sdt_cu){
        header("location: ./home.php?page=member&failed=used");
        exit();
    }
    $a->query("update users set name='$name',sdt='$sdt',email='$email' where id_user='$id_user'");
    header("location: ./home.php?page=member&success=$id_user");
}
if($_GET[act]=='delete_member'){
    extract($_GET);
    $a->query("delete from users where id_user='$id_user'");
    $sort = $a->query("select id_user from users");
    for($i=1;$i<count($sort)+1;$i++){
        $a->query("update users set id=$i where id_user='".$sort[$i-1][id_user]."'");
    }
    $a->query("ALTER TABLE users AUTO_INCREMENT = 1");
    echo 'OK';
}
if($_POST[act]=='addnewmem'){
    extract($_POST);
    if($type!=='2') $phof='';
    if(count($a->query("select email from users where email='$email'"))>0){
                if(count($a->query("select sdt from users where sdt='$sdt'"))>0){
                header("location: ./home.php?page=member&name=$name");
                exit();
            }else{
                    header("location: ./home.php?page=member&name=$name&email=$email");
                exit();
                }
        
    }
   elseif(count($a->query("select phof from users where phof='$phof' and type='2'"))>0){
        header("location: ./home.php?page=member&name=$name&emai=$email&sdt=$sdt");
    }else{
        rerandiduser:$id_user = '022'.rand(100000,999999);
        if(count($a->query("select id_user from users where id_user='$id_user'"))>0){
            goto rerandiduser;
        }
        $password = rand(100000000000,9999999999999);
        
        $a->query("insert into users (id_user,type,name,password,sdt,lop,phof,email) values ('$id_user','$tucach','$name','$password','$sdt','$lop','$phof','$email')");
        header("location: ./home.php?page=member&success=$id_user");
    }
    
  }

if($_POST[act]=='edit_diem'){
    extract($_POST);
    $b = new mys();
    $b->query("update bangdiemtonghop set toan='$t',li='$l',hoa='$h',van='$v',sinh='$si',tin='$ti',su='$s',dia='$d',cd='$cd',cn='$cn',gdqp='$qp',td='$td',diemtb='$tbcm',hanhkiem='$hanhkiem',xeploai='$xl' where id_user='$id_user' and hk='$hk'");
   header("location: ./home.php?page=search_point&success=$id_user");
    
   
}
if($_POST[act]=='add_diem'){
    extract($_POST);
    $b = new mys();
    if(count($b->query("select id_user from bangdiemtonghop where id_user='$id_user'"))>=1){
        header("location: ./home.php?page=search_point&error=1");
        exit();
    }
    $b->query("insert into bangdiemtonghop (name,id_user,toan,li,hoa,van,anh,sinh,tin,su,dia,cd,cn,gdqp,td,diemtb,hanhkiem,xeploai,hk,lop) values('$name','$id_user','$t','$l','$h','$v','$a','$si','$ti','$s','$d','$cd','$cn','$qp','$td','$tbcm','$hanhkiem','$xl','$hk','$lop')");
    header("location: ./home.php?page=search_point&success=$id_user");
}
if($_POST[act]=='addgv'){
    extract($_POST);
    $b = new mys();
    $check = $b->query("select count(*) from users where lop='$lop' and type='3'")[0][0];
    if($check>=1){
        header("location: ./manager/?error=added");
    }else{
        recx:$id_user = rand(100000,999999);
    $check = $a->query("select id_user from users where id_user='022".$id_user."'");
    if(count($check)>=1){
        goto recx;
    }
    $password = rand(100000000000,9999999999999);
        $b->query("insert into users (name,id_user,type,lop,email,password) values('$name','$id_user','3','$lop','$email','$password')");
        header("location: ./manager/");
    }
}
if($_POST[act]=='add_posts'){
    extract($_POST);
    if(preg_match_all('/\<img alt=\"(.*)\" src=\"(.*?)\" /', $content,$rs, PREG_SET_ORDER, 0)){
        print_r($rs);
       $image = $rs[0][count($rs[0])-1];
    }
    if(preg_match_all('/ style=\"(.*?)\" /', $content,$rs, PREG_SET_ORDER, 0)){
     $content= str_replace($rs[0][1], 'height:300px; width:100%;border-radius:4px;box-shadow:1px 1px 1px #666', $content);
      
    }
    $b = new mys();
   $b->query("insert into adminposts (title,content,image,create_at,type) values('$title','$content','$image',CURRENT_DATE(),'$type')");
  header("location: ./manager/typography.php");

}
if($_POST[act]=='send_question'){
    extract($_POST);
    ranf:$id_question = rand(100000,999999);
    $check = $a->query("select id_question from questions where id_question='$id_question'");
    if(count($check)>=1){
        goto ranf;
    }
    $b = new mys();
    
  $b->query("insert into questions (title,noidung,id_question,create_at,is_rep,who,id_user) values('$title','".nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'))."','$id_question',CURRENT_DATE(),'2','".$_POST[name]."','".$_POST[id_user]."')");
  //send thong bao
  include('./cron/send_mess.php');
  $admin = $b->query("select mess_id,email,name from users where type='4'");
  $mess_id = $admin[0][mess_id];
  $XS = $b->query("select lop from users where id_user='".$_POST[id_user]."'");
  $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
    $lop= $XS[0][lop];
  send_mess($token,$mess_id,'https://dev-v.systems/?idquestion='.$id_question,"Thông báo: ".$_POST[name]."(Lớp ". explode('_',$lop)[0].'/'.explode('_',$lop)[1].") đã thêm một câu hỏi mới trên Website tiện ích THPT Ông Ích Khiêm","Nội dung: $content",'Vui lòng kiểm tra và trả lời!');
  include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$admin[0][email],$admin[0][name],$mFrom,$mPass,"Thông báo: ".$_POST[name]."(Lớp ". explode('_',$lop)[0].'/'.explode('_',$lop)[1].") đã thêm một câu hỏi mới trên Website tiện ích THPT Ông Ích Khiêm","Nội dung: $content.<br>Vui lòng kiểm tra và trả lời",'https://dev-v.systems/?idquestion='.$id_question);
  header("location: ./?idquestion=$id_question");

}
if($_POST[act]=='reply_question'){
    extract($_POST);
    $b = new mys();
    $c = $b->query("select reply,id_user from questions where id_question='$id_question'");
    $id_user = $c[0][id_user];
    $c = json_decode(urldecode($c[0][reply]),true);
    
    $c[] = ['who'=>$name,'content'=>$reply];
    $c = urlencode(json_encode($c));
    $b->query("update questions set reply='$c',is_rep='1' where id_question='$id_question'");
    
   //thong baso messenger
    
    $info = $b->query("select mess_id,lop,email,name from users where id_user='$id_user'");
    $lop= $info[0][lop];
    $mess_id = $info[0][mess_id];
    include('./cron/send_mess.php');
    $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
    send_mess($token,$mess_id,'https://dev-v.systems/?idquestion='.$id_question,"Thông báo: $name(Lớp:". explode('_',$lop)[0].'/'.explode('_',$lop)[1].") trả lời câu hỏi của bạn trên Website tiện ích THPT Ông Ích Khiêm","Nội dung: $reply",'Cảm ơn!');
    include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$info[0][email],$info[0][name],$mFrom,$mPass,"Thông báo: $name(Lớp:". explode('_',$lop)[0].'/'.explode('_',$lop)[1].") trả lời câu hỏi của bạn trên Website tiện ích THPT Ông Ích Khiêm","Nội dung: $reply.<br>Cảm ơn!",'https://dev-v.systems/?idquestion='.$id_question);
   header("location: ./?idquestion=$id_question&reply=success");

}
    if($_POST[act]=='send_test'){
        extract($_POST);
        $test=[];
       
       for($i=0;$i<count($cauhoi_test);$i++){
        if($cauhoi_test[$i]=='') continue;
        $test[] = ['cauhoi'=>$cauhoi_test[$i],'dapan'=>${'cau_'.($i+1)},'list'=> ${'dapan_'.($i+1)}];
        
        
       }

       $json = urlencode(json_encode($test));
       $type= $mon.'_'.$lop;
       randix:$id_test = rand(100000,999999);
    $check = $a->query("select id_test from tracnghiem where id_test='$id_test'");
    if(count($check)>=1){
        goto randix;
    }
       $b= new mys();
       $b->query("insert into tracnghiem (id_test,type,chude,testing,tacgia,id_user,create_at) values('$id_test','$type','$title_test','$json','".$_POST[name]."','".$_POST[id_user]."',now())");
       header("location: ./gochoctap/?id_test=$id_test&area=bai");
    }
    if($_POST[act]=='send_qs_ght'){
        extract($_POST);
        if($content!==''){
            $b = new mys();
            $type= $mon.'_'.$lop;
            randixx:$id_question = rand(100000,999999);
    $check = $a->query("select id_question from qsght where id_question='$id_question'");
    if(count($check)>=1){
        goto randixx;
    }
            $b->query("insert into qsght (id_question,title,noidung,create_at,who,id_user,type) values('$id_question','$content','".nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'))."',CURRENT_DATE(),'$name','$id_user','$type')");
            header("location: ./gochoctap/?idquestion=$id_question");




        }else{
            header("location: ./gochoctap/?error=nocontent");
        }
    }
    if($_POST[act]=='send_video'){
        extract($_POST);
        if($video !==''){
            $b =  new mys();
             $type= $mon.'_'.$lop;
            randiv:$id_video = rand(100000,999999);
    $check = $a->query("select id_video from baigiang where id_video='$id_video'");
    if(count($check)>=1){
        goto randiv;
    }
            $b->query("insert into baigiang (id_video,video,content,type,tacgia,id_user,create_at) values('$id_video','$video','".nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'))."','$type','$name','$id_user',CURRENT_DATE())");
          header("location: ./gochoctap/?video=$id_video");
        }else{
                header("location: ./gochoctap/?error=video");
        }
    }
    if($_POST[act]=='cmt_ght'){
        extract($_POST);
        if($cmt ==''){ header("location: ./gochoctap/?error=1"); exit();}
        $b = new mys();
        $get = $b->query("select binhluan,id_user from qsght where id_question='$id_question'");
        $cmts = json_decode(urldecode($get[0][binhluan]),true);
        $cmts[] =[ 'who'=> $who, 'content'=>$cmt];
        $cmts = urlencode(json_encode($cmts));
        $b->query("update qsght set binhluan='$cmts' where id_question='$id_question'");
         ignore_user_abort(1);
set_time_limit(0);
      header("location: ./gochoctap/?idquestion=$id_question");
        flush();
        $id_poster = $get[0][id_user];
        $info =$b->query("select mess_id,email,name from users where id_user='$id_poster'");
        echo $mess_id = $info[0][mess_id];
        //thong baso
        include('./cron/send_mess.php');
        $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
        send_mess($token,$mess_id,'https://dev-v.systems/gochoctap/?idquestion='.$id_question,"Thông báo: $who đã trả lời câu hỏi của bạn trong góc học tập","Nội dung: $cmt",'Cảm ơn!');
         include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$info[0][email],$info[0][name],$mFrom,$mPass,"Thông báo: $who đã trả lời câu hỏi của bạn trong góc học tập","Nội dung: $cmt.<br>Cảm ơn!",'https://dev-v.systems/gochoctap/?idquestion='.$id_question);
       

    }
    if($_POST[act]=='cmt_ght_test'){
        extract($_POST);
        if($cmt ==''){ header("location: ./gochoctap/?error=1"); exit();}
        $b = new mys();
        $get = $b->query("select binhluan,id_user from tracnghiem where id_test='$id_test'");
        $cmts = json_decode(urldecode($get[0][binhluan]),true);
        $cmts[] =[ 'who'=> $who, 'content'=>$cmt];
        $cmts = urlencode(json_encode($cmts));
        $b->query("update tracnghiem set binhluan='$cmts' where id_test='$id_test'");
        ignore_user_abort(1);
set_time_limit(0);
       header("location: ./gochoctap/?idtest=$id_test");
        flush();
        $id_poster = $get[0][id_user];
        $info =$b->query("select mess_id,email,name from users where id_user='$id_poster'");
        $mess_id = $info[0][mess_id];
        //thong baso
        include('./cron/send_mess.php');
        $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
        send_mess($token,$mess_id,'https://dev-v.systems/gochoctap/?idtest='.$id_test,"Thông báo: $who đã trả lời câu hỏi của bạn trong góc học tập","Nội dung: $cmt",'Cảm ơn!');
        include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$info[0][email],$info[0][name],$mFrom,$mPass,"Thông báo: $who đã trả lời câu hỏi của bạn trong góc học tập","Nội dung: $cmt.<br>Cảm ơn!",'https://dev-v.systems/gochoctap/?idtest='.$id_test);
        
    }
    if($_POST[act]=='cmt_ght_bg'){
        extract($_POST);
        if($cmt ==''){ header("location: ./gochoctap/?error=1"); exit();}
        $b = new mys();
        $get = $b->query("select binhluan,id_user from baigiang where id_video='$id_video'");
        $cmts = json_decode(urldecode($get[0][binhluan]),true);
        $cmts[] =[ 'who'=> $who, 'content'=>$cmt];
        $cmts = urlencode(json_encode($cmts));
        $b->query("update baigiang set binhluan='$cmts' where id_video='$id_video'");
        ignore_user_abort(1);
        set_time_limit(0);
        header("location: ./gochoctap/?idvideo=$id_video");
        flush();
        $id_poster = $get[0][id_user];
        $info =$b->query("select mess_id,email,name from users where id_user='$id_poster'");
        $mess_id = $info[0][mess_id];
        //thong baso
        include('./cron/send_mess.php');
        $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
        send_mess($token,$mess_id,'https://dev-v.systems/gochoctap/?idvideo='.$id_video,"Thông báo: $who đã trả lời câu hỏi của bạn trong góc học tập","Nội dung: $cmt",'Cảm ơn!');
        include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$info[0][email],$info[0][name],$mFrom,$mPass,"Thông báo: $who đã trả lời câu hỏi của bạn trong góc học tập","Nội dung: $cmt.<br>Cảm ơn!",'https://dev-v.systems/gochoctap/?idvideo='.$id_video);
          ignore_user_abort(1);
set_time_limit(0);
        header("location: ./gochoctap/?idvideo=$id_video");
        flush();

    }
    if($_GET['act']=='send_chat'){
        extract($_GET);
       if($message!==''){
         $b = new mys();
        $chat = $b->query("select chatlist from chatbox where lop ='$lop'");
        $chat= json_decode(urldecode($chat[0][chatlist]),true);
        $idchat=rand(1000000000,999999999999999999);
        $chat[] = ['who'=>$who,'message'=>$message,'idchat'=>''.$idchat.''];
        $chat = urlencode(json_encode($chat));
        $b->query("update chatbox set chatlist='$chat' where lop='$lop'");
        echo"OK|$idchat";
       }
    }
    if($_GET[act]=='get_message'){
        extract($_GET);
        $b = new mys();
        $chat=$b->query("select chatlist from chatbox where lop='$lop'");
        $chat = json_decode(urldecode($chat[0][chatlist]),true);
        $html='';
        for($i= count($chat)-1;$i>=0;$i--){
            if($chat[$i][idchat]!==$finalid){
                $html .='<div class="row" ><div class="col-lg-12" style="border-bottom: dotted 1px black;"><div class="media"> <div class="media-body"><p class="media-heading"><b>'.$chat[$i][who].'</b></p> <p class="text-green" style="word-break: break-all;">'.$chat[$i][message].'</p> </div></div></div></div> ';
            }else{
                break;
            }
        }
        echo $html.'////////////////////'.$chat[count($chat)-1][idchat];
    }
    if($_POST[act]=='update_system'){
        extract($_POST);
        $b = new mys();
        $b->query("update users set name='$name',chatfuel_token='$token',gmail_us='$gmail_us',gmail_pw='$gmail_pw',password='$password',email='$email' where type='4' and id_user='$id_user'");
        header("location: ./manager/user.php?success=true");
    }
    if($_GET[act]=='delete_postadmin'){
        extract($_GET);
        $b = new mys();
        $b->query("delete from adminposts where id='$idpost'");
        echo 'OK';
    }
    if($_POST[act]=='send_noti'){
        extract($_POST);
        $b = new mys();
        if($lop=='all'){
            if($type=='4'){
                $data = $b->query("select mess_id,email,name from users where type<>'4'");

            }else{
                if($type=='1') $data= $b->query("select mess_id,email,name from users where type='1' or type='1*'");
                if($type!=='1') $data= $b->query("select mess_id,email,name from users where type='$type'");
            }
        }else{
            if($type=='1') $data= $b->query("select mess_id,email,name from users where type='1' or type='1*' and lop='$lop'");
                if($type!=='1') $data= $b->query("select mess_id,email,name from users where type='$type' and lop='$lop'"); 
        }
        ignore_user_abort(1);
set_time_limit(0);
header('Location: ./manager/notifications.php?status=running');
flush();
        if($sendby=='mess'){
            include('./cron/send_mess.php');
            $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
            for($i=0;$i<count($data);$i++){
                $mess_id = $data[$i][mess_id];
                send_mess($token,$mess_id,'https://dev-v.systems',"Thông báo: Bạn nhận được một thông báo từ trang THPT Ông Ích Khiêm($name)","Nội dung: $content",'Cảm ơn!');
            }
            exit();
        }
        elseif($sendby=='mail'){
            include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          for($i=0;$i<count($data);$i++){
                $emailto = $data[$i][email];
                $nameto = $data[$i][name];
                 sendmail($mail,$emailto,$nameto,$mFrom,$mPass,"Thông báo: Bạn nhận được một thông báo từ trang THPT Ông Ích Khiêm($name)","Nội dung: $content.<br>Cảm ơn!",'https://dev-v.systems/gochoctap/?idvideo='.$id_video);
            }
         



            exit();
        }
        elseif($sendby=='all'){
            include('./cron/send_mess.php');
            $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
            for($i=0;$i<count($data);$i++){
                $mess_id = $data[$i][mess_id];
                send_mess($token,$mess_id,'https://dev-v.systems',"Thông báo: Bạn nhận được một thông báo từ trang THPT Ông Ích Khiêm($name)","Nội dung: $content",'Cảm ơn!');
            }
            include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          for($i=0;$i<count($data);$i++){
                $emailto = $data[$i][email];
                $nameto = $data[$i][name];
                 sendmail($mail,$emailto,$nameto,$mFrom,$mPass,"Thông báo: Bạn nhận được một thông báo từ trang THPT Ông Ích Khiêm($name)","Nội dung: $content.<br>Cảm ơn!",'https://dev-v.systems/gochoctap/?idvideo='.$id_video);
            }
        }
    }
    if($_GET[act]=='hoi_traloi'){
        extract($_GET);
        $b = new mys();
        send_question:$id_question = rand(100000,999999);
        $check = $b->query("select id_question from questions where id_question='$id_question'");
        if(count($check)>=1){
            goto send_question;
        }
        $info = $b->query("select name,id_user,lop from users where mess_id='$mess_id'");
        extract($info[0]);
        $b->query("insert into questions (title,noidung,id_question,create_at,is_rep,who,id_user) values('$title','".nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'))."','$id_question',CURRENT_DATE(),'2','".$name."','".$id_user."')");
          //send thong bao
          include('./cron/send_mess.php');
          $admin = $b->query("select mess_id,email,name from users where type='4'");
          $mess_id = $admin[0][mess_id];
          $XS = $b->query("select lop from users where id_user='".$id_user."'");
          $token = $b->query("select chatfuel_token from users where type='4'")[0][chatfuel_token];
            $lop= $XS[0][lop];
          send_mess($token,$mess_id,'https://dev-v.systems/?idquestion='.$id_question,"Thông báo: ".$name."(Lớp ". explode('_',$lop)[0].'/'.explode('_',$lop)[1].") đã thêm một câu hỏi mới trên Website tiện ích THPT Ông Ích Khiêm","Nội dung: $content",'Vui lòng kiểm tra và trả lời!');
          include('./cron/sendmail.php');
         $mail  = new PHPMailer();
          $login_email = $a->query("select gmail_us,gmail_pw from users where type='4'");
         $mFrom = $login_email[0][gmail_us];
          $mPass = $login_email[0][gmail_pw];
          sendmail($mail,$admin[0][email],$admin[0][name],$mFrom,$mPass,"Thông báo: ".$name."(Lớp ". explode('_',$lop)[0].'/'.explode('_',$lop)[1].") đã thêm một câu hỏi mới trên Website tiện ích THPT Ông Ích Khiêm","Nội dung: $content.<br>Vui lòng kiểm tra và trả lời!",'https://dev-v.systems/?idquestion='.$id_question);
    }
    if($_GET[act]=='getdiem'){
        extract($_GET);
        $b = new mys();
        $info = $b->query("select name,lop,id_user,phof from users where mess_id='$mess_id'");
      
        if($info[0][phof]!==''){
            $info = $b->query("select name,lop,id_user from users where id_user='".$info[0][phof]."'");

        }
        extract($info[0]);
        $hi ='cả năm';
        $diem = $b->query("select * from bangdiemtonghop where id_user='$id_user' and hk='3'");
        if(count($diem)==0) {$diem = $b->query("select * from bangdiemtonghop where id_user='$id_user' and hk='2'");$hki ='học kì II';}
        if(count($diem)==0) {$diem = $b->query("select * from bangdiemtonghop where id_user='$id_user' and hk='1'");$hki ='học kì I';}
        extract($diem[0]);
        
            echo'{
                 "messages": [
           {"text": "Xin chào ! Hệ thống sẽ gửi cho bạn bảng điểm '.$hki.' của '.$name.'"},
           {"text": "Môn Toán: '.$toan.' đ || Môn Lí: '.$li.' đ || Môn Hóa:  '.$hoa.' đ || Môn Văn:  '.$van.' đ || Môn Anh:  '.$anh.' đ || Môn Sinh:  '.$sinh.' đ || Môn Tin:  '.$tin.' đ || Môn Sử:  '.$su.' đ || Môn Địa:  '.$dia.' đ || Môn GDCD:  '.$cd.' đ || Môn Công Nghệ:  '.$cn.' đ || Môn Thể dục:  '.$td.' đ || Môn GDQP:  '.$gdqp.' đ  "},
           
           {"text": "Điểm TB:  '.$diemtb.' đ"},
           {"text": "Hạnh Kiểm:  '.$hanhkiem.' "},
           {"text": "Xếp Loại: '.$xeploai.' "}
         ]
        }';
        
    }
    if($_GET[act]=='gettintuc'){
        $b = new mys();
        $posts = $b->query("select title,content,type from adminposts order by id desc limit 20");
        $count = count($b->query("select type from adminposts where type='2' order by id desc limit 20"));
        $lists='';
        $num =0;
        for($i=0;$i<count($posts);$i++){
            extract($posts[$i]);
            if($num==5) break;
            if(($num==($count-1) || $num==3) && $type=='2'){
$num++;
                $lists .= '{
              "title":"'.str_replace('"', "", $title).'",
              "image_url":"http://i2.cdn8.net/-dWKEpo9XUIU/WL5mEuGCY3I/AAAAAAABIxI/jaY2FxZTbg8/s0/cdn8.net-1488872975-icon-sp-4.png",
              "subtitle":"",
              "buttons":[ { 
                  "type":"web_url",
                  "url":"https://dev-v.systems/?idpost='.$i.'",
                  "title":"Đọc bài viết"  } ] }';
            }elseif($i<(count($posts)-1) && $type=='2'){
                $num++;
                $lists .= '{
              "title":"'.str_replace('"', "", $title).'",
              "image_url":"http://i2.cdn8.net/-dWKEpo9XUIU/WL5mEuGCY3I/AAAAAAABIxI/jaY2FxZTbg8/s0/cdn8.net-1488872975-icon-sp-4.png",
              "subtitle":"",
              "buttons":[ { 
                  "type":"web_url",
                  "url":"https://dev-v.systems/?idpost='.$i.'",
                  "title":"Đọc bài viết" } ] },';
            }
            
        }


        echo '{
 "messages": [ {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"list",
          "top_element_style":"large",
          "elements":[ 
            '.$lists.'
         ] } } } ] }';
    }
    if($_GET[act]=='getthongbao'){
        $b = new mys();
        $posts = $b->query("select title,content,type from adminposts order by id desc limit 20");
        $count = count($b->query("select type from adminposts where type='1' order by id desc limit 20"));
        $lists='';
        $num =0;
        for($i=0;$i<count($posts);$i++){
            extract($posts[$i]);
            if($num==5) break;
            if(($num==($count-1) || $num==3) && $type=='1'){
$num++;
                $lists .= '{
              "title":"'.str_replace('"', "", $title).'",
              "image_url":"https://dev-v.systems/images/noti.jpeg",
              "subtitle":"",
              "buttons":[ { 
                  "type":"web_url",
                  "url":"https://dev-v.systems/?idpost='.$i.'",
                  "title":"Đọc thông báo"  } ] }';
            }elseif($i<(count($posts)-1) && $type=='1'){
                $num++;
                $lists .= '{
              "title":"'.str_replace('"', "", $title).'",
              "image_url":"https://dev-v.systems/images/noti.jpeg",
              "subtitle":"",
              "buttons":[ { 
                  "type":"web_url",
                  "url":"https://dev-v.systems/?idpost='.$i.'",
                  "title":"Đọc thông báo" } ] },';
            }
            
        }


        echo '{
 "messages": [ {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"list",
          "top_element_style":"large",
          "elements":[ 
            '.$lists.'
         ] } } } ] }';
    }
    if($_GET[act]=='postght'){
        extract($_GET);
        $b = new mys();
        if(!in_array($lop, ['10','11','12'])){
            echo '{
  "messages": [
    {
      "attachment": {
        "type": "template",
        "payload": {
          "template_type": "button",
          "text": "Có vẻ như bạn đã nhầm lẫn phần nào đó vui lòng thử lại!",
          "buttons": [
             {
              "type": "show_block",
              "block_names": ["góc học tập"],
              "title": "Thử lại"
            },
            {
              "type": "show_block",
              "block_names": ["menu"],
              "title": "Menu"
            }

           
            
          ]
        }
      }
    }
  ]
}';
            exit();
        }
        if(!in_array($mon, ['toan','li','hoa','anh','van','su','dia','cd','tin','sinh'])){
            echo '{
  "messages": [
    {
      "attachment": {
        "type": "template",
        "payload": {
          "template_type": "button",
          "text": "Có vẻ như bạn đã nhầm lẫn phần nào đó vui lòng thử lại!",
          "buttons": [
             {
              "type": "show_block",
              "block_names": ["góc học tập"],
              "title": "Thử lại"
            },
            {
              "type": "show_block",
              "block_names": ["menu"],
              "title": "Menu"
            }

           
            
          ]
        }
      }
    }
  ]
}';
            exit();
        }

        $info = extract($b->query("select name,id_user where mess_id='$mess_id'")[0]);
        $type= $mon.'_'.$lop;
            search_id_qsght:$id_question = rand(100000,999999);
    $check = $a->query("select id_question from qsght where id_question='$id_question'");
    if(count($check)>=1){
        goto search_id_qsght;
    }
    $b->query("insert into qsght (id_question,title,noidung,create_at,who,id_user,type) values('$id_question','$content','".nl2br(htmlentities($content, ENT_QUOTES, 'UTF-8'))."',CURRENT_DATE(),'$name','$id_user','$type')");
    echo'{
  "messages": [
    {
      "attachment": {
        "type": "template",
        "payload": {
          "template_type": "button",
          "text": "Câu hỏi của bạn đã được đăng thành công trên Góc học tập",
          "buttons": [
             
            {
              "type": "show_block",
              "block_names": ["menu"],
              "title": "Trở lại"
            }

           
            
          ]
        }
      }
    }
  ]
}';

    }
?>

