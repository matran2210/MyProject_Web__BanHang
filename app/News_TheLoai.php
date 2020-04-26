<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_TheLoai extends Model
{
    protected $table="news_theloai";
    public function loaitin(){ // Lưu ý cái tên hàm này cần dùng khi chúng ta truy xuất từ thể loại đến loại tin: $theloai->loaitin
        return $this->hasMany('App\News_LoaiTin','idTheLoai','id');
    }
    //Ở đây 1 thể loại gồm nhiều loại tin, 1 loại tin gồm nhiều tin tức . Như vậy với mối quan hệ Thể loại - Tin tức  ,ta phải
    //qua trung gian với bảng Loại Tin
    public function tintuc(){
        return $this->hasManyThrough('App\News_TinTuc','App\News_LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
