<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Ward;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
// use App\Models\District;
// use App\Models\Province;
// use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Helpers\CloudinaryHelper;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
        //
        $products = Product::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $products->where('name', 'like', '%' . $name . '%');
        }

        $products = $products->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        // $provinces = Province::all();
        // $districts = District::all();
        // $wards = Ward::all();


        // $model = new Product();
        // $status = $model->getStatus();

        // $viewData = [
        //     'categories' => $categories,
        //     'status' => $status,
        //     'provinces' => $provinces,
        //     'districts' => $districts,
        //     'wards' => $wards,
        // ];
        return view('admin.product.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        // dd($request->all());
        try {
            $data = $request->except('size','color','qty2');


            $product = Product::create($data);

            $dataDetails = $request->only('size', 'color', 'qty2');

            // Lặp qua các mảng size, color và qty2 để lưu vào bảng product_detail
            foreach ($dataDetails['size'] as $index => $size) {
                ProductDetail::create([
                    'product_id' => $product->id, 
                    'size' => $size,
                    'color' => $dataDetails['color'][$index],
                    'qty' => $dataDetails['qty2'][$index],
                ]);
            }


            
        } catch (Exception $ex) {
            Log::error("ERROR => ProductController@store =>". $ex->getMessage());
            return redirect()->route('admin.product.create');
        }
        return redirect()->route('admin.product.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $Product,$id)
    {
        //
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $detail = ProductDetail::where('product_id', $id);

        return view('admin.product.edit',compact('product','categories','detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);

        $dataUpdate = $request->except('size', 'color', 'qty2');

        $product->update($dataUpdate);

        $dataDetails = $request->only('size', 'color', 'qty2');

        foreach ($dataDetails['size'] as $index => $size) {
            $productDetail = ProductDetail::updateOrCreate(
                ['product_id' => $product->id, 'size' => $size],
                ['color' => $dataDetails['color'][$index], 'qty' => $dataDetails['qty2'][$index]]
            );
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Product $product, $id)
    {
        $product = Product::findOrFail($id);
        ProductDetail::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->route('admin.product.index');
    }
}
