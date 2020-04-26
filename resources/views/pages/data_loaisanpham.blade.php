
    <div class="tab-content">
        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
            <div class="product-area shop-product-area">
                <div class="row">


                    @foreach($sp_theoloai as $sp)


                        <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{route('chitietsanpham',$sp->id)}}">
                                        <img src="source/images/product/{{$sp->image}}" alt="Li's Product Image">
                                    </a>
                                    @if($sp->new!=0)
                                        <span class="sticker">New</span>
                                    @endif
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">

                                        <h4><a class="product_name" href="{{route('chitietsanpham',$sp->id)}}">{{$sp->name}}</a></h4>
                                        <div class="price-box">
                                            @if($sp->promotion_price!=0)
                                                <span class="new-price new-price-2">{{number_format($sp->promotion_price)}}đ</span>
                                                <span class="old-price">{{number_format($sp->unit_price)}}đ</span>
                                            @else
                                                <span class="new-price">{{number_format($sp->unit_price)}}đ</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="{{route('themgiohang',$sp->id)}}">Add to cart</a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
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
    <div style="margin-top:100px;">{{ $sp_theoloai->links() }}</div>




