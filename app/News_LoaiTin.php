<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_LoaiTin extends Model
{
    protected $table="news_loaitin";

    public function theloai(){
        return $this->belongsTo('App\News_TheLoai','idTheLoai','id');
    }
    public function tintuc(){
        return $this->hasMany('App\News_TinTuc','idLoaiTin','id');
    }
}
