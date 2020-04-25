@extends('master')
@section('content')
    <!-- Begin Slider With Banner Area -->

    <div class="slider-with-banner">



        <div class="container">
            <div class="row">
                <!-- Begin Slider Area -->
                <div class="col-lg-8 col-md-8">
                    <div class="slider-area">
                        <div class="slider-active owl-carousel">
                            <!-- Begin Single Slide Area -->
                            @foreach($slide as $sl)
                            <div class="single-slide align-center-left  animation-style-01 bg-1" >
                                <img src=" source/images/slider/{{$sl->image}}" alt="">
                                <div class="slider-progress"></div>

                            </div>
                            @endforeach

                            <!-- Single Slide Area End Here -->

                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
                <!-- Begin Li Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                    <div class="li-banner">
                        <a href="#">
                            <img src="source/images/banner/1_1.jpg" alt="">
                        </a>
                    </div>
                    <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                        <a href="#">
                            <img src="source/images/banner/1_2.jpg" alt="">
                        </a>
                    </div>
                </div>
                <!-- Li Banner Area End Here -->
            </div>
        </div>
    </div>
    <!-- Slider With Banner Area End Here -->
    <!-- Begin Product Area -->
    <div class="product-area pt-60 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#li-new-product"><span style="font-family: Arial;font-weight: bold;">Sản phẩm mới</span></a></li>

                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($new_product as $new)
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->

                                <div class="single-product-wrap">

                                    <div class="product-image">
                                        <a href="{{route('chitietsanpham',$new->id)}}">
                                            <img src="source/images/product/{{$new->image}}" alt="Li's Product Image" >
                                        </a>
                                        @if($new->new!=0)
                                        <span class="sticker">New</span>
                                            @endif
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">

                                            <h4><a class="product_name" href="{{route('chitietsanpham',$new->id)}}">{{$new->name}}</a></h4>
                                            <div class="price-box">
                                                @if($new->promotion_price!=0)
                                                <span class="new-price new-price-2">{{number_format($new->promotion_price)}}đ</span>
                                                <span class="old-price">{{number_format($new->unit_price)}}đ</span>
                                                @else
                                                    <span class="new-price">{{number_format($new->unit_price)}}đ</span>
                                                @endif


                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a href="{{route('themgiohang',$new->id)}}">Add to cart</a></li>
                                                <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <!-- single-product-wrap end -->
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Product Area End Here -->

    <!-- Begin Li's Promotion Product Area -->

    <div class="product-area pt-60 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#li-new-product"><span style="font-family: Arial;font-weight: bold;">Sản phẩm khuyến mãi</span></a></li>

                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($promotion_product as $pr_product)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->

                                    <div class="single-product-wrap">

                                        <div class="product-image">
                                            <a href="{{route('chitietsanpham',$pr_product->id)}}">
                                                <img src="source/images/product/{{$pr_product->image}}" alt="Li's Product Image" >
                                            </a>
                                            @if($pr_product->new!=0)
                                                <span class="sticker">New</span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">

                                                <h4><a class="product_name" href="{{route('chitietsanpham',$pr_product->id)}}">{{$pr_product->name}}</a></h4>
                                                <div class="price-box">

                                                    <span class="new-price new-price-2">{{number_format($pr_product->promotion_price)}}đ</span>
                                                    <span class="old-price">{{number_format($pr_product->unit_price)}}đ</span>

                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="{{route('themgiohang',$new->id)}}">Add to cart</a></li>
                                                    <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Li's Promotion Product Area End Here -->





    @endsection
