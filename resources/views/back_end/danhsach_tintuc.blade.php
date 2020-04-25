@extends('back_end.master_admin')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="panel panel-info" >
                    <div class="panel-heading">Danh sách tin tức
                        <a  id="create_record" style="position: relative;left:65%"class="btn btn-primary">Thêm tin tức mới</a>

                    </div>

                    <div class="panel-body">
                        <div class="bootstrap-table">
                            <div class="row">
                                <div class="col-xs-6 col-md-6 col-lg-6">


                                    <select style=" width: 245px;height: 30px;border: 1px #0f74a8 solid"  class="custom-select " >

                                        <option  value="id-asc" >Sắp xếp theo Id (Trên-Dưới)</option>

                                        <option value="id-desc">Sắp xếp theo Id (Dưới-Trên)</option>
                                        <option value="TieuDe-asc"  >Sắp xếp theo Tiêu đề (A-Z)</option>
                                        <option value="TieuDe-desc"  >Sắp xếp theo Tiêu đề(Z-A)</option>



                                    </select>
                                </div>

                                <div style="margin-left: 200px" class="col-xs-3 col-md-3 col-lg-3">

                                    <input style="border: 1px #0f74a8 solid" type="text" name="serach" id="serach" class="form-control" placeholder="Tìm kiếm tin tức" />
                                </div>


                            </div>

                            <div id="ketqua" class="table-responsive">



                                @include('back_end.data_tintuc')


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

    <div id="formModal" class="modal fade" role="dialog">
        <div style="width: 850px;height: auto;" class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm tin tức mới</h4>
                </div>
                <div class="modal-body">

                    <form style=" width: 900px;" method="post" id="sample_form" name="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2" >Tiêu đề : </label>
                            <div class="col-md-8">
                                <input type="text" name="tieude" id="tieude" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="control-label col-md-2">Avatar : </label>
                            <div  class="col-md-2">
                                <input  id="image" type="file" name="image"  class="form-control hidden" onchange="changeImg(this);" >
                                <img  id="avatar" class="thumbnail" width="110px" height="83px" src="source/back-end/img/new_seo-10-512.png">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Thể loại: </label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="theloai" id="theloai">
                                            <option value="chon_the_loai" name="option_theloai"  disabled="disabled" selected="selected">MỜI CHỌN THỂ LOẠI</option>
                                            @foreach($theloai as $tl)
                                                <option name="option_theloai" value="{{$tl->id}}">{{$tl->Ten}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                    <div class="form-group">
                                    <label class="control-label col-md-2" >Loại tin: </label>
                                    <div class="col-md-7">
                                        <select  class="form-control" name="loaitin" id="loaitin">



                                        </select>
                                    </div>
                                    </div>
                                </div>

                            </div>


                        <div  class="form-group">
                            <label  class="control-label col-md-2">Nổi bật : </label>
                            <div style="margin-top: 5px"  class="col-md-2">
                                <input   type="radio" name="noibat" id="noibat" value="1" checked="checked" /> <span>Có</span>

                                <input  type="radio" name="noibat" id="noibat" value="0" /> <span>Không</span>
                            </div>
                        </div>


                        <div class="form-group" >
                            <label class="control-label col-md-2" >Tóm tắt : </label>
                            <div class="col-md-8">
                                <textarea   id="tomtat" name="tomtat"  class="form-control " rows="3"></textarea>
                            </div>



                        </div>








                        <div  class="form-group">
                            <label class="control-label col-md-2" >Nội dung : </label>
                            <div class="col-md-8">
                                <textarea  id="noidung"  class="form-control ckeditor" rows="3"></textarea>
                            </div>
                        </div>

                        <script type="text/javascript">
                            var editor = CKEDITOR.replace('noidung',{
                                language:'vi',
                                filebrowserImageBrowseUrl: 'source/ckfinder/ckfinder.html?Type=Images',
                                filebrowserFlashBrowseUrl: 'source/ckfinder/ckfinder.html?Type=Flash',
                                filebrowserImageUploadUrl: 'source/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: 'public/source/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                            });
                        </script>








                        <br />
                        <div style=" margin-left: -10%" class="form-group" align="center">
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />


                            <input type="submit" style="width: 100px;" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                        </div>
                    </form>
                    <span id="form_result"></span>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Xác nhận</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Bạn có thật sự muốn xóa tin tức này?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //hàm thay đổi ảnh theo ảnh đã chọn trong file
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
        function reset_form(){
            //set lại form và thể loại và loại tin về mặc định
            $('#sample_form').trigger("reset");
            $("option[name=option_theloai"+"][value=chon_the_loai]").prop('selected', true);
            $("option[name=option_loaitin"+"][value=chon_loai_tin]").prop('selected', true);
            $('#avatar').prop('src','source/back-end/img/new_seo-10-512.png');
            CKEDITOR.instances['noidung'].setData('');
            $("#loaitin").html('');

          //  $("#loaitin").prop("disabled", true);
        }

        $(document).ready(function(){

            //thay đổi ảnh khi người dùng chọn ảnh xong


                $('#avatar').click(function(){

                    $('#image').click();
                });







            function fetch_data(page, sort_type, sort_by,query) {  //reload lại table
                $.ajax({
                    url: "admin/news/list?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
                    method: 'GET',

                    dataType: 'text',

                    success: function (data) {


                        $('div#ketqua').html('');
                        $('div#ketqua').html(data);
                    }


                })
            }




            //Ajax  Loại tin theo thể loại
            $('#theloai').change(function () {
                var idTheLoai = $(this).val();

                $.ajax({
                    url: "admin/news/ajax-loai-tin",
                    method:"get",

                    data:{
                        idTheLoai:idTheLoai,
                    },
                    dataType:"text",

                    success:function(data)
                    {
                       // $("#loaitin").prop("disabled", false); //chọn xong thể loại thì được phép chọn loại tin
                        $("#loaitin").html(data);

                    }
                });

            });



            $('#create_record').click(function(){
                $('.modal-title').text('Thêm tin tức mới');
                $('#action_button').val('Add');
                $('#action').val('Add');
                $('#form_result').html('');

                reset_form(); //gọi đến hàm reset form ta định nghĩa ở trên


//liên quan đến hàm click Edit bên dưới ta đã thêm class Hidden vào rồi , mà đây là Ajax ko load lại trang nên khi ấn nút Edit xong
//lại ấn nút Add ngay thì sẽ ko có ô Password nên ta phải remove class Hidden đi khi gọi hàm Add
                $('#formModal').modal('show'); //show cái modal thêm sản phẩm
            });




            var oldImage; //phục vụ cho phần update tin tức

            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                //Do trong cái Ckeditor nếu ta viết tiếng việt các chữ Á Â Ă,Ư,... thì sẽ bị mã hóa HTML Entities
                //do vậy ta phải decode chuyển sang text rồi mới gửi cho database

               var temp1 = CKEDITOR.instances.noidung.getData();   // text nguyên bản gồm cả mã hóa
               var Noidung = $('<textarea />').html(temp1).text();  //chuyển thành text thường


                //upload file bằng Ajax bắt buộc cần truyền qua formData
                var form = $('form')[0]; // 'form' ở đây là thẻ form chứ k phải id hay name
                var formData = new FormData(form);
                formData.append('noidung', Noidung);



                if($('#action').val() == 'Add')
                {
                    action_url = "{{ route('news.store') }}";
                }

                if($('#action').val() == 'Edit')
                {
                    action_url = "{{ route('news.update') }}";
                }

                $.ajax({
                    url: action_url+"?oldImage="+oldImage,
                    method:"post",
                    data: formData,
                    //---------------------------------------------------------------------
                    //Chỉ vì thiếu 3 cái dòng dưới này mà mất 2 ngày hôm nay không upload file bằng Ajax được
                    //Hóa ra dùng formData thì cần phải có 3 dòng này
                    // Dùng $(this).serialize() sẽ không thể gửi request dạng file sang bên kia được

                    type: 'POST',
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    //---------------------------------------------------------------------
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count]  + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';

                            $('#serach').val(''); //vớ vẩn thôi, cho input tìm kiếm về rỗng




                            //nếu thêm thành công thì ta reload lại table và sắp xếp theo id-desc
                            if($('#action').val() == 'Add')
                            {
                                reset_form();

                                //reset lại table và đưa option sắp xếp về lựa chọn desc id
                                $("option[value=id-desc"+"]").prop('selected', true);
                                fetch_data(1,'desc','id','');
                            }
                            else  if($('#action').val() == 'Edit') {
                                $("option[value=id-asc" + "]").prop('selected', true);
                                fetch_data(1, 'asc', 'id', '');
                            }



                        }

                        $('#form_result').html(html);
                        setTimeout(function(){
                            $('#form_result').html('');

                        }, 10000);


                    }
                });
            });




            $(document).on('click', '.edit', function(){

                var id = $(this).attr('id');
                $("#loaitin").html('');


                $('#form_result').html('');
                $.ajax({
                    url :"admin/news/edit/"+id,
                    dataType:"json",
                    success:function(data) {   // khi ấn nút Edit sẽ hiện ra bảng edit, ta tận dụng sửa lại cái bảng Add thành bảng Edit

                        // $("#loaitin").prop("disabled", true);


                        $('#tieude').val(data.result.TieuDe);


                        $("input[name=noibat" + "][value=" + data.result.NoiBat + "]").prop('checked', true); //đặt checked cho nút radio

                        $("option[name=option_theloai" + "][value=" + data.theloai.id + "]").prop('selected', true);



                        for (i = 0; i < data.arrLoaiTin.length; i++){
                            $('#loaitin').append("<option name=option_loaitin value="+data.arrLoaiTin[i].id+">" +data.arrLoaiTin[i].Ten+ " </option>");

                    }


                        $("option[name=option_loaitin"+"][value="+data.result.idLoaiTin+"]").prop('selected', true);


                        //đổi lại đường dẫn đến ảnh của tin tức hiện tại,
                        //nhớ là ta đổi cái ảnh avatar hiển thị chứ input image ta để hidden rồi k đổi làm gì
                        $('#avatar').prop("src",'source/images/news_tintuc/avatar/'+data.result.Hinh);
                        //nếu người dùng không thay đổi ảnh gì thì cái ô input file sẽ không có thông tin dẫn đến bên kia k nhận đc
                        //request, do đó nếu k có thay đổi về ảnh thì ta phải truyền cái biến ảnh cũ oldImage lại cho controller xử lý
                        oldImage = data.result.Hinh;




                        $('#tomtat').val(data.result.TomTat);
                        CKEDITOR.instances['noidung'].setData(data.result.NoiDung);
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Sửa tin tức');
                        $('#action_button').val('Edit');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');


                    }
                })
            });

            var news_id;

            $(document).on('click', '.delete', function(){
                news_id = $(this).attr('id');
                $('.modal-title').text('Xóa tin tức');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
                $.ajax({
                    url:"admin/news/destroy/"+news_id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...'); //set text thành Deleting
                    },


                    success:function(data)
                    {

                        setTimeout(function(){
                            $('#confirmModal').modal('hide'); //ẩn ô confirm
                            $("option[value=id-asc" + "]").prop('selected', true);
                            fetch_data(1, 'asc', 'id', '');
                            alert('Data Deleted');
                            $('#ok_button').text('Delete');
                        }, 1000);
                    }
                })
            });

            //Sắp xếp tìm kiếm

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



