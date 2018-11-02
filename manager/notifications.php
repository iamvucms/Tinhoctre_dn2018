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
    <style>
        body:hover .fa-exchange-alt{
                          transform: rotate(-360000deg);transition-duration: 1000s;
                        }
    </style>

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
               
                <li class="active">
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
                    <a class="navbar-brand" href="#">Thông báo</a>
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
extract($admin[0]);?>

         <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Gửi thông báo đến thành viên( Thông qua Messenger và Email)</h4>
                            </div>
                            <div class="content">
                                <form action="../req.php" method="post">
                                  
                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên hiển thị</label>
                                                <input type="text" class="form-control" placeholder="Nhập họ tên..." value="<?php  echo $name;?>" name="name" required>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Lớp</label>
                                                <select name="lop" id="" style="border-radius: 4px;height: 40px;width: 100%">
                                                    <option value="all">Tất cả các lớp</option>
                                                    <?php for($i=1;$i<13;$i++){echo '<option value="10_'.$i.'">10/'.$i.'</option>';}
                                                    for($i=1;$i<13;$i++){echo '<option value="11_'.$i.'">11/'.$i.'</option>';}
                                                        for($i=1;$i<13;$i++){echo '<option value="12_'.$i.'">12/'.$i.'</option>';}?>
                                                    
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Đối tượng</label>
                                                <select name="type" id="" style="border-radius: 4px;height: 40px;width: 100%">
                                                    <option value="1">Học sinh</option>
                                                    <option value="2">Phụ huynh</option>
                                                    <option value="3">Giáo viên</option>
                                                     <option value="4">Tất cả</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nội dung thông báo</label>
                                                <textarea  class="form-control" placeholder="Nhập nội dung..." name="content"  rows="5" required=""></textarea>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Gửi qua:</label>
                                                <select name="sendby" id="" style="border-radius: 4px;height: 40px;width: 100%">
                                                    <option value="mess">Messenger</option>
                                                    <option value="mail">Email</option>
                                                     <option value="all">Tất cả</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
    
                                    

                                   
                                    <input type="hidden" name="act" value="send_noti">
                                    <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Gửi thông báo</button>
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


</body>

        <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
    <script>
         if('<?php echo $_GET[status]?>'=='running'){
                $.notify({
                icon: 'pe-7s-bell',
                message: "Thông báo của bạn đang được gửi đi"

            },{
                type: 'success',
                timer: 4000
            });
            }
    </script>

</html>
