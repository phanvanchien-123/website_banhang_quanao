<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    use ImageHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categories = Category::paginate(10);
        // dd($categories);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        try {
            $data = $request->except('avatar');
            $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/category');
            $data['avatar'] = $imagePath ;    
    
            $category = Category::create($data);
        } catch (Exception $ex) {
            Log::error("ERROR => CategoryController@store =>" . $ex->getMessage());
            return redirect()->route('admin.category.create');
        }
    
        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category,$id)
    {
        //
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->except('avatar');
        $imagePath = $category->avatar;

        if ($request->hasFile('avatar')) {
            $imagePath = $this->updateImage($request->file('avatar'), $category->avatar, 'theme_admin/upload/category');
        }
        $data['avatar'] = $imagePath ;


        $category->update($data);
        return redirect()->route('admin.category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Category $category, $id)
    {
        //
        $category = Category::findOrFail($id);
        $this->deleteImage($category->avatar);

        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
