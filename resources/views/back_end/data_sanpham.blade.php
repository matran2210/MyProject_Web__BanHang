<table class="table table-bordered" style="margin-top:20px;">
    <thead>
    <tr class="bg-primary">
        <th>ID</th>
        <th width="30%">Tên Sản phẩm</th>
        <th>Giá gốc sản phẩm</th>

        <th width="20%">Ảnh sản phẩm</th>
        <th>Tình trạng</th>
        <th >Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @foreach($product as $p)
        <tr>

            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>

            <td>{{number_format($p->unit_price)}}đ</td>
            <td>
                <img width="80px" src="source/images/product/{{$p->image}}" class="thumbnail">
            </td>
            @if($p->new==1)
                <td>Mới</td>
            @else
                <td>Cũ</td>
            @endif
            <td>


                <form action="{{route('postDeleteProduct',$p->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <a href="{{route('getViewEditProduct',$p->id)}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>



                <button onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" type="submit" id="delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                </form>

            </td>

        </tr>
    @endforeach

    </tbody>

</table>
{{$product->links()}}
