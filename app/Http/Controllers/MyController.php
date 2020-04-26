<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_Reward;
use App\Http\Requests\MySignInRequest_User;
use App\Http\Requests\MySignUpRequest;
use App\News_Comment;
use App\News_LoaiTin;
use App\News_TheLoai;
use App\News_TinTuc;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Slide;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\Detail_Bill;
use App\Http\Requests\MyRequest_Info_Customer;
use Hash;
use Auth;
 use Validator;
use Illuminate\Support\Collection;



class MyController extends Controller
{


    //Controller trang tin tức (phía người dùng)
    public function getViewTrangChuTinTuc(){
        $tintuc =News_TinTuc::where('NoiBat',1)->paginate(5);
        //thể loại và loại tin nếu lấy all() thì ta để bên View Share AppServiceProvider

        return view('page_news.trangchu_tintuc',compact('tintuc'));
    }
    public function getViewChiTietTinTuc($id,Request $req){
        $tintuc = News_TinTuc::findOrFail($id);
        $tinnoibat = News_TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = News_TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        $binhluan = News_Comment::where('idTinTuc',$id)->limit(5)->get();


        if($req->ajax()){

            if ($req->id_remove != ''){ // nếu có tín hiệu xóa thì xóa
                $data = News_Comment::findOrFail($req->id_remove);
                $data->delete();
            }
            $binhluan = News_Comment::where('idTinTuc',$id)->limit(5)->get();
            if($req->limit_loadmore!=''){
                $binhluan = News_Comment::where('idTinTuc',$id)

                    ->limit($req->limit_loadmore)->get();



            }



            return view('page_news.data_comment',compact('binhluan'));
        }




        return view('page_news.chitiet_tintuc',compact('tintuc','tinlienquan','tinnoibat','binhluan'));
    }
    public function getViewLoaiTinTuc($type){
        $tintuc_theoloai=News_TinTuc::where('idLoaiTin',$type)->paginate(5);
        $tenLoaiTin = News_LoaiTin::findOrFail($type);

        return view('page_news.loai_tintuc',compact('tintuc_theoloai','tenLoaiTin'));
    }
    public function ajaxGuiDangnhap(Request $req){ //cho chức năng comment

        $rules = array(
            'email'    =>  'bail|required|email',
            'password'     =>  'bail|required|min:3',


        );

        $error = Validator::make($req->all(), $rules);

        if($error->fails())
        {

            return response()->json(['errors' => $error->errors()->all()]);
        }


        $credentials = array('email'=>$req->email,'password'=>$req->password);


        if(Auth::attempt($credentials)){
            $ten = Auth::user()->name;
            return response()->json(['success' => 'Đăng nhập thành công','user_name'=>$ten]);
        }else{
            return response()->json(['fail' => 'Đăng nhập thất bại, kiểm tra lại thông tin đăng nhập']);
        }


    }
    public function ajaxGuiBinhLuan($id,Request $req){
        $rules = array(
            'comment'    =>  'bail|required|max:300',



        );

        $error = Validator::make($req->all(), $rules);

        if($error->fails())
        {

            return response()->json(['errors' => $error->errors()->all()]);
        }
            $cmt = New News_Comment();
            $cmt->idTinTuc  = $id;
            $cmt->idUser = Auth::user()->id;
            $cmt->noiDung = $req->comment;
            $cmt->save();
        return response()->json(['cmt' => $cmt,'user'=>Auth::user(),'success'=>'Bình luận thành công']);
    }



















//------------------------------------------------------------------------------------------------------------------------
    public function getIndex(){
        $slide = Slide::all();
        $new_product = Product::where('new',1)->get();
        $promotion_product = Product::where('promotion_price','<>',0)->get();
        return view('index',compact('slide','new_product','promotion_product'));
    }


    public function getViewSuKien(Request $req){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time_sever = Carbon::now();


        //làm rõ vấn đề: do thiết kế ngu nên 2 bảng event và bảng event_reward chả liên quan mẹ gì đến nhau cả
        //do đó ta sẽ dùng bảng event_reward để lưu các phần thưởng thôi , sau đó dùng hàm Random lấy ra 1
        //phần thưởng cho người dùng và lưu trực tiếp tên phần thưởng vào bảng event chứ k lưu qua id làm gì cả
        // Mà k hiểu sao đặt tên bảng là event






        if(Auth::check()){
            $idUser = Auth::user()->id;


        }
        else $idUser = null;


        //nếu dùng ->get() thì lúc nào cũng trả về 1 mảng object, dùng first() thì chỉ trả về 1 object đầu tiên
        //ta dùng first vì ta biết trong bảng events chỉ có 1 trường hợp thỏa mãn mode ON
        $event = Event::where('idUser',$idUser)->where('mode','ON')->first();
        if($event==null){ //nếu object rỗng thì gán deadline=0
            $deadline=0;
        }
        else{
            $deadline = $event->deadline;

        }




        if ($req->ajax()){

            if($req->mode=="OFF"){ // nhận Ajax khi hết thời gian hiệu lực
                $event = Event::where('idUser',$idUser)->where('mode','ON')->first();
                $event->mode = "OFF";
                $event->save();
            }else{  //nhận Ajax khi người dùng click nhận quà
                // 12 tiếng  ->addHour(12)
                $event_reward = Event_Reward::all()->random(1)->first();
                //ta phải lấy lại thời gian sever ở thời điểm người dùng gửi ajax thì mới chuẩn được chứ
                // $time_sever ta lấy ở trên kia là ta lấy lúc vừa load trang web , ko chuẩn khi 1 lúc người dùng mới
                //click ajax .  Và nhớ gửi lại time_sever cập nhật mới sang bên view
                //load lại trang thì chả có vấn đề gì nhưng đã dùng ajax thì phải xử lý hết mức
                $time_severs = Carbon::now();
                //hàm addSecond sẽ làm thay đổi kết quả của biến $time_sever luôn, do đó
                //sau khi addHour(12) thì ta phải gọi lại Carbon::now() để về đúng thời điểm hiện tại
                //vì ta cần truyền $time_Sever sang view mà

                $deadline =$time_severs->addSeconds(25);

                 $time_severs = Carbon::now();




                $e = new Event();
                $e->idUser = $idUser;
                $e->deadline = $deadline;
                if ($event_reward->noidung!="Chúc bạn may mắn lần sau"){
                    $e->reward = $event_reward->noidung;
                }

                $e->save();
                return response()->json(['time_sever'=>$time_severs,'deadline' => $deadline,'event_reward'=>$event_reward->noidung]);

            }

        }
        return view('pages.sukien',compact('time_sever','deadline'));





    }
    public function getGioiThieu(){
        return view('pages.gioithieu');
    }
    public function getLienHe(){
        return view('pages.lienhe');
    }
    public function getLoaiSanPham(Request $req,$type){

        $sp_theoloai =Product::where('id_type',$type)->orderBy('name', 'asc')->paginate(4);

        if ($req->ajax()) {
            $sort_type = $req->get('sorttype');
            $sort_by = $req->get('sortby');



            $sp_theoloai =Product::where('id_type',$type)->orderBy($sort_by, $sort_type)->paginate(4);
            //méo hiểu thiếu  dấu - ở chỗ ->orderBy mà nó ko báo lỗi, làm tìm mỏi cả mắt
            return view('pages.data_loaisanpham', compact('sp_theoloai'));
        }


        return view('pages.loaisanpham',compact('sp_theoloai'));







    }
    public function getChiTietSanPham(Request $req){
        $sanpham = Product::where('id',$req->id)->first();
        return view('pages.chitietsanpham',compact('sanpham'));
    }

    public function getAddtoCart(Request $req,$id){

        $product = Product::find($id);
        //toán tử 3 ngôi kiểm tra xem trong session đã có session cart hay chưa,
        //nếu có rồi thì lấy ra, chưa thì  = null
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $n=1;
         //$n là số lượng sản phẩm, mặc định là 1 để phục vụ cho các trường hợp add to cart nhanh ko nhập số lượng
         if($req->has('input_quantity')){ //nếu có request thì mới gán cho $n chứ k có request thì cứ để nó =0
            $n= $req->input('input_quantity');
         }


        $cart->add($n,$product,$id); //hàm đã viết trong model Cart.php
        $req->session()->put('cart',$cart); //đưa $cart vào session 'cart', phải sử dụng Request $req ở đầu hàm


         // dùng nếu cần xóa session (phục vụ test)
         //$req->session()->forget('cart');

        return redirect()->back(); //quay trở về view ban đầu của nó, hiểu đơn giản là vì phần giỏ hàng mình để ở trên đầu header nên dùng ->back để quay lên trên đầu là hợp lý r

    }
    public function getdeleteCart($id){
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        if (count($cart->items)>1){ //khi click nút xóa, nếu có nhiều sản phẩm thì ta xóa bình thường
            Session::put('cart',$cart);
        }
        else{  //nhưng nếu chỉ còn 1 sản phẩm cuối mà ta xóa thì ta xóa luôn session để cho view giỏ hàng trong header sẽ hiện trống.
            Session::forget('cart');
        }
        $cart->removeItem($id);


        return redirect()->back();
    }

    public function getGioHang(){

        return view('pages.giohang');
    }
    public function getDangnhap(){
        return view('pages.dangnhap');
    }
    public function getDangky(){
        return view('pages.dangky');
    }
    public function getDatHang(){

        return view('pages.dathang');

    }
    public function postThanhToan(MyRequest_Info_Customer $req){
        //mấy cái $req->... ví dụ $req->fullname do fullname là thuộc tinh name="fullname" của thẻ input tương ứng bên html
        //và lưu ý cascc thẻ input phải bọc trong 1 thẻ form với phương thức get post tương ứng thì mới lấy được request
        $cart = Session::get('cart');


            $customer = new Customer();
            $customer->name = $req->fullname;
            $customer->gender = $req->gender;
            $customer->email = $req->email;
            $customer->address = $req->address;
            $customer->phone = $req->phone;
            $customer->save();


            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order= date('Y-m-d');
            $bill->total_Price = $cart->totalPrice;
            $bill->unit_payment = $req->payment;
            $bill->save();



        foreach($cart->items as $key=>$value){ //value đại diện cho giá trị
            $detail_bill = new Detail_Bill();
            $detail_bill->id_bill = $bill->id;
            $detail_bill->id_product = $key; //bằng $key là do ta đã để $key của $cart['items] = $id bên hàm add() của class Cart
            $detail_bill->quantity = $value['qty'];
            $detail_bill->unit_price = $value['price']/$value['qty'];
            $detail_bill->save();
        }

           Session::forget('cart');

        return redirect()->back();

    }
    public function postThanhToanCoTaiKhoan(Request $req){
        $cart = Session::get('cart');
        $bill = new Bill();
        $bill->id_customer = Auth::user()->id;
        $bill->date_order= date('Y-m-d');
        $bill->total_Price = $cart->totalPrice;
        $bill->unit_payment = $req->payment1;
        $bill->save();



        foreach($cart->items as $key=>$value){ //value đại diện cho giá trị
            $detail_bill = new Detail_Bill();
            $detail_bill->id_bill = $bill->id;
            $detail_bill->id_product = $key; //bằng $key là do ta đã để $key của $cart['items] = $id bên hàm add() của class Cart
            $detail_bill->quantity = $value['qty'];
            $detail_bill->unit_price = $value['price']/$value['qty'];
            $detail_bill->save();
        }

        Session::forget('cart');

        return redirect()->back();
    }

    public function postGuiDangky(MySignInRequest_User $req){
        $user = new User();
        $user->name = $req->fullname;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->password = Hash::make($req->password); //Dùng Hash để mã hóa mật khẩu khi lưu vào csdl
        $user->save();
        // cái lệnh with('thanhcong') này sẽ tạo ra 1 Session tên là thanhcong, ta sẽ vận dụng để kiểm tra trong view
        //nếu có Session này thì sẽ in ra câu Tạo tài khoản thành công
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }
    public function postGuiDangnhap(MySignUpRequest $req){
        $rememberMe = false;


        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(isset($req->remember_me)){
            $rememberMe=true;
        }

        if(Auth::attempt($credentials,$rememberMe)){
            return redirect()->route('trang-chu');
        }else{
            return redirect()->back()->with('thatbai','Đăng nhập thất bại'); //đưa ra Session thatbai
        }


    }

    public function getGuiDangxuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    public function getTimKiem(Request $req){

        if($req->key==null){
            //return view('pages.trangchu'); trường hợp này phải dùng redirect()->route()
            //bởi vì muốn return view thì phải truyền đầy đủ biến vào mới được
            // cái view trang-chu này cần đủ biến  return view('pages.trangchu',compact('slide','new_product','promotion_product'));
            //như trong hàm getIndex() thì mới chạy. Nói chung muốn return về trang gì cho tiện thì dùng redirect
            //nhưng lưu ý là do view trang-chu không truyền biến gì sang thì mới làm thế được chứ
            //ví dụ trang loaisanpham có truyền biến $type sang, ta không redirect về trang đó không được.
            //Nói chung các view có tham số chuyển qua controller thì ta phải xử lý hết
            return redirect()->route('trang-chu');
        }else{
            $product = Product::where('name','like','%'.$req->key.'%')->orwhere('unit_price',$req->key)->get();
            //phương thức like % là để người dùng chỉ cần nhập gần đúng cũng đc, k cần chính xác

            return view('pages.timkiem',compact('product'));
        }


    }

    function getAjax(Request $request)
    {
        if($request->ajax()){
            $sort_type = $request->get('sorttype');
            $sort_by = $request->get('sortby');
            $type = $request->get('type');

            $sp_theoloai =Product::where('id_type',$type)->orderBy($sort_by, $sort_type)->paginate(4);
            //méo hiểu thiếu  dấu - ở chỗ ->orderBy mà nó ko báo lỗi, làm tìm mỏi cả mắt
            return view('pages.data_loaisanpham', compact('sp_theoloai'));


        }
        else dd('không thấy ajax');



    }










}
