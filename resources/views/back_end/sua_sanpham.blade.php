@extends('back_end.master_admin')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">


                <div class="panel panel-info">
                    <div class="panel-heading">Sửa sản phẩm</div>
                    <div class="panel-body">
{{--  //lưu ý để dùng được mấy phương thức lấy tên của ảnh như getClientOriginalName()
,.. này ta phải thêm thuộc tính enctype="multipart/form-data" vào--}}


                        <form action="{{route('postEditProduct',$product->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row" style="margin-bottom:40px">
                                <div class="col-xs-8">
                                    <div class="form-group" >
                                        <label>Tên sản phẩm</label>
                                        <input value="{{$product->name}}" required type="text" name="name" class="form-control">
                                    </div>


                                    <div class="form-group" >
                                        <label>Giá gốc sản phẩm</label>
                                        <input value="{{$product->unit_price}}" required type="number" name="unit_price" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Giá khuyến mãi sản phẩm</label>
                                        <input value="{{$product->promotion_price}}" required type="number" name="promotion_price" class="form-control">
                                    </div>

                                    <div class="form-group" >
                                        <label>Tình trạng</label>
                                        <select required name="tinhtrang" class="form-control">
                                            @foreach($arrTinhTrang as $key=>$value)
                                             @if($product->new==$key)   {{--    $product->new =1 hoặc = 0--}}
                                                <option selected value="{{$key}}">{{$value}}</option>
                                                    @else
                                                 <option  value="{{$key}}">{{$value}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Loại sản phẩm</label>
                                        <select required name="loaisanpham" class="form-control">
                                            @foreach($arrLoaiSanPham as $loai)
                                                @if($product->id_type==$loai->id)   {{--    $product->new =1 hoặc = 0--}}
                                                <option selected value="{{$loai->id}}">{{$loai->name}}</option>
                                                @else
                                                    <option  value="{{$loai->id}}">{{$loai->name}}</option>
                                                @endif
                                            @endforeach


                                        </select>
                                    </div>

                                    <div class="form-group" >
                                        <label>Ảnh sản phẩm</label>
                                        <input value="{{$product->image}}" id="img" type="file" name="image" class="form-control hidden" onchange="changeImg(this)">
                                        <img  id="avatar" class="thumbnail" width="300px" src="source/images/product/{{$product->image}}">
                                    </div>




                                    <input type="submit" name="submit" value="Sửa" class="btn btn-primary" onclick="thanhcong();" >
                                    <a href="{{route('getViewListProduct')}}" class="btn btn-danger">Hủy bỏ</a>
                                </div>
                            </div>

                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->

    <script>
        function thanhcong() {
            alert('Sửa thành công sản phẩm');
        }

        function changeImg(input){

            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if(input.files && input.files[0]){
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e){
                    //Thay đổi đường dẫn ảnh
                    $('#avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#avatar').click(function(){

                $('#img').click();
            });
        });
    </script>

    @endsection
