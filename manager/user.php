<?php
session_start();
error_reporting(0);
if(!$_SESSION[admin]){
    header("location: ../");
}else{
    include('../controller.php');
    $all = new mys();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Quản trị trang</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="../bootstrap/js/jquery.js"></script>
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link rel="stylesheet" href="../bootstrap/css/fontawesome-all.min.css">

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
               <a href="#" class="simple-text">HOME <i class="fas fa-exchange-alt"></i> SCHOOL</a>
            </div>

            <ul class="nav">
                <li >
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                <li class="active">
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>Cài đặt</p>
                    </a>
                </li>
               
                <li>
                    <a href="typography.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Quản lí bài viết</p>
                    </a>
                </li>
                <li>
                    <a href="icons.php">
                        <i class="pe-7s-science"></i>
                        <p>Quản lí hỏi đáp</p>
                    </a>
                </li>
               
                <li>
                    <a href="notifications.php">
                        <i class="pe-7s-bell"></i>
                        <p>Thông báo</p>
                    </a>
                </li>
                
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Cài đặt</a>
                </div>
                <div class="collapse navbar-collapse">
                   

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Cài đặt</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Chuyển đến
                                        <b class="caret"></b>
                                    </p>

                              </a>
                              <ul class="dropdown-menu">
                                <li class="active">
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>Cài đặt</p>
                    </a>
                </li>
               
                <li>
                    <a href="typography.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Quản lí bài viết</p>
                    </a>
                </li>
                <li>
                    <a href="icons.php">
                        <i class="pe-7s-science"></i>
                        <p>Quản lí hỏi đáp</p>
                    </a>
                </li>
               
                <li>
                    <a href="notifications.php">
                        <i class="pe-7s-bell"></i>
                        <p>Thông báo</p>
                    </a>
                </li>
                
                              </ul>
                        </li>
                        <li>
                            <a href="../logout.php">
                                <p>Đăng xuất</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

                                                                             

<?php 
$admin = $all->query("select * from users where type='4'");
extract($admin[0]);

                                                                               if($mess_id==''){
                                                                                    echo '<script>
                                                                                    $(window).on("load",function(){
                                                                            $("#myModal").modal("show");
                                                                        });
                                                                        </script>';
                                                                                }
                                                                                
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Cài đặt hệ thống </h4>
                            </div>
                            <div class="content">
                                <form action="../req.php" method="post">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email" value="<?php echo $email?>" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Mật khẩu</label>
                                                <input type="password" class="form-control" placeholder="password" name="password" value="<?php echo $password;?>" required>
                                            </div>
                                        </div>
                                       
                                                </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Messenger ID</label>
                                                <input type="text" class="form-control" placeholder="" name="mess_id" value="<?php echo $mess_id;?>" disabled="disabled" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input type="text" class="form-control" placeholder="Nhập họ tên..." value="<?php  echo $name;?>" name="name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chatfuel Token-</label><span style="color: #9A9A9A">(Lưu ý: Hết sức cẩn thận, việc sửa đổi token này đồng nghĩa với việc ảnh hường đến hệ thống thông báo. Hãy nhập chính xác token nếu muốn thay đổi)</span>
                                                <input type="text" class="form-control" placeholder="Nhập chatfuel TOKEN..." value="<?php echo $chatfuel_token;?>" name="token" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                        <label for=""> <u style="font-size: 15px">Tài khoản Gmail gửi thông báo:</u></label></div>
                                        
                                        </div>
                                       
                                       <div class="col-md-12">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email đăng nhập gmail</label>
                                                <input type="email" class="form-control" placeholder="Email đăng nhập gmail" value="<?php echo $gmail_us;?>" name="gmail_us">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password đăng nhập gmail</label>
                                                <input type="password" class="form-control" placeholder="Password đăng nhập gmail" value="<?php echo $gmail_pw;?>" name="gmail_pw">
                                            </div>
                                        </div>
                                       </div>
                                        
                                    </div>

                                   
                                    <input type="hidden" name="act" value="update_system">
                                    <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>


        

    </div>
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
                                                                                      <button class="btn btn-success"><a class="upmess" href="https://www.messenger.com/t/625619247828076" target="_blank" style="color:green;display:inline-block">Đi đến</a></button>
                                                                                      <div class="notimess"></div>
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                                                    </div>
                                                                                  </div>

                                                                                </div>
                                                                              </div>

</body>

    <!--   Core JS Files   -->
   
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
    <script> 
   $(document).ready(function(){
                $("#upmess").click(function(){
                    var x= setInterval(function(){
                        $.ajax({
                            method:'get',
                            url:'../req.php?act=checkmess&id_user=<?php echo $id_user;?>',
                            success: function(req){
                                if(req.indexOf('OK')>=0){
                                    $(".notimess").html('<div class="alert alert-success"><strong>Thành công</strong> Cập nhật thành công.</div>');
                                    clearInterval(x);
                                    location.reload();
                                }
                            }
                        
                        });
                    }, 3000);
                });
            });
   $(".upmess").click(function(){
                    var x= setInterval(function(){
                        $.ajax({
                            method:'get',
                            url:'../req.php?act=checkmess&id_user=<?php echo $id_user;?>',
                            success: function(req){
                                if(req.indexOf('OK')>=0){
                                    $(".notimess").html('<div class="alert alert-success"><strong>Thành công</strong> Cập nhật thành công.</div>');
                                    clearInterval(x);
                                    location.reload();
                                }
                            }
                        
                        });
                    }, 3000);
                });
    if('<?php echo $_GET[success]?>'=='true'){
                $.notify({
                icon: 'pe-7s-bell',
                message: "Cập nhật hệ thống thành công!"

            },{
                type: 'success',
                timer: 4000
            });
            }
                </script>
                <style>
        body:hover .fa-exchange-alt{
                          transform: rotate(-360000deg);transition-duration: 1000s;
                        }
    </style>

</html>
