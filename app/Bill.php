<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";
    public function detail_bill(){
        return $this -> hasMany('App/Detail_Bill','id_bill','id');
    }
    public function customer(){
        return $this -> belongsTo('App/Customer','id_customer','id');
    }
}
