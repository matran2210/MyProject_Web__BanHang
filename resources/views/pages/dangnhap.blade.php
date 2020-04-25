@extends('master')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area" style="font-family: Arial">
        <div class="container" >
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{route('trang-chu')}}">Home</a></li>
                    <li class="active">Tài khoản</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60" style="font-family: Arial">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30" style="left: 25%">
                    @if(Session::has('thatbai'))
                        <div class="alert alert-danger">{{Session::get('thatbai')}}</div>

                @endif
                    <!-- Login Form s-->
                    <form action="{{route('guidangnhap')}}" method="post" >
                        @csrf
                        <div class="login-form">

                            <h1   style="text-align: center;color: red;font-weight: bold">Đăng nhập</h1>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email*</label>
                                    <input class="mb-0" name="email" type="email" placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" name="password" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" name="remember_me" id="remember_me">
                                        <label for="remember_me">Ghi nhớ đăng nhập</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="#"> Quên mật khẩu?</a>
                                </div>
                                <div class="col-md-12">
                                    <button class="register-button mt-0">Đăng nhập</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
@endsection
