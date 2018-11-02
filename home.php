<?php
error_reporting(0);
session_start();
include('./controller.php');

if(!$_SESSION[login]){
    $ema = $_POST[email];
    $pwd = $_POST[password];
    $a = new mys();
    $qr=$a->query("select id_user,type,name,lop from users where email='".$ema."' and password='".$pwd."'");
    
    if(count($qr)>0){
        $_SESSION[login]=$qr[0][id_user];
        $_SESSION[type]=$qr[0][type];
        $_SESSION[lop]= $qr[0][lop];
        $_SESSION[name]= $qr[0][name];
    }else{
        header("location: ./index.php?error=1");
       exit();
    }
    
}

$id_user = $_SESSION[login];
extract($_SESSION);
$all = new mys();
$user = $all->query("select * from users where id_user='".$id_user."'");
if($type==2){
    $phof = $user[0][phof];
    $hs = $all->query("select * from users where id_user='".$phof."'");
}
if(!$_SESSION[login]){
    header("location: ./index.php?error=2");
}
if($_GET[page]=='member' || $_GET[page]=='search_point'){
    $dshs= $all->query("select * from users where lop='$lop' and (type='1' or type='3' or type='2' or type='1*') ORDER BY id ASC");
    
}
//check permisson of gv and lop truong
$type = $_SESSION[type];
$per_send = true;
if($type!=='1*' && $type!=='3'){
    $per_send = false;
    
}  

if($type==1){}
elseif($type==2){
    
}
elseif($type==3){
    
}
elseif($type==4){
 $_SESSION[admin]=1;
 header("location: ./manager/");   
}
?>
 <html> 
    <head>
          <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Trao đổi trực tuyến THPT Ông Ích Khiêm</title>
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="./bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link rel="stylesheet" href="./bootstrap/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="./bootstrap/css/animation.css">
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" type="image/png" href="./icon.png"/>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"
            }
            
            
            input[name=email],input[name=password]{
                height: 40px;
                display: inline-block;
                width: 100%;
                border: solid #017ebe 1.5px;
                font-family: cursive;
                border-radius: 5px;
                
            }
            input[type=text],input[type=number]{
                height: 40px;
                display: inline-block;
                width: 100%;
                border: solid #017ebe 1.5px;
                
                border-radius: 5px;
            }
            
            .post>h2{
                 
                
    font-size: 16px;
    font-weight: bold;
    text-transform: initial;
    color: #fff;
    position: relative;
    line-height: 27px;
    margin-bottom: 15px;
}
             
       
            .post>h2>a{;
                
    font-size: 16px;
    color: #FFF;
    background: #017ebe;
    font-weight: 700;
    padding: 1px 20px 2px;
    display: inline-block;
    text-transform: initial;
            }
            .post{ 
                background: #fafafb;
            }
            td,th{
                padding-bottom: 4px;
                padding-top: 4px;
                text-align: center;
            }
            #btnthaydoi{
                font-size: 22px;
               }  
        </style>
    </head>
    <body>
<button class="btn" style="position: fixed;bottom: 0%;right: 10%;background: #34495e;color: white;z-index: 10" onclick="document.getElementById('chatboxx').style.display='block';document.getElementById('openchat').style.display='none';"" id="openchat"><i class="fa fa-circle text-green" ></i> Chat nhóm: Lớp <?php echo explode('_',$lop)[0].'/'.explode('_',$lop)[1]; ?></button>
    <div class="container bootstrap snippet" style="position: fixed;bottom: -1%;right: -20%;z-index: 100;display: none" id="chatboxx">
    <div class="row" >
        <div class="col-md-4 col-md-offset-4" >
            <div class="portlet portlet-default" style="border-radius: 5px;">
                <div class="portlet-heading" id="head" onclick="document.getElementById('chatboxx').style.display='none';document.getElementById('openchat').style.display='block';">
                    <div class="portlet-title"  >

                        <h4><i class="fa fa-circle text-green" ></i> Chat room: Lớp <?php echo explode('_',$lop)[0].'/'.explode('_',$lop)[1]; ?></h4>

                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <div id="chat" class="panel-collapse collapse in">
                    <div>
                    <div class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;" id="scrollchat">
                      
                        <?php 
                          $chat = $all->query("select chatlist from  chatbox where lop='$lop'");
                          $chat = json_decode(urldecode($chat[0][chatlist]),true);
                          for($i=0;$i<100;$i++){
                            if(!$chat[$i]) break;
                            extract($chat[$i]);
                        ?>
                           <div class="row">
                            <div class="col-lg-12" style="border-bottom: dotted 1px black; ">
                                <div class="media">
                                    
                                       
                                    <div class="media-body">
                                        <p class="media-heading"><b><?php echo $who;?></b></p>
                                           
                                        <p class="text-green" style="word-break: break-all;"><?php echo $message;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php }?>
                       
                        
                        
                       <script>
                        var finalid = '<?php echo $chat[count($chat)-1][idchat];?>';
                       
                          
                         function getchat(){
                           $.ajax({
                            method:'get',
                            url: './req.php?act=get_message&finalid='+finalid+'&lop=<?php echo $lop;?>',
                            success:function(re){
                              re = re.split('////////////////////');
                              finalid = re[1];
                              var html = re[0];
                              $('#scrollchat').append(html);
                              $("#scrollchat").scrollTop($('#scrollchat')[0].scrollHeight);
                            }
                          });
                         }
                         setInterval(getchat, 2000);
                         
                       </script>
                       <div class="finalmessage"></div>
                    </div>
                    
                    </div>
                    <div class="portlet-footer">
                        <form role="form">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Nhập tin nhắn...." id="chatmessage"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default pull-left" onclick="send_chat();">Gửi tin nhắn</button>
                                <div class="clearfix"></div>
                            </div>
                            <script>
                              function send_chat(){
                                var message = $('textarea#chatmessage').val();
                                $.ajax({
                                  method:'get',
                                  url:'./req.php?act=send_chat&message='+message+'&who=<?php echo $name;?>&lop=<?php echo $lop;?>',
                                  success:function(re){
                                    if(re.indexOf('OK')>=0){
                                      finalid = re.split('|')[1];
                                     $('#scrollchat').append(' <div class="row"><div class="col-lg-12" style="border-bottom: dotted 1px black; "><div class="media"> <div class="media-body"><p class="media-heading"><b><?php echo $name;?></b></p> <p  class="text-green" style="word-break: break-all;">'+message+'</p> </div></div></div></div>');
                                      $("#scrollchat").scrollTop($('#scrollchat')[0].scrollHeight);
                                      $('textarea#chatmessage').val('');

                                    }
                                  }
                                });
                              }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div></div>
    <script>
      $("#scrollchat").animate({ scrollTop: $('.finalmessage').offset().top }, 0);
    </script>
<style>
  .portlet {
    margin-bottom: 15px;
}

.btn-white {
    border-color: #cccccc;
    color: #333333;
    background-color: #ffffff;
}

.portlet {
    border: 1px solid;
}

.portlet .portlet-heading {
    padding: 0 15px;
}

.portlet .portlet-heading h4 {
    padding: 1px 0;
    font-size: 16px;
}

.portlet .portlet-heading a {
    color: #fff;
}

.portlet .portlet-heading a:hover,
.portlet .portlet-heading a:active,
.portlet .portlet-heading a:focus {
    outline: none;
}

.portlet .portlet-widgets .dropdown-menu a {
    color: #333;
}

.portlet .portlet-widgets ul.dropdown-menu {
    min-width: 0;
}

.portlet .portlet-heading .portlet-title {
    float: left;
}

.portlet .portlet-heading .portlet-title h4 {
    margin: 10px 0;
}

.portlet .portlet-heading .portlet-widgets {
    float: right;
    margin: 8px 0;
}

.portlet .portlet-heading .portlet-widgets .tabbed-portlets {
    display: inline;
}

.portlet .portlet-heading .portlet-widgets .divider {
    margin: 0 5px;
}

.portlet .portlet-body {
    padding: 15px;
    background: #fff;
}

.portlet .portlet-footer {
    padding: 10px 15px;
    background: #e0e7e8;
}

.portlet .portlet-footer ul {
    margin: 0;
}

.portlet-green,
.portlet-green>.portlet-heading {
    border-color: #16a085;
}

.portlet-green>.portlet-heading {
    color: #fff;
    background-color: #16a085;
}

.portlet-orange,
.portlet-orange>.portlet-heading {
    border-color: #f39c12;
}

.portlet-orange>.portlet-heading {
    color: #fff;
    background-color: #f39c12;
}

.portlet-blue,
.portlet-blue>.portlet-heading {
    border-color: #2980b9;
}

.portlet-blue>.portlet-heading {
    color: #fff;
    background-color: #2980b9;
}

.portlet-red,
.portlet-red>.portlet-heading {
    border-color: #e74c3c;
}

.portlet-red>.portlet-heading {
    color: #fff;
    background-color: #e74c3c;
}

.portlet-purple,
.portlet-purple>.portlet-heading {
    border-color: #8e44ad;
}

.portlet-purple>.portlet-heading {
    color: #fff;
    background-color: #8e44ad;
}

.portlet-default,
.portlet-dark-blue,
.portlet-default>.portlet-heading,
.portlet-dark-blue>.portlet-heading {
    border-color: #34495e;
}

.portlet-default>.portlet-heading,
.portlet-dark-blue>.portlet-heading {
    color: #fff;
    background-color: #34495e;
}

.portlet-basic,
.portlet-basic>.portlet-heading {
    border-color: #333;
}

.portlet-basic>.portlet-heading {
    border-bottom: 1px solid #333;
    color: #333;
    background-color: #fff;
}

@media(min-width:768px) {
    .portlet {
        margin-bottom: 30px;
    }
}

.text-green {
    color: #16a085;
}

.text-orange {
    color: #f39c12;
}

.text-red {
    color: #e74c3c;
}                
</style>   
    







































<div class="row">
               <div class="col-md-12">
                      <div><button  style="display: inline-block;height: 50px; width: 75%;background: #017ebe;color: white;border: none;border-radius: 0.5px;"><center id="btnthaydoi" style="display: inline-block;width: 100%;float: left;" class="animated pulse"><marquee behavior="ALTERNATE" direction="left" >WEBSITE TRAO ĐỔI, HỌC TẬP GIỮA NHÀ TRƯỜNG, PHỤ HUYNH VÀ HỌC SINH THPT ÔNG ÍCH KHIÊM </marquee>
                        </center>
                        <style>
                          a{
                            display: inline-block;
                           
                            color: #017ebe;
                            margin: auto 12px;

                          }
                          body:hover .fa-angle-double-right{
                           transform: rotate(-360000deg);transition-duration: 1000s;
                        }
                          li{
                            display: inline-block;
                            
                          }
                        @media screen and (max-width:990px)  {
                          #iconphu{
                            display: none;
                          }
                          
                        }
                        @media screen and (max-width:1348px)  {
                          
                          #btnthaydoi{
                            font-size: 18px;
                          }
                        }
                        @media screen and (max-width:1348px)  {
                          
                          #btnthaydoi{
                            font-size: 12px;
                          }
                        }
                        </style>
                        </button>
                        
                        <ul  style="text-align: center;display: inline-block;height: 50px;float: right;width:25%;border-bottom: solid 3px #017ebe">
                          <div class="row">
                            <div class="col-md-4 animated rotateIn"><a href="http://messenger.com/t/thpt.oik14/" target="_blank" class="fab fa-facebook-messenger" style="text-decoration: none; font-size: 45px;;display: block;"></a></div>
                            <div class="col-md-4 animated rotateIn" id="iconphu"><a href="http://messenger.com/t/thpt.oik14/" target="_blank" class="fab fa-youtube" style="text-decoration: none;color: red ;font-size: 45px;;display: block;"></a></div>
                            <div class="col-md-4 animated rotateIn" id="iconphu"> <a href="http://messenger.com/t/thpt.oik14/" target="_blank" class="fab fa-twitter" style="text-decoration: none; font-size: 45px;display: block;"></a></div>
                          </div>
                          
                          
                         
                      
                        
                        </ul>
                    
                      
                      </div>

      
           <div class="row">
               <div class="col-md-12">
                      
                   <div class="cover"><center><h1 class="animated rubberBand" style="font-size:100px;width:100%;background:#fafafb;font-family: Roboto;
">NHÓM LỚP <?php echo explode('_',$lop)[0].'/'.explode('_',$lop)[1]; ?></h1></center></div>
               </div><div style="display: inline-block;width:20%"></div>
              
               <div class="col-md-12" style="margin-top: 10px;">
                                   <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-2"> <button class="xbtn" id="x" style="display: inline-block;width: 103%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;color: white"><center><i class="fas fa-home"></i><a href="./" style="display:inline-block;line-height:50px;text-decoration:none;color:white">Trang chủ</a></center></button></div>
                                      <div class="col-md-2"> <button class="xbtn" id="thaoluan" style="display: inline-block;width: 103%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;color: white "><center><i class="glyphicon glyphicon-list-alt"></i><a href="?" style="display:inline-block;line-height:50px;text-decoration:none;color:white">Thảo luận</a></center></button></div>
                                      <div class="col-md-2"><button class="xbtn" id="thanhvien" style="display: inline-block;width: 103%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;color: white"><center><i class="glyphicon glyphicon-user"></i><a href="?page=member" style="display:inline-block;line-height:50px;text-decoration:none;color:white">Thành viên</a></center></button></div>
                                      <div class="col-md-2"><button class="xbtn" id="tracuudiem" style="display: inline-block;width: 103%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;color: white"><center><i class="glyphicon glyphicon-search"></i><a href="?page=search_point" style="display:inline-block;line-height:50px;text-decoration:none;color:white">Tra cứu điểm</a></center></button></div>
                                      <div class="col-md-2"><button class="xbtn" id="x" style="display: inline-block;width: 103%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;color: white"><center><i class="fas fa-graduation-cap"></i><a href="./gochoctap" style="display:inline-block;line-height:50px;text-decoration:none;color:white">Góc học tập</a></center></button></div>
                                      <div class="col-md-2"> <button class="xbtn" id="setting" style="display: inline-block;width: 103%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;color: white"><center><i class="glyphicon glyphicon-cog"></i><a href="?page=setting" style="display:inline-block;line-height:50px;text-decoration:none;color:white">Cài đặt</a></center></button></div>
                                    </div>
                                   
                                     
                        
                        
                        
                        
                                   </div>   
                                   <style>
                                   .xbtn{
                                    background: #563d7c;
                                   }
                                     .xbtn:hover{
                                       background:  #017ebe;
                                     }
                                   </style>    
                    <div class="col-xs-12 col-md-3" style="" id="fltor">
                    <?php 
                      $newques = $all->query("SELECT * FROM `questions` ORDER BY id DESC  LIMIT 10");
                    ?>
                    <div class="allques" style="box-shadow: 2px 2px 2px 2px #666;margin-bottom: 25px;">
                       <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;background:#017ebe;color: white;margin-top: 25px;"><center>Câu hỏi mới nhất</center></button>
                       <div id="ques" style="overflow: hidden;" >
                          
                           <?php
                              for($i=0;$i<count($newques);$i++){
                                if($i==0) echo'<li style="margin-top: 16px;width;100%"><i class="fas fa-angle-double-right"></i><a target="_blank" href="./index.php?idquestion='.$newques[$i][id_question].'">'.substr($newques[$i][title], 0,40).'...</a></li> <hr>'; 
                                  else echo '<li><i class="fas fa-angle-double-right" style="width;100%;"></i><a target="_blank" href="./index.php?idquestion='.$newques[$i][id_question].'">'.substr($newques[$i][title], 0,40).'...</a></li> <hr>';
                              }
                           ?>
                           <li style="width: 100%"><button class="btn"  style="width: 100%;margin: 0 auto;background: #017ebe;"><a target="_blank" href="./index.php?page=hoidap" style="display: inline-block;width: 100%;line-height:34px;text-decoration: none;color:white;"><i class="fas fa-align-justify"></i> Xem thêm câu hỏi mới</a></button></li> 
                       </div>
                   </div>
                   



                 </div>
                    <?php
                   if($type==1 || $type ==2 || $type==3){
                   ?>
                   <div class="col-md-9">
                    
                   
<div class="col-md-8">
                        
                        <p style="margin-top:15px;">Xin chào! <a href="#user"><?php if($phof){
                       echo "Phụ huynh em $hs[0][name]";
                   }else{
                       echo $user[0][name];
                   }
                            ?></a></p>
                                                                          
                                                                          <div class="notinew" style="margin-top: 15px;font-size: 15px;width: 100%;display: inline-block;background:#fafafb;">
                   <?php $posts = $all->query("select * from adminposts ORDER BY id DESC limit 10");?>
                   <marquee behavior="" direction="" style="display: inline-block; ">Mới nhất: <a href="./?idpost=0" target="_blank" "><b ><?php echo $posts[0][title];?></b></a>
                   
                   </marquee>

               </div>
                            
                                                                           

                                                                              <!-- Modal -->
                                                                              <div class="modal fade" id="myModal" role="dialog">
                                                                                <div class="modal-dialog">

                                                                                  <!-- Modal content-->
                                                                                  <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                      <h4 class="modal-title">Cập nhật tài khoản nhận thư qua messenger</h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                      <p>Vui lòng gửi tin nhắn có nội dung : <a href="#" style="color:red;background:#c1c1c1"><?php echo $id_user;?></a> đến <a style="color:red;background:#c1c1c1" href="https://www.messenger.com/t/625619247828076" target="_blank" id="upmess">Fanpage</a> của trường THPT Ông Ích Khiêm để cập nhật địa chỉ nhận thông báo của trường qua Facebook</p>
                                                                                      <button class="btn btn-success"><a class="upmess" href="https://www.messenger.com/t/625619247828076" target="_blank" style="color:white;display:inline-bloack">Đi đến</a></button>
                                                                                      <div class="notimess"></div>
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                  </div>

                                                                                </div>
                                                                              </div>
                            <div class="col-md-12">
                                <div class="postbai" style="margin-top:15px;display:none;background:#fafafb;padding: 7px 7px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                                   <label for="" style="font-size:18px;"><u style="font-family: monospace;">ĐĂNG TẢI BÀI VIẾT MỚI TRÊN NHÓM LỚP</u></label>
                                   <form action="./req.php" method="post" enctype="multipart/form-data">
                                    <textarea name="content" id="" cols="80" rows="5" style="font-size:17px;border: solid 1px #017ebe;overflow:hidden; width:100%;display:block;"></textarea><br>
                                    <input style="display:none;" type="file" name="pic" accept="image/*" style="border: 1px solid #ccc;
                                    display: inline-block;
                                    padding: 6px 12px;
                                    cursor: pointer;" id="chen_pic">
                                    <a   onclick="chen_pic();" id="btnchenpic" style="border:solid 1px black;display:inline-block;background:#ddd;text-decoration:none;color:black">Chèn ảnh</a>
                                    <input type="hidden" name="act" value="postbai">
                                    <?php if($per_send==true) {echo '<label for="checkx">Thông báo qua Messenger</label><input type="checkbox" id="is_mess" name="is_mess">
                                    <label for="checkm">Thông báo qua Email</label><input type="checkbox" id="is_mail" name="is_mail">';}?>
                                    <input type="hidden" name="lop" value="<?php echo $lop;?>">
                                    <input type="hidden" name="tacgia" value="<?php echo $name;?>">
                                    <input type="hidden" name="id_user" value="<?php echo $login;?>">
                                    <button class="btn" style="border:solid 2px #017ebe; float:right" type="submit">Đăng Bài</button>
                                    </form>
                                    <script>function chen_pic(){
                                        $('#btnchenpic').css('display','none');
                                        $("#chen_pic").css('display','inline-block');
                                            return false;

                                    }</script>
                                    <div class="col-md-12" style="margin-top:15px;padding: 7px 7px;background:white;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                                        <div class="baiviet">
                                            <label for="" style="font-size:18px;"><u>BÀI VIẾT MỚI</u></label>
                                                            <?php
                                                                $baiviet = $all->query('select * from baiviet where lop="'.$lop.'" ORDER BY id DESC');
                                                                for($i=0;$i<count($baiviet);$i++){ 
                                                                    extract($baiviet[$i]);
                                                                    $binhluan = json_decode(urldecode($binhluan),true);
                                                                    ?>
                                                                    <div class="post<?php echo $idbaiviet;?>" id="scrollpost" style="border:solid 1px #017ebe;border-radius: 4px;margin-top:10px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);b">
                                                                <div class="text" style="margin-left:15px;">
                                                                   <label for="name"><?php echo $tacgia;?> đã đăng bài viết:</label>
                                                                    <?php 
                                                                     
                                                                        if($id_poster==$login){
                                                                            ?>
                                                                            <button style="display:inline-block;float:right;border:solid 1px red;color:red" class="btn" onclick="delete_post(<?php echo $idbaiviet ?>);">Xóa bài viết</button>
                                                                            <script> 
                                                                                function delete_post(idbaiviet){
                                                                                    if(confirm('Bạn có chắc muốn xóa bài viết này?')==true){
                                                                                        $.ajax({
                                                                                            method:'get',
                                                                                            url:'./req.php?act=delete_post&idbaiviet='+idbaiviet,
                                                                                            success: function(req){
                                                                                                if(req.indexOf('OK')>=0){
                                                                                                    alert('Xóa thành công bài viết!');
                                                                                                    $('.post'+idbaiviet).css('display','none');

                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                }
                                                                            </script>
                                                                            <?php
                                                                        }
                                                                    ?><br><div style="margin-top:-8px; font-size:9.5px;">
                                                                     <span class="glyphicon glyphicon-time" ></span> <u><?php echo $time?></u></div><hr>
                                                                    <p style="display:block; width:100%;margin-top:5px;" ><?php echo $content;?></p>
                                                                </div>
                                                                <?php if(file_exists($image)){?>
                                                                <center><img src="<?php echo $image;?>" alt="" style="width:100%;border-radius: 4px;"></center>
                                                                <?php } ?>
                                                                <div class="but_tool" style="border-top:solid 3px white">
                                                                  <script>
                                                                    function zoom_pic(){
                                                                        $('#modalvucms').modal('show');
                                                                    }
                                                                    </script>
                                                                  

 


                                                                    <button class="btn" onclick="showcomment<?php echo $idbaiviet;?>();" style="line-height:25px;color:#337ab7;width:49%;">Bình luận(<?php echo count($binhluan);?>)</button>
                                                                       <script>
                                                                    function showcomment<?php echo $idbaiviet;?>(){

                                                                        $('.binhluan<?php echo $idbaiviet;?>').css('display','block');
                                                                        $("html, body").animate({ scrollTop: $('.post<?php echo $idbaiviet;?>').offset().top }, 1000);
                                                                    }
                                                                    </script>

                                                                    <button class="btn" style="width:49%;float:right"><a href="<?php echo ''?>" style="text-decoration:none;line-height:25px;" target="_blank">Chia sẻ</a></button>
                                                                    <div style="display:none;" class="binhluan<?php echo $idbaiviet;?>">
                                                                        
                                                                         <?php
                                                                            for($k=0;$k<count($binhluan);$k++){
                                                                                ?>
                                                                                <div class="cmt" style="margin-left:15px;margin-top:15px;border:solid 3px white;margin-bottom:15px;margin-right:15px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                                                                           <div style="margin-left:15px;">
                                                                               <strong><u><?php echo $binhluan[$k][who]?>:</u></strong> <p class="cmt" style="word-wrap: break-word;"><?php echo $binhluan[$k][nd]?></p>
                                                                           </div>
                                                                           
                                                                    </div>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                          <div class="newbinhluan<?php echo $idbaiviet?>"></div>
                                                                        <div style="margin:5px 15px;">
                                                                            <label for="">Bình luận:</label> <br><textarea name="comment" id="cmtlog<?php echo $idbaiviet?>" rows="2" style="border:solid 1px #017ebe;overflow:hidden; width:100%;display:block;" required=""></textarea><button class="btn" style="display:block;margin-bottom:5px;height:35px;border:solid 1px #017ebe;color: #017ebe" onclick="comment<?php echo $idbaiviet?>();">Đăng</button> 
                                                                            <script>
                                                                                function comment<?php echo $idbaiviet?>(){
                                                                                    var message = $('textarea#cmtlog<?php echo $idbaiviet?>').val();
                                                                                    $.ajax({
                                                                                        method:'get',
                                                                                        url:'./req.php?act=comment_post&nd='+message+'&who=<?php echo $name;?>&idbaiviet=<?php echo $idbaiviet?>',
                                                                                        success: function(req){
                                                                                            if(req.indexOf('OK')>=0){
                                                                                                $('.newbinhluan<?php echo $idbaiviet?>').append('<div class="cmt" style="margin-left:15px;margin-top:15px;border:solid 3px white;margin-bottom:15px;margin-right:15px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);"><div style="margin-left:15px;"><strong><u><?php echo $name;?>:</u></strong> <p class="cmt" style="word-wrap: break-word;";>'+message+'</p></div></div>');
                                                                                                $('textarea#cmtlog<?php echo $idbaiviet?>').val('');
                                                                                            }
                                                                                        }
                                                                                    })
                                                                                }
                                                                            </script>
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                                    <?php
                                                                    
                                                                }
                                                            ?>
                                                            
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="thanhvien" style="display:none;margin-top:20px;background:#fafafb;border:solid 1px #017ebe;border-radius:4px;">
                                    <div class="member" style="margin: 20px 8px;overflow-x:scroll">
                                        <center><h3>Thành viên </h3></center>
                                        <div id="hideformaddmem" style="display:none;">
                                            <table style="width:100%;border:solid 1px blue;margin-bottom:15px;border-radius:4px;display:block" >
                                                <tr>
                                                    <th>Họ và tên:</th>
                                                    <th>Số điện thoại:</th>
                                                    <th>Email:</th>
                                                    <th>Tham gia với tư cách:</th>
                                                    <th id="thphof" style="display:none;">Phụ huynh của em :</th>
                                                    <th>Hành động</th>
                                                </tr>
                                                <tr>
                                                   <form action="./req.php" method="post">
                                                    <td><input type="text" name="name" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:80%;margin:0 auto;" value="<?php echo $_GET[name]?>" required></td>
                                                    <td><input type="text" name="sdt" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:80%;margin:0 auto;" value="<?php echo $_GET[sdt]?>"  required></td>
                                                    <td><input type="text" name="email" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:80%;margin:0 auto;" value="<?php echo $_GET[email]?>" required></td>
                                                    <td><select id="tucach" name="tucach" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:80%;margin:0 auto;">
                                                          <option value="1" selected>Học sinh</option>
                                                          <option value="1*">Lớp trưởng</option>
                                                          <option value="2">Phụ huynh</option>
                                                        </select>
                                                        <input type="hidden" name="act" value="addnewmem">
                                                        <input type="hidden" name="lop" value="<?php echo $lop;?>">
                                                        </td>
                                                        <td id="tdphof" style="display:none;"><select name="phof" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:80%;margin:0 auto;">
                                                          <?php
                                                            
                                                            $allhs = $all->query("select id_user,name from users where (type='1' or type ='1*') and lop='$lop'");
                                                           for($i=0;$i<count($allhs);$i++){
                                                               echo'<option value="'.$allhs[$i][id_user].'">'.$allhs[$i][name].'</option>';
                                                           }
                                                            ?>
                                                        </select></td>
                                                    <th><button class="btn" style="background:#4CAF50;float:right;color:white;">Thêm</button></th>
                                                    </form>
                                                    <script>
                                                        $('#tucach').change(function(){
                                                            if($('#tucach option[value=2]').is(':selected')){
                                                               $('#thphof').css('display','block');
                                                                $('#tdphof').css('display','block');
                                                            }else{
                                                                $('#thphof').css('display','none');
                                                                $('#tdphof').css('display','none');
                                                            }
                                                            
                                                        });
                                                    </script>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php if($type==3){
                                                echo'<button id="btnaddmem" class="btn" style="background:#4CAF50;float:right;color:white;" onclick="addnewmem();">Thêm mới</button>';
                                                }?>
                                                <script>
                                                    function addnewmem(){
                                                        $('#btnaddmem').css('display','none');
                                                        $('#hideformaddmem').css('display','block');
                                                    }
                                                    if('<?php echo $_GET[name]?>'!==''){
                                                                $('#btnaddmem').css('display','none');
                                                        $('#hideformaddmem').css('display','block');
                                                            }
                                                </script>
                                         <table style="width:100%" border="1" style="">
                                             <tr>
                                                <th>STT</th>
                                                <th>Tên</th> 
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <?php if($type==3){
                                                echo'<th style="color:#4CAF50;">Sửa</th><th style="color:red">Xóa</th>';
                                                }?>
                                              </tr>
                                              <?php 
                                                for($i=0;$i<count($dshs);$i++){
                                                    
                                                
                                             ?>
                                              <!-- Modal -->
<div class="modal fade" id="modalhocsinh<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="hocsinhLabel<?php echo $i;?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hocsinhLabel<?php echo $i;?>">Cập nhật thông tin học sinh:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./req.php" method="post">
            <label for="name">Họ và tên:</label>
            <input type="text" name="name" value="<?php echo $dshs[$i][name];?>" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:100%;">
            <label for="sdt">Số điện thoại:</label>
            <input type="text" name="sdt" value="<?php echo $dshs[$i][sdt];?>" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;text">
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $dshs[$i][email];?>" style="display:block;height:34.8px;border-radius:4px;border:none;border:solid 1px blue;width:100%;">
            <input type="hidden" name="id_user" value="<?php echo $dshs[$i][id_user]?>">
            <input type="hidden" name="act" value="update_hs">
            <input type="hidden" name="email_cu" value="<?php echo $dshs[$i][email];?>">
            <input type="hidden" name="sdt_cu" value="<?php echo $dshs[$i][sdt];?>">
            
            
        
      <hr>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Cập nhật</button></form>
      </div>
    </div>
  </div>
</div>
                                              <tr id="member<?php echo $dshs[$i][id_user]?>">
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $dshs[$i][name];?></td> 
                                                <td><?php echo $dshs[$i][sdt];?></td>
                                                <td><?php echo $dshs[$i][email];?></td>
                                                
                                                 <?php if($type==3){
                                                echo'<th><button class="btn" style="color:#4CAF50;" data-toggle="modal" data-target="#modalhocsinh'.$i.'">Sửa</button></th><th>
                                                <button class="btn" style="color:red" onclick="delete_member(\''.$dshs[$i][id_user].'\');">Xóa</button></th>';
                                                }?>
                                              </tr>
                                              <?php }?>
                                              <script>function delete_member(idmember){
                                                      if(confirm('Bạn có chắc muốn xóa thành viên này?')==true){
                                                          $.ajax({
                                                              method:'get',
                                                              url:'./req.php?act=delete_member&id_user='+idmember,
                                                              success: function(req){
                                                                  if(req.indexOf('OK')>=0){
                                                                      window.location='./home.php?page=member';
                                                                  }
                                                              }
                                                          });
                                                      }
                                                  }</script>
                                         </table>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <div class="tracuu" style="display:none;">
                                    <div class="bangdiem" style="background:#fafafb;margin-top:20px;border:solid 1px #017ebe;border-radius:4px;">
                                        <center><h3>Bảng điểm tổng hợp học kì</h3></center>
                                        <div class="diem" style="margin:7px 10px;">
                                            <?php
                                                    
                                                if($type=='1' || $type=='1*' || $type=='2'){
                                                    if($type=='2'){
                                                        $name_hs= $hs[0][name];
                                                    }else{
                                                        $name_hs = $name;
                                                    }
                                                    if($phof){
                                                        $diem_hk1 = $all->query("select * from bangdiemtonghop where id_user='$phof' and hk='1'");
                                                        $diem_hk2 = $all->query("select * from bangdiemtonghop where id_user='$phof' and hk='2'");
                                                        $diem_hk3 = $all->query("select * from bangdiemtonghop where id_user='$phof' and hk='3'");
                                                        
                                                    }else{
                                                       
                                                        $diem_hk1 = $all->query("select * from bangdiemtonghop where id_user='$login' and hk='1'");
                                                        $diem_hk2 = $all->query("select * from bangdiemtonghop where id_user='$login' and hk='2'");
                                                        $diem_hk3 = $all->query("select * from bangdiemtonghop where id_user='$login' and hk='3'");
                                                    }
                                                   
                                                   ?>
                                                <label for="hvt" style="">Họ và tên học sinh:</label> <b><i><?php echo $name;?> </i></b><br>
                                                <label for="lop_hs">Lớp:</label><i><?php echo explode('_',$lop)[0].'/'.explode('_',$lop)[1]; ?></i> 
                                                  <div class="hk1" style="border:solid 1px #017ebe;">
                                                   <center><label for="" style="margin-top:15px;font-size:16px;">Học kì I</label></center> 
                                                     <style>
                                                         th,td{
                                                             padding: 20.1px 7.9px;
                                                         }
                                                      </style>
                                                      <table style="width:100%;display:block; margin-top:7px;overflow:scroll;" border="1" >
                                                          <tr>
                                                              <th>Toán</th>
                                                              <th>Lí</th>
                                                              <th>Hóa</th>
                                                              <th>Văn</th>
                                                              <th>Anh</th>
                                                              <th>Sinh</th>
                                                              <th>Tin</th>
                                                              <th>Sử</th>
                                                              <th>Địa</th>
                                                              <th>GDCD</th>
                                                              <th>Công Nghệ</th>
                                                              <th>GDQP</th>
                                                              <th>Thể Dục</th>
                                                              <th>TBCM</th>
                                                              <th>Hạnh Kiểm</th>
                                                                <th>Xếp loại</th>
                                                              
                                                              
                                                          </tr>
                                                          <tr>
                                                              <td><?php echo $diem_hk1[0][toan];?></td>
                                                              <td><?php echo $diem_hk1[0][li];?></td>
                                                              <td><?php echo $diem_hk1[0][hoa];?></td>
                                                              <td><?php echo $diem_hk1[0][anh];?></td>
                                                              <td><?php echo $diem_hk1[0][van];?></td>
                                                              <td><?php echo $diem_hk1[0][sinh];?></td>
                                                              <td><?php echo $diem_hk1[0][tin];?></td>
                                                              <td><?php echo $diem_hk1[0][su];?></td>
                                                              <td><?php echo $diem_hk1[0][dia];?></td>
                                                              <td><?php echo $diem_hk1[0][cd];;?></td>
                                                              <td><?php echo $diem_hk1[0][cn];;?></td>
                                                              <td><?php echo $diem_hk1[0][gdqp];?></td>
                                                              <td><?php echo $diem_hk1[0][td];?></td> 
                                                              <td><?php echo $diem_hk1[0][diemtb];?></td> 
                                                              <td><?php echo $diem_hk1[0][hanhkiem];?></td> 
                                                              <td><?php echo $diem_hk1[0][xeploai];?></td> 
                                                              
                                                              
                                                          </tr>
                                                      </table>
                                                  </div>
                                                  
                                                  
                                                  
                                                  
                                                    <div class="hk2" style="border:solid 1px #017ebe;margin-top:20px;">
                                                   <center><label for="" style="margin-top:15px;font-size:16px;">Học kì II</label></center> 
                                                     
                                                      <table style="width:100%;display:block; margin-top:7px;overflow:scroll;" border="1">
                                                          <tr>
                                                              <th>Toán</th>
                                                              <th>Lí</th>
                                                              <th>Hóa</th>
                                                              <th>Văn</th>
                                                              <th>Anh</th>
                                                              <th>Sinh</th>
                                                              <th>Tin</th>
                                                              <th>Sử</th>
                                                              <th>Địa</th>
                                                              <th>GDCD</th>
                                                              <th>Công Nghệ</th>
                                                              <th>GDQP</th>
                                                              <th>Thể Dục</th>
                                                              <th>TBCM</th>
                                                              <th>Hạnh Kiểm</th>
                                                                <th>Xếp loại</th>
                                                             
                                                              
                                                              
                                                          </tr>
                                                          <tr>
                                                              <td><?php echo $diem_hk2[0][toan];?></td>
                                                              <td><?php echo $diem_hk2[0][li];?></td>
                                                              <td><?php echo $diem_hk2[0][hoa];?></td>
                                                              <td><?php echo $diem_hk2[0][anh];?></td>
                                                              <td><?php echo $diem_hk2[0][van];?></td>
                                                              <td><?php echo $diem_hk2[0][sinh];?></td>
                                                              <td><?php echo $diem_hk2[0][tin];?></td>
                                                              <td><?php echo $diem_hk2[0][su];?></td>
                                                              <td><?php echo $diem_hk2[0][dia];?></td>
                                                              <td><?php echo $diem_hk2[0][cd];;?></td>
                                                              <td><?php echo $diem_hk2[0][cn];;?></td>
                                                              <td><?php echo $diem_hk2[0][gdqp];?></td>
                                                              <td><?php echo $diem_hk2[0][td];?></td> 
                                                              <td><?php echo $diem_hk2[0][diemtb];?></td> 
                                                              <td><?php echo $diem_hk2[0][hanhkiem];?></td> 
                                                              <td><?php echo $diem_hk2[0][xeploai];?></td> 
                                                              
                                                              
                                                          </tr>
                                                      </table>
                                                  </div>
                                                  
                                                  
                                                  
                                                    <div class="hk3" style="border:solid 1px #017ebe;margin-top:20px;">
                                                   <center><label for="" style="margin-top:15px;font-size:16px;">Tổng hợp cả năm</label></center> 
                                                     
                                                      <table style="width:100%;display:block; margin-top:7px;overflow:scroll;" border="1">
                                                          <tr>
                                                              <th>Toán</th>
                                                              <th>Lí</th>
                                                              <th>Hóa</th>
                                                              <th>Văn</th>
                                                              <th>Anh</th>
                                                              <th>Sinh</th>
                                                              <th>Tin</th>
                                                              <th>Sử</th>
                                                              <th>Địa</th>
                                                              <th>GDCD</th>
                                                              <th>Công Nghệ</th>
                                                              <th>GDQP</th>
                                                              <th>Thể Dục</th>
                                                              <th>TBCM</th>
                                                              <th>Hạnh Kiểm</th>
                                                                <th>Xếp loại</th>
                                                              
                                                              
                                                          </tr>
                                                          <tr>
                                                              <td><?php echo $diem_hk3[0][toan];?></td>
                                                              <td><?php echo $diem_hk3[0][li];?></td>
                                                              <td><?php echo $diem_hk3[0][hoa];?></td>
                                                              <td><?php echo $diem_hk3[0][anh];?></td>
                                                              <td><?php echo $diem_hk3[0][van];?></td>
                                                              <td><?php echo $diem_hk3[0][sinh];?></td>
                                                              <td><?php echo $diem_hk3[0][tin];?></td>
                                                              <td><?php echo $diem_hk3[0][su];?></td>
                                                              <td><?php echo $diem_hk3[0][dia];?></td>
                                                              <td><?php echo $diem_hk3[0][cd];;?></td>
                                                              <td><?php echo $diem_hk3[0][cn];;?></td>
                                                              <td><?php echo $diem_hk3[0][gdqp];?></td>
                                                              <td><?php echo $diem_hk3[0][td];?></td> 
                                                              <td><?php echo $diem_hk3[0][diemtb];?></td> 
                                                              <td><?php echo $diem_hk3[0][hanhkiem];?></td> 
                                                              <td><?php echo $diem_hk3[0][xeploai];?></td> 
                                                              
                                                              
                                                          </tr>
                                                      </table>
                                                  </div>
                                                   <?php
                                                }else{
                                            ?>
                                            <div class="quanli_diem">
                                               <label for="lop" style="font-size:17px;">Quản lí điểm lớp:</label> <i><?php echo explode('_',$lop)[0].'/'.explode('_',$lop)[1]; ?></i><br>
                                               <div class="table_diemlop">
                                                   
                                                <style>
                                                    th,td{
                                                        padding:  0px 8px;
                                                    }
                                                   </style>
                                                        <label for="chon_hk" style="font-size:17px;">Học kì:</label>
                                                         <select name="hk" id="hocki" onchange="show_hk();">
                                                           <option value="1">I</option>
                                                           <option value="2">II</option>
                                                           <option value="3">Cả năm</option>
                                                       </select>
                                                           <?php
                                                            if($type=='3'){
                                                                $diem_1 = $all->query("select * from bangdiemtonghop where lop='$lop' and hk='1'");
                                                                $diem_2 = $all->query("select * from bangdiemtonghop where lop='$lop' and hk='2'");
                                                                $diem_3 = $all->query("select * from bangdiemtonghop where lop='$lop' and hk='3'");
                                                            }
                                                            $dshs_ = $all->query("select id,id_user,name from users where lop='$lop' and (type='1' or type='1*')");
                                                            $sort_hs=[];
                                                            for($i=0;$i<count($diem_1);$i++){
                                                                $sort_hs[] = $all->query("select id from users where id_user='".$diem_1[$i][id_user]."'")[0][id];
                                                            }
                                                            array_multisort($diem_1,SORT_DESC,$sort_hs);


                                                     for($i=0;$i<count($diem_2);$i++){
                                                                $sort_hs[] = $all->query("select id from users where id_user='".$diem_2[$i][id_user]."'")[0][id];
                                                            }
                                                            array_multisort($diem_2,SORT_DESC,$sort_hs);


                                                             for($i=0;$i<count($diem_3);$i++){
                                                                $sort_hs[] = $all->query("select id from users where id_user='".$diem_3[$i][id_user]."'")[0][id];
                                                            }
                                                            array_multisort($diem_3,SORT_DESC,$sort_hs);

                                                            //sort end
                                                         ?>
                                                         <table id="hk__1" style="width:100%;display:block; margin-top:7px;overflow:scroll;" border="1">
                                                             <tr>
                                                             <td>TT</td>
                                                             <th>Họ tên</th>
                                                              <th>T</th>
                                                              <th>L</th>
                                                              <th>H</th>
                                                              <th>V</th>
                                                              <th>A</th>
                                                              <th>Si</th>
                                                              <th>Ti</th>
                                                              <th>S</th>
                                                              <th>Đ</th>
                                                              <th>CD</th>
                                                            <th>CN</th>
                                                              <th>QP</th>
                                                              <th>TD</th>
                                                              <th>TBCM</th>
                                                              <th>HK</th>
                                                                <th>XL</th>
                                                                <th>Sửa</th>
                                                              
                                                              
                                                          </tr>
                                                          <tr>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  
                                                                  <td><button class="btn" style="color:#4CAF50" onclick="add_diem1();">Thêm</button></td>
                                                                  <script>
                                                                function add_diem1(){
                                                                    $('#add_diem').modal('show');
                                                                    $('#hk_add').val('1');
                                                                }
                                                                </script>
                                                              </tr>
                                                            
                                                          <?php
                                                   
                                                             for($i=0;$i<count($diem_1);$i++){
                                                                 ?>
                                                                 <tr id="tr_<?php echo $diem_1[$i][id_user];?>">
                                                                 <td><?php echo $i+1;?></td>
                                                              <td><?php echo $diem_1[$i][name];?></td>
                                                              <td><?php echo $diem_1[$i][toan];?></td>
                                                              <td><?php echo $diem_1[$i][li];?></td>
                                                              <td><?php echo $diem_1[$i][hoa];?></td>
                                                              <td><?php echo $diem_1[$i][van];?></td>
                                                              <td><?php echo $diem_1[$i][anh];?></td>
                                                              <td><?php echo $diem_1[$i][sinh];?></td>
                                                              <td><?php echo $diem_1[$i][tin];?></td>
                                                              <td><?php echo $diem_1[$i][su];?></td>
                                                              <td><?php echo $diem_1[$i][dia];?></td>
                                                              <td><?php echo $diem_1[$i][cd];?></td>
                                                              <td><?php echo $diem_1[$i][cn];?></td>
                                                              <td><?php echo $diem_1[$i][gdqp];?></td>
                                                              <td><?php echo $diem_1[$i][td];?></td>
                                                              <td><?php echo $diem_1[$i][diemtb];?></td>
                                                              <td><?php echo $diem_1[$i][hanhkiem];?></td>
                                                              <td><?php echo $diem_1[$i][xeploai];?></td>
                                                              <td><button class="btn" style="color:#4CAF50" onclick="edit_diem('<?php echo $diem_1[$i][name];?>','<?php echo $diem_1[$i][toan];?>','<?php echo $diem_1[$i][li];?>','<?php echo $diem_1[$i][hoa];?>','<?php echo $diem_1[$i][van];?>','<?php echo $diem_1[$i][anh];?>','<?php echo $diem_1[$i][sinh];?>','<?php echo $diem_1[$i][tin];?>','<?php echo $diem_1[$i][su];?>','<?php echo $diem_1[$i][dia];?>','<?php echo $diem_1[$i][cd];?>','<?php echo $diem_1[$i][cn];?>','<?php echo $diem_1[$i][gdqp];?>','<?php echo $diem_1[$i][td];?>','<?php echo $diem_1[$i][diemtb];?>','<?php echo $diem_1[$i][hanhkiem];?>','<?php echo $diem_1[$i][xeploai];?>','<?php echo $diem_1[$i][hk];?>','<?php echo $diem_1[$i][id_user];?>')">Sửa</button></td>
                                                                   
                                                                  </tr>
                                                                 <?php
                                                             }
                                                             ?>
                                                         </table>
                                                         
                                                         
                                                         
                                                         
                                                         <table id="hk__2" style="width:100%;display:block; margin-top:7px;overflow:scroll;display:none;" border="1">
                                                             <tr>
                                                             <td>TT</td>
                                                             <th>Họ tên</th>
                                                              <th>T</th>
                                                              <th>L</th>
                                                              <th>H</th>
                                                              <th>V</th>
                                                              <th>A</th>
                                                              <th>Si</th>
                                                              <th>Ti</th>
                                                              <th>S</th>
                                                              <th>Đ</th>
                                                              <th>CD</th>
                                                            <th>CN</th>
                                                              <th>QP</th>
                                                              <th>TD</th>
                                                              <th>TBCM</th>
                                                              <th>HK</th>
                                                                <th>XL</th>
                                                                <th>Sửa</th>
                                                              
                                                              
                                                          </tr>
                                                          <tr>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  
                                                                  <td><button class="btn" style="color:#4CAF50" onclick="add_diem2();">Thêm</button></td>
                                                                  <script>
                                                                function add_diem2(){
                                                                    $('#add_diem').modal('show');
                                                                    $('#hk_add').val('2');
                                                                }
                                                                </script>
                                                              </tr>
                                                          <?php
                                                   
                                                             for($i=0;$i<count($diem_2);$i++){
                                                                 ?>
                                                                 <tr id="tr_<?php echo $diem_2[$i][id_user];?>">
                                                                 <td><?php echo $i+1;?></td>
                                                              <td><?php echo $diem_2[$i][name];?></td>
                                                              <td><?php echo $diem_2[$i][toan];?></td>
                                                              <td><?php echo $diem_2[$i][li];?></td>
                                                              <td><?php echo $diem_2[$i][hoa];?></td>
                                                              <td><?php echo $diem_2[$i][van];?></td>
                                                              <td><?php echo $diem_2[$i][anh];?></td>
                                                              <td><?php echo $diem_2[$i][sinh];?></td>
                                                              <td><?php echo $diem_2[$i][tin];?></td>
                                                              <td><?php echo $diem_2[$i][su];?></td>
                                                              <td><?php echo $diem_2[$i][dia];?></td>
                                                              <td><?php echo $diem_2[$i][cd];?></td>
                                                              <td><?php echo $diem_2[$i][cn];?></td>
                                                              <td><?php echo $diem_2[$i][gdqp];?></td>
                                                              <td><?php echo $diem_2[$i][td];?></td>
                                                              <td><?php echo $diem_2[$i][diemtb];?></td>
                                                              <td><?php echo $diem_2[$i][hanhkiem];?></td>
                                                              <td><?php echo $diem_2[$i][xeploai];?></td>
                                                              <td><button class="btn" style="color:#4CAF50" onclick="edit_diem('<?php echo $diem_2[$i][name];?>','<?php echo $diem_2[$i][toan];?>','<?php echo $diem_2[$i][li];?>','<?php echo $diem_2[$i][hoa];?>','<?php echo $diem_2[$i][van];?>','<?php echo $diem_2[$i][anh];?>','<?php echo $diem_2[$i][sinh];?>','<?php echo $diem_2[$i][tin];?>','<?php echo $diem_2[$i][su];?>','<?php echo $diem_2[$i][dia];?>','<?php echo $diem_2[$i][cd];?>','<?php echo $diem_2[$i][cn];?>','<?php echo $diem_2[$i][gdqp];?>','<?php echo $diem_2[$i][td];?>','<?php echo $diem_2[$i][diemtb];?>','<?php echo $diem_2[$i][hanhkiem];?>','<?php echo $diem_2[$i][xeploai];?>','<?php echo $diem_2[$i][hk];?>','<?php echo $diem_2[$i][id_user];?>')">Sửa</button></td>
                                                                   
                                                                  </tr>
                                                                 <?php
                                                             }
                                                             ?>
                                                         </table>
                                                             
                                                         
                                                         
                                                         
                                                         
                                                         
                                                         
                                                         
                                                         
                                                         <table id="hk__3" style="width:100%;display:block; margin-top:7px;overflow:scroll;display:none;" border="1">
                                                             <tr>
                                                             <td>TT</td>
                                                             <th>Họ tên</th>
                                                              <th>T</th>
                                                              <th>L</th>
                                                              <th>H</th>
                                                              <th>V</th>
                                                              <th>A</th>
                                                              <th>Si</th>
                                                              <th>Ti</th>
                                                              <th>S</th>
                                                              <th>Đ</th>
                                                              <th>CD</th>
                                                            <th>CN</th>
                                                              <th>QP</th>
                                                              <th>TD</th>
                                                              <th>TBCM</th>
                                                              <th>HK</th>
                                                                <th>XL</th>
                                                                <th>Sửa</th>
                                                              
                                                              </tr>
                                                              <tr>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  <td></td>
                                                                  
                                                                  <td><button class="btn" style="color:#4CAF50" onclick="add_diem3();">Thêm</button></td>
                                                                  <script>
                                                                function add_diem3(){
                                                                    $('#add_diem').modal('show');
                                                                    $('#hk_add').val('3');
                                                                }
                                                                </script>
                                                              </tr>
                                                          <?php
                                                   
                                                             for($i=0;$i<count($diem_3);$i++){
                                                                 ?>
                                                                 <tr id="tr_<?php echo $diem_3[$i][id_user];?>">
                                                                 <td><?php echo $i+1;?></td>
                                                              <td><?php echo $diem_3[$i][name];?></td>
                                                              <td><?php echo $diem_3[$i][toan];?></td>
                                                              <td><?php echo $diem_3[$i][li];?></td>
                                                              <td><?php echo $diem_3[$i][hoa];?></td>
                                                              <td><?php echo $diem_3[$i][van];?></td>
                                                              <td><?php echo $diem_3[$i][anh];?></td>
                                                              <td><?php echo $diem_3[$i][sinh];?></td>
                                                              <td><?php echo $diem_3[$i][tin];?></td>
                                                              <td><?php echo $diem_3[$i][su];?></td>
                                                              <td><?php echo $diem_3[$i][dia];?></td>
                                                              <td><?php echo $diem_3[$i][cd];?></td>
                                                              <td><?php echo $diem_3[$i][cn];?></td>
                                                              <td><?php echo $diem_3[$i][gdqp];?></td>
                                                              <td><?php echo $diem_3[$i][td];?></td>
                                                              <td><?php echo $diem_3[$i][diemtb];?></td>
                                                              <td><?php echo $diem_3[$i][hanhkiem];?></td>
                                                              <td><?php echo $diem_3[$i][xeploai];?></td>
                                                              <td><button class="btn" style="color:#4CAF50" onclick="edit_diem('<?php echo $diem_3[$i][name];?>','<?php echo $diem_3[$i][toan];?>','<?php echo $diem_3[$i][li];?>','<?php echo $diem_3[$i][hoa];?>','<?php echo $diem_3[$i][van];?>','<?php echo $diem_3[$i][anh];?>','<?php echo $diem_3[$i][sinh];?>','<?php echo $diem_3[$i][tin];?>','<?php echo $diem_3[$i][su];?>','<?php echo $diem_3[$i][dia];?>','<?php echo $diem_3[$i][cd];?>','<?php echo $diem_3[$i][cn];?>','<?php echo $diem_3[$i][gdqp];?>','<?php echo $diem_3[$i][td];?>','<?php echo $diem_3[$i][diemtb];?>','<?php echo $diem_3[$i][hanhkiem];?>','<?php echo $diem_3[$i][xeploai];?>','<?php echo $diem_3[$i][hk];?>','<?php echo $diem_3[$i][id_user];?>')">Sửa</button></td>
                                                          
                                                                   
                                                                  </tr>
                                                                 <?php
                                                             }
                                                             ?>
                                                         </table>
                                                         
                                                         
                                                     
                                                     <script>
                                                         function edit_diem(name,t,l,h,a,v,si,ti,s,d,cd,cn,qp,td,tb,hanhkiem,xl,hk,id_user){
                                                             $('#editdiem').modal('show');
                                                             $('#name_edit').val(name);
                                                             $('#t_edit').val(t);
                                                             $('#l_edit').val(l);
                                                             $('#h_edit').val(h);
                                                             $('#a_edit').val(a);
                                                             $('#v_edit').val(v);
                                                             $('#si_edit').val(si);
                                                             $('#ti_edit').val(ti);
                                                             $('#s_edit').val(s);
                                                             $('#d_edit').val(d);
                                                             $('#cd_edit').val(cd);
                                                             $('#cn_edit').val(cn);
                                                             $('#qp_edit').val(qp);
                                                             $('#td_edit').val(td);
                                                             $('#tb_edit').val(tb);
                                                             $('#hanhkiem_edit').val(hanhkiem);
                                                             $('#xl_edit').val(xl);
                                                             $('#hk_edit').val(hk);
                                                             $('#id_user_edit').val(id_user);
                                                            
                                                         }
                                                    function show_hk(){
                                                        if($('#hocki option:selected').val()=='1'){
                                                            $('#hk__1').css('display','block');
                                                            $('#hk__2').css('display','none');
                                                            $('#hk__3').css('display','none');
                                                        }
                                                        if($('#hocki option:selected').val()=='2'){
                                                            $('#hk__1').css('display','none');
                                                            $('#hk__2').css('display','block');
                                                            $('#hk__3').css('display','none');
                                                        }
                                                        if($('#hocki option:selected').val()=='3'){
                                                            $('#hk__1').css('display','none');
                                                            $('#hk__2').css('display','none');
                                                            $('#hk__3').css('display','block');
                                                        }
                                                    } 
                                                   </script>
                                                      
                                               </div>
                                            </div>
                                            
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
<div id="editdiem" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chỉnh sửa điểm học sinh:</h4>
      </div>
      <div class="modal-body">
       <form action="./req.php" method="post">
        <label for="name">Họ tên:</label> <input type="text" value="" disabled="disabled" id="name_edit"><br>
        <label for="name">Điểm toán:</label> <input type="text" value="" id="t_edit" name="t"><br>
        <label for="name">Điểm lí:</label> <input type="text" value="" id="l_edit" name="l"><br>
        <label for="name">Điểm hóa:</label> <input type="text" value="" id="h_edit" name="h"><br>
        <label for="name">Điểm văn:</label> <input type="text" value="" id="v_edit" name="v"><br>
        <label for="name">Điểm anh:</label> <input type="text" value="" id="a_edit" name="a"><br>
        <label for="name">Điểm sinh:</label> <input type="text" value="" id="si_edit" name="si"><br>
        <label for="name">Điểm tin:</label> <input type="text" value="" id="ti_edit" name="ti"><br>
        <label for="name">Điểm sử:</label> <input type="text" value="" id="s_edit" name="s"><br>
        <label for="name">Điểm địa:</label> <input type="text" value="" id="d_edit" name="d"><br>
        <label for="name">Điểm gdcd:</label> <input type="text" value="" id="cd_edit" name="cd"><br>
        <label for="name">Điểm công nghệ:</label> <input type="text" value="" id="cn_edit" name="cn"><br>
        <label for="name">Điểm gdqp:</label> <input type="text" value="" id="qp_edit" name="qp"><br>
        <label for="name">Điểm thể dục:</label> <input type="text" value="" id="td_edit" name="td"><br>
        <label for="name">Điểm tbcm:</label> <input type="text" value="" id="tb_edit" name="tbcm"><br>
        <label for="name">Hạnh kiểm:</label> <input type="text" value="" id="hanhkiem_edit" name="hanhkiem"><br>
        <label for="name">Xếp loại:</label> <input type="text" value="" id="xl_edit" name="xl"><br>
         <input type="hidden" value="" id="hk_edit" name="hk">
         <input type="hidden" value="" id="id_user_edit" name="id_user">
         <input type="hidden" value="edit_diem" name="act">
         <button class="btn" style="background:#4CAF50;color:white">Cập nhật</button>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<div id="add_diem" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thêm điểm học sinh:</h4>
      </div>
      <div class="modal-body">
       <form action="./req.php" method="post">
        <label for="name">Họ tên:</label>
        <select name="id_user" id="hoten" style="display:inline-block;height:34.8px;border-radius:4px;border:none;border:solid 1px #017ebe;width:100%;margin:0 auto;">
            <?php
            
            if($dshs_){
              for($i=0;$i < count($dshs_);$i++){
                echo '<option value="'.$dshs_[$i][id_user].'">'.$dshs_[$i][name].'</option>';
              }
            }
            ?>
        </select>
        <input type="hidden" name="name" id="addname" value="">
        <script>
          $('#hoten').change(function(){
            $('#addname').val($('#hoten option:selected').html());
          });
           $('#addname').val($('#hoten option:selected').html());
        </script>
        <br>
        <label for="name">Điểm toán:</label> <input type="text" value=""  name="t" required=""><br>
        <label for="name">Điểm lí:</label> <input type="text" value=""  name="l" required=""><br>
        <label for="name">Điểm hóa:</label> <input type="text" value="" name="h" required=""><br>
        <label for="name">Điểm văn:</label> <input type="text" value=""  name="v" required=""><br>
        <label for="name">Điểm anh:</label> <input type="text" value="" name="a" required=""><br>
        <label for="name">Điểm sinh:</label> <input type="text" value=""  name="si" required=""><br>
        <label for="name">Điểm tin:</label> <input type="text" value="" name="ti" required=""><br>
        <label for="name">Điểm sử:</label> <input type="text" value=""  name="s" required=""><br>
        <label for="name">Điểm địa:</label> <input type="text" value="" name="d" required=""><br>
        <label for="name">Điểm gdcd:</label> <input type="text" value="" name="cd" required=""><br>
        <label for="name">Điểm công nghệ:</label> <input type="text" value="" name="cn" required=""><br>
        <label for="name">Điểm gdqp:</label> <input type="text" value=""  name="qp" required=""><br>
        <label for="name">Điểm thể dục:</label> <input type="text" value="" name="td" required=""><br>
        <label for="name">Điểm tbcm:</label> <input type="text" value=""  name="tbcm" required=""><br>
        <label for="name">Hạnh kiểm:</label> <input type="text" value=""  name="hanhkiem" required=""><br>
        <label for="name">Xếp loại:</label> <input type="text" value="" name="xl" required=""><br>
         <input type="hidden" value="" id="hk_add" name="hk">
         
         <input type="hidden" value="add_diem" name="act">
         <input type="hidden" name="lop" value="<?php echo $lop;?>">
         <button class="btn" style="background:#4CAF50;color:white">Cập nhật</button>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <div class="setting" style="display:none;background:#fafafb;border:solid 1px #017ebe;margin-top:25px;" >
                                    <center><h2>Cài đặt
                                    </h2></center>
                                    <script>
                                        if('<?php echo $_GET[page]?>'=='setting'){
                                            $("html, body").animate({ scrollTop: $('#setting').offset().top }, 1000);
                                        }
                                    </script>
                                    <div style="margin-left:15px;margin-right:15px;margin-bottom:15px;" id="seting">
                                        <form action="./req.php" method="post">
                                        <label for="email">Email:</label>
                                    <input type="email" name="email" value="<?php echo $user[0][email];?>" required>
                                    <input type="hidden" name="email_cu" value="<?php echo $user[0][email];?>">
                                    
                                    <label for="password" style="margin-top:10px;">Mật Khẩu:</label>
                                    <input id="o_pwd" type="password" name="password" style="font-size:20px;" value="<?php echo $user[0][password];?>" required>
                                    <input type="hidden" name="password_cu" value="<?php echo $user[0][password];?>">
                                    Hiển thị mật khẩu:<input type="checkbox" id="showpass" onclick="passshow();"><br>
                                    <label for="tintuc_truong" style="margin-top:20px;">Nhận tin tức từ bảng tin trường:</label>
                                    <input type="checkbox" name="tintuc_truong" id="tintuc_truong"><br>
                                    <label for="tintuc_lop" style="margin-top:20px;">Nhận tin tức từ bài viết trong nhóm lớp <?php echo explode('_',$lop)[0].'/'.explode('_',$lop)[1]; ?> : </label>
                                    <input type="checkbox" name="tintuc_lop" id="tintuc_lop"><br>
                                    <div class="errorsetting"></div>
                                    <input type="hidden" name="act" value="update_info">
                                    <button type="submit" class="btn" style="font-size:15px;background:#4CAF50;color:white">Lưu thay đổi</button>
                                    <p class="btn" style="float:right;color:red;height:34.8px;border:solid 2px red;" onclick="window.location='./logout.php';" >Đăng xuất hệ thống</p>
                                    <script>
                                        if('<?php echo $user[0][tintuc_truong]?>'=='on'){
                                            $('#tintuc_truong').attr('checked','checked');
                                        }
                                        if('<?php echo $user[0][tintuc_lop]?>'=='on'){
                                            $('#tintuc_lop').attr('checked','checked');
                                        }
                                        if('<?php echo $_GET[error]?>'=='0'){
                                            $('.errorsetting').html('<div class="alert alert-success"><strong>Thành công!</strong> Cập nhật thông tin thành công.</div>');
                                        }else if('<?php echo $_GET[error]?>'=='email_used'){
                                             $('.errorsetting').html('<div class="alert alert-danger"><strong>Lỗi!</strong> Địa chỉ Email đã được sử dụng cho một tài khoản khác.</div>');
                                        }
                                        function passshow(){ 
                                            
                                            if($('#showpass').val()=='on' && $('#o_pwd').attr('type')!=='text'){
                                                $('#o_pwd').attr('type','text');
                                            }else if($('#o_pwd').attr('type')=='text'){
                                                $('#o_pwd').attr('type','password');
                                            }
                                        }    
                                    </script>
                                    </form>
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                   
                   
                   
                   <?php }else{ ?>
                   
                   <?php } ?>
                  
                                        <div class="col-md-4">
                                       
                    <?php 
                      $qsght = $all->query("SELECT * FROM `qsght` ORDER BY id DESC  LIMIT 10");
                    ?>
                    <div class="allques" style="box-shadow: 2px 2px 2px 2px #666;margin-bottom: 25px;">
                       <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;background:#017ebe;color: white;margin-top: 25px;"><center>Góc học tập</center></button>
                       <div id="ques" style="overflow: hidden;" >
                          
                           <?php
                              for($i=0;$i<count($qsght);$i++){
                                if($i==0) echo'<li style="margin-top: 16px;width;100%"><i class="fas fa-angle-double-right"></i><a target="_blank" href="./gochoctap/?idquestion='.$qsght[$i][id_question].'">'.substr($qsght[$i][title], 0,40).'...</a></li> <hr>'; 
                                  else echo '<li><i class="fas fa-angle-double-right" style="width;100%;"></i><a target="_blank" href="./gochoctap/?idquestion='.$qsght[$i][id_question].'">'.substr($qsght[$i][title], 0,40).'...</a></li> <hr>';
                              }
                           ?>
                           <li style="width: 100%"><button class="btn"  style="width: 100%;margin: 0 auto;background: #017ebe;"><a target="_blank" href="./gochoctap" style="display: inline-block;width: 100%;line-height:34px;text-decoration: none;color:white;"><i class="fas fa-align-justify"></i> Xem thêm câu hỏi mới</a></button></li> 
                       </div>
                   </div>
                   



                
                                      
                                      </div>
                                      </div>
                                      
               </div>
           
      </div></div>

        <script>
            
        <?php
            
            if($user[0][mess_id]==''){
                echo '$(window).on("load",function(){
        $("#myModal").modal("show");
    });';
            }
             ?>
            $(document).ready(function(){
                $("#upmess").click(function(){
                    var x= setInterval(function(){
                        $.ajax({
                            method:'get',
                            url:'./req.php?act=checkmess&id_user=<?php echo $id_user;?>',
                            success: function(req){
                                if(req.indexOf('OK')>=0){
                                    $(".notimess").html('<div class="alert alert-success"><strong>Thành công</strong> Cập nhật thành công.</div>');
                                    clearInterval(x);
                                }
                            }
                        
                        });
                    }, 3000);
                });
                $(".upmess").click(function(){
                    var x= setInterval(function(){
                        $.ajax({
                            method:'get',
                            url:'./req.php?act=checkmess&id_user=<?php echo $id_user;?>',
                            success: function(req){
                                if(req.indexOf('OK')>=0){
                                    $(".notimess").html('<div class="alert alert-success"><strong>Thành công</strong> Cập nhật thành công.</div>');
                                    clearInterval(x);
                                }
                            }
                        
                        });
                    }, 3000);
                });
                var curent = '<?php echo $_GET[page];?>';
                if(curent=='member'){
                                        $("#thanhvien").css('background','#017ebe');
                    $(".thanhvien").css('display','block');
                    if('<?php echo $_GET[success]?>'!==''){
                         $("html, body").animate({ scrollTop: $('#member<?php echo $_GET[success];?>').offset().top }, 1000);
                        $('#member<?php echo $_GET[success];?>').css('background','#ddd');
                        setTimeout(function(){ $('#member<?php echo $_GET[success];?>').css('background','#fafafb'); }, 3000);
                    }else{
                         $("html, body").animate({ scrollTop: $('#member<?php echo $login;?>').offset().top }, 1000);
                         $('#member<?php echo $login;?>').css('background','#ddd');
                         setTimeout(function(){ $('#member<?php echo $login;?>').css('background','#fafafb'); }, 3000);
                    }
                    if('<?php echo $_GET[failed]?>'=='used'){
                        alert("Thất bại! Thông tin đã được sử dụng cho tài khoản khác");
                    }
                    
                }
                else if(curent=='search_point'){
                                        $("#tracuudiem").css('background','#017ebe');
                    $(".tracuu").css('display','block');
                    if('<?php echo $_GET[success]?>'!==''){
                      $("html, body").animate({ scrollTop: $('#tr_<?php echo $_GET[success];?>').offset().top }, 1000);
                        $('#tr_<?php echo $_GET[success];?>').css('background','#ddd');
                        setTimeout(function(){ $('#tr_<?php echo $_GET[success];?>').css('background','#fafafb'); }, 3000);
                    }else if('<?php echo $_GET[error]?>'=='1'){
                      alert('Lỗi! Học sinh này đã được thêm điểm trước đó');

                    }
                }
                else if(curent=='setting'){
                                        $("#setting").css('background','#017ebe');
                    $(".setting").css('display','block');

                }else{
                                        $("#thaoluan").css('background','#017ebe');
                    $(".postbai").css('display','block');

                }
                var scrolltox = '<?php echo $_GET[idscroll];?>';
                if(scrolltox!==''){
                    $("html, body").animate({ scrollTop: $('.post<?php echo $_GET[idscroll];?>').offset().top }, 1000);
                }
            });
           
        </script>
          <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '154864741877144',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/vi_VN/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
        

    
<<div class="fb-customerchat" page_id="625619247828076" logged_in_greeting="Xin chào, chúng tôi có thể giúp gì cho bạn?"
 logged_out_greeting="Xin chào, chúng tôi có thể giúp gì cho bạn?">
</div>
    </body>
</html>