<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function getIndex()
    {
        $products = Products::all();
    
        return view('shop', ['products' => $products]);
    }
    
}
