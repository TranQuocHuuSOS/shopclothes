<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class PageController extends Controller
{
    //
    public function getIndex()
    {
        $products = Products::all();
    
        return view('shop', ['products' => $products]);
    }
    

    public function getAddToCart(Request $req, $id)																				
      {																				
       																		
          if (Products::find($id)) {																				
            $product = Products::find($id);																				
            $oldCart = Session('cart') ? Session::get('cart') : null;																				
            $cart = new Carts($oldCart);																				
            $cart->add($product, $id);																				
            $req->session()->put('cart', $cart);																				
            return redirect()->back();																				
          } else {																				
            return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';																				
          }																				
       																		
      }		
      
      public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Carts($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
        Session::put('cart',$cart);

        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }
}
