<?php
session_start();
error_reporting(0);
if(!$_SESSION[admin]){
    header("location: ../");
}else{
    include('../controller.php');
    $a= new mys();
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Quản lí hỏi đáp</a>
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


        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Quản lí hỏi đáp</h4>
                                <p class="category">Câu hỏi mới nhất</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <?php 
                                             $nqs = $a->query("SELECT * FROM `questions` ORDER BY id DESC  LIMIT 10");
                                                for($i=0;$i<count($nqs);$i++){
                                                    extract($nqs[$i]);
                                            ?>
                                           <tr>
                                                <td>
                                                    
                                                </td>
                                                <td><a target="_blank" href="../?idquestion=<?php echo $id_question;?>"><?php echo $title;?>(<?php echo substr($noidung,0,70).'...';?>)</a></td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Viết câu trả lời" class="btn btn-info btn-simple btn-xs">
                                                        <a target="_blank" href="../?idquestion=<?php echo $id_question;?>"><i class="fa fa-edit"></i></a>
                                                    </button>
                                                    
                                                </td>
                                            </tr><?php }?>
                                            

                                        </tbody>
                                    </table>
                                </div>

                                
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>
