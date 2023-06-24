<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\bill_detail;
use App\Models\Products;
use App\Models\Carts;
use App\Models\Users;
use App\Models\wishlists;
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

    public function getCheckout()
    {
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Carts($oldCart);
            return view('checkout')->with([
                'cart' => Session::get('cart'),
                'product_cart' => $cart->items,
                'totalPrice' => $cart->totalPrice,
                'totalQty' => $cart->totalQty
            ]);;
        } else {
            return redirect('/');
        }
    }

    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');
        $customer = new Users();
        $customer->name = $req->full_name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;

        if (isset($req->notes)) {
            $customer->note = $req->notes;
        } else {
            $customer->note = "Không có ghi chú gì";
        }

        $customer->save();

        $bill = new Bills();
        $bill->id_user = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        if (isset($req->notes)) {
            $bill->note = $req->notes;
        } else {
            $bill->note = "Không có ghi chú gì";
        }
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new bill_detail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key; //$value['item']['id'];
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price'] / $value['qty'];
            $bill_detail->save();
            return "<script>alert('Đặt hàng thành công!');
            window.location.href='/'</script>;
             ";
        }

        Session::forget('cart');
        $wishlists = wishlists::where('id_user', Session::get('user')->id)->get();
        if (isset($wishlists)) {
            foreach ($wishlists as $element) {
                $element->delete();
            }
        }
    }
}
