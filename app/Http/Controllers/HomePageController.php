<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $category = Category::all();
        $subcategory = SubCategory::all();
        $brand = Brand::all();
        $product = Product::take(20)->get();
        $letestProduct = Product::latest()->take(20)->with('stock')->get();

        $data = [
            'category'=>$category,
            'subcategory'=>$subcategory,
            'brand'=>$brand,
            'product'=>$product,
            'letestProduct'=>$letestProduct

        ];
        return view('UserSite.pages.home',['data'=>$data]);
    }
}
