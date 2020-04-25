<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý tài khoản</title>
    <base href="{{asset('')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <link href="source/back-end/css/styles.css" rel="stylesheet">
  <script src="source/back-end/js/lumino.glyphs.js"></script>
</head>
<body>


<div class="container">

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a  class="navbar-brand" href="{{route('trang-chu-admin')}}">Quay về trang chủ</a>
                <ul class="user-menu">
                    <li class="dropdown pull-right">
                    @if(Auth::check())

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{Auth::user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('logout-admin')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                        </ul>

                    @else



                    @endif

                    </li>
                </ul>
            </div>

        </div><!-- /.container-fluid -->
    </nav>





    <br />
    <h3 align="center">Quản lý danh sách tài khoản người dùng</h3>
    <br />
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Thêm tài khoản mới</button>
    </div>
    <br />
    <div class="table-responsive">
        {{-- 	table với class table table-bordered table-striped sẽ theo chuẩn jquery --}}
        <table id="user_table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th width="15%">Name</th>
                <th width="30%">Email</th>
                <th width="15%">Level</th>
                <th width="20%">Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>
</body>
</html>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thêm tài khoản mới</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form style=" width: 500px" method="post" id="sample_form" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4" >Họ và tên : </label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" >Email : </label>
                        <div class="col-md-8">
                            <input type="text" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div id="form_password" class="form-group">
                        <label class="control-label col-md-4">Password : </label>
                        <div class="col-md-8">
                            <input type="text" name="password" id="password" class="form-control" />
                        </div>
                    </div>

                    <div  class="form-group">
                        <label  class="control-label col-md-4">Level : </label>
                        <div style="margin-top: 5px"  class="col-md-8">
                            <input   type="radio" name="level" id="level" value="Member" checked="checked" /> <span>Member</span>
                            <input  type="radio" name="level" id="level" value="Admin" /> <span>Admin</span>
                        </div>
                    </div>



                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />


                        <input type="submit" style="width: 100px; margin-left: 20%" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                    </div>
                </form>

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
                <h4 align="center" style="margin:0;">Bạn có thật sự muốn xóa tài khoản này?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('user.index') }}",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'level',
                    name: 'level'
                },
                {
                    data: 'action',
                    name: 'action',
                    //orderable đặt = false để cột action không có chức năng sắp xếp
                    orderable: false
                }
            ]
        });

        $('#create_record').click(function(){
            $('.modal-title').text('Thêm tài khoản mới');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#form_password').removeClass('hidden');
//liên quan đến hàm click Edit bên dưới ta đã thêm class Hidden vào rồi , mà đây là Ajax ko load lại trang nên khi ấn nút Edit xong
//lại ấn nút Add ngay thì sẽ ko có ô Password nên ta phải remove class Hidden đi khi gọi hàm Add
            $('#formModal').modal('show'); //show cái modal thêm sản phẩm
        });






        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = '';


            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('user.store') }}";
            }

            if($('#action').val() == 'Edit')
            {
                action_url = "{{ route('user.update') }}";
            }

            $.ajax({
                url: action_url,
                method:"POST",

                data:$(this).serialize(), //lấy toàn bộ dữ liệu từ những ô input chuyển sang bên thực hiện ajax
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
                        $('#sample_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                    }

                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url :"admin/user/"+id+"/edit",
                dataType:"json",
                success:function(data)
                {   // khi ấn nút Edit sẽ hiện ra bảng edit, ta tận dụng sửa lại cái bảng Add thành bảng Edit

                    //data.result.name là dữ liệu trả về của Ajax ở hàm Edit bên UserController đó
                    $('#name').val(data.result.name);
                    $('#email').val(data.result.email);
                    $('#form_password').addClass('hidden'); //ẩn tạm thẻ password đi vì eidt ta k đụng đến nó, sau đó phải trả
                    $("input[name=level"+"][value="+data.result.level+"]").prop('checked', true); //đặt checked cho nút radio


                    $('#hidden_id').val(id);
                    $('.modal-title').text('Sửa thông tin tài khoản');
                    $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function(){
            user_id = $(this).attr('id');
            $('.modal-title').text('Xóa tài khoản');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"admin/user/destroy/"+user_id,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...'); //set text thành Deleting
                },


                success:function(data)
                {

                    setTimeout(function(){
                        $('#confirmModal').modal('hide'); //ẩn ô confirm
                        $('#user_table').DataTable().ajax.reload(); //reload lại table
                        alert('Data Deleted');
                        $('#ok_button').text('Delete');
                    }, 1000);
                }
            })
        });

    });
</script>

</body>
</html>
