<!-- Begin Header Area -->
<header>
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li><span>Sđt liên hệ: </span><a href="{{route('trang-chu')}}">(+84)376973639</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul id="user_name" class="ht-menu">
                            <!-- Begin Setting Area -->
                            @if(Auth::check())
                                <li><a  href="#">   {{Auth::user()->name}}</a></li>
                                <li><a href="{{route('guidangxuat')}}">Đăng xuất</a></li>
                                @else
                            <li><a  href="{{route('dangnhap')}}">Đăng nhập</a></li>
                            <li><a href="{{route('dangky')}}">Đăng ký</a></li>

                            @endif
                            <!-- Setting Area End Here -->
                            <!-- Begin Currency Area -->


                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="{{route('trang-chu')}}">
                            <img src="source/images/menu/logo/1.jpg" alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="{{route('timkiem')}}" method="get" class="hm-searchbox">

                        <input type="text" name="key" placeholder="Enter your search key ...">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            <li  class="hm-wishlist">
                                <a href="wishlist.html">
                                    <span class="cart-item-count wishlist-item-count">0</span>
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </li>
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li  class="hm-minicart">
                                <div  class="hm-minicart-trigger">
                                    <span class="item-icon"></span>

                                    <span class="item-text">@if(Session::has('cart')){{number_format($totalPrice)}}đ
                                                            @else Trống
                                                             @endif
                                                    <span class="cart-item-count">
                                                        @if(Session::has('cart')){{$totalQty}}
                                                        @else 0

                                                        @endif


                                                    </span>
                                                </span>
                                </div>
                                <span></span>
                                @if(Session::has('cart'))

                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        @foreach($product_cart as $product)
                                        <li>
                                            <a href="{{route('chitietsanpham',$product['item']['id'])}}" class="minicart-product-image">
                                                <img src="source/images/product/{{$product['item']['image']}}" alt="cart products" >
                                            </a>
                                            <div class="minicart-product-details">
                                                <h6><a href="{{route('chitietsanpham',$product['item']['id'])}}">{{$product['item']['name']}}</a></h6>
                                                @if($product['item']['promotion_price']!=0)
                                                <span>{{number_format($product['item']['promotion_price'])}} x {{$product['qty']}}</span>
                                                    @else
                                                    <span>{{number_format($product['item']['unit_price'])}} x {{$product['qty']}}</span>
                                                @endif
                                            </div>
                                            <button class="close" title="Remove" >
                                                <a href="{{route('xoagiohang',$product['item']['id'])}}">
                                                    <i class="fa fa-close"></i>
                                                </a>

                                            </button>
                                        </li>
                                            @endforeach


                                    </ul>
                                    <p class="minicart-total">Tổng: <span>{{number_format($totalPrice)}}đ</span></p>
                                    <div class="minicart-button">
                                        <a href="{{route('giohang')}}" class="li-button li-button-fullwidth li-button-dark">
                                            <span>Xem giỏ hàng</span>
                                        </a>
                                        <a href="{{route('dathang')}}" class="li-button li-button-fullwidth">
                                            <span>Thanh toán</span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>

                                <li class="megamenu-holder down"><a>Loại sản phẩm</a>
                                    <ul class="megamenu hb-megamenu">
                                        @foreach($loai_sp as $loai)
                                        <li><a href="{{route('loaisanpham',$loai->id)}}">{{$loai->name}}</a>
                                            <ul>

                                                <li>{{$loai->description}}</li>

                                            </ul>
                                        </li>
                                        @endforeach

                                    </ul>
                                </li>

                                <li><a href="{{route('trangchu-tintuc')}}">Tin tức</a></li>
                                <li><a href="{{route('gioithieu')}}">Giới thiệu</a></li>

                                <li><a href="{{route('lienhe')}}">Liên hệ</a></li>
                                <li><a href="{{route('sukien')}}">Sự kiện</a></li>

                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>
<!-- Header Area End Here -->
