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
        return view('admin.product.create', $categories);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        // dd($request->all());
        try {
            $data = $request->all();


            $product = Product::create($data);

            
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
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();


        $product = Product::findOrFail($id);
        $imgs = Image::get()->where('product_id',$product->id);
        // dd($imgs);
        $model = new Product();
        $status = $model->getStatus();
        return view('Backend.product.edit',compact('product','categories','status','imgs','provinces','districts','wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, $id)
    {
        //
        $product = Product::findOrFail($id);
     
        $data = $request->except('_token','avatar','avatars');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('avatar')) {
            // Upload ảnh mới
            $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
            // Xóa ảnh cũ
            if (!empty($product->avatar)) {
                CloudinaryHelper::deleteImage($product->avatar);
            }
            
            $data['avatar'] = $imageUrl;
        }

        // $product = Product::findOrFail($id);
        $product->update($data);
        
        if ($request->hasFile('avatars')){
            if(!empty($product->images)){
                foreach($product->images as $image){
                    $upload = CloudinaryHelper::deleteImage($image->path);
                    Image::destroy($image->id);
                }
            }

            // Lặp qua từng file ảnh được gửi từ form
            foreach ($request->file('avatars') as $avatar) {
                // Upload ảnh lên Cloudinary
                $uploadResult = CloudinaryHelper::uploadImage($avatar);

                // Nếu upload thành công, lưu đường dẫn và tên của ảnh vào CSDL
                if ($uploadResult) {
                    // Lưu đường dẫn và tên ảnh vào CSDL
                    $imageModel = new Image();
                    $imageModel->path = $uploadResult;
                    $imageModel->name = $avatar->getClientOriginalName();
                    $imageModel->product_id = $product->id;
                    $imageModel->save();
                }
            }
            
            
            
        }

        return redirect()->route('admin.product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Product $product, $id)
    {
        //
        // $product = Product::destroy($id);
        // $product->delete();


        $product = Product::findOrFail($id)->load('images');
        // dd($product);
        // Kiểm tra xem product có ảnh không
        if ($product->avatar) {
            // Nếu có, thực hiện xóa ảnh từ Cloudinary
            CloudinaryHelper::deleteImage($product->avatar);
        }
        if($product->images){
            foreach ($product->images as $image) {
                CloudinaryHelper::deleteImage($image->path);
            }
        }

        $product->delete();

        return redirect()->route('admin.product.index');
    }
}
