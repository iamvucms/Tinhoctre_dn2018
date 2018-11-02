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
    <script src="../ckeditor/ckeditor.js"></script>
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
               
                <li class="active">
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
                    <a class="navbar-brand" href="#">Quản lí bài viết</a>
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Đăng bài viết mới</h4>

                            </div>
                            <div class="content">
                                <form action="../req.php" method="post">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label>Tiêu đề:</label>
                                                <input type="text" class="form-control" placeholder="Tiêu đề" name="title" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Thể loại</label><br>
                                                <select name="type" id="thuoctinh" style="display: block;width: 100%;height: 40px;border:none;border: 1px solid #E3E3E3;border-radius: 4px;">
                                                    <option value="1" style="display: block;width: 100%;height: 40px;">Thông báo</option>
                                                    <option value="2" style="display: block;width: 100%;height: 40px;" selected="selected">Tin tức</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>

                                   

                                   

                                    

                                    <div class="row">
                                        <div class="col-md-12">

                                                <div class="alert alert-info" style="margin-top: 10px;">
                                    
                                    <span><b> Chú ý: </b><br>-Khi bạn chọn thể loại: Thông báo thì sau khi bài viết được đăng lên thì thông báo sẽ được tự động gửi đến tất cả các thành viên <br>   -Khi bạn chọn thể loại:Tin tức thì chỉ những thành viên đăng kí nhận tin tức mới được thông báo </span>
                                </div><hr>
                                            <div class="form-group">
                                                <label>Nội dung</label>
                                                <textarea name="content" id="content" rows="5" class="form-control" required=""></textarea>
                                                 <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
                                            </div>
                                        </div>
                                    </div>
<input type="hidden" name="act" value="add_posts">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Đăng bài</button>
                                    <div class="clearfix"></div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Quản lí bài viết</h4>
                                <p class="category">Các bài viết mới</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                           <?php
                                            $posts = $all->query("select * from adminposts order by id desc limit 50");
                                            for($i=0;$i<count($posts);$i++){
                                                extract($posts[$i]);
                                                ?>
                                            <tr id="post_<?php echo (count($posts)-$i); ?>">
                                                <td>
                                                    
                                                </td>
                                                <td><a href="../?idpost=<?php echo $i;?>" target="_blank"><?php echo $title?></a></td>

                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Xem bài viết" class="btn btn-info btn-simple btn-xs">
                                                        <a href="../?idpost=<?php echo $i;?>" target="_blank"><i class="fas fa-eye"></i></a>
                                                    </button>
                                                    
                                                </td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Xóa bài viết này" class="btn btn-info btn-simple btn-xs">
                                                        <span onclick="delete_postadmin('<?php echo (count($posts)-$i); ?>');" ><i class="fas fa-remove" style="color:red;"></i></span>
                                                    </button>
                                                    
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                           ?>
                                           <script>
                                               function delete_postadmin(idpost){
                                               if(confirm('Bạn có chắc chắn muốn xóa bài viết này !')==true){
                                                 $.ajax({
                                                    method:'get',
                                                    url:'../req.php?act=delete_postadmin&idpost='+idpost,
                                                    success:function(re){
                                                        if(re.indexOf('OK')>=0){
                                                            $('#post_'+idpost).css('display','none');
                                                        }
                                                    }
                                                });
                                               }
                                               }
                                           </script>
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
