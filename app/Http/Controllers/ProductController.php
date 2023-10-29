<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Throwable;
class ProductController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $category = Category::with('subcategory')->get();
        $brand = Brand::all();
        $seller = Seller::all();
        

        $products = Product::with(['category', 'subcategory', 'brand', 'stock'])->get();
        $data = [
            'category'   =>$category,
            'brand'      =>$brand,
            'seller'     =>$seller,
            'productData'=>$products,
           
        ];
        return view('AdminSite.Pages.Product.product',['data'=>$data]);

        
    }
    public function ProductDetails($id){
       $data = Product::with('stock')->where('id','=',$id)->get();
       return view('UserSite.userSiteComponent.shopDetails',['data'=>$data]);
    }
    
public function store(Request $request)
{
    try {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required',
            'status' => 'required',
            'preparedby' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'buying_price' => 'required',
            'selling_price' => 'required',
            'seller_id' => 'required',
            'discount_percentage' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Ensure that the discount percentage is between 0 and 100
        $discountPercentage = max(0, min(100, $request->input('discount_percentage')));

        // Calculate the discounted selling price
        $originalSellingPrice = $request->input('selling_price');
        $discountedSellingPrice = $originalSellingPrice - ($originalSellingPrice * ($discountPercentage / 100));

        // Store the image
        $imagePath = $request->file('image')->store('images', 'public');

        // Create a new product instance
        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->brand_id = $request->input('brand_id');
        $product->product_name = $request->input('product_name');
        $product->status = $request->input('status');
        $product->image = $imagePath; // Store the image path
        $product->preparedby = $request->input('preparedby');
        $product->save();

        // Create a new stock entry
        $stock = new Stock();
        $stock->product_id = $product->id;
        $stock->quantity = $request->input('quantity');
        $stock->buying_price = $request->input('buying_price');
        $stock->selling_price = $discountedSellingPrice;
        $stock->seller_id = $request->input('seller_id');
        $stock->save();

        // Create a new discount entry
        $discount = new Discount();
        $discount->product_id = $product->id;
        $discount->discount_percentage = $discountPercentage;
        $discount->save();

        return back()->with("success", "Product added successfully");
        } catch (Throwable $e) {
            return back()->with("error", "An error occurred while adding the product.");
        }
    }
        // public function search(Request $request)
        //     {
        //         $search = $request->input('search');
        //         $products = Product::where('product_name', 'like', "%$search%")->get();

        //         return response()->json(['products' => $products]);
        //     }
        public function search(Request $request)
            {
                $search = $request->input('search');

                // Split the search input into an array of words
                $searchTerms = explode(' ', $search);

                $products = Product::where(function ($query) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $query->orWhere('product_name', 'like', "%$term%");
                    }
                })->get();

                return response()->json(['products' => $products]);
        }



        public function update(Request $request){
            
              


        }


}
