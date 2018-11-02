<?php
//Please Confirm YOUR_GMAIL_ACCOUNT and YOUR_GMAIL_PASSWORD
    
   
include('./cron/lib/class.smtp.php');
    include "./cron/lib/class.phpmailer.php";


   function sendmail($mail,$mTo,$nTo,$mFrom,$mPass,$text,$text1,$http){
    
    
     $nFrom = "THPT ÔNG ÍCH KHIÊM";    
    $body='
 <div style="background:#09f">
 <center><img src="https://assets.ifttt.com/images/channels/651849913/icons/large.png" style="height:50px;width:50px"><br><span style="color:white;font-family:monospace;font-size:25px">Thông báo từ website THPT ÔNG ÍCH KHIÊM</span></center>
 <div style="padding:20px 20px;color:white;font-size:18px;font-family:monospace;"><p style="line-height: 200%;color:white">'.$text.'</p>
  <p style="line-height: 200%;color:white;">'.$text1.'</p>
  <p style="line-height: 200%;color:white;">Bạn có thể xem thêm tại <a href="'.$http.'" style="text-decoration:none;">đây</a></p>  <button style="display:block;height:40px;width:100px;background:#28a745;border:none;border-radius:4px;margin-top:10px"><a href="https://dev-v.systems/" style="text-decoration:none;color:white">Trang chủ</a><br></button>
 </div>
 </div>
 ';
   
    $title = 'Thông báo mới từ website THPT Ông Ích Khiêm'; 
     $mail->IsSMTP();             
    $mail->CharSet  = "utf-8";
    $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";    // sever gui mail.
    $mail->Port       = 465;         // cong gui mail de nguyen
    // xong phan cau hinh bat dau phan gui mail
    $mail->Username   = $mFrom;  // khai bao dia chi email
    $mail->Password   = $mPass;              // khai bao mat khau
    $mail->SetFrom($mFrom, $nFrom);
    $mail->AddReplyTo($mFrom, $nFrom); //khi nguoi dung phan hoi se duoc gui den email nay
     $mail->isHTML(true);
    $mail->Subject    = $title;// tieu de email 
    $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
    $mail->AddAddress($mTo, $nTo);
   
    $mail->Send();
   }
?>