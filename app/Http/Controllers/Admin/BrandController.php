<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $brands = Brand::paginate(10);
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
            $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/brand');
            $data['avatar'] = $imagePath ;
    
            $brand = Brand::create($data);
        } catch (Exception $ex) {
            Log::error("ERROR => brandController@store =>" . $ex->getMessage());
            return redirect()->route('admin.brand.create');
        }
    
        return redirect()->route('admin.brand.index');

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
        $brand = Brand::findOrFail($id);
        $data = $request->except('avatar');
        $imagePath = $brand->avatar;
        if ($request->hasFile('avatar')) {
            $imagePath = $this->updateImage($request->file('avatar'), $brand->avatar, 'theme_admin/upload/blog');
        }
        $data['avatar'] = $imagePath ;


        $brand->update($data);

        return redirect()->route('admin.brand.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Brand $brand, $id)
    {
        //
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->avatar);
        $brand->delete();

        return redirect()->route('admin.brand.index');
    }
}
