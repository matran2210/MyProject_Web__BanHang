<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_TinTuc extends Model
{
    protected $table="news_tintuc";
    protected $fillable = [
        'TieuDe', 'TieuDeKhongDau', 'TomTat','Hinh','NoiDung','NoiBat','SoLuotXem','idLoaiTin',
    ];
    public function loaitin(){
        return $this->belongsTo('App\News_LoaiTin','idLoaiTin','id');
    }
    public function binhluan(){
        return $this->hasMany('App\News_Comment','idTinTuc','id');
    }


}
