<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::with('subcategory')->get();
    //     return $data[0]->subcategory;
       return view('AdminSite.Pages.Category.category',["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation as needed
            'description' => 'required',
        ]);

        // Upload and store the image
        $bannerPath = $request->file('banner')->store('banners', 'public');

        // Create a new category
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->banner = $bannerPath; // Store the image path in the database
        $category->description = $validatedData['description'];
        $result= $category->save();

       
  
        if(!$result){
            return redirect()->back()->with('error', 'Category created successfully');
        }else{
            return redirect()->back()->with('success', 'Category created successfully');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Summary of Update
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Update(Request $request, $id)
    {

        $rules = [
            'name' => 'sometimes',
            'banner' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'sometimes',
            'status' => 'sometimes',
        ];
        $validatedData = $request->validate($rules);
        $category = Category::findOrFail($id);
        if ($request->hasFile('banner')) {
            if (Storage::disk('public')->exists($category->banner)) {
                Storage::disk('public')->delete($category->banner);
            }
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $category->banner = $bannerPath;
        }
        if (isset($validatedData['name'])) {
            $category->name = $validatedData['name'];
        }
    
        if (isset($validatedData['description'])) {
            $category->description = $validatedData['description'];
        }
        if (isset($validatedData['status'])) {
            $category->status = $validatedData['status'];
        }
    
        $res = $category->save();
    
        if (!$res) {
            return redirect()->back()->with('error', 'Category update not successful');
        } else {
            return redirect()->back()->with('success', 'Category updated successfully');
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Category::destroy($id);
        if($result){
            return back()->with('success','category deleted success fully ');
        }else{
            return back()->with('error','category deleted not success fully ');
        }
    }
    public function search($name)
    {
        return Category::where('name', 'like', '%'.$name.'%')->get();
    }
}
