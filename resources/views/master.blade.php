<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
<head>
    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Website Bán điện thoại</title>
    <base href="{{asset('')}}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="source/images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="source/css/material-design-iconic-font.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="source/css/font-awesome.min.css">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="source/css/fontawesome-stars.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="source/css/meanmenu.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="source/css/owl.carousel.min.css">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="source/css/slick.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="source/css/animate.css">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="source/css/jquery-ui.min.css">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="source/css/venobox.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="source/css/nice-select.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="source/css/magnific-popup.css">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link href="source/back-end/css/bootstrap.min.css" rel="stylesheet">
{{--  dưới đây là source bootstrap của trang chính, nếu như trang chính
 có lỗi gì thì xóa cái bootstrap ở trên đi thay bằng cái này . Hơi rối

    <link rel="stylesheet" href="source/css/bootstrap.min.css">--}}
    <!-- Helper CSS -->
    <link rel="stylesheet" href="source/css/helper.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="source/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="source/css/responsive.css">
    <!-- Modernizr js -->
    <script src="source/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


{{--    Link trang tin tức--}}

    <link href="source/css/page_news_1.css" rel="stylesheet">

    <link href="source/css/page_news.css" rel="stylesheet">

    <script src="source/back-end/js/bootstrap.min.js"></script>
    <script src="source/back-end/js/jquery.js"></script>







</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">

@include('pages.header')


@yield('content')



    @include('pages.footer')
    @include('pages.quick_Area')  {{--    dùng thẻ Model fade nên không nhìn thấy chứ nó là nút QuickView--}}





</div>
<!-- Body Wrapper End Here -->
<!-- jQuery-V1.12.4 -->
<script src="source/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper js -->
<script src="source/js/vendor/popper.min.js"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="source/js/bootstrap.min.js"></script>
<!-- Ajax Mail js -->
<script src="source/js/ajax-mail.js"></script>
<!-- Meanmenu js -->
<script src="source/js/jquery.meanmenu.min.js"></script>
<!-- Wow.min js -->
<script src="source/js/wow.min.js"></script>
<!-- Slick Carousel js -->
<script src="source/js/slick.min.js"></script>
<!-- Owl Carousel-2 js -->
<script src="source/js/owl.carousel.min.js"></script>
<!-- Magnific popup js -->
<script src="source/js/jquery.magnific-popup.min.js"></script>
<!-- Isotope js -->
<script src="source/js/isotope.pkgd.min.js"></script>
<!-- Imagesloaded js -->
<script src="source/js/imagesloaded.pkgd.min.js"></script>
<!-- Mixitup js -->
<script src="source/js/jquery.mixitup.min.js"></script>
<!-- Countdown -->
<script src="source/js/jquery.countdown.min.js"></script>
<!-- Counterup -->
<script src="source/js/jquery.counterup.min.js"></script>
<!-- Waypoints -->
<script src="source/js/waypoints.min.js"></script>
<!-- Barrating -->
<script src="source/js/jquery.barrating.min.js"></script>
<!-- Jquery-ui -->
<script src="source/js/jquery-ui.min.js"></script>
<!-- Venobox -->
<script src="source/js/venobox.min.js"></script>
<!-- Nice Select js -->
<script src="source/js/jquery.nice-select.min.js"></script>
<!-- ScrollUp js -->
<script src="source/js/scrollUp.min.js"></script>
<!-- Main/Activator js -->
<script src="source/js/main.js"></script>

<script src="source/js/page_news.js"></script>



</body>

<!-- index30:23-->
</html>
