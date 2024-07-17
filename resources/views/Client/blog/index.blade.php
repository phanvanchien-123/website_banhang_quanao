@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Home</a>
                <span></span> <a href="/blog">Blog</a>
                <span></span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-9">
                   
                    <div class="loop-grid pr-30">
                        <div class="row">
                           @foreach ($BlogsPagina as $item)
                           <div class="col-lg-6">
                            <article class="wow fadeIn animated hover-up mb-30">
                                <div class="post-thumb img-hover-scale">
                                    <a href="/blog/{{$item->id}}">
                                        <img src="{{asset('storage/'.$item->image)}}" alt="">
                                    </a>
                                   
                                </div>
                                <div class="entry-content-2">
                                    <h3 class="post-title mb-15">
                                        <a href="/blog/{{$item->id}}">{{$item->title}}</a></h3>
                                    <p class="post-exerpt mb-30">{{$item->subtitle}}</p>
                                    <div class="">
                                        <div>
                                            <span class="post-on"> <i class="fi-rs-clock"></i> {{$item->created_at}}</span>
                                            <span class="hit-count has-dot">{{$item->view}} lượt xem</span>
                                            <span class="hit-count has-dot">{{count($item->blogComments)}} Bình luận</span>
                                        </div>
                                      
                                    </div>
                                </div>
                            </article>
                        </div>
                           @endforeach
                           
                       
                        </div>
                    </div>
                    {{$BlogsPagina->withQueryString()->links('Client.pagination.default')}}
                </div>
             @include('Client.blog.view')
            </div>
        </div>
    </section>
</main>
@endsection