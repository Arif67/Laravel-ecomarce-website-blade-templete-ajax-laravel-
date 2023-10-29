<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
       
       /**
        * Summary of index
        * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
        */
       public function index(){
           $brandData = Brand::all();
           return view('AdminSite.Pages.Brand.brand',['data'=>$brandData]);
       }

       
       public function store(Request $request)
       {
           $request->validate([
               'name' => 'required',
               'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
           ]);
 
           if ($request->hasFile('banner')) {
           
               $bannerPath = $request->file('banner')->store('brands', 'public');
           } else {
              
               $bannerPath = 'default-image-path.jpg'; 
           }
       
           $brand = new Brand;
           $brand->name = $request->input('name');
           $brand->banner = $bannerPath;
           $brand->status = "active";
           $result=$brand->save();
           if(!$result){
            return redirect()->back()->with('error', 'Brand created successfully');
        }else{
            return redirect()->back()->with('success', 'Brand  created successfully');
        }
           
       }
       

       public function show($id){
        return Brand::find($id);
       }
       public function update(Request $request, $id)
       { 
           $brand = Brand::findOrFail($id);
           $validatedData = $request->validate([
               'name' => 'sometimes',
               'banner' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', 
               'status' => 'sometimes',
           ]);
           if ($request->hasFile('banner')) {
              
               if (Storage::disk('public')->exists($brand->banner)) {
                   Storage::disk('public')->delete($brand->banner);
               }
               $bannerPath = $request->file('banner')->store('brands', 'public');
               $brand->banner = $bannerPath;
           }
            if (isset($validatedData['name'])) {
                $brand->name = $validatedData['name'];
            }
            if (isset($validatedData['status'])) {
                $brand->status = $validatedData['status'];
            }
            $result = $brand->save();

            if(!$result){
                return redirect()->back()->with('error', 'Brand update not successfully');
            }else{
                return redirect()->back()->with('success', 'Brand updated successfully');
            }
       }
       
       public function destroy($id){
        $result = Brand::destroy($id);
        if(!$result){
            return redirect()->back()->with('error', 'Brand delted not successfully');
        }else{
            return redirect()->back()->with('success', 'Brand  Deleted successfully');
        }

       }

       public function search($name)
       {
           return Brand::where('name', 'like', '%'.$name.'%')->get();
       }
}
