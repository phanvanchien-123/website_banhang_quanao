<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $sort = $request->get('sort', 'id'); // Mặc định sắp xếp theo tên sản phẩm
        $order = $request->get('order', 'asc'); 

        $brands = Brand::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $brands->where('name', 'like', '%' . $name . '%');
        }

        $brands->orderBy($sort, $order);

        $brands = $brands->paginate(10);
        // dd($brand);
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.brand.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        //
        try {
            $data = $request->except('avatar');
            if ($request->hasFile('avatar')) {
                $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/brand');
                $data['avatar'] = $imagePath ;
            }
    
            $brand = Brand::create($data);

            return redirect()->route('admin.brand.index')->with(['success' => 'Thêm mới brand thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => brandController@store =>" . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới brand thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand,$id)
    {
        //
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, $id)
    {
        try{

            $brand = Brand::findOrFail($id);
            $data = $request->except('avatar');
            $imagePath = $brand->avatar;
            if ($request->hasFile('avatar')) {
                $imagePath = $this->updateImage($request->file('avatar'), $brand->avatar, 'theme_admin/upload/brand');
            }
            $data['avatar'] = $imagePath ;


            $brand->update($data);

            return redirect()->back()->with(['success' => 'Cập nhật brand thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => BrandController@store => Không tìm thấy brand: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy brand']);
        } catch (Exception $ex) {
            Log::error("ERROR => BrandController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật brand thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Brand $brand, $id)
    {
        //
        try{

            $brand = Brand::findOrFail($id);
            $this->deleteImage($brand->avatar);
            $brand->delete();

            return redirect()->back()->with(['success' => 'Xóa brand thành công']);
        
        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => BrandController@store => Không tìm thấy brand: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy brand']);
        } catch (Exception $ex) {
            Log::error("ERROR => BrandController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa brand thất bại']);
        }

        return redirect()->back();
    }
}
