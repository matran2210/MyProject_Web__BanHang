<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Product extends Model
{
    protected $table = "type_products";
    public function product(){
        return $this -> hasMany('App/Product','id_type','id');
    }
}
