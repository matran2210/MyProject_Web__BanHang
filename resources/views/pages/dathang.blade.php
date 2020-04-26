@extends('master')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{route('trang-chu')}}">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Checkout Area Strat-->
    <div class="checkout-area pt-60 pb-30">
        <div class="container" style="font-family: Arial">
            <div class="row">





            @if(Auth::check())

                    <div class="col-lg-6 col-12">

                            <!--Thông tin người nhận hàng có tài khoản -->
                        <form action="{{route('thanhtoancotaikhoan')}}" method="post">
                            @csrf
                        <div class="checkbox-form">
                            <h3 style="color: #c69500">Thông tin người nhận hàng</h3>

                            <div class="row">


                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label class="bold1">Họ và tên: <span class="required">*</span>{{Auth::user()->name}} </label>


                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email: <span class="required">*</span>{{Auth::user()->email}}</label>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ nhận hàng: <span class="required">*</span>{{Auth::user()->address}}</label>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại:  <span class="required">*</span>{{Auth::user()->phone}}</label>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Hình thức thanh toán  <span class="required">*</span> </label>
                                        <label style="font-size:15px">
                                            <input style="width: 15px;height: 15px;" type="radio" name="payment1" value="Thanh toán khi nhận hàng" id="hinhthuc" checked/>    Thanh toán khi nhận hàng
                                            <input style="width: 15px;height: 15px" type="radio" name="payment1" value="Thanh toán chuyển khoản" id="hinhthuc"/>     Thanh toán chuyển khoản
                                        </label>



                                    </div>
                                </div>
                                @if(Session::has('cart'))
                                <div class="col-md-12 order-button-payment">
                                    <input value="Tiến hành đặt hàng" type="submit">
                                </div>
                                    @endif



                            </div>

                        </div>

                        </form>

                    </div>

                        @else
                    <div class="col-lg-6 col-12">

                            <!-- cái Click here to login? này cũng chứa 1 form input khác nên không được đặt trong form route('thanhtoan') -->
                            <div class="coupon-accordion">
                                <!--Accordion Start-->
                                <h3>Bạn có tài khoản trước đây chưa? <span id="showlogin">Click here to login</span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <p class="coupon-text">Đăng nhập để tiện hơn trong việc mua hàng.</p>
                                        @if(Session::has('thatbai'))
                                            <div class="alert alert-danger">{{Session::get('thatbai')}}</div>

                                        @endif
                                        <form action="{{route('guidangnhap')}}" method="post" >
                                                @csrf

                                            <p class="form-row-first">
                                                <label>Email*</label>
                                                <input class="mb-0" name="email" type="email" placeholder="Email Address">
                                            @if ($errors->has('email'))
                                                <p class="help is-danger" style="color: red">{{ $errors->first('email') }}</p>
                                                @endif
                                            </p>
                                            <p class="form-row-last">
                                                <label>Password*</label>
                                                <input class="mb-0" type="password" name="password" placeholder="Password">
                                                @if ($errors->has('password'))
                                                    <p class="help is-danger" style="color: red">{{ $errors->first('password') }}</p>
                                                    @endif
                                            </p>
                                            <p style="margin-top:10px" class="form-row">
                                                <input value="Đăng nhập" type="submit">
                                                <label>
                                                    <input type="checkbox" name="remember_me">
                                                    Ghi nhớ đăng nhập
                                                </label>
                                            </p>
                                            <p class="lost-password"><a href="#">Bạn mất mật khẩu?</a></p>
                                        </form>
                                    </div>
                                </div>
                                <!--Accordion End-->

                            </div>
                            <!--Thông tin người nhận hàng không có tài khoản -->
                            <form action="{{route('thanhtoan')}}" method="post">
                                @csrf

                                    <div class="checkbox-form">
                                        <h3>Thông tin người nhận hàng</h3>

                                        <div class="row">


                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Họ và tên <span class="required">*</span></label>
                                                    <input placeholder="Fullname" id="fullname" name="fullname" type="text">
                                                    @if ($errors->has('fullname'))
                                                        <p class="help is-danger" style="color: red">{{ $errors->first('fullname') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label style="font-size:15px">
                                                        Nam:  <input style="width: 15px;height: 15px;" type="radio" name="gender" value="Nam" id="gender" checked/>
                                                        Nữ:  <input style="width: 15px;height: 15px" type="radio" name="gender" value="Nữ" id="gender"/>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input placeholder="Email Address" name="email" type="text">
                                                    @if ($errors->has('email'))
                                                        <p class="help is-danger" style="color: red">{{ $errors->first('email') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Địa chỉ nhận hàng <span class="required">*</span></label>
                                                    <input placeholder="Address"name="address" type="text">
                                                    @if ($errors->has('address'))
                                                        <p class="help is-danger" style="color: red">{{ $errors->first('address') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Số điện thoại  <span class="required">*</span></label>
                                                    <input  placeholder="Phone" name="phone" type="text">
                                                    @if ($errors->has('phone'))
                                                        <p class="help is-danger" style="color: red">{{ $errors->first('phone') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Hình thức thanh toán  <span class="required">*</span> </label>
                                                    <label style="font-size:15px">
                                                        <input style="width: 15px;height: 15px;" type="radio" name="payment" value="Thanh toán khi nhận hàng" id="hinhthuc" checked/>    Thanh toán khi nhận hàng
                                                        <input style="width: 15px;height: 15px" type="radio" name="payment" value="Thanh toán chuyển khoản" id="hinhthuc"/>     Thanh toán chuyển khoản
                                                    </label>



                                                </div>
                                            </div>
                                            @if(Session::has('cart'))
                                            <div class="col-md-12 order-button-payment">
                                                <input value="Tiến hành đặt hàng" type="submit">
                                            </div>
                                                @endif



                                        </div>

                                    </div>
                            </form>
                    </div>
                        @endif




                <!-- Đơn hàng -->
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3 style="color: #1d5987">Đơn hàng của bạn</h3>
                        @if(Session::has('cart'))
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr style="color: red;">
                                    <th class="cart-product-name" style="font-weight: bold">Sản phẩm</th>
                                    <th class="cart-product-total" style="font-weight: bold">Tổng</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($product_cart as $product)
                                <tr class="cart_item">
                                    <td class="cart-product-name"> {{$product['item']['name']}}<strong class="product-quantity"> × {{$product['qty']}}</strong></td>
                                    <td class="cart-product-total"><span class="amount">{{number_format($product['price'])}}đ</span></td>
                                </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>

                                <tr class="order-total">
                                    <th>Tổng tiền đơn hàng</th>
                                    <td><strong><span class="amount">{{number_format($totalPrice)}}đ</span></strong></td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>

                            @else <h1 style="color: red">Đặt hàng thành công</h1>

                            @endif

                    </div>
                </div>



            </div>


            </div>



        </div>
    </div>
    <!--Checkout Area End-->
    @endsection
