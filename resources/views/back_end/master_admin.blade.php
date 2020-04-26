<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content ="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin - Khoa Phạm</title>
    <base href="{{asset('')}}">

    <!-- Bootstrap Core CSS -->
    <link href="source/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="source/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="source/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="source/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="source/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="source/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <script type="text/javascript" language="javascript" src="source/ckeditor/ckeditor.js" ></script>



    <script type="text/javascript" language="javascript" src="source/ckfinder/ckfinder.js" ></script>



</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav style="background-color: #222222;" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div  class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style="color: mintcream" class="navbar-brand" href="{{route('trang-chu-admin')}}">Admin-Bảng điều khiển</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                @if(Auth::check())

                <a style="color: white;background-color: #222222"  class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                    {{Auth::user()->name}}


                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">


                    <li><a href="{{route('logout-admin')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>

                @endif
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div  class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{route('trang-chu-admin')}}"><i class="fa fa-dashboard fa-fw"></i>Trang chủ</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Quản lý sản phẩm<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('getViewListProduct')}}">Danh sách sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{route('getViewAddProduct')}}">Thêm sản phẩm mới</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Quản lý tài khoản<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('getViewListUser')}}">Danh sách tài khoản</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Quản lý tin tức<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('getViewListNews')}}">Danh sách tin tức</a>
                            </li>
                            <li>
                                <a href="#">Danh sách thể loại</a>
                            </li>
                            <li>
                                <a href="#">Danh sách loại tin</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>


    <div style="margin-left:50px;width: auto" class="container">
        @yield('content')

    </div>




</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="source/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="source/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="source/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="source/dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="source/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="source/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });


</script>

</body>

</html>
