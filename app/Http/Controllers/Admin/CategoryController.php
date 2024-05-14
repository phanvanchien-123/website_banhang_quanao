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
        return view('Backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Backend.category.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        try {
            $data = $request->except('_token', 'avatar');
            $data['slug'] = Str::slug($request->name);
    
            // Nếu tồn tại file avatar trong request
            if ($request->hasFile('avatar')) {
                // Sử dụng Helper function để tải ảnh lên Cloudinary
                $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
                
                // Thêm đường dẫn của ảnh vào dữ liệu trước khi lưu
                $data['avatar'] = $imageUrl;
            }
    
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
        return view('Backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category, $id)
    {
        $category = Category::findOrFail($id);
        // dd($request->hasFile('avatar'));
        //
        $data = $request->except('_token','avatar');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('avatar')) {
                // Upload ảnh mới
                $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
                // Xóa ảnh cũ trước khi cập nhật ảnh mới
                if (!empty($category->avatar)) {
                    CloudinaryHelper::deleteImage($category->avatar);
                }
                
                $data['avatar'] = $imageUrl;
        }

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
        // Kiểm tra xem category có ảnh không
        if ($category->avatar) {
            // Nếu có, thực hiện xóa ảnh từ Cloudinary
            CloudinaryHelper::deleteImage($category->avatar);
        }
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
