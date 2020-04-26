<?php

namespace App\Providers;

use App\Event_Reward;
use App\News_LoaiTin;
use App\News_TheLoai;
use App\Type_Product;
use http\Env\Request;
use Illuminate\Support\ServiceProvider;
use Session;
use App\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {

        //Trang tin tức
        view()->composer('page_news.trangchu_tintuc',function($view){
            $theloai  = News_TheLoai::all();

            $view->with('theloai',$theloai);
        });
        view()->composer('page_news.loai_tintuc',function($view){
            $theloai  = News_TheLoai::all();


            $view->with('theloai',$theloai);
        });

        //------------------------------

        view()->composer('pages.sukien',function($view){
            $list_reward = Event_Reward::all()->random(10);
            $view->with('list_reward',$list_reward);
        });



        view()->composer('pages.header',function($view){
            $loai_sp  = Type_Product::all();
            $view->with('loai_sp',$loai_sp);
        });

        view()->composer('pages.header',function($view){

            if(Session('cart')){
                $oldCart = Session::get('cart'); // lấy thông tin giỏ hàng nếu có trong session gán vào giỏ hàng cũ trước đó
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }

        });
        view()->composer('pages.giohang',function($view){

        if(Session('cart')){
            $oldCart = Session::get('cart'); // lấy thông tin giỏ hàng nếu có trong session gán vào giỏ hàng cũ trước đó
            $cart = new Cart($oldCart);
            $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
        }

    });
        view()->composer('pages.dathang',function($view){

            if(Session('cart')){
                $oldCart = Session::get('cart'); // lấy thông tin giỏ hàng nếu có trong session gán vào giỏ hàng cũ trước đó
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }

        });


    }
}
