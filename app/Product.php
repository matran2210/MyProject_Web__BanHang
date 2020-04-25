<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function product_type(){
        return $this -> belongsTo('App/Type_Product','id_type','id');
    }
    public function detail_bill(){
        return $this->hasMany('App/Detail_Bill','id_product','id');
    }
}
