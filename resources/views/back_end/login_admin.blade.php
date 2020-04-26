<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V19</title>
    <base href="{{asset('')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="source/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/vendor/bootstrap/source/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/fonts/font-awesome-4.7.0/source/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/vendor/animsition/source/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="source/css/util.css">
    <link rel="stylesheet" type="text/css" href="source/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">

            <form class="login100-form validate-form" action="{{route('postlogin')}}" method="post">
                @csrf
					<span class="login100-form-title p-b-33">
						Admin Login
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="container-login100-form-btn m-t-20">
                    <button class="login100-form-btn">
                        Đăng nhập
                    </button>
                </div>
                @if(Session::has('thatbai'))
                    <div style="color: red;text-align: center;margin-top:10px ">{{Session::get('thatbai')}}</div>

                @endif


            </form>
        </div>
    </div>
</div>



<!--===============================================================================================-->
<script src="source/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="source/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="source/vendor/bootstrap/js/popper.js"></script>
<script src="source/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="source/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="source/vendor/daterangepicker/moment.min.js"></script>
<script src="source/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="source/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="source/js/main.js"></script>

</body>
</html>
