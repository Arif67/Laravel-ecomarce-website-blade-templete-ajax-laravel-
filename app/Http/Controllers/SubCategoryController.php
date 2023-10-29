<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
  
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
         $category = Category::all();
         $subcategory =SubCategory::with('category')->get();
         $data = [
            'category'=>$category,
            'subcategory'=>$subcategory
         ];
       //dd($data);
     return view('AdminSite.Pages.SubCategory.subcategory',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

  
   
    public function store(Request $request)
        {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'status' => 'sometimes', 
            ]);

        
            $bannerPath = null; 
            if ($request->hasFile('banner')) {
                $bannerPath = $request->file('banner')->store('subcategories', 'public');
            }
            $result = SubCategory::create([
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'banner' => $bannerPath,
                'status' => "active",
            ]);

            if(!$result){
                return redirect()->back()->with('error', 'Sub Category created successfully');
            }else{
                return redirect()->back()->with('success', 'Sub Category created successfully');
            }
        }


  
    public function show($id)
    {
        $data= SubCategory::where('category_id',"=",$id)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes'
        ]);
        // Find the subcategory by ID
        $result = SubCategory::find($id);
    
        if (!$result) {
            return back()->with('error','subcategory not found ');
        }
    
        // Update the category_id if provided
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id');
            $result->category_id = $category_id;
        }
    
        // Update the name 
        if ($request->has('name')) {
            $name = $request->input('name');
            $result->name = $name;
        }
    
        // Update the status 
        if ($request->has('status')) {
            $status = $request->input('status');
            $result->status = $status;
        }
    
        // Update the banner image if a new one is provided
        if ($request->hasFile('banner')) {
            // Delete the previous banner image if it exists
            if (Storage::disk('public')->exists($result->banner)) {
                Storage::disk('public')->delete($result->banner);
            }
    
            // Upload and store the new banner image
            $bannerPath = $request->file('banner')->store('subcategories', 'public');
            $result->banner = $bannerPath;
        }
    
        // Save the updated subcategory
        $res = $result->save();
    
        if(!$res){
            return redirect()->back()->with('error', 'Sub Category updated successfully');
        }else{
            return redirect()->back()->with('success', 'Sub Category updated successfully');
        }
    }
    
    public function destroy($id)
    {
        $result= SubCategory::destroy($id);
        if(!$result){
            return redirect()->back()->with('error', 'Sub Category created successfully');
        }else{
            return redirect()->back()->with('success', 'Sub Category created successfully');
        }
    }
    public function search($name)
    {
        return SubCategory::where('name', 'like', '%'.$name.'%')->get();
    }
}
