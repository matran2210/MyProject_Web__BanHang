
<table class="table table-bordered" style="margin-top:20px;">
    <thead>
    <tr class="bg-primary">
        <th>ID</th>
        <th width="50%">Tiêu đề</th>
        <th>Loại tin</th>

        <th >Thể loại</th>
        <th>Action</th>


    </tr>
    </thead>
    <tbody>
    @foreach($tintuc as $tt)
        <tr class="odd gradeX" align="center">
            <td>{{$tt->id}}</td>
            <td>{{$tt->TieuDe}}</td>
            <td>{{$tt->loaitin->Ten}}</td>

            <td>{{$tt->loaitin->theloai->Ten}}</td>

    <td class="center">
        <button style="width: 60px" type="button" name="edit" id="{{$tt->id}}" class="edit btn btn-primary btn-sm">Edit</button>
        &nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="{{$tt->id}}" class="delete btn btn-danger btn-sm">Delete</button>

    </td>
        </tr>

    @endforeach

    </tbody>

</table>
{{$tintuc->links()}}
