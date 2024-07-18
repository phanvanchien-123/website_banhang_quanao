<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Service\Blog\BlogServiceInterface;
use App\Service\BlogComment\BlogCommentService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    private $blogservice;
    private $blogcommentservice;
  
    public function __construct(BlogServiceInterface $blogService,
                                BlogCommentService $blogCommentService
    
    )
    {
        $this->blogservice = $blogService;
       $this->blogcommentservice =$blogCommentService;
    }
    public function index(){
      //  $blogs = $this->blogservice->all();
        $getblog = $this->blogservice->getlongBlogs(5);
        $BlogsPagina= $this->blogservice->getAllBlogsPaginated(10);
        return view('Client.blog.index',compact('getblog','BlogsPagina'));
    }
    public function show($id){
        $blogs = $this->blogservice->find($id);
        $blogs->increment('view');     
        $blogcommets = $this->blogcommentservice->getCommentsByBlogId($id,3);
        $getblog = $this->blogservice->getlongBlogs(5);
        return view('Client.blog.show',compact('blogs','blogcommets','getblog'));
    }
    public function postComment(Request $request){
        $this->blogcommentservice->create($request->all());
        return redirect()->back()->with('success', 'Bình luận đã được đăng thành công!');
    }
    
}
