<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    //
    use ImageHandler;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); // Mặc định sắp xếp theo tên sản phẩm
        $order = $request->get('order', 'asc'); 

        $suppliers = Supplier::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $suppliers->where('name', 'like', '%' . $name . '%');
        }

        $suppliers->orderBy($sort, $order);

        $suppliers = $suppliers->paginate(10);

        return view('admin.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.supplier.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $data = $request->except('avatar');

            if ($request->hasFile('avatar')) {
                $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/supplier');
                $data['avatar'] = $imagePath ;
            }
    
            $supplier = Supplier::create($data);

            return redirect()->route('admin.supplier.index')->with(['success' => 'Thêm mới supplier thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => supplierController@store =>" . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới supplier thất bại']);
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
    public function edit(Supplier $supplier,$id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{

            $supplier = Supplier::findOrFail($id);
            $data = $request->except('avatar');
            $imagePath = $supplier->avatar;
            if ($request->hasFile('avatar')) {
                $imagePath = $this->updateImage($request->file('avatar'), $supplier->avatar, 'theme_admin/upload/supplier');
            }
            $data['avatar'] = $imagePath ;


            $supplier->update($data);

            return redirect()->back()->with(['success' => 'Cập nhật supplier thành công']);

        }catch (Exception $ex) {
            Log::error("ERROR => supplierController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật supplier thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Supplier $supplier, $id)
    {
        //
        try{

            $supplier = Supplier::findOrFail($id);
            $this->deleteImage($supplier->avatar);
            $supplier->delete();

            return redirect()->back()->with(['success' => 'Xóa supplier thành công']);
        
        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => supplierController@store => Không tìm thấy supplier: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy supplier']);
        } catch (Exception $ex) {
            Log::error("ERROR => supplierController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa supplier thất bại']);
        }

        return redirect()->back();
    }
}
