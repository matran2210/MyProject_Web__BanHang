<?php

namespace App\Http\Controllers;

use App\Product;
use Auth;
use App\Type_Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getViewDanhSachSanPham(Request $request)
    {
        $product = Product::orderBy('id','asc')->paginate(5);
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            if($query=='Mới'){
                $tinhtrang =1;
            }else  {
                $tinhtrang=0;
            }
            $product = Product::where('id', 'like', '%'.$query.'%')
                ->orWhere('name', 'like', '%'.$query.'%')
                ->orWhere('unit_price','like', '%'.$query.'%')
                ->orWhere('new',$tinhtrang)
                ->orderBy($sort_by, $sort_type)->paginate(5);
            return view('back_end.data_sanpham',compact('product'));
        }
        return view('back_end.danhsach_sanpham',compact('product'));
    }
    public function getViewThemSanPham()
    {
        //view thêm sản phẩm
        return view('back_end.them_sanpham');
    }
    public function postThemSanPham(Request $request) //thêm sản phẩm vào database
    {
        $product = new Product();
        $product->name = $request->name;
        $product->new = $request->tinhtrang; //tình trạng mới hay cũ tương đương với new =1 hay 0 trong bảng products
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->id_type = $request->loaisanpham;

        if ($request->hasFile('image')){
            $file = $request->image; //trả về 1 mảng nhiều phần của ảnh gồm tên, đường dẫn tạm,....

            $product->image=$file->getClientOriginalName(); //phải dùng hàm này mới lấy ra được tên của ảnh
            //lưu ý để dùng được mấy phương thức lấy tên của ảnh như etClientOriginalName(),.. này ta phải thêm thuộc tính enctype="multipart/form-data" vào
            // trong form : <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">

            //laravel hỗ trợ ta hàm chuyển file đến thư mục , cú pháp là (đường dẫn, tên muốn đặt cho file)
            $file->move('source\images\product',$file->getClientOriginalName());
        }


        $product->save();
        return redirect()->back();


    }

    public function getViewSuaSanPham($id)
    {
        $product = Product::find($id);
        $arrTinhTrang = array(1=>'Mới',0=>'Cũ');
        $arrLoaiSanPham = Type_Product::all();
        return view('back_end.sua_sanpham',compact('product','arrTinhTrang','arrLoaiSanPham'));
    }
    public function postSuaSanPham(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->new = $request->tinhtrang; //tình trạng mới hay cũ tương đương với new =1 hay 0 trong bảng products
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->id_type = $request->loaisanpham;
        if ($request->hasFile('image')){ //nếu người ta thay đổi ảnh thì mới cần cập nhật , k thì cũng k cần làm gì
            $file = $request->image; //trả về 1 mảng nhiều phần của ảnh gồm tên, đường dẫn tạm,....
            $product->image=$file->getClientOriginalName(); //phải dùng hàm này mới lấy ra được tên của ảnh
            //lưu ý để dùng được mấy phương thức lấy tên của ảnh như etClientOriginalName(),.. này ta phải thêm thuộc tính enctype="multipart/form-data" vào
            // trong form : <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">

            //laravel hỗ trợ ta hàm chuyển file đến thư mục , cú pháp là (đường dẫn, tên muốn đặt cho file)
            $file->move('source\images\product',$file->getClientOriginalName());
        }
        $product->save();
        return redirect()->route('getViewListProduct');
    }

    public function postXoaSanPham($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('getViewListProduct');
    }


}
