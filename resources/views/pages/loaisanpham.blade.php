@extends('master')
@section('content')
  <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Sản phẩm theo loại</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- Begin Li's Content Wraper Area -->
            <div class="content-wraper pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Li's Banner Area -->
                            <div class="single-banner shop-page-banner">
                                <a >
                                    <img src="source/images/bg-banner/2.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                            <!-- Li's Banner Area End Here -->
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar mt-30">
                                <div class="shop-bar-inner">
                                    <div class="product-view-mode">
                                        <!-- shop-item-filter-list start -->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>

                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <div class="toolbar-amount">
                                        <span>Hiện có {{$sp_theoloai->total()}} sản phẩm</span>
                                    </div>
                                </div>
                                <!-- product-select-box start -->
                                <div class="product-select-box">
                                    <div class="product-short">
                                        <p>Sắp xếp:</p>
{{--                                        class="nice-select"--}}
                                        <select class="custom-select" >
                                            <option value="name-asc"  > Tên sản phẩm (A-Z)</option>
                                            <option value="name-desc"  > Tên sản phẩm (Z-A)</option>
                                            <option value="unit_price-asc" > Giá sản phẩm (Thấp-Cao)</option>
                                            <option value="unit_price-desc"> Giá sản phẩm (Cao-Thấp)</option>


                                        </select>
                                    </div>


                                </div>
                                <!-- product-select-box end -->
                            </div>
                            <!-- shop-top-bar end -->
                            <!-- shop-products-wrapper start -->
                            <div id="ketqua" class="shop-products-wrapper">
                                @include('pages.data_loaisanpham')
                            </div>
{{--                            Phải có 3 thẻ input hidđen này để cho các hàm sự kiện onclick, onchange,... lấy giá trị hiện tại --}}
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            <input type="hidden" name="hidden_sort_by" id="hidden_sort_by" value="id" />
                            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

                            <!-- shop-products-wrapper end -->
                        </div>

                    </div>

                </div>
            </div>

            <!-- Content Wraper Area End Here -->
  <script>
      $(document).ready(function(){



          function fetch_data(page, sort_type, sort_by) {
              $.ajax({
                  url: "loai-san-pham/{{$sp_theoloai[0]->id_type}}?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type,
                  method: 'GET',

                  dataType: 'text',

                  success: function (data) {

                      $('div#ketqua').html('');
                      $('div#ketqua').html(data);
                  }


              })
          }

          var $sortOptions = $('.custom-select');
          $sortOptions.on('change', function(event) {
              //cách 1: dùng sự kiện change,  event.target.value để lấy giá trị trong value ra mà cắt name-asc
              var str = event.target.value;
              var splitted =  str.split('-');
             var sortBy = splitted[0];
             var sortType = splitted[1];
            //gán giá trị vừa khai thác được là sortBy, sortType cho thẻ trung gian để hàm click bên dưới có cái mà dùng
              //bởi vì hàm fetch_data yêu cầu 3 tham số cơ. Nói chung là chia sẻ giá trị
              $('#hidden_sort_by').val(sortBy);
              $('#hidden_sort_type').val(sortType);
              //lấy giá trị page mà hàm onlick bên dưới đã chia sẻ lên thẻ input hidden_page
              var page = $('#hidden_page').val();

              fetch_data(page,sortType, sortBy);
          })
          $(document).on('click', '.pagination a',function(event)
          {
              event.preventDefault(); //không cho gửi form khi người dùng click button
   //trang nào đang được chọn thì số của trang đó sẽ in xanh đậm ,vì vậy ta phải remove cái hiện tại đi và thêm cho trang mới được click

              //2 lệnh này thấy chả cần thiết
   //            $('li').removeClass('active');
   //            $(this).parent('li').addClass('active');

              //tách bằng split theo key là 'page='sẽ được 1 mảng, và phần tử thứ 0 của mảng là link phần tử thứ 1 là số trang

                var page=$(this).attr('href').split('page=')[1];
            //  chia sẻ giá trị vừa khai thác được và lấy những giá trị cần để truyền vào  fetch_data
              $('#hidden_page').val(page);
              var sortBy = $('#hidden_sort_by').val();
              var sortType = $('#hidden_sort_type').val();

              fetch_data(page,sortType, sortBy);
          });

      });
  </script>


@endsection
