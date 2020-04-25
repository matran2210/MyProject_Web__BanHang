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
        <div class="container" >
            <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12" style="left: 25%" >
                    @if(Session::has('thanhcong'))
                        <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                    @else
                    @endif

                    <form action="{{route('guidangky')}}" method="post">
                        @csrf


                        <div class="login-form">
                            <h1   style="text-align: center;color: red;font-weight: bold">Đăng ký</h1>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Họ và tên</label>
                                    <input class="mb-0" name="fullname" type="text" placeholder="Fullname">
                                    @if ($errors->has('fullname'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('fullname') }}</p>
                                    @endif
                                </div>

                                <div class="col-md-12 mb-20">
                                    <label>Email*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Mật khẩu</label>
                                    <input class="mb-0" type="password" name="password" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Nhập lại mật khẩu</label>
                                    <input class="mb-0" type="password" name="re_password" placeholder="Confirm Password">
                                    @if ($errors->has('re_password'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('re_password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Số điện thoại</label>
                                    <input class="mb-0" type="text" name="phone" placeholder="Phone Number">
                                    @if ($errors->has('phone'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Địa chỉ</label>
                                    <input class="mb-0" type="text" name="address" placeholder="Address">
                                    @if ($errors->has('address'))
                                        <p class="help is-danger" style="color: red">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Đăng ký</button>
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
