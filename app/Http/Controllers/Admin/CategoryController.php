<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    use ImageHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); // Mặc định sắp xếp theo tên sản phẩm
        $order = $request->get('order', 'asc'); 

        $categories = Category::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $categories->where('name', 'like', '%' . $name . '%');
        }

        $categories->orderBy($sort, $order);

        $categories = $categories->paginate(10);

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
            if ($request->hasFile('avatar')) {
                $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/category');
                $data['avatar'] = $imagePath ;    
            }
    
            $category = Category::create($data);

            return redirect()->route('admin.category.index')->with(['success' => 'Thêm mới danh mục thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => CategoryController@store =>" . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới danh mục thất bại']);
        }
        
        return redirect()->back();

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
        try{

            $category = Category::findOrFail($id);
            $data = $request->except('avatar');
            $imagePath = $category->avatar;

            if ($request->hasFile('avatar')) {
                $imagePath = $this->updateImage($request->file('avatar'), $category->avatar, 'theme_admin/upload/category');
            }
            $data['avatar'] = $imagePath ;

            $category->update($data);
            return redirect()->back()->with(['success' => 'Sửa danh mục thành công']);

        
        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => CategoryController@store => Không tìm thấy danh mục: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy danh mục']);
        } catch (Exception $ex) {
            Log::error("ERROR => CategoryController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật danh mục thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Category $category, $id)
    {
        //
        try{
            $category = Category::findOrFail($id);

            Product::where('product_category_id', $category->id)->delete();


            $this->deleteImage($category->avatar);

            $category->delete();

            return redirect()->back()->with(['success' => 'Xóa danh mục thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => CategoryController@store => Không tìm thấy danh mục: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy danh mục']);
        } catch (Exception $ex) {
            Log::error("ERROR => CategoryController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa danh mục thất bại']);
        }

        return redirect()->back();
    }
}
