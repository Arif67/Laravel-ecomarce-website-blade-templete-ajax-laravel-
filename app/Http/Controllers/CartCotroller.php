<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProudctCart;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;
use Illuminate\Support\Facades\Cookie;

class CartCotroller extends Controller
{ 
    private function getGuestToken() {
        // Try to retrieve the guest token from the user's session, cookie, or local storage
        $guestToken = session('guest_token'); 
    
        // If the guest token doesn't exist, generate a new one
        if (!$guestToken) {
            $guestToken = bin2hex(random_bytes(16)); // Generate a unique token
            session(['guest_token' => $guestToken]); // 
        }
    
        return $guestToken;
    }
    
    
    //  public function addToCart(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required',
    //         'quantity' => 'required|integer|min:1'
    //     ]);
    //     $productId = $request->input('product_id');
    //     $quantity = $request->input('quantity');
    //     $name = $request->input('name');
    //     $price = $request->input('price');
    //     // // Fetch the product by ID
    //     $product = Product::find($productId);

    //      if (!$product) {
    //          return response()->json(['message' => 'Product not found'], 404);
    //      }

    //     $cartItem = ProudctCart::where('user_id', Auth::user()->id)
    //     ->where('product_id', $productId)
    //     ->first();
    
    //     if ($cartItem) {
    //         // If it exists, update the quantity
    //         $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
    //         return back()->with('massege','data add to cart successfully ');
    //     } else {
    //         // If it doesn't exist, create a new cart item
    //     $result= ProudctCart::create([
    //             'user_id' => Auth::user()->id,
    //             'product_id' => $productId,
    //             'quantity' => $quantity,
    //             'name'=>$name,
    //             'price'=>$price
                
    //         ]);
    //     if(!$result){
    //         return back()->with('massege' ,"data not add to cart success ");
    //     }else{
    //         return back()->with('massege','data add to cart successfully ');
    //     }
    // }

    // }



  
public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required',
        'quantity' => 'required|integer|min:1'
    ]);

    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $name = $request->input('name');
    $price = $request->input('price');

    // Check if the user is authenticated
    if (Auth::check()) {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $name = $request->input('name');
        $price = $request->input('price');
        // // Fetch the product by ID
        $product = Product::find($productId);

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }

        $cartItem = ProudctCart::where('user_id', Auth::user()->id)
        ->where('product_id', $productId)
        ->first();
    
        if ($cartItem) {
            // If it exists, update the quantity
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
            return back()->with('massege','data add to cart successfully ');
        } else {
            // If it doesn't exist, create a new cart item
              $result= ProudctCart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'name'=>$name,
                    'price'=>$price,
                    'guest_token'=>null
                    
                    ]);
                if(!$result){
                    return back()->with('massege' ,"data not add to cart success ");
                }else{
                    return back()->with('massege','data add to cart successfully ');
                }
            }
    } else {
        $guestToken = $this->getGuestToken();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $name = $request->input('name');
        $price = $request->input('price');
        // // Fetch the product by ID
        $product = Product::find($productId);

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }
         $user_guestToken = request()->cookie('guest_token');

        $cartItem = ProudctCart::where('guest_token',$user_guestToken)
        ->where('product_id', $productId)
        ->first();
    
        if ($cartItem) {
            // If it exists, update the quantity
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
            back()->with('massege' ,"data  add to cart success ");

        } else {
            // If it doesn't exist, create a new cart item
              $result= ProudctCart::create([
                    'user_id' => 0,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'name'=>$name,
                    'price'=>$price,
                    'guest_token'=>$guestToken
                    
                    ]);
                  // Set the guest token in a cookie for 5 days
                 Cookie::queue('guest_token', $guestToken, 7200); 
                if(!$result){
                    return back()->with('massege' ,"data not add to cart success ");
                }else{
                    return back()->with('massege' ,"data  add to cart success ");

                }
            }
    
    }
}


     public function buyNow(Request $request) {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $name = $request->input('name');
        $price = $request->input('price');

    // Check if the user is authenticated
    if (Auth::check()) {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $name = $request->input('name');
        $price = $request->input('price');
        // // Fetch the product by ID
        $product = Product::find($productId);

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }

        $cartItem = ProudctCart::where('user_id', Auth::user()->id)
        ->where('product_id', $productId)
        ->first();
    
        if ($cartItem) {
            // If it exists, update the quantity
            $userId = Auth::user()->id;
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
            return redirect('/checkout/' . $userId);
        } else {
            // If it doesn't exist, create a new cart item
              $result= ProudctCart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'name'=>$name,
                    'price'=>$price,
                    'guest_token'=>null
                    
                    ]);
                if(!$result){
                    return back()->with('massege' ,"data not add to cart success ");
                }else{
                    $userId = Auth::user()->id;
                    return redirect('/checkout/' . $userId);
                    
                     
                }
            }
    } else {
        $guestToken = $this->getGuestToken();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $name = $request->input('name');
        $price = $request->input('price');
        // // Fetch the product by ID
        $product = Product::find($productId);

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }
         $user_guestToken = request()->cookie('guest_token');

        $cartItem = ProudctCart::where('guest_token',$user_guestToken)
        ->where('product_id', $productId)
        ->first();
    
        if ($cartItem) {
            // If it exists, update the quantity
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
            return redirect('/checkout/' . $user_guestToken);

        } else {
            // If it doesn't exist, create a new cart item
              $result= ProudctCart::create([
                    'user_id' => 0,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'name'=>$name,
                    'price'=>$price,
                    'guest_token'=>$guestToken
                    
                    ]);
                  // Set the guest token in a cookie for 5 days
                 Cookie::queue('guest_token', $guestToken, 7200); 
                if(!$result){
                    return back()->with('massege' ,"data not add to cart success ");
                }else{
                    return redirect('/checkout/' . $user_guestToken);

                    }
                }
    
           }
        }














    /**
     * Summary of ShowCartpage
     * @return mixed
     */
    public function ShowCartpage(){
        if(Auth::check()){
            $cartItems = ProudctCart::with('product')->where('user_id',Auth::user()->id)->get();
            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                $subtotal = $cartItem->price * $cartItem->quantity;
                $totalAmount += $subtotal;
            } 
    
            $totalQuantity = ProudctCart::sum('quantity');
            $cartItem = ProudctCart::where('user_id','=',Auth::user()->id)->get();
    
            $data =[
                'totalQuantity'=>$totalQuantity,
                'cartItem'=>$cartItem,
                'totalAmount'=>$totalAmount
            ];
              // return  response()->json($data['cartItem'][0]->name);
             return view('UserSite.pages.shoppingCart',['data'=>$data]);
        }else{
            $user_guestToken = request()->cookie('guest_token');
            $cartItems = ProudctCart::with('product')->where('guest_token','=',$user_guestToken)->get();
            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                $subtotal = $cartItem->price * $cartItem->quantity;
                $totalAmount += $subtotal;
            } 
    
            $totalQuantity = ProudctCart::sum('quantity');
            $cartItem = ProudctCart::where('guest_token','=',$user_guestToken)->get();
    
            $data =[
                'totalQuantity'=>$totalQuantity,
                'cartItem'=>$cartItem,
                'totalAmount'=>$totalAmount
            ];
              // return  response()->json($data['cartItem'][0]->name);
             return view('UserSite.pages.shoppingCart',['data'=>$data]);
        }
    
     

    }






        /**
         * Summary of deleteCart
         * @param mixed $id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function deleteCart($id){
        $result = ProudctCart::destroy($id);
        if($result){
            return back()->with('massege','data deleted success ');
        }else{
            return back()->with('massege','data not deleted ');
        }
        
        }


        /**
         * Summary of increment
         * @param mixed $id
         * @return \Illuminate\Http\RedirectResponse
         */
            public function increment($id)
        {
            // Find the cart item by ID
            $cartItem = ProudctCart::find($id);

            if ($cartItem) {
                // Increment the quantity
                $cartItem->quantity++;
                $cartItem->save();
            }

            return redirect()->back()->with('success', 'Quantity incremented');
        }

        /**
         * Summary of decrement
         * @param mixed $id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function decrement($id)
        {
            // Find the cart item by ID
            $cartItem = ProudctCart::find($id);

            if ($cartItem) {
                // Decrement the quantity (avoid negative quantities)
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity--;
                    $cartItem->save();
                }
            }

            return redirect()->back()->with('success', 'Quantity decremented');
        }


        /**
         * Summary of calculateTotalAmountInCart
         * @return float|int
         */
        public function calculateTotalAmountInCart()
            {   
                $cartItems = CartCotroller::all();
                $totalAmount = 0;
                foreach ($cartItems as $cartItem) {
                    $subtotal = $cartItem->product->price * $cartItem->quantity;
                    $totalAmount += $subtotal;
                }

                return $totalAmount;
            }


}
