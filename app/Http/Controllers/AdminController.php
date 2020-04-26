<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{



public function getViewTrangChu(){
    return view('back_end.trangchu');
}
public function getLoginAdmin(){
    return view('back_end.login_admin');
}
public function postLoginAdmin(Request $req){
    $credentials = array('email'=>$req->email,'password'=>$req->password);
    if(Auth::attempt($credentials)){
        return redirect()->route('trang-chu-admin');
    }else{
        return redirect()->back()->with('thatbai','Đăng nhập thất bại,kiểm tra lại thông tin đăng nhập'); //đưa ra Session thatbai
    }
}
public  function getLogoutAdmin(){
    Auth::logout();
    return redirect()->route('login-admin');
}


}
