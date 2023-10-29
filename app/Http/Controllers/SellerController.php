<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class SellerController extends Controller
{
    public function index(){
       $sellerInfo = Seller::all();
       return view('AdminSite.Pages.SellerPage.seller',['data'=>$sellerInfo]);
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email', 
                'phone_number' => 'required',
                'address' => 'required',
            ]);
    
       
            $seller = new Seller;
            $seller->name = $validatedData['name'];
            $seller->email = $validatedData['email']; 
            $seller->phone_number = $validatedData['phone_number'];
            $seller->address = $validatedData['address'];
            $res = $seller->save();
    
            if (!$res) {
                throw new Exception('Failed to create seller.');
            }
    
            return back()->with("success", "Seller data created successfully");

        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput()->with("error", $e->getMessage());

        } catch (Throwable $e) {
            
            return back()->with("error", "An error occurred while creating seller data.");
        }
    }
       public function show($id){
           return Seller::find($id);
       }

       public function update(Request $request, $id)
       {
         
           $validatedData = $request->validate([
               'name' => 'sometimes',
               'email' => 'sometimes|email',
               'phone_number' => 'sometimes',
               'address' => 'sometimes',
           ]);
       
           try {
               $result = Seller::find($id);
               if ($request->has('name')) {
                   $result->name = $validatedData['name'];
               }
               if ($request->has('email')) {
                   $result->email = $validatedData['email'];
               }
               if ($request->has('phone_number')) {
                   $result->phone_number = $validatedData['phone_number'];
               }
               if ($request->has('address')) {
                   $result->address = $validatedData['address'];
               }
               $res = $result->save();
       
               if (!$res) {
                   return back()->with("error", "Seller data not updated.");
               }
       
               return back()->with("success", "Seller data updated successfully");
           } catch (Throwable $e) {
               return back()->with("error", "An error occurred while updating seller data.");
           }
       }
       
       public function destroy($id)
       {
           try {
               $seller = Seller::findOrFail($id);
       
               $seller->delete();
       
               return back()->with("success", "Seller deleted successfully");
           } catch (ModelNotFoundException $e) {
               return back()->with("error", "Seller not found.");
           } catch (Throwable $e) {
               return back()->with("error", "An error occurred while deleting seller.");
           }
       }
      
       public function search($phone_number)
       {
           return Seller::where('phone_number', 'like', '%'.$phone_number.'%')->get();
       }

}
