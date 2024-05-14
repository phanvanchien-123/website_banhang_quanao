<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // dd($request->cookie());

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
            $data = $request->all();
    
            // Nếu tồn tại file avatar trong request
            // if ($request->hasFile('avatar')) {
            //     // Sử dụng Helper function để tải ảnh lên Cloudinary
            //     $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
                
            //     // Thêm đường dẫn của ảnh vào dữ liệu trước khi lưu
            //     $data['avatar'] = $imageUrl;
            // }
    
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
        $data = $request->all();

        // if ($request->hasFile('avatar')) {
        //         // Upload ảnh mới
        //         $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
        //         // Xóa ảnh cũ trước khi cập nhật ảnh mới
        //         if (!empty($category->avatar)) {
        //             CloudinaryHelper::deleteImage($category->avatar);
        //         }
                
        //         $data['avatar'] = $imageUrl;
        // }

        $category = Category::findOrFail($id);
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
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
