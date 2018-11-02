
<?php
error_reporting(0);
session_start();
if(isset($_SESSION[login])){
    $login = 1;

}
include('../controller.php');
$all = new mys();
extract($_SESSION);
?>
   <html>
    <head>
          <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Trao đổi trực tuyến THPT Ông Ích Khiêm</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link rel="stylesheet" href="../bootstrap/css/fontawesome-all.min.css">
		<link rel="stylesheet" href="../bootstrap/css/animation.css">
		<link rel="stylesheet" href="../bootstrap/js/bootstrap.js">
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/wow.js"></script>
        <link rel="shortcut icon" type="image/png" href="../icon.png"/>
        <style>
            *{
                margin: 0;
                padding: 0px 0px;
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
            .btnxxx{
            	background:  #017ebe;
            }
           .btnxxx:hover{
            	background:#563d7c;
            }
               #btnthaydoi{
                font-size: 22px;
               }  
               body:hover .fa-align-justify{
                           transform: rotate(-360000deg);transition-duration: 1000s;
                        } 
               
        </style>
    </head>
    
    <body style="position: relative;">
    	<?php if($login){?>
   <button class="btn" style="position: fixed;bottom: 0%;right: 10%;background: #34495e;color: white;z-index: 10" onclick="document.getElementById('chatboxx').style.display='block';document.getElementById('openchat').style.display='none';"" id="openchat"><i class="fa fa-circle text-green" ></i>Chat room: Góc học tập</button>
    <div class="container bootstrap snippet" style="position: fixed;bottom: -1%;right: -20%;z-index: 100;display: none" id="chatboxx">
    <div class="row" >
        <div class="col-md-4 col-md-offset-4" >
            <div class="portlet portlet-default" style="border-radius: 5px;">
                <div class="portlet-heading" id="head" onclick="document.getElementById('chatboxx').style.display='none';document.getElementById('openchat').style.display='block';">
                    <div class="portlet-title"  >

                        <h4><i class="fa fa-circle text-green" ></i> Chat room: Góc học tập</h4>

                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <div id="chat" class="panel-collapse collapse in">
                    <div>
                    <div class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;" id="scrollchat">
                        <?php 
                          $chat = $all->query("select chatlist from  chatbox where lop='ght'");
                          $chat = json_decode(urldecode($chat[0][chatlist]),true);
                          for($i=0;$i<100;$i++){
                          	if(!$chat[$i]) break;
                            extract($chat[$i]);
                        ?>
                           <div class="row">
                            <div class="col-lg-12" style="border-bottom: dotted 1px black; ">
                                <div class="media">
                                    
                                       
                                    <div class="media-body">
                                        <p class="media-heading"><b><?php echo $who;?>:</b></p>
                                           
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
                            url: '../req.php?act=get_message&finalid='+finalid+'&lop=ght',
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
                                  url:'../req.php?act=send_chat&message='+message+'&who=<?php echo $name;?>&lop=ght',
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
<?php }?>    

































           <div class="row">
               <div class="col-md-12" style="margin-top: 5px;">
                
                      <div><button  style="display: inline-block;height: 50px; width: 75%;background: #017ebe;color: white;border: none;border-radius: 0.5px;"><center id="btnthaydoi" style="display: inline-block;width: 100%;float: left;" class="animated pulse"><marquee behavior="ALTERNATE" direction="left" >WEBSITE TRAO ĐỔI, HỌC TẬP GIỮA NHÀ TRƯỜNG, PHỤ HUYNH VÀ HỌC SINH THPT ÔNG ÍCH KHIÊM </marquee>
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
                          #flt{
                          	float: none;
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
                        
                          #ques>li>ul{
									
									top:100%;
									left:-1000%;
									
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
                            <div class="col-md-4 animated rotateIn"><a href="http://messenger.com/t/thpt.oik14/" target="_blank" class="fab fa-facebook-messenger" style="text-decoration: none; font-size: 45px;;display: block;"></a></div>
                            <div class="col-md-4 animated rotateIn" id="iconphu"><a href="https://youtube.com" target="_blank" class="fab fa-youtube" style="text-decoration: none;color: red ;font-size: 45px;;display: block;"></a></div>
                            <div class="col-md-4 animated rotateIn" id="iconphu"> <a href="http://twitter.com/" target="_blank" class="fab fa-twitter" style="text-decoration: none; font-size: 45px;display: block;"></a></div>
                          </div>
                          
                          
                         
                      
                        
                        </ul>
                    
                      
                      </div>
                   
               </div>
               <div class="col-md-12" style="margin-top: 25px;text-align: center;">
                
                <div class="gioithieu  animated shake" style="margin: 5px auto; width: 70%;display: none;"><script>

                  
                    $('.gioithieu').fadeIn(1500);
                  
                </script>
                   <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size:25px;border-bottom: solid 2px #017ebe; ">GÓC HỌC TẬP <i class="fas fa-graduation-cap"></i></font></font></h4>
                   <h4><font>Cùng nhau học, cùng nhau tiến bộ !</font></h4>
                  	
                </div>
               

              <script>
                
              </script>
        </div>


        

               <div class="col-md-12" style="margin-top: 50px;transition-delay: 5s; ">
                  <div class="col-md-12">

                        
                        
                        <div class="row">
                        	<div class=" col-md-2">
						<button class="btnxxx" id="btnhome" style="display: inline-block;width: 102%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white; "><center><i class="fas fa-home"></i><a href="../" style="display:inline-block;line-height:50px;text-decoration:none;color:white;"> 
Trang chủ</a></center></button>
                  </div>
                  <div class="	col-md-2">
                  	<button class="btnxxx" id="btngroup" style="display: inline-block;width: 102%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white; "><center><i class="far fa-object-group"></i><a href="../home.php" style="display:inline-block;line-height:50px;text-decoration:none;color:white;"> 
Nhóm lớp</a></center></button>
                  </div>
                  <div class="	col-md-2">
                  	<button class="btnxxx" id="btnthaoluan" style="display: inline-block;width: 102%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white; "><center><i class="fab fa-discourse"></i><a href="./" style="display:inline-block;line-height:50px;text-decoration:none;color:white;"> 
Thảo luận</a></center></button>
                  </div>
                  <div class=" col-md-2">
                  	<button class="btnxxx" id="btnhoi" style="display: inline-block;width: 102%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;" ><center><i class="far fa-question-circle"></i><a href="./?area=cauhoi" style="display:inline-block;line-height:50px;text-decoration:none;color:white;">Câu hỏi</a></center></button>
                  </div>
                  <div class=" col-md-2">
                  	<button class="btnxxx" id="btnbg" style="display: inline-block;width: 102%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;" ><center><i class="fas fa-video"></i><a href="./?area=baigiang" style="display:inline-block;line-height:50px;text-decoration:none;color:white;">Bài giảng</a></center></button>
                  </div>
                  <div class=" col-md-2">
                  	<button class="btnxxx" id="btnbt" style="display: inline-block;width: 102%;height:50px;border: none;font-size: 20px;border-bottom: solid 1.5px white;" ><center><i class="fab fa-leanpub"></i><a href="./?area=baitap" style="display:inline-block;line-height:50px;text-decoration:none;color:white;">Bài tập</a></center></button>
                  </div>
                        </div>
                       <script>
                       	$(document).ready(function(){
                       		if('<?php echo $_GET[area]?>'==''){
                       			$('#btnthaoluan').css('background','#563d7c');
                       		}
                       		if('<?php echo $_GET[area]?>'=='baigiang'){
                       			$('#btnbg').css('background','#563d7c');
                       		}
                       		if('<?php echo $_GET[area]?>'=='baitap'){
                       			$('#btnbt').css('background','#563d7c');
                       		}
                       		if('<?php echo $_GET[area]?>'=='cauhoi'){
                       			$('#btnhoi').css('background','#563d7c');
                       		}
                       	});
                       </script>
                  	





                   <div class="col-xs-12 col-md-2" style="" id="fltor">
                  
                    <div class="allques" style="box-shadow: 2px 2px 2px 2px #666;margin-bottom: 25px;">
                       <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;background:#017ebe;color: white;margin-top: 25px;text-align: center"><center><a href="#" style="height: 50px;display: block;color: white;line-height: 50px;">Chọn Lớp</a></center></button>
                       <div id="ques" style="" >
                          
                           <li style="padding: 10px 0px;width:100%;position: relative;border-bottom: solid 1.5px #666"><i class="fas fa-angle-double-right"></i><a  href="#" style="text-decoration: none;">Lớp 10</a>
							<ul style="text-align: center;" id="hoverul">
								<li><a  href="./?type=toan_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Toán 10</a></li>
								<li><a  href="./?type=li_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Vật Lí 10</a></li>
								<li><a  href="./?type=hoa_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Hóa 10</a></li>
								<li><a  href="./?type=van_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Ngữ Văn 10</a></li>
								<li><a  href="./?type=anh_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Tiêng Anh 10</a></li>
								<li><a  href="./?type=sinh_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Sinh Học 10</a></li>
								<li><a  href="./?type=tin_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Tin Học 10</a></li>
								<li><a  href="./?type=su_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Lịch Sử10</a></li>
								<li><a  href="./?type=dia_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Địa Lí 10</a></li>
								<li><a  href="./?type=cd_10<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">GDCD 10</a></li>

							</ul>
                           </li>
                           <li style="padding: 10px 0px;width:100%;position: relative;border-bottom: solid 1.5px #666"><i class="fas fa-angle-double-right"></i><a  href="#" style="text-decoration: none;">Lớp 11</a>
							<ul style="text-align: center;" id="hoverul">
								<li><a  href="./?type=toan_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Toán 11</a></li>
								<li><a  href="./?type=li_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Vật Lí 11</a></li>
								<li><a  href="./?type=hoa_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Hóa 11</a></li>
								<li><a  href="./?type=van_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Ngữ Văn 11</a></li>
								<li><a  href="./?type=anh_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Tiêng Anh 11</a></li>
								<li><a  href="./?type=sinh_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Sinh Học 11</a></li>
								<li><a  href="./?type=tin_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Tin Học 11</a></li>
								<li><a  href="./?type=su_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Lịch Sử11</a></li>
								<li><a  href="./?type=dia_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Địa Lí 11</a></li>
								<li><a  href="./?type=cd_11<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">GDCD 11</a></li>

							</ul>
                           </li>
                           <li style="padding: 10px 0px;width:100%;position: relative;border-bottom: solid 1.5px #666"><i class="fas fa-angle-double-right"></i><a  href="#" style="text-decoration: none;">Lớp 12</a>
							<ul style="text-align: center;" id="hoverul">
								<li><a  href="./?type=toan_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Toán 12</a></li>
								<li><a  href="./?type=li_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Vật Lí 12</a></li>
								<li><a  href="./?type=hoa_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Hóa 12</a></li>
								<li><a  href="./?type=van_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Ngữ Văn 12</a></li>
								<li><a  href="./?type=anh_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Tiêng Anh 12</a></li>
								<li><a  href="./?type=sinh_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Sinh Học 12</a></li>
								<li><a  href="./?type=tin_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Tin Học 12</a></li>
								<li><a  href="./?type=su_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Lịch Sử12</a></li>
								<li><a  href="./?type=dia_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">Địa Lí 12</a></li>
								<li><a  href="./?type=cd_12<?php if($_GET[area]=='cauhoi') echo'&area=cauhoi'; elseif($_GET[area]=='baitap') echo '&area=baitap'; elseif($_GET[area]=='baigiang') echo '&area=baigiang';?>">GDCD 12</a></li>

							</ul>
                           </li>
                           <li style="padding: 10px 0px;width:100%;position: relative;border-bottom: solid 1.5px #666"><i class="fas fa-angle-double-right"></i><a  href="./" style="text-decoration: none;">Tất cả</a></li>
                          
                             <style>
                             #ques>li{
                             	height: 40px;


                             }
								#ques>li>ul{
									position: absolute;
									top:0%;
									left: 55%;
									opacity: 0
								}
                             	#ques>li ul li{
                             		display: block;
                             		background: white;
                             		color: black;
                             		height: 40px;
                             		margin-left: 50px;
                             		width: 100%;
                             		border-radius: 4px;
                             		border: solid 1px #666;
                             		
                             	}
                             	#ques>li>ul>li>a{
                             		line-height: 40px;
                             		color:black;
                             		text-align: center;
                             		display: block;
                             		text-decoration: none;
                             		
                             		
                             	}
                             	#ques>li:hover {
                             		background: #00a99d;
                             		display: block;
                             		
                             	}
                             	#ques>li:hover >a{
                             		color: white;
                             	}
                             	#ques>li:hover  #hoverul{

                             		z-index: 10;
                             		opacity: 1;
                             		transition-duration: 0.5s;

                             	}
                             	#ques>li ul li:hover{
                             		background: #00a99d;
                             		color: white;
                             	}
                             	#ques>li ul li:hover a{
                             		
                             		color: white;
                             	}
                             	 @media screen and (max-width: 991px){
                          
                          			#ques>li>ul{
									

								}

                        }
                             </style>
                            
                       </div>
                   </div>
					
                 </div>




                   <div class="col-xs-12 col-md-10" style="">
                    <div class="col-xs-12 col-md-3" id="flt">
                    	<?php 
                      $qsght = $all->query("SELECT * FROM `qsght` ORDER BY id DESC  LIMIT 10");
                    ?><div class="row">
                    	<div class="col-md-12">
                    		<div class="allques" style="box-shadow: 2px 2px 2px 2px #666;margin-bottom: 25px;">
                       <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;background:#017ebe;color: white;margin-top: 25px;"><center>Câu hỏi mới</center></button>
                       <div id="qsght" style="padding-bottom: 5px;" >
                          <style>
                          	#qsght>li{
                          		
                          		display: block;
                          		text-align: left;
                          		padding: 20px 0px;
                          	}
                          </style>
                           <?php
                              for($i=0;$i<count($qsght);$i++){
                                if($i==0) echo'<li style="width:100%;border-bottom: solid 1.5px #666""><i class="fas fa-angle-double-right"></i><a  href="../gochoctap/?idquestion='.$qsght[$i][id_question].'">'.substr($qsght[$i][title], 0,25).'...</a></li> '; 
                                  else echo '<li style="width:100%;border-bottom: solid 1.5px #666""><i class="fas fa-angle-double-right" ></i><a  href="../gochoctap/?idquestion='.$qsght[$i][id_question].'">'.substr($qsght[$i][title], 0,25).'...</a></li> ';
                              }
                           ?>
                            
                       </div>
                   </div>
                    	</div>
                    	<div class="col-md-12">
                    		<div class="allques" style="box-shadow: 2px 2px 2px 2px #666;margin-bottom: 25px;">
                       <button style="display: block;width: 100%;height: 50px;border: none; font-size: 20px;background:#017ebe;color: white;margin-top: 25px;"><center>Bài giảng mới</center></button>
                       <?php 
                      $bgm = $all->query("SELECT * FROM `baigiang` ORDER BY id DESC  LIMIT 10");
                    ?>
                       <div id="qsght" style="padding-bottom: 5px;" >
                          <style>
                          	#qsght>li{
                          		display: block;
                          		height: 30px;
                          		padding: 20px 5px;
                          		text-align: left;
                          		overflow: hidden;
                          	}
                          </style>
                          
								<?php
                              for($i=0;$i<count($bgm);$i++){
                                if($i==0) echo'<li style="width:100%;border-bottom: solid 1.5px #666;white-space: nowrap;""><i class="fas fa-angle-double-right"></i><a  href="../gochoctap/?idvideo='.$bgm[$i][id_video].'">'.substr($bgm[$i][content], 0,25).'...</a></li> '; 
                                  else echo '<li style="width:100%;border-bottom: solid 1.5px #666""><i class="fas fa-angle-double-right" ></i><a  href="../gochoctap/?idvideo='.$bgm[$i][id_video].'">'.substr($bgm[$i][content], 0,25).'...</a></li> ';
                              }
                           ?>
                             										
                            
                       </div>
                   </div>
                    	</div>
                    </div>
                    
                    </div>



                   
                    
                    <div class="col-xs-12 col-md-9" id="logined">
                                
                        <div class="hoidap" style="box-shadow: 2px 2px 2px 2px #666;margin-top: 25px;">
                        	<button style="display: block;width: 100%;height:50px;border: none;border-radius: 5px;font-size: 20px;background: #00a99d;clip-path: polygon(0 0, 100% 0%, 94% 100%, 6% 100%);" ><center><p style="font-size: 25px;">Khu vực: <?php if($_GET[type] && $_GET[type] !==''){
                        		$xsc = explode('_', $_GET[type]);
                        		$mon = $xsc[0];
                        		$lop = $xsc[1];
                        		if($mon=='toan') echo 'Toán';
                        		elseif($mon=='li') echo 'Vật Lí ';
                        		elseif($mon=='hoa') echo 'Hóa Học ';
                        		elseif($mon=='van') echo 'Ngữ Văn ';
                        		elseif($mon=='anh') echo 'Tiếng Anh ';
                        		elseif($mon=='sinh') echo 'Sinh Học ';
                        		elseif($mon=='tin') echo 'Tin Học ';
                        		elseif($mon=='su') echo 'Lịch Sử ';
                        		elseif($mon=='dia') echo 'Địa Lí ';
                        		elseif($mon=='cd') echo 'GDCD ';
                        		else echo 'Thảo luận chung';
                        	 echo $xsc[1];}else echo 'Thảo luận chung';?> </p></center></button>
                      	<?php   if($login){?>
							<div class="postques" style="margin:15px 10px;padding: 7px;">
                          <label for="" style="font-size: 17px;" ><u>Gửi câu hỏi mới:</u></label>
                            <form action="../req.php" method="post">
                              <label for="">Lớp: </label><br><select name="lop" id="zlop" style="height: 40px;width: 100%;display: block;border-radius: 4px; border: solid 1px #666;z-index: 10">
                              	<option value="10">Lớp 10</option>
                              	<option value="11">Lớp 11</option>
                              	<option value="12">Lớp 12</option>
                              </select>
                              <br>
                              <label for="mon">Môn học: </label><br>
                              <select name="mon" id="zmon" style="height: 40px;width: 100%;display: block;border-radius: 4px; border: solid 1px #666;z-index: 10;">
                              	<option value="toan">Toán Học</option>
                              	<option value="li">Vật Lí</option>
                              	<option value="hoa">Hóa Học</option>
                              		<option value="van">Ngữ Văn</option>
                              	<option value="anh">Tiếng Anh</option>
                              	<option value="sinh">Sinh Học</option>
                              		<option value="tin">Tin Học</option>
                              	<option value="su">Lịch Sử</option>
                              	<option value="dia">Địa Lí</option>
                              	<option value="cd">GDCD</option>
                              </select><br>
                              <script>
                              
                        		
                              	$("#zmon option[value=<?php if($_GET[type] && $_GET[type] !==''
) echo $mon;?>]").prop('selected',true);
                              	
                              	$("#zlop option[value=<?php if($_GET[type] && $_GET[type] !==''
) echo $lop;?>]").prop('selected',true);
                              
                              </script>
                               <label for="">Loại tin:</label><br><select  id="typepost" style="height: 40px;width: 100%;display: block;border-radius: 4px; border: solid 1px #666;z-index: 10">
                              	<option value="1">Câu hỏi</option>
                              	<option value="2">Bài tập trắc nghiệm</option>
                              	<option value="3">Video bài giảng</option>
                              </select>
                              <div class="inputlink" style="margin-top: 10px;display: none;">
                              	<i class="fab fa-youtube" style="color: red;background: white"></i><label for="ytb"> Link youtube dẫn đến video bài giảng </label> (<i>Vui lòng upload video lên youtube trước!</i>)
                              	<br><input type="text" name="video" style="border: none;border: solid 1px black;" placeholder="  https://www.youtube.com/watch?v=.....">
                              </div>
                              <div id="tracnghiem" style="padding: 5px 5px;margin-top: 10px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);display: none;">
                              	<div class="row">
                              		<div class="col-md-12">
                              			<label for=""><u>Đăng tải câu hỏi trắc nghiệm:</u></label><br>
                              			<label for="">Chủ đề:</label>
                              			<input type="text" name="title_test" placeholder=" Ví dụ:Trắc nghiệm hình không gian....">
                              			
                              			<span class="btn" style="background: #4CAF50;color: white;margin: 10px 5px;" onclick="newques();"><i class="glyphicon glyphicon-plus"></i> Thêm</span><br>
                              			 <div class="listques" style="margin: 10 px 0px;">
                              			 	<div class="cau_1">
                              			 		<label for="" style="">Câu 1:</label><br>
                              <textarea name="cauhoi_test[]" id=""  rows="3" style="font-size: 16px;border:solid 1.5px black;overflow:hidden; width:100%;display:block;"></textarea>
                              				<label for="">Đáp án:</label><br>
                              				<div style="margin:5px 10px;">A: <input type="text" style="width: 80%;" placeholder="Đáp án A...." name="dapan_1[]" ></div><div style="margin:5px 10px;">B: <input type="text" style="width: 80%;" placeholder="Đáp án B...." name="dapan_1[]" ></div><div style="margin:5px 10px;">C: <input type="text" style="width: 80%;" placeholder="Đáp án C...." name="dapan_1[]" ></div><div style="margin:5px 10px;">D: <input type="text" style="width: 80%;" placeholder="Đáp án D...." name="dapan_1[]" ></div>
                              				<label for="">Đáp án đúng:</label><select name="cau_1" id="">
                              					<option value="A">Đáp án A</option>
                              					<option value="B">Đáp án B</option>
                              					<option value="C">Đáp án C</option>
                              					<option value="D">Đáp án D</option>


                              				</select>
                              			 </div> 
                              			 	</div>	  
                              		</div>
                              		<script>
                              			var i= 1;
                              			function newques(){
                              				i++;
                              				$('.listques').append('<hr><br><div class="cau_'+i+'"><label for="" style="">Câu '+i+':</label><br><textarea name="cauhoi_test[]" id=""  rows="3" style="font-size: 16px;border:solid 1.5px black;overflow:hidden; width:100%;display:block;"></textarea><label for="">Đáp án:</label><br><div style="margin:5px 10px;">A: <input type="text" style="width: 80%;" placeholder="Đáp án A...." name="dapan_'+i+'[]" ></div><div style="margin:5px 10px;">B: <input type="text" style="width: 80%;" placeholder="Đáp án B...." name="dapan_'+i+'[]" ></div><div style="margin:5px 10px;">C: <input type="text" style="width: 80%;" placeholder="Đáp án C...." name="dapan_'+i+'[]" ></div><div style="margin:5px 10px;">D: <input type="text" style="width: 80%;" placeholder="Đáp án D...." name="dapan_'+i+'[]" ></div><label for="">Đáp án đúng:</label><select name="cau_'+i+'" id=""><option value="A">Đáp án A</option><option value="B">Đáp án B</option><option value="C">Đáp án C</option><option value="D">Đáp án D</option></select><br><span class="btn" style="background: #4CAF50;color: white;margin: 10px 5px;" onclick="newques();"><i class="glyphicon glyphicon-plus"></i> Thêm</span></div>');
                              				$("html, body").animate({ scrollTop: $('.cau_'+i).offset().top }, 500);
                              			}

                              		</script>
                              	</div>
                              </div>
                              
                              <br>
                              <div id="content">
                              	  <label for="" style="margin-top: 10px;">Nội dung:</label><br>
                              <textarea name="content" id=""  rows="7" style="font-size: 16px;border:solid 1.5px #017ebe;overflow:hidden; width:100%;display:block;"></textarea>
                              </div>
                            
                              <input type="hidden" name="act" id="act" value="send_qs_ght">
                              <input type="hidden" name="name" value="<?php echo $_SESSION[name]?>">
                              <input type="hidden" name="id_user" value="<?php echo $_SESSION[login]?>">
                              <button class="btn" id="sendqs" style="color:white;background:#563d7c "><i class="glyphicon glyphicon-send"></i><x style=""> Đăng tải</x></button>
                            </form>
                            <style>
                            	body:hover .glyphicon-send{
                            		transform: rotate(-360000deg);transition-duration: 1000s;
                            	}
                            	option{
                            		border: solid 1px black;
                            		display: block;
                            	}
                            </style>
                           <script>
                              	$('#typepost').change(function(){
                              		if($('#typepost option:selected').val()=='2'){
                              			$('.inputlink').css('display','none');
                              			$('#content').css('display','none');
                              			$('#tracnghiem').css('display','block');
                              			$('#act').val('send_test');
                              		}else if($('#typepost option:selected').val()=='3'){
                              			$('.inputlink').css('display','block');
                              			$('#content').css('display','block');
                              			$('#tracnghiem').css('display','none');
                              			$('#act').val('send_video');
                              		}else{
                              			$('.inputlink').css('display','none');
                              			$('#content').css('display','block');
                              			$('#tracnghiem').css('display','none');
                              			$('#act').val('send_qs_ght');
                              		}
                              	});
                              </script>
                        </div>
                      	<?php }else{?>
							 <div class="alert alert-info" style="margin-top: 25px;"><i class="fas fa-exclamation-circle"></i>
  <strong><u> Thông báo:</u> </strong><label for="" > Bạn cần đăng nhập để gửi câu hỏi mới.</label>
</div> 
                      	<?php }?>
                        
                        	                  <hr>  
	                    <div id="baiviet"  style="margin:15px 10px;padding: 7px;">
								<div class="row">
									<style>
										#btnx:hover {
											background: #017ebe;
											color: white;
										}
										#btnx{
											color: #017ebe;
										}
									</style>
									<div class="col-md-12">
										<div class="cau_hoi" style="<?php if($_GET[area]=='baigiang' || $_GET[area]=='baitap') echo 'display: none';?>">
											<label for=""><u style="font-size: 20px;">Câu hỏi cần giải đáp:</u></label>
											<?php
												if(!$_GET[type] || $_GET[type]==''){
												$cauhoi = $all->query("select * from qsght order by id desc limit 10");
												$tracnghiem= $all->query("select * from tracnghiem order by id desc limit 10");
												$baigiang = $all->query("select * from baigiang order by id desc limit 10");
												}else{
													$cauhoi = $all->query("select * from qsght where type='".$_GET[type]."' order by id desc limit 10");
													$tracnghiem= $all->query("select * from tracnghiem where type='".$_GET[type]."' order by id desc limit 10");
													$baigiang = $all->query("select * from baigiang where type='".$_GET[type]."' order by id desc limit 10");
												}
												if($_GET[area]=='cauhoi'){
													unset($tracnghiem);
													unset($baigiang);
												}elseif($_GET[area]=='baitap'){
													unset($cauhoi);
													unset($baigiang);
												}elseif($_GET[area]=='baigiang'){
													unset($cauhoi);
													unset($tracnghiem);
												}
												if($_GET[area] && $_GET[area] !==''){}
												for($i=0;$i<count($cauhoi);$i++){
													extract($cauhoi[$i]);
													$binhluan = json_decode(urldecode($binhluan),true);
													?>
													<div class="posted<?php echo $id_question;?>" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin:20px 0px;border-radius: 4px">
														<span class="btn" style="color: white;background: #898282;clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);"><i><?php 
															$xsc = explode('_', $type);
                        		$mon = $xsc[0];
                        		$lop = $xsc[1];
                        		if($mon=='toan') echo 'Toán';
                        		elseif($mon=='li') echo 'Vật Lí ';
                        		elseif($mon=='hoa') echo 'Hóa Học ';
                        		elseif($mon=='van') echo 'Ngữ Văn ';
                        		elseif($mon=='anh') echo 'Tiếng Anh ';
                        		elseif($mon=='sinh') echo 'Sinh Học ';
                        		elseif($mon=='tin') echo 'Tin Học ';
                        		elseif($mon=='su') echo 'Lịch Sử ';
                        		elseif($mon=='dia') echo 'Địa Lí ';
                        		elseif($mon=='cd') echo 'GDCD ';
                        		echo " $lop";
														?></i></span>
														<label for="" style="border-bottom: solid 1px black"><span class="glyphicon glyphicon-time" style="font-size: 10px;"><i><?php echo $create_at;?></i></span> <?php echo $who;?> đã đăng một câu hỏi mới </label>
																
														<div class="noidung" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);margin-top: 10px; padding: 5px 5px;">
															<p style="word-wrap: break-word;"><i><?php  echo $noidung;?></i></p><hr>

															<div class="row">
																<div class="col-xs-6 col-md-6"><button id="btnx" style="width: 100%;" class="btn" onclick="showcmt('<?php echo $id_question?>');">Bình luận(<?php echo count($binhluan); ?>)</button></div>
																<div class="col-xs-6 col-md-6"><button id="btnx" style="width: 100%;" class="btn"><a href="https://dev-v.systems/gochoctap/?idquestion=<?php echo $id_question;?>"></a>Chia sẻ</button></div>
																<div class="col-md-12">
																	<div class="cmts<?php echo $id_question;?>" style="margin-top: 10px;display: none;">
																		<label for=""><u>Bình luận:</u></label>
																		<?php for($k=count($binhluan)-1;$k>=0;$k--){?>
																			<div class="cmt" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin: 10px 0px;"><label for=""><?php echo $binhluan[$k][who]; ?>: </label><i style="word-wrap: break-word;"> <?php echo $binhluan[$k][content]; ?></i><br></div>
																		
																		
																		<?php }?>
																		<?php if($_SESSION[login]){?>
																			<form action="../req.php" method="post">
																			<textarea  style="display: block;width: 100%" name="cmt"  placeholder="  Viết bình luận...."></textarea>
																			<input type="hidden" name="act" value="cmt_ght">
																			<input type="hidden" name="who" value="<?php echo $_SESSION[name];?>">
																			<input type="hidden" name="id_user" value="<?php echo $_SESSION[login];?>">
																			<input type="hidden" name="id_question" value="<?php echo $id_question;?>">
																			<button type="submit" class="btn" style="background: #4CAF50;margin-top: 7px;">Đăng bình luận</button>
																		</form>
																		<?php }?>
																	</div>
																</div>
															</div>
														</div>
													</div>
															
													<?php
												}
											?>
											




											<script>
												function showcmt(idqs){
													$('.cmts'+idqs).css('display','block');
													$("html, body").animate({ scrollTop: $('.cmts'+idqs).offset().top }, 500);
													$('.posted'+idqs).css('border','solid 2px green');
												}
												if('<?php echo $_GET[idquestion]?>'!==''){
													$("html, body").animate({ scrollTop: $('.posted<?php echo $_GET[idquestion]?>').offset().top }, 700);
													$('.posted<?php echo $_GET[idquestion]?>').css('border','solid 2px green');
												}
											</script>
										</div>
										<!-- next -->
										<div class="trac_nghiem" style="<?php if($_GET[area]=='cauhoi' || $_GET[area]=='baigiang') echo 'display: none';?>">
											<label for=""><u style="font-size: 20px;">Bài tập trắc nghiệm:</u></label>
											<?php
												
												for($i=0;$i<count($tracnghiem);$i++){
													extract($tracnghiem[$i]);
													$binhluan = json_decode(urldecode($binhluan),true);
													$test = json_decode(urldecode($testing),true);

													?>
													<div class="idtest<?php echo $id_test;?>" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin:20px 0px;border-radius: 4px">
														<span class="btn" style="color: white;background: #898282;clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);"><i><?php 
															$xsc = explode('_', $type);
                        		$mon = $xsc[0];
                        		$lop = $xsc[1];
                        		if($mon=='toan') echo 'Toán';
                        		elseif($mon=='li') echo 'Vật Lí ';
                        		elseif($mon=='hoa') echo 'Hóa Học ';
                        		elseif($mon=='van') echo 'Ngữ Văn ';
                        		elseif($mon=='anh') echo 'Tiếng Anh ';
                        		elseif($mon=='sinh') echo 'Sinh Học ';
                        		elseif($mon=='tin') echo 'Tin Học ';
                        		elseif($mon=='su') echo 'Lịch Sử ';
                        		elseif($mon=='dia') echo 'Địa Lí ';
                        		elseif($mon=='cd') echo 'GDCD ';
                        		echo " $lop";
														?></i></span>
														<label for="" style="border-bottom: solid 1px black"><span class="glyphicon glyphicon-time" style="font-size: 10px;"><i><?php echo $create_at;?></i></span> <?php echo $who;?> đã đăng bài tập trắc nghiệm mới</label>
																
														<div class="noidung" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);margin-top: 10px; padding: 5px 5px;">
															<p style="word-wrap: break-word;"><i><?php  echo $chude;?></i></p><hr>
															<button class="btn" style="background: #563d7c;color:white;margin: 10px 0px;" onclick="showtest('<?php echo $id_test;?>');"><i class="fas fa-align-justify"> </i> Bắt đầu làm</button>
															<div class="row">
																<div class="col-md-12">
																	<div class="testx<?php echo $id_test;?>" style="display: none;border-radius: 4px;margin: 10px 0px;padding: 10px 10px;">
																					<center><label for=""><h4><u><?php echo $chude;?></u></h4></label></center>
																					<script>
																						var done_<?php echo $id_test?> = 0; 
																						var sai_<?php echo $id_test;?> = 0;
																					</script>
																	<?php 
																	
																		for($z=0;$z<count($test);$z++){
																		extract($test[$z]);
																			?>
																			
																					<div class="test<?php echo ($z+1);?>" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin: 20px 0px;">
																					<u><b>Câu <?php echo ($z+1);?>:</b></u><p><i style="word-wrap: break-word;"><?php echo $cauhoi;?></i></p>
																					<p><input type="radio" id="dapan_<?php echo ($z+1);?>_a_<?php echo $id_test;?>"  onclick="check_test_<?php echo ($z+1);?>_<?php echo $id_test;?>('A')"> A.<?php echo $list[0];?></p>
																					<p><input type="radio" id="dapan_<?php echo ($z+1);?>_b_<?php echo $id_test;?>"  onclick="check_test_<?php echo ($z+1);?>_<?php echo $id_test;?>('B')"> B.<?php echo $list[1];?></p>
																					<p><input type="radio" id="dapan_<?php echo ($z+1);?>_c_<?php echo $id_test;?>" onclick="check_test_<?php echo ($z+1);?>_<?php echo $id_test;?>('C')"> C.<?php echo $list[2];?></p>
																					<p><input type="radio" id="dapan_<?php echo ($z+1);?>_d_<?php echo $id_test;?>" onclick="check_test_<?php echo ($z+1);?>_<?php echo $id_test;?>('D')"> D.<?php echo $list[3];?></p>
																					<p id="result_<?php echo ($z+1);?>_<?php echo $id_test;?>"></p> 
																					</div>
																					
																					<script>

																						function check_test_<?php echo ($z+1);?>_<?php echo $id_test;?>(key){
																								
																								done_<?php echo $id_test?>++;
																					if(key=='<?php echo $dapan;?>'){
																					$('#result_<?php echo ($z+1);?>_<?php echo $id_test;?>').html('<div class="alert alert-success" style="margin-top: 25px;"><strong>Đúng - Trả lời: '+key+' - Đáp án <?php echo $dapan;?></strong></div>');
																				}else{
																					sai_<?php echo $id_test;?>++;
																					$('#result_<?php echo ($z+1);?>_<?php echo $id_test;?>').html('<div class="alert alert-danger" style="margin-top: 25px;"><strong>Sai - Trả lời: '+key+' - Đáp án <?php echo $dapan;?></strong></div>');	
																				}
																				$('#dapan_<?php echo ($z+1);?>_a_<?php echo $id_test;?>').attr('disabled','disabled');
																				$('#dapan_<?php echo ($z+1);?>_b_<?php echo $id_test;?>').attr('disabled','disabled');
																				$('#dapan_<?php echo ($z+1);?>_c_<?php echo $id_test;?>').attr('disabled','disabled');
																				$('#dapan_<?php echo ($z+1);?>_d_<?php echo $id_test;?>').attr('disabled','disabled');
																					
																				if(done_<?php echo $id_test?>==tongcau_<?php echo $id_test;?>){
																					$('.result_<?php echo $id_test;?>').html('<div class="alert alert-info" style="margin-top: 25px;"><strong>Kết quả: Đúng '+(tongcau_<?php echo $id_test;?>-sai_<?php echo $id_test;?>)+'/'+tongcau_<?php echo $id_test;?>+' .Đạt tỉ lệ: '+((tongcau_<?php echo $id_test;?>-sai_<?php echo $id_test;?>)/tongcau_<?php echo $id_test;?>*100).toFixed(2)+'%</strong></div>');
																				}
																			}

																					</script>

																			
																			<?php
																		}
																	?>
																	<div class="result_<?php echo $id_test;?>"></div>
																	<script>
																		var tongcau_<?php echo $id_test;?>= <?php echo count($test);?>;
																	</script>
																</div></div>
																<div class="col-xs-6 col-md-6"><button id="btnx" style="width: 100%;" class="btn" onclick="showcmts('<?php echo $id_test?>');">Bình luận(<?php echo count($binhluan); ?>)</button></div>
																<div class="col-xs-6 col-md-6"><button id="btnx" style="width: 100%;" class="btn"><a href="https://dev-v.systems/gochoctap/?idquestion=<?php echo $id_test;?>"></a>Chia sẻ</button></div>
																<div class="col-md-12">
																	<div class="cmtq<?php echo $id_test;?>" style="margin-top: 10px;display: none;">
																		<label for=""><u>Bình luận:</u></label>
																		<?php for($k=count($binhluan)-1;$k>=0;$k--){?>
																			<div class="cmt" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin: 10px 0px;"><label for=""><?php echo $binhluan[$k][who]; ?>: </label><i style="word-wrap: break-word;"> <?php echo $binhluan[$k][content]; ?></i><br></div>
																		
																		
																		<?php }?>
																		<?php if($_SESSION[login]){?>
																		<form action="../req.php" method="post">
																			<textarea  style="display: block;width: 100%" name="cmt"  placeholder="  Viết bình luận...."></textarea>
																			<input type="hidden" name="act" value="cmt_ght_test">
																			<input type="hidden" name="who" value="<?php echo $_SESSION[name];?>">
																			<input type="hidden" name="id_user" value="<?php echo $_SESSION[login];?>">
																			<input type="hidden" name="id_test" value="<?php echo $id_test;?>">
																			<button type="submit" class="btn" style="background: #4CAF50;margin-top: 7px;">Đăng bình luận</button>
																		</form><?php }?>
																	</div>
																</div>
															</div>
														</div>
													</div>
															
													<?php
												}
											?>
											




											<script>
												function showcmts(idqs){
													$('.cmtq'+idqs).css('display','block');
													$("html, body").animate({ scrollTop: $('.cmtq'+idqs).offset().top }, 500);
													$('.idtest'+idqs).css('border','solid 2px green');
												}
												if('<?php echo $_GET[idtest]?>'!==''){
													$("html, body").animate({ scrollTop: $('.idtest<?php echo $_GET[idtest]?>').offset().top }, 700);
													$('.idtest<?php echo $_GET[idtest]?>').css('border','solid 2px green');
												}
												function showtest(idtest){
													$('.testx'+idtest).css('display','block');
													
													$('.testx'+idtest).css('border','solid 2px green');
													$("html, body").animate({ scrollTop: $('.testx'+idtest).offset().top }, 500);

													
												}
											</script>
										</div>

										<!-- end -->




										<!-- start		 -->
										<div class="bai_giang" style="<?php if($_GET[area]=='cauhoi' || $_GET[area]=='baitap') echo 'display: none';?>">
											<label for=""><u style="font-size: 20px;">Bài giảng vừa đăng:</u></label>
											<?php
												for($i=0;$i<count($baigiang);$i++){
													extract($baigiang[$i]);
													$binhluan = json_decode(urldecode($binhluan),true);
													?>
													<div class="bg<?php echo $id_video;?>" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin:20px 0px;border-radius: 4px">
														<span class="btn" style="color: white;background: #898282;clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);"><i><?php 
															$xsc = explode('_', $type);
                        		$mon = $xsc[0];
                        		$lop = $xsc[1];
                        		if($mon=='toan') echo 'Toán';
                        		elseif($mon=='li') echo 'Vật Lí ';
                        		elseif($mon=='hoa') echo 'Hóa Học ';
                        		elseif($mon=='van') echo 'Ngữ Văn ';
                        		elseif($mon=='anh') echo 'Tiếng Anh ';
                        		elseif($mon=='sinh') echo 'Sinh Học ';
                        		elseif($mon=='tin') echo 'Tin Học ';
                        		elseif($mon=='su') echo 'Lịch Sử ';
                        		elseif($mon=='dia') echo 'Địa Lí ';
                        		elseif($mon=='cd') echo 'GDCD ';
                        		echo " $lop";
														?></i></span>
														<label for="" style="border-bottom: solid 1px black"><span class="glyphicon glyphicon-time" style="font-size: 10px;"><i><?php echo $create_at;?></i></span> <?php echo $tacgia;?> đã đăng một video bài giảng mới </label>
																
														<div class="noidung" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);margin-top: 10px; padding: 5px 5px;">
															<p style="word-wrap: break-word;"><i><?php  echo $content;?></i></p><hr>
															<div class="video_<?php echo $id_video;?>" style="margin-bottom: 20px;">
																<iframe width="100%" height="345" src="https://www.youtube.com/embed/<?php echo explode('=',$video)[1];?>" style="border:none;border-radius:20px">
</iframe>
															</div>
															<div class="row">
																
																<div class="col-xs-6 col-md-6"><button id="btnx" style="width: 100%;" class="btn" onclick="showcmtb('<?php echo $id_video?>');">Bình luận(<?php echo count($binhluan); ?>)</button></div>
																<div class="col-xs-6 col-md-6"><button id="btnx" style="width: 100%;" class="btn"><a href="https://dev-v.systems/gochoctap/?idvideo=<?php echo $id_video;?>"></a>Chia sẻ</button></div>
																<div class="col-md-12">
																	<div class="cmtbg<?php echo $id_video;?>" style="margin-top: 10px;display: none;">
																		<label for=""><u>Bình luận:</u></label>
																		<?php for($k=count($binhluan)-1;$k>=0;$k--){?>
																			<div class="cmt" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);padding: 5px 5px;margin: 10px 0px;"><label for=""><?php echo $binhluan[$k][who]; ?>: </label><i style="word-wrap: break-word;"> <?php echo $binhluan[$k][content]; ?></i><br></div>
																		
																		
																		<?php }?>
																		<?php if($_SESSION[login]){?>
																		<form action="../req.php" method="post">
																			<textarea  style="display: block;width: 100%" name="cmt"  placeholder="  Viết bình luận...."></textarea>
																			<input type="hidden" name="act" value="cmt_ght_bg">
																			<input type="hidden" name="who" value="<?php echo $_SESSION[name];?>">
																			<input type="hidden" name="id_user" value="<?php echo $_SESSION[login];?>">
																			<input type="hidden" name="id_video" value="<?php echo $id_video;?>">
																			<button type="submit" class="btn" style="background: #4CAF50;margin-top: 7px;">Đăng bình luận</button>
																		</form>
																		<?php }?>
																	</div>
																</div>
															</div>
														</div>
													</div>
															
													<?php
												}
											?>
											




											<script>
												function showcmtb(idqs){
													$('.cmtbg'+idqs).css('display','block');
													$("html, body").animate({ scrollTop: $('.cmtbg'+idqs).offset().top }, 500);
													$('.bg'+idqs).css('border','solid 2px green');
												}
												if('<?php echo $_GET[idvideo]?>'!==''){
													$("html, body").animate({ scrollTop: $('.bg<?php echo $_GET[idvideo]?>').offset().top }, 700);
													$('.bg<?php echo $_GET[idvideo]?>').css('border','solid 2px green');
												}
											</script>
										</div>
										<!-- end -->


									</div>
								</div>
	                    </div>
                    </div>
					
                	</div>
                	<style>
                		#flt{
                			float: right;
                		}

                	</style>
                    
                    
                   </div>
               </div>
           </div>
       
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

  if('<?php echo $_GET[error];?>'=='1'){
  	alert('Nội dung bình luận không hợp lệ');
  }
</script>
        

    
<div class="fb-customerchat" page_id="625619247828076" logged_in_greeting="Xin chào, chúng tôi có thể giúp gì cho bạn?"
 logged_out_greeting="Xin chào, chúng tôi có thể giúp gì cho bạn?">
</div>





<!-- chatbox -->


<!-- end -->
    </body>
</html>