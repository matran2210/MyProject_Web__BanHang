@extends('back_end.master_admin')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-info">
					<div class="panel-heading">Thêm sản phẩm</div>
					<div class="panel-body">
						<form action="{{route('postAddProduct')}}" method="post" enctype="multipart/form-data">
                            @csrf
							<div class="row" style="margin-bottom:40px">
								<div class="col-xs-8">
									<div class="form-group" >
										<label>Tên sản phẩm</label>
										<input required type="text" name="name" class="form-control">
									</div>


									<div class="form-group" >
										<label>Giá gốc sản phẩm</label>
										<input required type="number" name="unit_price" class="form-control">
									</div>
									<div class="form-group" >
										<label>Giá khuyến mãi sản phẩm</label>
										<input required type="number" name="promotion_price" class="form-control">
									</div>

									<div class="form-group" >
										<label>Tình trạng</label>
										<select required name="tinhtrang" class="form-control">
											<option value="1">Mới</option>
											<option value="0">Cũ</option>
					                    </select>
									</div>
									<div class="form-group" >
										<label>Loại sản phẩm</label>
										<select required name="loaisanpham" class="form-control">
											<option value="1">Dưới 500.000đ</option>
											<option value="2">Từ 500k đến 1 triệu đồng</option>
											<option value="3">Từ 1 triệu đến 10 triệu đồng</option>
											<option value="4">Trên 10 triệu đồng</option>
					                    </select>
									</div>

									<div class="form-group" >
										<label>Ảnh sản phẩm</label>
										<input required id="img" type="file" name="image" class="form-control hidden" onchange="changeImg(this)">
					                    <img  id="avatar" class="thumbnail" width="300px" src="source/back-end/img/new_seo-10-512.png">
                                    </div>




									<input type="submit" name="submit" value="Thêm" class="btn btn-primary" onclick="thanhcong();" >
									<a href="#" class="btn btn-danger">Hủy bỏ</a>
								</div>
							</div>
						</form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
<script>
    function thanhcong() {
alert('Thêm thành công sản phẩm');
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
