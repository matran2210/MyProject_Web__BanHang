<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//----------------Route trang tin tức (phía người dùng) ------------------------------------

Route::group(["prefix"=>"news"],function () {
    Route::get('index',[
        'as'=>'trangchu-tintuc',
        'uses'=>'MyController@getViewTrangChuTinTuc'
    ]);
    Route::get('chi-tiet-tin-tuc/{id}',[
        'as'=>'chitiet_tintuc',
        'uses'=>'MyController@getViewChiTietTinTuc'
    ]);
    Route::get('loai-tin-tuc/{type}',[
        'as'=>'loaitintuc',
        'uses'=>'MyController@getViewLoaiTinTuc'
    ]);
    Route::post('ajax-dang-nhap',[
        'as' => 'ajaxdangnhap',
        'uses'=>'MyController@ajaxGuiDangnhap'
    ]);
    Route::post('ajax-binh-luan/{id}',[
        'as' => 'ajaxbinhluan',
        'uses'=>'MyController@ajaxGuiBinhLuan'
    ]);


});









//------------------------------------------------------------------

//Route trang Admin bảng điều khiển:


Route::group(["prefix"=>"admin/news","middleware"=>"adminLogin"],function (){
    Route::get('list',[
        'as'=>'getViewListNews',
        'uses'=>'NewsController@getViewDanhSachTinTuc'
    ]);
    Route::get('ajax-loai-tin',[   //route phụ để lấy loại tin
        'as'=>'ajax_loai_tin',
        'uses'=>'NewsController@getAjaxLoaiTin'
    ]);


    Route::post('store',[
        'as'=>'news.store',
        'uses'=>'NewsController@store'
    ]);
    Route::get('edit/{id}',[
        'as'=>'news.edit',
        'uses'=>'NewsController@edit'
    ]);
    Route::post('update',[
        'as'=>'news.update',
        'uses'=>'NewsController@update'
    ]);
    Route::get('destroy/{id}', 'NewsController@destroy');




});




Route::group(["prefix"=>"admin","middleware"=>"adminLogin"],function () { //route cho User Admin
    Route::get('user/list',[
        'as'=>'getViewListUser',
        'uses'=>'UserController@getViewDanhSachTaiKhoan'
    ]);
    // cái route API này dùng middleware bình thường sẽ ko được, phải dùng Passport, tạm thời chưa có middlware cho route này
    Route::resource('user', 'UserController');

    Route::post('user/update', 'UserController@update')->name('user.update');

    Route::get('user/destroy/{id}', 'UserController@destroy');
});

Route::group(["prefix"=>"admin/product","middleware"=>"adminLogin"],function (){
    Route::get('list',[
        'as'=>'getViewListProduct',
        'uses'=>'ProductController@getViewDanhSachSanPham'
    ]);
    Route::get('add',[
        'as'=>'getViewAddProduct',
        'uses'=>'ProductController@getViewThemSanPham'
    ]);
    Route::post('post-add',[
        'as'=>'postAddProduct',
        'uses'=>'ProductController@postThemSanPham'
    ]);
    Route::get('edit/{id}',[
        'as'=>'getViewEditProduct',
        'uses'=>'ProductController@getViewSuaSanPham'
    ]);
    Route::post('post-edit/{id}',[
        'as'=>'postEditProduct',
        'uses'=>'ProductController@postSuaSanPham'
    ]);
    Route::post('post-delete/{id}',[
        'as'=>'postDeleteProduct',
        'uses'=>'ProductController@postXoaSanPham'
    ]);


});



Route::get('admin/index',[
    'as'=>'trang-chu-admin',
    'uses'=>'AdminController@getViewTrangChu'

])->middleware('adminLogin');

Route::get('admin/login',[
    'as'=>'login-admin',
    'uses'=>'AdminController@getLoginAdmin'
]);
Route::post('admin/postlogin',[
    'as'=>'postlogin',
    'uses'=>'AdminController@postLoginAdmin',
]);
Route::get('admin/logout',[
    'as'=>'logout-admin',
    'uses'=>'AdminController@getLogoutAdmin',

])->middleware('adminLogin');

//---------------------------------Route trang Web chính----------------------------------------------------------
Route::get('',[
    'as'=>'trang-chu',
    'uses'=>'MyController@getIndex'
]);

Route::get('event',[
    'as'=>'sukien',
    'uses'=>'MyController@getViewSuKien'
]);
Route::get('gioi-thieu',[
    'as'=>'gioithieu',
    'uses'=>'MyController@getGioiThieu'
]);
Route::get('lien-he',[
    'as'=>'lienhe',
    'uses'=>'MyController@getLienHe'
]);
Route::get('loai-san-pham/{type}',[
    'as'=>'loaisanpham',
    'uses'=>'MyController@getLoaiSanPham'
]);
Route::get('chi-tiet-san-pham/{id}',[
    'as'=>'chitietsanpham',
    'uses'=>'MyController@getChiTietSanPham'
]);

Route::get('add-to-cart/{id}',[
    'as' => 'themgiohang',
    'uses'=>'MyController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
    'as' => 'xoagiohang',
    'uses'=>'MyController@getdeleteCart'
]);
Route::get('gio-hang',[
    'as' => 'giohang',
    'uses'=>'MyController@getGioHang'
]);
Route::get('dang-nhap',[
    'as' => 'dangnhap',
    'uses'=>'MyController@getDangnhap'
]);
Route::post('gui-dang-nhap',[
    'as' => 'guidangnhap',
    'uses'=>'MyController@postGuiDangnhap'
]);
Route::get('gui-dang-xuat',[
    'as' => 'guidangxuat',
    'uses'=>'MyController@getGuiDangxuat'
]);
Route::get('dang-ky',[
    'as' => 'dangky',
    'uses'=>'MyController@getDangky'
]);
Route::post('gui-dang-ky',[
    'as' => 'guidangky',
    'uses'=>'MyController@postGuiDangky'
]);
Route::get('dat-hang',[
    'as'=>'dathang',
    'uses'=>'MyController@getDatHang'
]);
Route::post('thanh-toan',[
    'as'=>'thanhtoan',
    'uses'=>'MyController@postThanhToan'
]);
Route::post('thanh-toan-co-tai-khoan',[
    'as'=>'thanhtoancotaikhoan',
    'uses'=>'MyController@postThanhToanCoTaiKhoan'
]);
Route::get('tim-kiem',[
    'as'=>'timkiem',
    'uses'=>'MyController@getTimKiem'
]);









