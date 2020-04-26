@extends('back_end.master_admin')
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">

				<div class="panel panel-info" >
					<div class="panel-heading">Danh sách sản phẩm
                        <a style="position: relative;left:63%" href="{{route('getViewAddProduct')}}" class="btn btn-primary">Thêm sản phẩm</a>

                    </div>

					<div class="panel-body">
						<div class="bootstrap-table">
                            <div class="row">
                                <div class="col-xs-6 col-md-6 col-lg-6">


                                    <select style=" width: 245px;height: 30px;border: 1px #0f74a8 solid"  class="custom-select " >

                                        <option selected value="id-asc" >Sắp xếp theo Id (Trên-Dưới)</option>

                                        <option value="id-desc">Sắp xếp theo Id (Dưới-Trên)</option>
                                        <option value="name-asc"  >Sắp xếp theo Tên sản phẩm (A-Z)</option>
                                        <option value="name-desc"  >Sắp xếp theo Tên sản phẩm (Z-A)</option>



                                    </select>
                                </div>

                                <div style="margin-left: 200px" class="col-xs-3 col-md-3 col-lg-3">

                  <input style="border: 1px #0f74a8 solid" type="text" name="serach" id="serach" class="form-control" placeholder="Tìm kiếm sản phẩm" />
                                   </div>


                            </div>

							<div id="ketqua" class="table-responsive">



								@include('back_end.data_sanpham')


							</div>
						</div>
						<div class="clearfix"></div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_sort_by" id="hidden_sort_by" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->

    <script>
        $(document).ready(function(){



            function fetch_data(page, sort_type, sort_by,query) {
                $.ajax({ //ajax này gọi đến route của listProduct thực hiện hàm getListProduct trong AdminController
                    url: "admin/product/list?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
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

                var str = event.target.value;
                var splitted =  str.split('-');
                var sortBy = splitted[0];
                var sortType = splitted[1];
                var query = $('#serach').val();


                $('#hidden_sort_by').val(sortBy);
                $('#hidden_sort_type').val(sortType);


                var page = $('#hidden_page').val();

                fetch_data(page,sortType, sortBy,query);
            })
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                var page=$(this).attr('href').split('page=')[1];
                var query = $('#serach').val();

                $('#hidden_page').val(page);
                var sortBy = $('#hidden_sort_by').val();
                var sortType = $('#hidden_sort_type').val();


                fetch_data(page,sortType, sortBy,query);
            });

            $(document).on('keyup', '#serach', function(){
                var query = $('#serach').val();
                var sortBy = $('#hidden_sort_by').val();
                var sortType = $('#hidden_sort_type').val();
                // var page = $('#hidden_page').val();
                var page = 1; //mình nghĩ khi tìm kiếm nên đặt lại page =1 chứ  k nên lấy ra page hiện tại
                //vì nếu đang ở page =40 mà kết quả tìm kiếm chỉ có 6 kết quả thì ta phải quay về page=1 mới thấy đc kết quả
                fetch_data(page, sortType, sortBy, query);
            });

        });
    </script>
@endsection
