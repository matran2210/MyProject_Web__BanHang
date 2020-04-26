<?php

namespace App\Http\Controllers;

use App\News_LoaiTin;
use App\News_TheLoai;
use App\News_TinTuc;
use Validator;


use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function getViewDanhSachTinTuc(Request $request){
        $theloai = News_TheLoai::all(); //do ta dùng modal hide nên dữ liệu của phần thêm tin tức cũng phải lấy luôn từ trang danh sách
        $loaitin =News_LoaiTin::all();


        $tintuc = News_TinTuc::paginate(10);



        if ($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');

            if($query==''){ //nếu người dùng xóa hết nội dung trong ô Search hoặc ban đầu chưa nhập query
                $tintuc = News_TinTuc::orderBy($sort_by, $sort_type)->paginate(10);
            }else {


// Liệt kê các tin tức có loại tin = $query , phải dùng or khi có nhiều điều kiện  khác nhau chứ thực tế nó là hàm whereHas thôi
                $tintuc = News_TinTuc::where('id', $query)
                    ->orWhere('TieuDe', 'like', '%' . $query . '%')
                    ->orwhereHas('loaitin', function ($q) use ($query) { // phải dùng use($query) để truyền biến vào hàm này
                        // loaitin ở đây là cái hàm  quan hệ trong Model News_TinTuc
                        $q->where('Ten', 'like', '%' . $query . '%');
                    })
                    ->orwhereHas('loaitin.theloai', function ($q) use ($query) { // truy cập loaitin xong truy cập hàm theloai
                        // theloai ở đây là cái hàm  quan hệ trong Model News_LoaiTin, ta truy cập trung gian
                        $q->where('Ten', 'like', '%' . $query . '%');
                    })






                ->orderBy($sort_by, $sort_type)->paginate(10);

            }
            return view('back_end.data_tintuc',compact('tintuc'));


        }

        return view('back_end.danhsach_tintuc',compact('tintuc','theloai','loaitin'));
    }
    public function getAjaxLoaiTin(Request $request){
    if($request->ajax()){
        $idTheLoai = $request->get('idTheLoai');
        $loaitin = News_LoaiTin::where('idTheLoai',$idTheLoai)->get();
        echo " <option disabled=\"disabled\" selected=\"selected\">MỜI CHỌN LOẠI TIN</option>";
        foreach ($loaitin as $lt){
            echo " <option name=\"option_loaitin\" value='".$lt->id."'>".$lt->Ten."</option>";
        }

    }

}


    public function store(Request $request){

        $rules = array(

            'tieude' => 'required',
            'tomtat' => 'required',
            'noidung' => 'required',
            'theloai' => 'required',
            'loaitin' => 'required',
            'image' => 'bail|required|image'



        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {

            return response()->json(['errors' => $error->errors()->all()]);
        }

       if ($request->hasFile('image')){

            $file = $request->file('image'); //trả về 1 mảng nhiều phần của ảnh gồm tên, đường dẫn tạm,....
           $nameImg=$file->getClientOriginalName(); //phải dùng hàm này mới lấy ra được tên của ảnh

            $file->move('source\images\news_tintuc\avatar',$file->getClientOriginalName());

       }



        $form_data = array(
            'TieuDe'         =>  $request->input('tieude'),
            'TieuDeKhongDau'        =>  changeTitle($request->input('tieude')),
            'TomTat'         =>  $request->input('tomtat'),
            'NoiDung'         =>  $request->input('noidung'),
            'NoiBat'         =>  $request->input('noibat'),
            'idLoaiTin'     => $request->input('loaitin'),
            'Hinh'  => $nameImg

        );



        News_TinTuc::create($form_data);




        return response()->json(['success' => 'Thêm dữ liệu thành công!']);
    }
    public function edit($id)
    {

        if(request()->ajax())
        {
            $data = News_TinTuc::findOrFail($id);
            $loaitin = News_LoaiTin::findOrFail($data->idLoaiTin);
            $theloai = News_TheLoai::findOrFail($loaitin->idTheLoai);
            $lt =News_LoaiTin::where('idTheLoai',$theloai->id)->get();
            return response()->json(['result' => $data,'theloai'=>$theloai,'arrLoaiTin'=>$lt]);
        }
    }
    public function update(Request $request){

        $rules = array(

            'tieude' => 'required',
            'tomtat' => 'required',
            'noidung' => 'required',
            'theloai' => 'required',
            'loaitin' => 'required',
             'image' => 'image'   //updated thì bỏ điều kiện reuquired đi


        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {

            return response()->json(['errors' => $error->errors()->all()]);
        }



        if ($request->hasFile('image')){

            $file = $request->file('image'); //trả về 1 mảng nhiều phần của ảnh gồm tên, đường dẫn tạm,....
            $nameImg=$file->getClientOriginalName(); //phải dùng hàm này mới lấy ra được tên của ảnh

            $file->move('source\images\news_tintuc\avatar',$file->getClientOriginalName());

        }
        else{ //nếu không có yêu cầu thay đổi ảnh thì mình lấy tên cũ của ảnh lưu vào csdl thôi , nhới validator ở trên bỏ điều kiện required
            $nameImg = $request->get('oldImage');
        }

        $form_data = array(
            'TieuDe'         =>  $request->input('tieude'),
            'TieuDeKhongDau'        =>  changeTitle($request->input('tieude')),
            'TomTat'         =>  $request->get('tomtat'),
            'NoiDung'         =>  $request->input('noidung'),
            'NoiBat'         =>  $request->input('noibat'),
            'idLoaiTin'     => $request->input('loaitin'),

                'Hinh'  => $nameImg



        );




        News_TinTuc::whereId($request->hidden_id)->update($form_data);




        return response()->json(['success' => 'Sửa dữ liệu thành công!']);

    }

    public function destroy($id)
    {


        $data = News_TinTuc::findOrFail($id);
        $data->delete();

    }
}
