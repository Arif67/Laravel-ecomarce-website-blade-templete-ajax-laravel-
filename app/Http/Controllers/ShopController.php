<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    
   /**
    * Summary of index
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    */
   public function index(){
     $product = Product::with('stock')->get();
     $data = [
        'product'=>$product
     ];
     return view('UserSite.pages.shop',['data'=>$data]);

   }
}
