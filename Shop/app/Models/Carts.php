<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    public $items = null;
  public $totalQty = 0;
  public $totalPrice = 0;
  /**
   * Summary of __construct
   * @param mixed $oldCart
   */
  public function __construct($oldCart)
  {
    if ($oldCart) {
      $this->items = $oldCart->items;
      $this->totalQty = $oldCart->totalQty;
      $this->totalPrice = $oldCart->totalPrice;
    }
  }
  //Them phan tu vao gio hang                 
  public function add($item, $id, $qty = 1)
  {
    if ($item->promotion_price == 0) {
      $giohang = ['qty' => 0, 
                  'price' => $item->price, 
                  'item' => $item];
      if ($this->items) {
        if (array_key_exists($id, $this->items)) {
          $giohang = $this->items[$id];
        }
      }
      $giohang['qty'] = $giohang['qty'] + $qty;
      $giohang['price'] = $item->price * $giohang['qty'];
      $this->items[$id] = $giohang;
      $this->totalQty = $this->totalQty + $qty;
      $this->totalPrice += $item->price * $giohang['qty'];
    } else {
      $giohang = ['qty' => 0, 'price' => $item->promotion_price, 'item' => $item];
      if ($this->items) {
        if (array_key_exists($id, $this->items)) {
          $giohang = $this->items[$id];
        }
      }
      $giohang['qty'] = $giohang['qty'] + $qty;
      $giohang['price'] = $item->promotion_price * $giohang['qty'];
      $this->items[$id] = $giohang;
      $this->totalQty = $this->totalQty + $qty;
      $this->totalPrice += $item->promotion_price * $giohang['qty'];
    }
  }
}
