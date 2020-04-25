@extends('master')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{route('trang-chu')}}">Home</a></li>
                    <li class="active">Giỏ hàng</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            @if(Session::has('cart'))
            <div class="row">
                <div class="col-12">


                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="li-product-remove">Xóa</th>
                                    <th class="li-product-thumbnail">Ảnh</th>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th class="li-product-price">Giá</th>
                                    <th class="li-product-quantity">Số lượng</th>
                                    <th class="li-product-subtotal">Tổng</th>
                                </tr>
                                </thead>
                                <tbody>


                                    @foreach($product_cart as $product)

                                <tr>

                                    <td class="li-product-remove"><a href="{{route('xoagiohang',$product['item']['id'])}}"><i class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail" ><a href="{{route('chitietsanpham',$product['item']['id'])}}"><img src="source/images/product/{{$product['item']['image']}}" alt="Li's Product Image"style="height: 150px;width: 150px"></a></td>
                                    <td class="li-product-name"><a href="{{route('chitietsanpham',$product['item']['id'])}}">{{$product['item']['name']}}</a></td>
                                    <td class="li-product-price">
                                        @if($product['item']['promotion_price']!=0)
                                        <span class="amount">{{number_format($product['item']['promotion_price'])}}đ</span>
                                            @else
                                            <span class="amount">{{number_format($product['item']['unit_price'])}}đ</span>

                                        @endif

                                    </td>
                                    <td class="quantity">
                                        <label>Số lượng: {{$product['qty']}} </label>

                                    </td>
                                    <td class="product-subtotal"><span class="amount">{{number_format($product['price'])}}đ</span></td>


                                </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>



                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Tổng giỏ hàng</h2>
                                    <ul>
                                        @if(Session::has('cart'))
                                        <li>Tổng tiền <span>{{number_format($totalPrice)}}đ</span></li>
                                            @endif

                                    </ul>
                                    <a href="{{route('dathang')}}">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
                <!--Nếu không thấy Session tức là ko có giỏ hàng thì ghi giỏ hàng trống  -->
            @else <h1 style="text-align: center;color: red;;font-family:Arial; font-weight: bold">Giỏ hàng trống</h1>
            @endif
        </div>
    </div>
    <!--Shopping Cart Area End-->

    @endsection
