<?php

namespace App\Http\Controllers;

use App\Models\Billing_addresses;
use App\Models\GuestCart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\ProudctCart;
use App\Models\Shipping_addresse;
use App\Models\Sipping_addresses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Validator;
/**
 * Summary of CheckoutController
 */
class CheckoutController extends Controller
{
     /**
      * Summary of index
      * @param mixed $id
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
      */
     public function index($id){

        if(Auth::check()){
            $cartItems = ProudctCart::where('user_id',Auth::user()->id)->get();
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
         return view('UserSite.userSiteComponent.checkout',['data'=>$data]);
        }else{
            $cartItems = ProudctCart::where('guest_token','=', $id)->get();
            $totalAmount = 0;
            foreach ($cartItems as $cartItem) {
                $subtotal = $cartItem->price * $cartItem->quantity;
                $totalAmount += $subtotal;
            } 
    
            $totalQuantity = ProudctCart::sum('quantity');
            $cartItem = ProudctCart::where('guest_token','=',$id)->get();
    
            $data =[
                'totalQuantity'=>$totalQuantity,
                'cartItem'=>$cartItem,
                'totalAmount'=>$totalAmount
            ];
         return view('UserSite.userSiteComponent.checkout',['data'=>$data]);
        }
       
       
     }

    
    // public function placeOrder(Request $request){
    //     $request->validate([
    //         // billing address
    //         // 'quantity' => 'required|integer|min:1',


    //         // "fist_name"=>"required",
    //         // "last_name"=>"required",
    //         // "email"=>"required",
    //         // "mobile_no"=>"required",
    //         // "address_line1"=>"required",
    //         // "address_line2"=>"required",
    //         // "country"=>"required",
    //         // "city"=>"required",
    //         // "state"=>"required",
    //         // "zipcode"=>"required",

    //         // shipping address
    //         // "sfirst_name"=>"required",
    //         // "slast_name"=>"required",
    //         // "semail"=>"required",
    //         // "smobile_no"=>"required",
    //         // "saddress_line1"=>"required",
    //         // "saddress_line2"=>"required",
    //         // "scountry"=>"required",
    //         // "scity"=>"required",
    //         // "sstate"=>"required",
    //         // "postal_code"=>"required",

    //         // payment method 

    //         // "total"=>"required",
    //         // "payment_method"=>"required",
    //         // "tranggetion_id"=>"required",

    //     ]);

    //     $first_name = $request->input('fist_name');
    //     $last_name = $request->input('last_name');
    //     $email = $request->input('email');
    //     $mobile_no = $request->input('mobile_no');
    //     $address_line1 = $request->input('address_line1');
    //     $address_line2 = $request->input('address_line2');
    //     $country = $request->input('country');
    //     $city = $request->input('city');
    //     $state = $request->input('state');
    //     $zipcode = $request->input('zipcode');


    //     $sfirst_name = $request->input('sfirst_name');
    //     $slast_name = $request->input('slast_name');
    //     $semail = $request->input('semail');
    //     $smobile_no = $request->input('smobile_no');
    //     $saddress_line1 = $request->input('saddress_line1');
    //     $saddress_line2 = $request->input('saddress_line2');
    //     $scountry = $request->input('scountry');
    //     $scity = $request->input('scity');
    //     $sstate = $request->input('sstate');
    //     $postal_code = $request->input('postal_code');

    //         if(Auth::check()){

    //              //   place order 

    //                 $billing_address =new Billing_addresses();
    //                 $shipping_addresses = new Shipping_addresse();
    //                 $order = new Order();

    //                 $order->user_id = Auth::user()->id;
    //                 $order->orderDate = now()->format('Y-m-d H:i:s');
    //                 $order->status = "pending";

                    
    //                 $order->save();

    //                 //   saving billing_address
    //                 $billing_address->user_id       = Auth::user()->id;
    //                 $billing_address->order_id      = $order->id;
    //                 $billing_address->fist_name    = $first_name;
    //                 $billing_address->last_name     = $last_name;
    //                 $billing_address->email         = $email;
    //                 $billing_address->mobile_no     = $mobile_no;
    //                 $billing_address->address_line1 = $address_line1;
    //                 $billing_address->address_line2 = $address_line2;
    //                 $billing_address->country       = $country;
    //                 $billing_address->city          = $city;
    //                 $billing_address->state         = $state;
    //                 $billing_address->zipcode       = $zipcode;
    //                 $billing_address->save();


    //                 // Sipping address
    //                 $shipping_addresses->user_id       = Auth::user()->id;
    //                 $shipping_addresses->order_id      = $order->id;
    //                 $shipping_addresses->first_name = $sfirst_name;
    //                 $shipping_addresses->last_name = $slast_name;
    //                 $shipping_addresses->email = $semail;
    //                 $shipping_addresses->mobile_no = $smobile_no;
    //                 $shipping_addresses->address_line1 = $saddress_line1;
    //                 $shipping_addresses->address_line2 = $saddress_line2;
    //                 $shipping_addresses->country = $scountry;
    //                 $shipping_addresses->city = $scity;
    //                 $shipping_addresses->state = $sstate;
    //                 $shipping_addresses->postal_code = $postal_code;
    //                 $shipping_addresses->save();

    //             // payment 
    //             $total = $request->input('total_amount');
    //             $payment_method = $request->input('payment_method');
    //             $transection_id = $request->input('transection_id');

    //             $payment = new PaymentMethod();
    //             $payment->payment = $payment_method;
    //             $payment->order_id = $order->id;
    //             $payment->total_price = $total;
    //             $payment->transection_id = $transection_id;
    //             $payment->save();
    //                     // order details 
    //             $userId = Auth::user()->id; // Assuming you're using authentication
    //             $cartItems = ProudctCart::where('user_id', $userId)->get();
    //             foreach ($cartItems as $cartItem) {
    //             // Create an order detail record for each cart item
    //             $orderDetail = new OrderDetail();
    //             $orderDetail->order_id = $order->id;
    //             $orderDetail->product_id = $cartItem->product_id;
    //             $orderDetail->name = $cartItem->name;
    //             $orderDetail->qty = $cartItem->quantity;

    //             // Retrieve the product's price and name
    //             $price = $cartItem->price;
    //             $orderDetail->total_price = $price;

    //             $orderDetail->save();


    //         }
 
    //             $result =  ProudctCart::where('user_id', $userId)->delete();
    //             if($result){
    //                 return response()->redirectTo('orderConfirm');
    //             }else{
    //                 return "order not successfull";
    //             }

    //   }else{

    //     //   place order 
    //     $user_guestToken = request()->cookie('guest_token');
    //     $billing_address =new Billing_addresses();
    //     $shipping_addresses = new Shipping_addresse();
    //     $order = new Order();
    //     $order->user_id = 0;
    //     $order->guest_token = $user_guestToken;
    //     $order->orderDate = now()->format('Y-m-d H:i:s');
    //     $order->status = "pending";
    //     $order->save();

    //     // saving billing_address
    //     $billing_address->user_id       =0;
    //     $billing_address->order_id      = $order->id;
    //     $billing_address->fist_name    = $first_name;
    //     $billing_address->last_name     = $last_name;
    //     $billing_address->email         = $email;
    //     $billing_address->mobile_no     = $mobile_no;
    //     $billing_address->address_line1 = $address_line1;
    //     $billing_address->address_line2 = $address_line2;
    //     $billing_address->country       = $country;
    //     $billing_address->city          = $city;
    //     $billing_address->state         = $state;
    //     $billing_address->zipcode       = $zipcode;
    //     $billing_address->save();


    //     // Sipping address
    //     $shipping_addresses->user_id       = 0;
    //     $shipping_addresses->order_id      = $order->id;
    //     $shipping_addresses->first_name = $sfirst_name;
    //     $shipping_addresses->last_name = $slast_name;
    //     $shipping_addresses->email = $semail;
    //     $shipping_addresses->mobile_no = $smobile_no;
    //     $shipping_addresses->address_line1 = $saddress_line1;
    //     $shipping_addresses->address_line2 = $saddress_line2;
    //     $shipping_addresses->country = $scountry;
    //     $shipping_addresses->city = $scity;
    //     $shipping_addresses->state = $sstate;
    //     $shipping_addresses->postal_code = $postal_code;
    //     $shipping_addresses->save();

    //     // payment 
    //     $total = $request->input('total_amount');
    //     $payment_method = $request->input('payment_method');
    //     $transection_id = $request->input('transection_id');

    //     $payment = new PaymentMethod();
    //     $payment->payment = $payment_method;
    //     $payment->order_id = $order->id;
    //     $payment->total_price = $total;
    //     $payment->transection_id = $transection_id;
    //     $payment->save();
    //     // order details 
        
    //     $cartItems = ProudctCart::where('guest_token', $user_guestToken)->get();
    //     foreach ($cartItems as $cartItem) {
    //         // Create an order detail record for each cart item
    //         $orderDetail = new OrderDetail();
    //         $orderDetail->order_id = $order->id;
    //         $orderDetail->product_id = $cartItem->product_id;
    //         $orderDetail->name = $cartItem->name;
    //         $orderDetail->qty = $cartItem->quantity;

    //         // Retrieve the product's price and name
    //         $price = $cartItem->price;
    //         $orderDetail->total_price = $price;

    //         $orderDetail->save();


    //     }
 
    //     $result =  ProudctCart::where('guest_token', $user_guestToken)->delete();
    //     if($result){
    //         return response()->redirectTo('orderConfirm');
    //     }else{
    //         return "order not successfull";
    //     }

    //   }
      

    // }


    // i have done separete function for make code clead and i am following coding principle like DRY .

    private function createAndSaveAddress($model, $data, $user_id, $order_id)
        {
            $address = new $model;
            $address->user_id = $user_id;
            $address->order_id = $order_id;
            
            foreach ($data as $field => $value) {
                $address->$field = $value;
            }

            $address->save();

            return $address; 
        }

        private function createOrder($user_id) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->orderDate = now()->format('Y-m-d H:i:s');
            $order->status = "pending";
            $order->save(); // Save the order to the database
            return $order; // Return the created order entity
        }

        public function clearCart($user_id, $guest_token) {
            if ($user_id) {
                ProudctCart::where('user_id', $user_id)->delete();
            } elseif ($guest_token) {
                ProudctCart::where('guest_token', $guest_token)->delete();
            }
        }
        

    public function placeOrder(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $user = Auth::user();
            $user_id = $user ? $user->id : 0;
            $user_guestToken = $user ? null : request()->cookie('guest_token');
    
            // Create a new order
            $order = Order::create([
                'user_id' => $user_id,
                'guest_token' => $user_guestToken,
                'orderDate' => now(),
                'status' => 'pending',
            ]);

              // Create and save billing address
            $billingFields = [
                'fist_name', 'last_name', 'email', 'mobile_no', 'address_line1', 'address_line2',
                'country', 'city', 'state', 'zipcode',
            ];
            $billingAddress = $this->createAndSaveAddress(Billing_addresses::class, $request->only($billingFields), $user_id, $order->id);

            // Create and save shipping address
            $shippingFields = [
                'sfirst_name', 'slast_name', 'semail', 'smobile_no', 'saddress_line1', 'saddress_line2',
                'scountry', 'scity', 'sstate', 'spostal_code',
            ];
           $shippingAddress = $this->createAndSaveAddress(Shipping_addresse::class, $request->only($shippingFields), $user_id, $order->id);
            // payment method 
            $paymentData = $request->only(['total_price', 'payment', 'transection_id']);
            $paymentData['order_id'] = $order->id;
            $paymentMethod = new PaymentMethod;
            foreach ($paymentData as $key => $value) {
                $paymentMethod->$key = $value;
            }

            $paymentMethod->save();

            $cartQuery = $user ? ProudctCart::where('user_id', $user_id) : ProudctCart::where('guest_token', $user_guestToken);
    
            $cartItems = $cartQuery->get();
    
            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'name' => $cartItem->name,
                    'qty' => $cartItem->quantity,
                    'total_price' => $cartItem->price,
                ]);
            }
    
            $this->clearCart($user_id, $user_guestToken);
                if ($user_id) {
                    $user = Auth::user();
                    Mail::to($user->email)->send(new OrderConfirmation($order));
                } else {
                    $guestEmail = $request->input('email');
                    Mail::to($guestEmail)->send(new OrderConfirmation($order));
                }
    
            DB::commit();
    
            return response()->redirectTo('orderConfirm');
        } catch (\Exception $e) {
            DB::rollback();
           return "Order not successful: " . $e->getMessage();
        }
    }


//     public function placeOrder(Request $request) {
//         try {
//             // Validate the order request
//             $this->validateOrderRequest($request);

//             // Determine user information
//             $user = Auth::user();
//             $user_id = $user ? $user->id : 0;
//             $user_guestToken = $user ? null : request()->cookie('guest_token');
    
//             // Create a new order
//             $order = $this->createOrder($user_id, $user_guestToken);
    
//             // Create and save billing and shipping addresses
//             $this->createAndSaveAddress($request->only('fist_name', 'last_name', 'email', 'mobile_no', 'address_line1', 'address_line2', 'country', 'city', 'state', 'zipcode'), $user_id, $order->id, Billing_addresses::class);
//             $this->createAndSaveAddress($request->only('sfirst_name', 'slast_name', 'semail', 'smobile_no', 'saddress_line1', 'saddress_line2', 'scountry', 'scity', 'sstate', 'postal_code'), $user_id, $order->id, Shipping_addresse::class);
    
//             // Handle payment and order details (Add your code here)
    
//             // Clear the cart for the user or guest
//             $this->clearCart($user_id, $user_guestToken);
    
//             // Send an order confirmation email
//             $this->sendOrderConfirmationEmail($order, $user);
    
//             return response()->redirectTo('orderConfirm');
//         } catch (\Exception $e) {
//             // Handle exceptions and return an error response
//             return "Order not successful: " . $e->getMessage();
//         }
//     }

//     public function validateOrderRequest(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
           
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'message' => 'Validation failed',
//                 'errors' => $validator->errors(),
//             ], 422); 
//         }
//     }

    
//     private function createOrder($user_id, $guest_token) {
//         $order = new Order();
//         $order->user_id = $user_id;
//         $order->guest_token = $guest_token;
//         $order->orderDate = now();
//         $order->status = "pending";
//         $order->save();
//         return $order;
//     }
    
//    private function createAndSaveAddress($model, $data, $user_id, $order_id)
//         {
//             $address = new $model;
//             $address->user_id = $user_id;
//             $address->order_id = $order_id;
            
//             foreach ($data as $field => $value) {
//                 $address->$field = $value;
//             }

//             $address->save();

//             return $address; 
//         }
    
//     private function clearCart($user_id, $guest_token) {
//         if ($user_id) {
//             ProudctCart::where('user_id', $user_id)->delete();
//         } elseif ($guest_token) {
//             ProudctCart::where('guest_token', $guest_token)->delete();
//         }
//     }
    
//     private function sendOrderConfirmationEmail($order, $user) {
//         if ($user) {
//             Mail::to($user->email)->send(new OrderConfirmation($order));
//         }
//     }
    






}
