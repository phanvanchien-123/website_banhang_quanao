<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Ward;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Models\ProductDetail;
use App\Models\Product_comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;



class ProductController extends Controller
{
    use ImageHandler;

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
        $brands = Brand::all();
        return view('admin.product.create', compact('categories','brands'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        try {
            $data = $request->except('size','color','qty2','avatar','images');

            $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/product');
            $data['avatar'] = $imagePath ;


            $product = Product::create($data);

            if($request->has('images')){
                foreach ($request->file('images') as $image){
                    $imagePath = $this->uploadImage($image, 'theme_admin/upload/product');
                    Product_image::create([
                        'product_id' => $product->id, 
                        'path' => $imagePath,
                    ]);
                }
            }
            

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
        $brands = Brand::all();
        $product = Product::findOrFail($id);

        return view('admin.product.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $product = Product::findOrFail($id);

        $data = $request->except('size','color','qty2','avatar','images');

        $imagePath = $product->avatar;

        if ($request->hasFile('avatar')) {
            $imagePath = $this->updateImage($request->file('avatar'), $product->avatar, 'theme_admin/upload/product');
        }
        $data['avatar'] = $imagePath ;

        $product->update($data);

        // Kiểm tra và cập nhật album ảnh nếu có
        if ($request->hasFile('images')) {
            // Xóa các ảnh cũ trước khi thêm ảnh mới
            if($product->productImages){
                foreach ($product->productImages as $img) {
                    $this->deleteImage($img->path);
                    $img->delete();
                }
            }
            
            // Thêm ảnh mới vào album
            foreach ($request->file('images') as $image) {
                $imagePath = $this->uploadImage($image, 'theme_admin/upload/product');
                Product_image::create([
                    'product_id' => $product->id,
                    'path' => $imagePath,
                ]);
            }
        }


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

        // Xóa ảnh đại diện
        $this->deleteImage($product->avatar);

        // Xóa các ảnh trong album
        foreach ($product->images as $image) {
            $this->deleteImage($image->path);
            $image->delete();
        }

        // Xóa chi tiết sản phẩm liên quan
        ProductDetail::where('product_id', $product->id)->delete();

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('admin.product.index');
    }

    public function cmt()
    {
        //
        $comments = Product_comment::paginate(10);
        return view('admin.product.cmt',compact('comments'));

    }

    public function updateCmt(Request $request, $id)
    {
        $comment = Product_comment::findOrFail($id);
        $comment->status = $request->input('status');
        $comment->save();

        return response()->json(['success' => true]);
    }
}
