<div class="col-lg-3 primary-sidebar sticky-sidebar">
    <div class="row">
        <div class="col-lg-12 col-mg-6"></div>
        <div class="col-lg-12 col-mg-6"></div>
    </div>
    <form action="{{request()->segment(2) == 'details' ? '/shop' : ''}}">
    <div class="widget-category mb-30">
        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
        <ul class="categories">
            @foreach ($categories as $item)
            <li><a href="/shop/category/{{$item->name}}">{{$item->name}}</a></li><br>
            @endforeach
           
           
        </ul>
    </div>
    </form>
  
    <!-- Fillter By Price -->
    <div class="sidebar-widget price_range range mb-30">
        <div class="widget-header position-relative mb-20 pb-10">
            <h5 class="widget-title mb-10">Price</h5>
            
        </div>
        
            <div id="collapseFour" class="accordion-collapse collapse show"
            aria-labelledby="headingFour" >
            <div class="accordion-body">
                <div class="range-slider category-list" >
                    <input type="text" class="js-range-slider" id="js-range-price" value="">
                  
                </div>
             <div><button class="btn btn-sm btn-default" id="updateURLButton" type="submit">Tìm Kiếm</button>
                </div> 
              
            </div>
        </div>

       
       
      
    </div>
    <form action="{{request()->segment(2) == 'details' ? '/shop' : ''}}">
    <div class="list-group">
        <div class="list-group-item mb-10 mt-10">
            <label class="fw-900">Color</label>
            
            <div class="color-picker">
                <input type="radio" id="color-red" name="color" value="red"  onchange="this.form.submit();" 
                {{ request('color')=='red' ? 'checked' : ''}}>
                <label for="color-red" class="color-red"></label>
                <input type="radio" id="color-blue" name="color" value="blue" onchange="this.form.submit();" 
                {{ request('color')=='blue' ? 'checked' : ''}}>
                <label for="color-blue" class="color-blue"></label>
                <input type="radio" id="color-black" name="color" value="black"  onchange="this.form.submit();" 
                {{ request('color')=='black' ? 'checked' : ''}}>
                <label for="color-black" class="color-black"></label>
                <input type="radio" id="color-green" name="color" value="green" onchange="this.form.submit();" 
                {{ request('color')=='green' ? 'checked' : ''}}>
                <label for="color-green" class="color-green"></label>
                <!-- Thêm các màu khác tại đây -->
            </div>
            <script>
                function updateUrl(color) {
                 window.location.href = window.location.pathname + '?color=' + color;
}
             </script>
        </div>
    </div>
    
        <div class="sidebar-widget price_range range mb-30">
         
            
            <div class="list-group">
                <div class="list-group-item mb-10 mt-10">
                    <label class="fw-900">Brand</label>
                    <div class="custome-checkbox">
                        @foreach ($brands as $item)
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="brand[{{$item->id}}]" 
                            {{ (request("brand")[$item->id] ?? '') =='on' ? 'checked' : '' }}
                            id="exampleCheckbox{{$item->id}}" 
                            onchange="this.form.submit();" 
                            value="on"
                        >
                        <label class="form-check-label" for="exampleCheckbox{{$item->id}}">
                            <span>{{$item->name}}</span>
                        </label>
                        <br>
                    @endforeach
                       

                    </div>
                    
                </div>
                
            </div>
          
           
        </div>
        </form>
    <!-- Product sidebar Widget -->
    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
        <div class="widget-header position-relative mb-20 pb-10">
            <h5 class="widget-title mb-10">New products</h5>
            <div class="bt-1 border-color-1"></div>
        </div>
        <div class="single-post clearfix">
            <div class="image">
                <img src="assets/imgs/shop/thumbnail-3.jpg" alt="#">
            </div>
            <div class="content pt-10">
                <h5><a href="product-details.html">Chen Cardigan</a></h5>
                <p class="price mb-0 mt-5">$99.50</p>
                <div class="product-rate">
                    <div class="product-rating" style="width:90%"></div>
                </div>
            </div>
        </div>
        <div class="single-post clearfix">
            <div class="image">
                <img src="assets/imgs/shop/thumbnail-4.jpg" alt="#">
            </div>
            <div class="content pt-10">
                <h6><a href="product-details.html">Chen Sweater</a></h6>
                <p class="price mb-0 mt-5">$89.50</p>
                <div class="product-rate">
                    <div class="product-rating" style="width:80%"></div>
                </div>
            </div>
        </div>
        <div class="single-post clearfix">
            <div class="image">
                <img src="assets/imgs/shop/thumbnail-5.jpg" alt="#">
            </div>
            <div class="content pt-10">
                <h6><a href="product-details.html">Colorful Jacket</a></h6>
                <p class="price mb-0 mt-5">$25</p>
                <div class="product-rate">
                    <div class="product-rating" style="width:60%"></div>
                </div>
            </div>
        </div>
    </div>
   
</div>