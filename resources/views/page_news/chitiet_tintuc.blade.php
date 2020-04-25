@extends('master')

@section('content')
    <div style="font-family: Arial" class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div  class="col-md-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a>The matrix news</a>
                </p>




                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Đăng lúc {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead"> {{$tintuc->TomTat}} </p>

{{--                thế méo nào dùng {!!  !!} mới lấy ra được nội dung html ta--}}
               {!! $tintuc->NoiDung !!}

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span> </h4>
                    <form name="cmt_form" role="form" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="text_comment" name="comment" rows="3"></textarea>

                        </div>
                        @if(Auth::check())
                        <button type="submit"  id="submit_cmt" name="submit_cmt"  class="btn btn-info">Gửi</button>
                            @else
            {{--           Chú ý nếu để button type = submit thì nó sẽ load lại trang, phải để type=button--}}
                    <button data-toggle="modal" data-target="#formModal" id="request_login" type="button" class="btn btn-info">Gửi</button>
                            <button type="submit"  id="submit_cmt" name="submit_cmt"  class="btn btn-info hidden">Gửi</button>
                        @endif

                    </form>
                    <br>
                    <span id="thongbao-result"> </span>



                </div>

                <hr>

                <!-- Posted Comments -->
                {{ csrf_field() }}
                <div id="result_cmt">

               @include('page_news.data_comment')
                </div>
                <hr>
                <div id="load_more" style="text-align: center" >
                    <button type="button" style="width: 40%;display: inline-block" class="btn btn-info form-control" data-limit="5" id="load_more_button">Xem thêm</button>
                </div>
                <div id="collapse" class="hidden" style="text-align: center" >
                    <button  type="button" style="width: 40%;display: inline-block" class="btn btn-info form-control" data-limit="5" id="collapse_button">Thu gọn</button>
                </div>




            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        @foreach($tinlienquan as $tin)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="{{route('chitiet_tintuc',$tin->id)}}">
              <img style="width: 80px;height: 80px"  src="source/images/news_tintuc/avatar/{{$tin->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="{{route('chitiet_tintuc',$tin->id)}}"><b>{{$tin->TieuDe}}</b></a>
                            </div>
                          <span style="display:block;text-overflow: Ellipsis;width: 200px;overflow: hidden;height: 50px;"><p >{{$tin->TomTat}}</p> </span>...
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                            @endforeach


                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                    @foreach($tinnoibat as $tin)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="{{route('chitiet_tintuc',$tin->id)}}">
                                        <img style="width: 80px;height: 80px"  src="source/images/news_tintuc/avatar/{{$tin->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{route('chitiet_tintuc',$tin->id)}}"><b>{{$tin->TieuDe}}</b></a>
                                </div>
                                <span style="display:block;text-overflow: Ellipsis;width: 200px;overflow: hidden;height: 50px;"><p >{{$tin->TomTat}}</p> </span>...
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>

    <hr>

    <div style="font-family: Arial" id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Xác nhận</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Bạn có thật sự muốn xóa bình luận này?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div style="font-family: Arial" id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bạn cần đăng nhập trước khi bình luận</h4>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form  style=" width: 500px" method="post" id="sample_form" name="sample_form" class="form-horizontal">
                        @csrf

                        <div class="form-group">
                            <label class="control-label col-md-4" >Email : </label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                        </div>
                        <div id="form_password" class="form-group">
                            <label class="control-label col-md-4">Password : </label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>
                        </div>




                        <div class="form-group" align="center">

                            <input type="submit" style="width: 100px; height: 40px; margin-left: 20%" name="login_button" id="login_button" class="btn btn-warning" value="Đăng nhập" />


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function(){

            $('#login_button').click(function(event){
                event.preventDefault();


                $.ajax({
                    url:"{{route('ajaxdangnhap')}}",
                    method:"POST",
                    //đéo hiểu viết là $(this).serialize() thì bị lỗi 419
                    data: $('form').serialize(), //form là form nói chung chứ k phải tên form cụ thể

                    dataType:"json",

                    success:function(data)
                    {
                        var html = '';
                        var temp='';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';

                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count]  + '</p>';
                            }
                            html += '</div>';

                        }
                        else if(data.success)
                        {

                            html = '<div class="alert alert-success">' + data.success + '</div>';

                            //tạo lại cái ô UserName| Đăng Xuất , vì cái ô cũ phải load lại trang mới lấy được
                            $('#user_name').html('');
                        temp = '<li><a id="user_name" href="#">'  + data.user_name + '</a></li>';
                            temp+= '<li><a href="{{route('guidangxuat')}}">Đăng xuất</a></li>' ;
                            $('#user_name').html(temp);

                            //ẩn nút mở form modal login đi thay bằng nút submit_cmt như lúc đã đăng nhập rồi
                            //do cái if(Auth::check()) vẫn cần load lại trang mới được
                            $('#request_login').addClass('hidden');
                            $('#submit_cmt').removeClass('hidden');

                            //load lại data bình luận để thêm nút xóa cho những bình luận của tài khoản vừa login
                            fetch_data('','');  //k thực hiện chức năng loadmore hay xóa cmt thì truyền rỗng


                            //tắt cái modal đăng nhập đi
                            setTimeout(function(){

                                //phải có 2 lệnh dưới này thì mới tự động tắt cái màn đen của modal đi
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                $('#formModal').modal('hide'); //ẩn ô formModal


                            }, 1000);


                        }
                        else if(data.fail)
                        {
                            html = '<div class="alert alert-danger">' + data.fail + '</div>';

                        }

                        $('#form_result').html(html);




                    }
                })
            });
            $('#submit_cmt').click(function(event){
                event.preventDefault();


                $.ajax({
                    url:"{{route('ajaxbinhluan',$tintuc->id)}}",
                    method:"POST",
                    //đéo hiểu viết là $(this).serialize() thì bị lỗi 419
                    data: $('form').serialize(), //form là form nói chung chứ k phải tên form cụ thể

                    dataType:"json",

                    success:function(data) {
                        if (data.errors) {
                            error = '<div class="alert alert-danger">';

                            for (var count = 0; count < data.errors.length; count++) {
                                error += '<p>' + data.errors[count] + '</p>';
                            }
                            error += '</div>';
                            $('#thongbao-result').html(error);

                        }
                        else {
              //Thay vì viết lại cả cái thẻ html ở bên dưới thì chúng ta có thể load lại data bằng fetch_data('khong_xoa');


                            var html = '';
                            html = '<div  class="media">';
                            html += ' <a class="pull-left"> ';
                            html += ' <img style="width: 40px;height: 50px" class="media-object" src="source/images/user/' + data.user.Avatar + '" alt="avatar"> ';
                            html += '</a>';
                            html += '   <div class="media-body">  ';
                            html += '    <h4 class="media-heading">' + data.user.name + '  ';
                            html += '   <small>' + data.cmt.created_at + '</small>  ';
                            html += '   <small>';
                            html += '<a id="remove_cmt" data-toggle="modal" data-target="#confirmModal" data-id="'+data.cmt.id+'" class="remove_cmt glyphicon glyphicon-remove"> </a> </small>  ';
                            html += '   </small>';
                            html += '   </h4> ';
                            html += data.cmt.noiDung;
                            html += '</div>';
                            html += '</div>';
                            html += '<br>';

                            $('#result_cmt').prepend(html); //chèn cmt vào vị trí đầu tiên, append là truyền vào vị trí cuối cùng


                            var thongbao = '<div class="alert alert-success">' + data.success + '</div>';

                            $('#thongbao-result').html(thongbao);
                            $('#text_comment').val('');
                        }

                        setTimeout(function () {
                            $('#thongbao-result').html('');
                        },2000);

                    }
                })
            });
            //Nếu dùng vòng foreach thì 1 đống thẻ sẽ có chung id là #remove_cmt, do vậy , id không là duy nhất
            // nên ta chỉ lấy được cái đầu tiên khi dùng  $('#remove_cmt').click(function () {
            //do  đó phải dùng lệnh dưới gọi theo class .remove_cmt và lấy giá trị =   $(this).attr('data-id');

            function fetch_data(id_remove ,limit_loadmore) {
                $.ajax({
                    url: "news/chi-tiet-tin-tuc/{{$tintuc->id}}?id_remove="+id_remove+"&limit_loadmore="+limit_loadmore,
                    method: 'GET',

                    dataType: 'text',

                    success: function (data) {

                        $('div#result_cmt').html('');
                        $('div#result_cmt').html(data);
                        $('#load_more_button').html('Xem thêm'); //set lại cho cái nút load more

                    }


                })
            }
            var id_remove='';
            $(document).on('click', '.remove_cmt', function(){
                id_remove=  $(this).attr('data-id');






            });
            $('#ok_button').click(function(){
                $('#ok_button').text('Deleting...');
                fetch_data(id_remove,'');

                setTimeout(function(){
                    //phải có 2 lệnh dưới này thì mới tự động tắt cái màn đen của modal đi
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#confirmModal').modal('hide'); //ẩn ô formModal
                    $('#ok_button').text('OK');

                }, 500);

            });




            ///////////////////////////////////////////////////////////////////////////////



            $(document).on('click', '#load_more_button', function(){
               var limit_loadmore = $(this).data('limit')+5;
                var soluot_cmt = {{count($tintuc->binhluan)}} //láy ra số bình luận của tin tức này

                    $('#load_more_button').html('<b>Loading...</b>');


                fetch_data('',limit_loadmore);


                $('#load_more_button').data('limit',limit_loadmore); //set lại data-limit phải để sau fetch_data


                if(soluot_cmt<=limit_loadmore){ //đặt dưới cùng, nếu số limit > số lượng cmt hiện có r thì đổi thành nút thu gọn

                        $('#load_more').addClass('hidden');
                        $('#collapse').removeClass('hidden');



                }
            });

            $(document).on('click', '#collapse_button', function(){
                fetch_data('',5); //thu gọn lại còn 5 cmt
                $('#load_more_button').data('limit',5); //đặt lại mặc định limit=5 cho nút
                $('#collapse').addClass('hidden');
                $('#load_more').removeClass('hidden');

            });











        });

    </script>
@endsection

