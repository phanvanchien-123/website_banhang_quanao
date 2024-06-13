@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Blog
                <span></span> Technology
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-page pr-30">
                        <div class="single-header style-2">
                            <h1 class="mb-30">{{$blogs->title}}</h1>
                            <div class="single-header-meta">
                                <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                    <span class="post-by">Viết Bởi : {{$blogs->users->name}}</a></span>
                                    <span class="post-on has-dot">{{$blogs->created_at}}</span>
                                 
                                    <span class="hit-count  has-dot">{{$blogs->view}} Views</span>
                                </div>
                              
                            </div>
                        </div>
                        <figure class="single-thumbnail">
                            <img src="assets/imgs/blog/blog-6.jpg" alt="">
                        </figure>
                        <div class="single-content">
                            {!! $blogs->content !!}
                        </div>
                        
                        <div class="comments-area">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mb-30">Comments</h4>
                                   
                                    <div class="comment-list">
                                        @foreach ($blogcommets as $item)
                                        @if ($item->status ==1)
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="assets/imgs/page/avatar-6.jpg" alt="">
                                                    <h6><a href="#">{{$item->user->name}}</a></h6>
                                                    <p class="font-xxs">{{$item->created_at}}</p>
                                                </div>
                                                <div class="desc">
                                                    
                                                    <p>{{$item->messages}}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">{{$item->created_at}}</p>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else

                                        @endif
                                        @endforeach
                                        
                                       
                                    </div>
                                    <div class="pagination">
                                        {{$blogcommets->withQueryString()->links('Client.pagination.default')}}
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="comment-form">
                            <h4 class="mb-15">Đánh Giá Bài Viết</h4>
                            @auth
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <form class="form-contact comment_form" action="/blog/{{$blogs->id}}/Comment" id="commentForm" method="POST">
                                        <div class="row">
                                            @csrf
                                            <input type="hidden" name="blog_id" value="{{ $blogs->id }}">
                                            <input type="hidden" name="user_id"
                                                value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control w-100" name="messages" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button button-contactForm">Post Comment</button>
                                        </div>
                                    </form>
                                    
                                </div>
                               
                            </div>
                            @endauth
    
                            @guest
                            <div class="row">
                            <p>Hãy <a href="{{ route('login') }}"> Đăng Nhập </a>để có thể đánh giá bài viết này
                            </p>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
                @include('Client.blog.view')
            </div>
        </div>
    </section>
</main>
@endsection