<?php

namespace App;

use http\Env\Request;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

    public function add($n, $product, $id){
        //khởi tạo giá trị đầu tiên của giỏ hàng chính là sản phẩm được thêm vào, chú ý 'item' mang giá trị là 1 Object kiểu $product
        //chứ không mang giá trị số cụ thể như 'qty' và 'price'
        //$n là số lượng sản phẩm mà người dùng đã nhập
                $giohang = ['qty'=>0, 'price' => 12, 'item' => $product];

        if($this->items){ //lần đầu lặp thì chưa thực hiện vòng if này đâu do $this->>items=null
            if(array_key_exists($id, $this->items)){ //hàm này kiểm tra xem key $id có tồn tại trong mảng $this->>items chưa
                $giohang = $this->items[$id]; //nếu có tồn tại rồi thì
            }
        }
        $giohang['qty']+=$n; //tăng số lượng giỏ hàng lên $n
        if ($product->promotion_price!=0){
            $giohang['price'] = $product->promotion_price * $giohang['qty'];

        }else{
            $giohang['price'] = $product->unit_price * $giohang['qty'];

        }


        $this->items[$id] = $giohang; //items thứ $id chính là = giỏ hàng hiện tại
        $this->totalQty+=$n;
        if ($product->promotion_price!=0){
            $this->totalPrice+= $product->promotion_price * $n;

        }else{
            $this->totalPrice+= $product->unit_price * $n;

        }





    }

	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
