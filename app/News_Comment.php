<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_Comment extends Model
{
    protected $table="news_comment";
    public function tintuc(){
        return $this->belongsTo('App\News_TinTuc','idTinTuc','id');
    }
    public function user_comment(){
        return $this->belongsTo('App\User','idUser','id');
    }
}
