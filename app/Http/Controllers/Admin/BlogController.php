<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Blog_comment;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Exception;
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
        //
        $blogs = Blog::paginate(10);
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
            $data['user_id'] = 1 ;
            // $data['user_id'] = Auth::user()->id ;

            $imagePath = $this->uploadImage($request->file('image'), 'theme_admin/upload/blog');
            $data['image'] = $imagePath ;

            $blog = Blog::create($data);
        } catch (Exception $ex) {
            Log::error("ERROR => BrandController@store =>" . $ex->getMessage());
            return redirect()->route('admin.blog.create');
        }
    
        return redirect()->route('admin.blog.index');

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
        $blog = Blog::findOrFail($id);
        $data = $request->except('image');
        $data['category'] = '0' ;
        $data['user_id'] = 1 ;
        // $data['user_id'] = Auth::user()->id ;

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            $imagePath = $this->updateImage($request->file('image'), $blog->image, 'theme_admin/upload/blog');
        }
        $data['image'] = $imagePath ;


        $blog->update($data);
        return redirect()->route('admin.blog.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Blog $blog, $id)
    {
        //
        $blog = Blog::findOrFail($id);

        $this->deleteImage($blog->image);
        $blog->delete();

        return redirect()->route('admin.blog.index');
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
