<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="quần áo, xe,..." name="name"  value="{{ isset($category) ? $category->name : ''}}">
        @error('name')
                <small class="text-danger">{{ $errors->first('name')  }}</small>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
        <div class="border rounded">
            <div id="imageWrapper" class="border-bottom d-flex" style="display: none;">
                @if (isset($category->avatar))
                    <img src="{{ $category->avatar }}" alt="" class="m-3" width="120px" height="120px">    
                @endif                    
            </div>
            <input type="file"  class="form-control" id="exampleFormControlInput2" placeholder="" name="avatar" value="" onchange="previewImages(event)">
        </div>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">mô tả</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"> {{ isset($category) ? $category->description : ''}}</textarea>
      </div>
      <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>


      <script>
        function previewImages(event) {
            const input = event.target;
            const imageWrapper = document.getElementById('imageWrapper');
    
            // Xóa các ảnh hiển thị trước đó
            imageWrapper.innerHTML = '';
    
            if (input.files && input.files.length > 0) {
                // Hiển thị phần tử chứa ảnh
                imageWrapper.style.display = 'flex';
    
                // Duyệt qua từng tệp hình ảnh và hiển thị
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Uploaded Image';
                        img.className = 'm-3';
                        img.width = '120';
                        img.height = '120';
                        imageWrapper.appendChild(img);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            } else {
                // Nếu không có tệp hình ảnh nào được chọn, ẩn phần tử chứa ảnh
                imageWrapper.style.display = 'none';
            }
        }
    </script>
</form>