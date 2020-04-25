@extends('master')
@section('content')
 <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{route('trang-chu')}}">Home</a></li>
                            <li class="active">Chi tiết sản phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- content-wraper start -->
            <div class="content-wraper">
                <div class="container">

                    <div class="row single-product-area">

                        <div class="col-lg-5 col-md-6">
                           <!-- Product Details Left -->
                            <div class="product-details-left">

                                    <div class="lg-image" >
                                        <a class="popup-img venobox vbox-item" href="source/images/product/{{$sanpham->image}}" data-gall="myGallery">

                                        <img src="source/images/product/{{$sanpham->image}} " alt="product image" style="height: 400px;width:450px;">
                                        </a>
                                    </div>
                                <div class="product-desc">
                                    <p>
                          <span>{{$sanpham->name}} :  100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                            </span>
                                    </p>
                                </div>

                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2>{{$sanpham->name}}</h2>

                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">Read Review</a></li>
                                            <li class="review-item"><a href="#">Write Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        @if($sanpham->promotion_price!=0)
                                            <span class="new-price new-price-2">{{number_format($sanpham->promotion_price)}}đ</span>
                                            <span class="old-price">{{number_format($sanpham->unit_price)}}đ</span>
                                        @else
                                            <span class="new-price">{{number_format($sanpham->unit_price)}}đ</span>
                                        @endif
                                    </div>


                                    <div class="single-add-to-cart">
                                        {{ csrf_field()}}
                                        <form action="{{route('themgiohang',$sanpham->id)}}" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" name="input_quantity" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- content-wraper end -->

@endsection
