<?php
error_reporting(0);
session_start();
if(isset($_SESSION[login])){
    $login = 1;

}
include('./controller.php');
$all = new mys();
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
        <script src="./bootstrap/js/jquery.js"></script>
        <script src="./bootstrap/js/wow.js"></script>
        <link rel="shortcut icon" type="image/png" href="./icon.png"/>
        <style>
            *{
                margin: 0;
                padding: 0px 1px;
                box-sizing: border-box;
                font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
                
            }
            button{
              color:white;
            }
           li{
                            display: block;
                            margin: 0 auto; 
                            text-align: center;

                          }
            input[name=email],input[name=password]{
                height: 40px;
                display: inline-block;
                width: 100%;
                border: solid #017ebe 1.5px;
                font-family: cursive;
                border-radius: 5px;
                
            }
            input[type=text]{
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

            #itemx{
              opacity: 1;
              transition-duration: 0.5s;
            }
            #itemx{
              margin: 5px auto;

            }
            #itemx:hover{
              box-shadow: 5px 5px 5px #666;
            }
            #itemx:hover #imgx{
                margin-right: 100px;
                transform: rotate(-360deg);
               transition: 1s;

            }
            #itemx:hover p{
                font-size: 15px;
                 text-shadow: 0.5px 0.5px 0.5px #666;
            }
            #itemx:hover h4{
                font-size: 19px;
                 text-shadow: 0.5px 0.5px 0.5px #666;
            }
            #home{
              background: #017ebe;
            }
            #hoidap{
               background: #017ebe;
            }
            #nhomlop{
               background: #017ebe;
            }
                        #home:hover{
                          background: #563d7c;
                        }
                         #hoidap:hover{
                          background: #563d7c;
                        }
                         #nhomlop:hover{
                          background: #563d7c;
                        }
               #btnthaydoi{
                font-size: 22px;
               }   
               
        </style>
    </head>
    <body>
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
        

    
<div class="fb-customerchat" page_id="625619247828076" logged_in_greeting="Xin chào, chúng tôi có thể giúp gì cho bạn?"
 logged_out_greeting="Xin chào, chúng tôi có thể giúp gì cho bạn?">
</div>
           <div class="row">
               <div class="col-md-12" style="margin-top: 5px;">
                
                      <div><button   style="display: inline-block;height: 50px; width: 75%;background: #017ebe;color: white;border: none;border-radius: 0.5px;"><center id="btnthaydoi" style="display: inline-block;width: 100%;float: left;" class="animated pulse" ><marquee behavior="ALTERNATE" direction="left" >WEBSITE TRAO ĐỔI, HỌC TẬP GIỮA NHÀ TRƯỜNG, PHỤ HUYNH VÀ HỌC SINH THPT ÔNG ÍCH KHIÊM </marquee> 
                        </center>
                        <style>
                          a{
                            display: inline-block;
                           
                            color: #017ebe;
                            margin: auto 12px;

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
                            font-size: 19px;
                          }
                        }
                        @media screen and (max-width:1348px)  {
                          
                          #btnthaydoi{
                            font-size: 12px;
                          }
                        }
                        @media screen and (max-width: 991px){
                          #fltor{
                            float: right;
                          }

                        }

                        body:hover .fa-exchange-alt{
                          transform: rotate(-360000deg);transition-duration: 1000s;
                        }
                        body:hover .fa-angle-double-right{
                           transform: rotate(-360000deg);transition-duration: 1000s;
                        }
                        #itemx{

                        }
                        </style>
                        </button>
                        
                        <ul  style="text-align: center;display: inline-block;height: 50px;float: right;width:25%;border-bottom: solid 3px #017ebe">
                          <div class="row">
                            <div class="col-md-4 animated rotateIn" ><a href="http://messenger.com/t/thpt.oik14/" target="_blank" class="fab fa-facebook-messenger" style="text-decoration: none; font-size: 45px;;display: block;"></a></div>
                            <div class="col-md-4 animated rotateIn" id="iconphu"><a href="https://youtube.com" target="_blank" class="fab fa-youtube" style="text-decoration: none;color: red ;font-size: 45px;;display: block;"></a></div>
                            <div class="col-md-4 animated rotateIn" id="iconphu"> <a href="http://twitter.com/" target="_blank" class="fab fa-twitter" style="text-decoration: none; font-size: 45px;display: block;"></a></div>
                          </div>
                          
                          
                         
                      
                        
                        </ul>
                    
                      
                      </div>
                   
               </div>
               <div class="col-md-12" style="margin-top: 25px;text-align: center;">
                
                <div class="gioithieu animated shake" style="margin: 5px auto; width: 70%;display: none;"><script>

                  
                    $('.gioithieu').fadeIn(1500);
                  
                </script>
                   <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size:25px;border-bottom: solid 2px #017ebe; ">HOME <i class="fas fa-exchange-alt"></i> SCHOOL</font></font></h4>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Website tiện ích cho nhà trường và phụ huynh và học sinh.Phụ huynh sẽ được nhận thông báo định kì về các thông báo điểm của học sinh.Giáo viên chủ nhiệm có thể dễ dàng quản lí học sinh,điểm số và gửi thông báo đến học sinh cũng như phụ huynh.Tạo môi trường tương tác giữa giáo viên,phụ huynh, học sinh và nhà trường thông qua các nhóm lớp được tạo sẵn cho từng lớp.Góc học tập nơi học sinh có thể đăng lên các câu hỏi về bài tập liên quan được phân loại theo các môn, các lớp.</font></font></p>
                </div>
               <div class="col-md-6 col-lg-4 animated flipInX" id="itemx"  style="">
                  <center><img src="img/s1.png" id="imgx" alt="" class=""></center>
                   
                   <h4><font style="vertical-align: inherit;border-bottom: solid 2px #017ebe;"><font style="vertical-align: inherit;">TRAO ĐỔI THÔNG TIN ĐA CHIỀU</font></font></h4>
                   <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Website trao đổi thông tin giữa nhà trường và gia đình, cũng như thuận tiện cho việc học tập của học sinh</font></font></p>
                </div> <!-- ITEM END -->

                <div class="col-md-6 col-lg-4 animated flipInX" id="itemx"  style="">
                  <center><img src="img/s2.png" id="imgx" alt="" class=""></center>
                   
                   <h4><font style="vertical-align: inherit;border-bottom: solid 2px #017ebe;"><font style="vertical-align: inherit;">ĐỔI MỚI TRONG CÁCH LIÊN LẠC</font></font></h4>
                   <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Các thành viên tham gia có thể nhận được thông báo qua các thiết bị smartphone thông qua Messenger và Email</font></font></p>
                </div> <!-- ITEM END -->
                <div class="col-md-6 col-lg-4 animated flipInX" id="itemx"  style="">
                  <center><img src="img/s3.png" id="imgx" alt="" class=""></center>
                   
                   <h4><font style="vertical-align: inherit;border-bottom: solid 2px #017ebe;"><font style="vertical-align: inherit;">CẬP NHẬT NHANH CHÓNG</font></font></h4>
                   <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Giúp các quý phụ huynh, học sinh có thể nắm bắt được các hoạt động, tin tức cũng như các thông báo từ trường.</font></font></p>
                </div> <!-- ITEM END -->

              <script>
                
              </script>
        </div>


        

               <div class="col-md-12" style="margin-top: 50px;transition-delay: 5s; ">
                  
                        
                        
                       
                       <div class="row">
                         <div class="col-md-3"><button id="home" style="display: inline-block;width:105%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white; "><center><i class="fas fa-home"></i><a href="./" style="display:inline-block;line-height:50px;text-decoration:none;color:white;"> 
Trang chủ</a></center></button></div>
                          <div class="col-md-3"><button id="hoidap" style="display: inline-block;width:105%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;"><center><i class="far fa-question-circle"></i><a href="?page=hoidap" style="display:inline-block;line-height:50px;text-decoration:none;color:white;">Hỏi đáp</a></center></button></div>
                           <div class="col-md-3"><button id="nhomlop" style="display: inline-block;width:105%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;"><center><i class="far fa-object-group"></i><a href="./home.php" style="display:inline-block;line-height:50px;text-decoration:none;color:white;;">Nhóm lớp</a></center></button></div>
                            <div class="col-md-3"> <button id="nhomlop" style="display: inline-block;width:105%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;margin-bottom: 10px;"><center><i class="fas fa-graduation-cap"></i><a href="./gochoctap" style="display:inline-block;line-height:50px;text-decoration:none;color:white;">Góc học tập</a></center></button></div>
                       </div>
                   <div class="col-xs-12 col-md-3" style="" id="fltor">
                    <?php 
                      $newques = $all->query("SELECT * FROM `questions` ORDER BY id DESC  LIMIT 10");
                    ?>
                    <div class="allques" style="box-shadow: 2px 2px 2px 2px #666;margin-bottom: 25px;">
                       <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;background:#017ebe"><center>Hỏi đáp mới</center></button>
                       <div id="ques" style="overflow: hidden;" >
                          
                           <?php
                              for($i=0;$i<count($newques);$i++){
                                if($i==0) echo'<li style="margin-top: 16px"><i class="fas fa-angle-double-right"></i><a href="./index.php?idquestion='.$newques[$i][id_question].'">'.substr($newques[$i][title], 0,40).'...</a></li> <hr>'; 
                                  else echo '<li><i class="fas fa-angle-double-right" style=""></i><a href="./index.php?idquestion='.$newques[$i][id_question].'">'.substr($newques[$i][title], 0,40).'...</a></li> <hr>';
                              }
                           ?>
                           <li style="width: 100%"><button class="btn"  style="width: 100%;margin: 0 auto;background: #017ebe;"><a href="./index.php?page=hoidap" style="display: inline-block;width: 100%;line-height:34px;text-decoration: none;color:white;"><i class="fas fa-align-justify"></i> Xem thêm câu hỏi mới</a></button></li> 
                       </div>
                   </div>
                   <div class="gallery" style="box-shadow: 2px 2px 2px 2px #666;">
                    <style>
                      .imgex{
                        display: inline-block;
                        width: 32.5%;
                        margin:5px 0px;
                        height: 102px;
                        position: relative;
                      }
                      .imgex>img{
                          
                         height: 100%;
                         width: 100%;
                         display: inline-block;
                         position: absolute;
                      }
                      
                      .imgex{
                        transition-duration: 2s;
                      }
                      .imgex:hover img{
                        display: block;
                       
                        bottom:105%;
                        position: absolute;
                        left: 105%;
                        height: 400px;
                        width: 700px;
                        border-radius: 10px;
                        box-shadow: 10px 10px 10px #666;
                        z-index: 100000;
                        transition-duration: 1s;

                      }
                      
                      
                      
                      
                    </style>
                   <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;margin: 15px 0px;background: #017ebe"><center><i class="fas fa-images" style="color: #a5d950"> </i>Hình ảnh hoạt động</center></button>
                     <div style="width: 100%;margin:5px auto;">

<marquee id="marq" scrollamount="8" direction="up" loop="50" scrolldelay="-10" onmouseover="this.stop()" onmouseout="this.start()" style="height: 300px;width: 100%">

<a href="#" >
                       <img  src="./images/209643.jpg" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id2.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </div></a>
                     <a href="#">
                       <img  src="./img/id3.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id4.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id5.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id6.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id7.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id8.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>
                     <a href="#">
                       <img  src="./img/id9.png" alt="" id="main1" style="width: 100%;margin-bottom: 10px;border-radius: 4px;">
                       
                     </a>



</marquee>


                       
                    
                     
                     </div>
                   </div>



                 </div>
                   <div class="col-xs-12 col-md-9" style="float: left;">
                     <!-- <button id="home" style="display: inline-block;width: 24.5%;height:50px;border: none;font-size: 20px; "><center><i class="fas fa-home"></i><a href="./" style="display:inline-block;line-height:50px;text-decoration:none;color:white;"> 
Trang chủ</a></center></button>
                        <button id="hoidap" style="display: inline-block;width: 24.5%;height:50px;border: none;font-size: 20px;"><center><i class="far fa-question-circle"></i><a href="?page=hoidap" style="display:inline-block;line-height:50px;text-decoration:none;color:white;">Hỏi đáp</a></center></button>
                        <button id="nhomlop" style="margin-bottom: 20px;display: inline-block;width: 24.5%;height:50px;border: none;font-size: 20px;"><center><i class="far fa-object-group"></i><a href="./home.php" style="display:inline-block;line-height:50px;text-decoration:none;color:white;;">Nhóm lớp</a></center></button>
                        <button id="nhomlop" style="margin-bottom: 20px;display: inline-block;width: 24.5%;height:50px;border: none;font-size: 20px;"><center><i class="fas fa-graduation-cap"></i><a href="./gochoctap" style="display:inline-block;line-height:50px;text-decoration:none;color:white;;">Góc học tập</a></center></button>
                        -->
                   
                    
                    <div class="col-xs-12 col-md-8" id="logined">
                                <?php
                    if($login==1){?>
                      
                     
                      


                    <?php }
                    ?>
                    <?php
                    if(!isset($_GET['idquestion']) && $_GET['page']!=='hoidap'){
                      

                          ?>

                        <button style="display: block;width: 100%;height:50px;border: none;border-radius: 5px;font-size: 20px;background: #00a99d;clip-path: polygon(0 0, 100% 0, 83% 100%, 0% 100%);"><center>Tin Tức Và Thông Báo </center></button>
                        <div class="baiviet">
                      <div class="notinew" style="margin-top: 15px;font-size: 15px;width: 100%;display: inline-block;">
                        <?php $posts = $all->query("select * from adminposts ORDER BY id DESC limit 10");?>
                   <marquee behavior="" direction="" style="display: inline-block; ">Mới nhất: <a href="#" onclick="scrtopost();"><b ><?php echo $posts[0][title];?></b></a>
                    <script>
                      function scrtopost(){
                        $("html, body").animate({ scrollTop: $('#post0').offset().top }, 1000);
                      }
                    </script>
                   </marquee>

                            <?php 
                            for($i=0;$i<count($posts);$i++){
                              extract($posts[$i]);
                              if($type=='1'){?>
                              <div class="post" id="post<?php echo $i;?>" style="margin: 10px auto; width: 100%;font-size: 17px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 10px 5px;border-radius: 5px">
                               <h2>
                                <p style="border-bottom: solid 1.5px #017ebe;background:#017ebe;clip-path: polygon(100% 0, 97% 49%, 100% 99%, 0% 100%, 3% 49%, 0% 0%);"><a href="#" style="text-align: center;width: 100%;color: white"><i class="far fa-bell"></i> Thông báo</a></p>
                          
                                        
                              <?php

                            }else{
                              ?>
                                
                            <div class="post" id="post<?php echo $i;?>" style="margin: 10px auto; width: 100%;font-size: 17px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 10px 5px;border-radius: 5px">
                               <h2>
                                <p style="border-bottom: solid 1.5px #017ebe;background:red;clip-path: polygon(100% 0, 97% 49%, 100% 99%, 0% 100%, 3% 49%, 0% 0%);"><a href="#" style="text-align: center;width: 100%;color: white"><i class="fas fa-newspaper"></i> Tin tức </a></p>
                          
                                        
                              <?php
                            }?>
                            <img id="imgpost" src="<?php echo $image;?>" alt="" style="width:100%;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;" height="300px">
                                        
                      </h2>                                      
                                <span class="glyphicon glyphicon-time"></span><?php echo $create_at;?>|Đăng bởi Đoàn trường <br> <a href="#link" style=""><?php
                                  echo $title;
                                ?></a><hr>
                                <button class="btn" style="background: rgb(86, 61, 124);color: white" onclick="showcontent('<?php echo $i?>')">Xem thêm</a></button>
                                <div  style="padding: 7px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);margin-top: 10px;font-size: 15px;display: none;border-radius: 4px" id="postct<?php echo $i?>">
                                  <i style="font-size: 15px;"><span class="glyphicon glyphicon-time"></span><?php echo $create_at;?>:<b><?php echo $title;?></b></i><hr>
                                  <p style="margin-top: 10px;"><?php echo $content;?></p>
                                  <p style="margin-bottom: 10px;display: inline-block;">Tác giả: Quản trị viên</p>
                                </div>
                            </div>
                            <?php
                            }?>
                            <script>
                              function showcontent(id){
                                
                                $('#postct'+id).css('display','block');
                                 $("html, body").animate({ scrollTop: $('#postct'+id).offset().top }, 1000);

                              }
                              if('<?php echo $_GET[idpost]?>'!==''){
                                $("html, body").animate({ scrollTop: $('#post<?php echo $_GET[idpost]?>').offset().top }, 1000);
                                $('#post<?php echo $_GET[idpost]?>').css('border','solid 2px green');
                              }
                            </script>
                            <style>
                              #imgpost:hover{
                                box-shadow: 2px 2px 2px #666;
                              }
                            </style>
                        </div>
                        
                    </div>
</div>
                      
                      <?php
                    }elseif($_GET['idquestion'] || $_GET[page]=='hoidap' ){?>
                      
                    <script>
                      $('#hoidap').css('background','#563d7c');
                    </script>
                    
                        <div class="hoidap" style="box-shadow: 2px 2px 2px 2px #666;">
                       <?php if($login){?>
                        <div class="postques" style="margin:15px 10px;padding: 7px;">
                          <label for="" style="font-size: 17px;" ><u>Gửi câu hỏi mới:</u></label>
                            <form action="./req.php" method="post">
                              <label for="">Tiêu đề:</label>
                              <input type="text" name="title" style="margin-bottom: 10px;font-size: 16px;" required=""><br>
                              <label for="">Nội dung:</label><br>
                              <textarea name="content" id=""  rows="7" style="font-size: 16px;border:solid 1.5px #017ebe;overflow:hidden; width:100%;display:block;" required=""></textarea><br>
                              <input type="hidden" name="act" value="send_question">
                              <input type="hidden" name="name" value="<?php echo $_SESSION[name]?>">
                              <input type="hidden" name="id_user" value="<?php echo $_SESSION[login]?>">
                              <button class="btn" style="color:white;background:#563d7c ">Gửi câu hỏi</button>
                            </form>
                        </div>
                       <?php }else{?>
                       <div class="alert alert-info"><i class="fas fa-exclamation-circle"></i>
  <strong><u> Thông báo:</u> </strong><label for="" > Bạn cần đăng nhập để gửi câu hỏi mới.</label>
</div> 
                       <?php }?>
                        <div class="questions" style="padding: 5px;">
                        <button style="font-size: 17px;color: white;background: #017ebe;width: 80%;display: block;clip-path: polygon(0% 0%, 96% 0, 100% 50%, 96% 100%, 0% 100%);margin:5px auto;" class="btn"><u>Câu hỏi mới:</u></button>
                          <?php
                            
                              $qts= $all->query("select * from questions order by id desc limit 25");
                            
                            for($i=0;$i<count($qts);$i++){
                              extract($qts[$i]);
                          ?>
                          <div class="ques<?php echo $id_question;?>" style="border: solid 2px white;padding: 7px;margin: 10px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                              <label for="name"><span class="glyphicon glyphicon-time"></span> <?php echo $create_at;?>: <?php echo $who;?> đã đăng một câu hỏi</label><?php if($is_rep=='1') echo'<button class="btn" style="background: white;color:black"><i style="color: green" class="far fa-check-circle"></i> Đã được trả lời</button>'; else echo'<button class="btn" style="background: white;color:black"><i style="color: red" class="far fa-times-circle"></i> Chưa được trả lời</button>'?><br>
                              <label for="">Tiêu đề: </label><i><?php echo $title;?></i><br>
                              <label for="">Nội dung câu hỏi:</label><i><?php echo $noidung;?></i><br>
                              <hr>
                               <label for="tl"><u>Câu trả lời</u>:</label>
                               <div class="reply" style="margin-bottom: 15px;">
                                 <?php
                                 $reply= json_decode(urldecode($reply),true);
                                 for($k=count($reply)-1;$k>=0;$k--){
                                  ?>
                                  <div class="cautl" style="padding: 5px 15px;border: solid 2px white;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                                   <label for="name"><?php echo $reply[$k][who]?>:</label>
                                   <i><?php echo $reply[$k][content]?></i>
                                 </div>
                                  <?php
                                 }

                                 ?>
                               </div>
                               
                             <?php if($_SESSION[type]==3 || $_SESSION[type]==4 ){
                              echo '<form action="./req.php" method="post"><textarea name="reply" id="" rows="2" style="overflow:hidden; width:100%;display:block;" required></textarea><br>
                                    <input type="hidden" name="id_question" value="'.$id_question.'">
                                    <input type="hidden" name="name" value="'.$_SESSION[name].'">
                                    <input type="hidden" name="act" value="reply_question"> 
                              <button class="btn" style="color:white;background:#563d7c;margin-top:2px;padding:0px 10px;float:right">Trả lời</button><br></form>';
                             }?>
                          </div>
                          <?php }?>

                           <script>
                             if('<?php echo $_GET[idquestion] ?>' !==''){
                                $('.ques<?php echo $_GET[idquestion] ?>').css('border','solid 2px green');
                                 $("html, body").animate({ scrollTop: $('.ques<?php echo $_GET[idquestion] ?>').offset().top }, 1500);
                             }
                           </script>
                        </div>
                    </div>




                    <?php }
                    if(!$_GET[idquestion] && !$_GET[page]){
                      ?>
                       <script>
                      $('#home').css('background','#563d7c');

                    </script>
                    
                    <?php };
                    if($_GET[page] || $_GET[idquestion]) echo '</div>';
                    if(!$login) echo '<div class="col-md-4" id="btnlogin">
                     <button style="display: block;width: 100%;height:50px;border: none;border-radius: 5px;font-size: 20px;background: #00a99d;clip-path: polygon(31% 0, 100% 0, 100% 100%, 0% 100%);" ><center>Khu vực thành viên</center></button>
                        <div class="login" style="margin: 7px auto;">
                            <form action="home.php" method="post">
                               <center>
                                <img src="./img/login.png" width="30%">
                               </center>
                                <label for="email">Email:</label>
                                <input type="text" name="email" placeholder="   Email đăng nhập" required>
                                <label for="password">Mật Khẩu:</label>
                                <input type="password" name="password" placeholder="   Mật khẩu đăng nhập" required>
                                <center><button id="loginbtnx" style="display: inline-block;margin: auto 10px; border: solid #017ebe 1.5px;border-radius: 5px;height: 40px;padding:5px;"><i class="fas fa-sign-in-alt"></i> Đăng nhập hệ thống</button></center>
                                <a href="./forgot.php" style="display: block;width: 100%;text-align: right">Quên Mật Khẩu ?</a>
                            </form>
                        </div>
                    </div>';
                    else echo '';
                    ?>
                    <div class="col-md-4" id="btnlogin">
                     <button style="display: block;width: 100%;height:50px;border: none;border-radius: 5px;font-size: 20px;background: #00a99d;clip-path: polygon(31% 0, 100% 0, 100% 100%, 0% 100%);" ><center>Thông tin hoạt động</center></button>
                                            
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
                    <style> 
                    #loginbtnx{
                      color: white;
                      background: #017ebe;
                    }
                    #loginbtnx:hover{
                      font-size: 16px;
                      transition-duration:0.8s; 
                    }
                  </style>
                   </div>
               </div>
           </div></div>
        <script>
          $(document).ready(function(){
            if('<?php echo $_GET[error];?>'=='1'){
              alert('Lỗi Đăng Nhập!');
            }
           
          });
        </script>
        <div class="col-md-12" style="margin-top: 50px;">
          <footer>
            <div style="background: black;color:white;text-align: center;text-decoration: none;width: 100%;">Thiết kế bởi <a href="https://www.facebook.com/devv.systems" target="_blank">Nguyễn Hoàng Vũ</a></div>
          </footer>
        </div>
    </body>
</html>