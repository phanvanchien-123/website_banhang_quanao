<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="mb-3">
                <div class="h5 pb-2 mb-4 text-success border-bottom border-success">
                    <label for="editor" class="form-label">Tên sản phẩm</label>
                </div>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name"
                    value="{{ isset($product) ? $product->name : '' }}">
                @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-5">

        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-7">
            <div class="mb-3 ">
                <div class="h5 pb-2 mb-4 text-success border-bottom border-success">
                    <label for="editor" class="form-label">Mô tả</label>
                </div>

                <textarea class="form-control" id="editor" rows="30" name="description">{{ isset($product) ? $product->description : '' }}</textarea>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Tìm phần tử textarea với id="editor"
                        const editorTextarea = document.querySelector('#editor');
                        // Tăng chiều cao của textarea lên 500px
                        editorTextarea.style.height = '500px';
                        ClassicEditor
                            .create(document.querySelector('#editor'))
                            .catch(error => {
                                console.error(error);
                            });
                    });
                </script>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="exampleFormControlInput6" class="form-label">Danh mục</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="exampleFormControlInput6"
                    name="category_id">
                    <option selected value="0">Chọn danh mục</option>
                    @foreach ($categories ?? [] as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($product) && $product->category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput6" class="form-label">Brand</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="exampleFormControlInput6"
                    name="category_id">
                    <option selected value="0">Chọn Brand</option>
                    @foreach ($brands ?? [] as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($product) && $product->brand_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="exampleFormControlInput2" placeholder="" name="avatar"
                    value="{{ isset($product) ? $product->avatar : '' }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Album</label>
                <div class="border rounded">
                    <div id="imageWrapper" class="border-bottom d-flex" style="display: none;">
                        @foreach ($imgs ?? [] as $img)
                            <img src="{{ $img->path }}" alt="" class="m-3" width="120px" height="120px">
                        @endforeach
                    </div>
                    <input type="file" multiple class="form-control" id="exampleFormControlInput2" placeholder=""
                        name="avatars[]" value="" onchange="previewImages(event)">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-7">
            <div class="h5 pb-2 mb-4 text-success border-bottom border-success">
                Thông tin sản phẩm
            </div>
            <div class="border border-top-0 px-3">
                <div class="mb-3">
                    <label for="editor" class="form-label">Mã sản phẩm</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
                        name="sku" value="{{ isset($product) ? $product->sku : '' }}">
                    @error('sku')
                        <small class="text-danger">{{ $errors->first('sku') }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">giá</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="VND"
                        name="price" value="{{ isset($product) ? $product->price : '' }}">
                    @error('price')
                        <small class="text-danger">{{ $errors->first('price') }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" id="exampleFormControlInput4" placeholder=""
                        name="number" value="{{ isset($product) ? $product->number : '' }}">
                    @error('number')
                        <small class="text-danger">{{ $errors->first('number') }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="exampleFormControlInput5" placeholder="%"
                        name="discount" value="{{ isset($product) ? $product->discount : '' }}">
                    @error('discount')
                        <small class="text-danger">{{ $errors->first('discount') }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Cân nặng (kilogram)</label>
                    <input type="number" class="form-control" id="weight" placeholder="" name="weight"
                        value="{{ isset($product) ? $product->weight : '' }}">
                    @error('weight')
                        <small class="text-danger">{{ $errors->first('weight') }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="editor" class="form-label">tag</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
                        name="sku" value="{{ isset($product) ? $product->sku : '' }}">
                    @error('sku')
                        <small class="text-danger">{{ $errors->first('sku') }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="editor" class="form-label">featured</label>
                    <div class="d-flex">
                        <div class="form-check ms-5">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                có
                            </label>
                        </div>
                        <div class="form-check ms-5">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                không
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="d-flex">
                <div class="h5 pb-2 mb-4 text-success border-bottom border-success me-auto">
                    Thuộc tính sản phẩm
                </div>
                <div>
                    <a class="btn btn-outline-primary" id="addAttributeBtn">Thêm thuộc tính</a>
                </div>
            </div>

            <div class="border border-top-0 px-3">
                <div id="attributeContainer">
                    <div class="d-flex justify-content-around">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Size: </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
                                name="size" value="{{ isset($product) ? $product->size : '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Color</label>
                            <input type="number" class="form-control" id="exampleFormControlInput3" placeholder=""
                                name="color" value="{{ isset($product) ? $product->color : '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="exampleFormControlInput4" placeholder=""
                                name="qty" value="{{ isset($product) ? $product->qty : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Sử dụng jQuery để thêm event listener cho nút "Thêm thuộc tính"
                $(document).ready(function() {
                    $('#addAttributeBtn').click(function() {
                        // Sao chép phần tử div chứa các input
                        var attributeDivClone = $('#attributeContainer').children().clone();
                        // Thêm phần tử div được sao chép vào cuối của container
                        $('#attributeContainer').append(attributeDivClone);
                    });
                });
            </script>
        </div>
    </div>
    <button type="submit" class="btn btn-outline-primary mt-3">Lưu dữ liệu</button>




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

    {{-- <script>
      // Lấy các select box và gán các sự kiện onchange
      var provinceSelect = document.getElementById('address');
      var districtSelect = document.getElementById('district');
      var wardSelect = document.getElementById('ward');

      provinceSelect.onchange = function() {
          // Xóa tất cả các lựa chọn cũ của quận/huyện và xã/phường
          districtSelect.innerHTML = '<option selected value="0">Chọn Quận/Huyện</option>';
          wardSelect.innerHTML = '<option selected  value="0">Chọn Xã/Phường</option>';

          // Lấy giá trị của tỉnh/thành phố được chọn
          var selectedProvinceId = provinceSelect.value;

          // Lọc danh sách quận/huyện tương ứng với tỉnh/thành phố được chọn
          var districts = {!! json_encode($districts) !!}; // Dữ liệu các quận/huyện, bạn cần đảm bảo dữ liệu này được truyền từ phía server

          // Lặp qua danh sách quận/huyện và thêm vào select box
          districts.forEach(function(district) {
              if (district.province_id == selectedProvinceId) {
                  var option = document.createElement('option');
                  option.text = district.name;
                  option.value = district.district_id;
                  districtSelect.add(option);
              }
          });
      };

      districtSelect.onchange = function() {
          // Xóa tất cả các lựa chọn cũ của xã/phường
          wardSelect.innerHTML = '<option selected  value="0">Chọn Xã/Phường</option>';

          // Lấy giá trị của quận/huyện được chọn
          var selectedDistrictId = districtSelect.value;

          // Lọc danh sách xã/phường tương ứng với quận/huyện được chọn
          var wards = {!! json_encode($wards) !!}; // Dữ liệu các xã/phường, bạn cần đảm bảo dữ liệu này được truyền từ phía server

          // Lặp qua danh sách xã/phường và thêm vào select box
          wards.forEach(function(ward) {
              if (ward.district_id == selectedDistrictId) {
                  var option = document.createElement('option');
                  option.text = ward.name;
                  option.value = ward.wards_id;
                  wardSelect.add(option);
              }
          });
      };

    </script> --}}
</form>

<style>
    /* Đặt chiều cao mặc định cho CKEditor là 300px */
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
