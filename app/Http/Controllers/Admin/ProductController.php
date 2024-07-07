<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Ward;
use Exception;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Models\ProductDetail;
use App\Models\Product_comment;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Service\Product\ProductServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Service\ProductComment\ProductCommentServiceInterface;

class ProductController extends Controller
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

        $products = Product::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $products->where('name', 'like', '%' . $name . '%');
        }

        $products->orderBy($sort, $order);

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
        $suppliers = Supplier::all();
        return view('admin.product.create', compact('categories','brands','suppliers'));

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
            if($dataDetails){
                foreach ($dataDetails['size'] as $index => $size) {
                    ProductDetail::create([
                        'product_id' => $product->id, 
                        'size' => $size,
                        'color' => $dataDetails['color'][$index],
                        'qty' => $dataDetails['qty2'][$index],
                    ]);
                }
            }

            

            return redirect()->route('admin.product.index')->with(['success' => 'Thêm mới sản phẩm thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => ProductController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới sản phẩm thất bại']);
        }

        return redirect()->back();
        


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
        $suppliers = Supplier::all();
        $product = Product::findOrFail($id);

        return view('admin.product.edit',compact('product','categories','brands','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        //
        try {
    
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

            return redirect()->back()->with(['success' => 'Sửa sản phẩm thành công']);

        }catch (Exception $ex) {
            Log::error("ERROR => ProductController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Sửa sản phẩm thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Product $product, $id)
    {
        try{

            $product = Product::findOrFail($id);

            Product_comment::where('product_id', $product->id)->delete();

            $this->deleteImage($product->avatar);

            // Xóa các ảnh trong album
            foreach ($product->productImages as $image) {
                $this->deleteImage($image->path);
                $image->delete();
            }

                ProductDetail::where('product_id', $product->id)->delete();

                $product->delete();

                return redirect()->back()->with(['success' => 'Xóa sản phẩm thành công']);

        }catch (Exception $ex) {
            Log::error("ERROR => ProductController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa sản phẩm thất bại']);
        }

        return redirect()->back();
    }

    public function deleteDetail($id)
    {
        $detail = ProductDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['success' => true]);
    }

    public function stock(Request $request) 
    {
        $filter = $request->input('filter');

        switch ($filter) {
            case 'lt6m':
                $products = Product::whereDate('created_at', '>', now()->subMonths(6))->where('qty', '>', 0)->get();
                break;
            case '6m1y':
                $products = Product::whereDate('created_at', '<=', now()->subMonths(6))
                    ->whereDate('created_at', '>', now()->subYear())->where('qty', '>', 0)->get();
                break;
            case 'gt1y':
                $products = Product::whereDate('created_at', '<=', now()->subYear())->where('qty', '>', 0)->get();
                break;
            default:
                $products = Product::where('qty', '>', 0)->get();
                break;
        }

        return view('admin.product.stock', compact('products'));
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
