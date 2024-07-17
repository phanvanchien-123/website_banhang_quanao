<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Blog_comment;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    use ImageHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); // Mặc định sắp xếp theo tên sản phẩm
        $order = $request->get('order', 'asc'); 

        $blogs = Blog::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $blogs->where('title', 'like', '%' . $name . '%');
        }

        $blogs->orderBy($sort, $order);

        $blogs = $blogs->paginate(10);

        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.blog.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        //
        try {
            $data = $request->except('image');
            $data['category'] = '0' ;
            $data['user_id'] = Auth::user()->id ;
           $data['view']=0;
            if ($request->hasFile('image')) {
                $imagePath = $this->uploadImage($request->file('image'), 'theme_admin/upload/blog');
                $data['image'] = $imagePath ;
            }else{
                 $data['image'] = 0 ;
            }
           

            $blog = Blog::create($data);

            return redirect()->route('admin.blog.index')->with(['success' => 'Thêm mới blog thành công']);

        } 
        catch (Exception $ex) {
            Log::error("ERROR => BrandController@store =>" . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới blog thất bại']);
        }
    
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        try{

            $blog = Blog::findOrFail($id);
            $data = $request->except('image');
            $data['category'] = '0' ;
            // $data['user_id'] = 1 ;
            $data['user_id'] = Auth::user()->id ;

            $imagePath = $blog->image;
            if ($request->hasFile('image')) {
                $imagePath = $this->updateImage($request->file('image'), $blog->image, 'theme_admin/upload/blog');
            }
            $data['image'] = $imagePath ;


            $blog->update($data);
            return redirect()->back()->with(['success' => 'Cập nhật blog thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => BlogController@store => Không tìm thấy blog: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy blog']);
        } catch (Exception $ex) {
            Log::error("ERROR => BlogController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật blog thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Blog $blog, $id)
    {
        //
        try{
            $blog = Blog::findOrFail($id);

            Blog_comment::where('blog_id', $blog->id)->delete();

            $this->deleteImage($blog->image);
            $blog->delete();

            return redirect()->back()->with(['success' => 'Xóa blog thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => BlogController@store => Không tìm thấy blog: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy blog']);
        } catch (Exception $ex) {
            Log::error("ERROR => BlogController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa blog thất bại']);
        }

        return redirect()->back();
    }

    public function cmt()
    {
        //
        $comments = Blog_comment::with('user')->paginate(10);
        // dd($comments);
        return view('admin.blog.cmt',compact('comments'));

    }

    public function updateCmt(Request $request, $id)
    {
        $comment = Blog_comment::findOrFail($id);
        $comment->status = $request->input('status');
        $comment->save();

        return response()->json(['success' => true]);
    }
}
