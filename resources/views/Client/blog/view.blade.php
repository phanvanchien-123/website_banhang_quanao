<div class="col-lg-3 primary-sidebar sticky-sidebar">
    <div class="widget-area">
       
       
        <!--Widget latest posts style 1-->
        <div class="sidebar-widget widget_alitheme_lastpost mb-20">
            <div class="widget-header position-relative mb-20 pb-10">
                <h5 class="widget-title">Những bài viết có nhiều lượt xem nhất</h5>
            </div>
            <div class="row">
               
@foreach ($getblog as $item)
               
<div class="col-md-6 col-sm-6 sm-grid-content mb-30">
<div class="post-thumb d-flex border-radius-5 img-hover-scale mb-15">
<a href="blog-details.html">
<img src="{{asset('storage/'.$item->image)}}" alt="">
</a>
</div>
<div class="post-content media-body">
<h6 class="post-title mb-10 text-limit-2-row">{{$item->title}}</h6>
<div class="">
<span class="post-on mr-10">{{$item->created_at}}</span>
<span class="hit-count has-dot ">{{$item->view }} Views</span>
</div>
</div>
</div>
@endforeach
              
            </div>
        </div>
    
        
    </div>
</div>