<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="mb-3">
                <div class="h5 pb-2 mb-4 text-success border-bottom border-success">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                </div>
                <input type="text" class="form-control form-control-lg" id="name" placeholder="" name="name"
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
                <script src="{{ asset('theme_admin/theme/js/styleCKedit.js') }}"></script>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="category" class="form-label">Danh mục</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="category"
                    name="product_category_id">
                    <option selected value="">Chọn danh mục</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($product) && $product->product_category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach

                </select>
                @error('product_category_id')
                    <small class="text-danger">{{ $errors->first('product_category_id') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="brand" name="brand_id">
                    <option selected value="">Chọn Brand</option>
                    @foreach ($brands ?? [] as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($product) && $product->brand_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <small class="text-danger">{{ $errors->first('brand_id') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Hình ảnh</label>
                <div id="avatarWrapper" class="border-bottom d-flex"
                    style="display: {{ isset($product) ? 'flex' : 'none' }};">
                    @if (isset($product->avatar))
                        <img src="{{ asset('storage/' . $product->avatar) }}" alt="" class="m-3"
                            width="120px" height="120px">
                    @endif
                </div>
                <input type="file" class="form-control" id="avatar" name="avatar"
                    onchange="previewAvatar(event)">
            </div>
            <div class="mb-3">
                <label for="album" class="form-label">Album</label>
                <div class="border rounded">
                    <div id="albumWrapper" class="border-bottom d-flex"
                        style="display: {{ isset($product->productImages) && count($product->productImages) > 0 ? 'flex' : 'none' }};">
                        @if (isset($product->productImages))
                            @foreach ($product->productImages as $img)
                                <img src="{{ asset('storage/' . $img->path) }}" alt="" class="m-3"
                                    width="120px" height="120px">
                            @endforeach
                        @endif
                    </div>
                    <input type="file" multiple class="form-control" id="album" name="images[]"
                        onchange="previewImages(event)">
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
                    <label for="sku" class="form-label">Mã sản phẩm</label>
                    <input type="text" class="form-control" id="sku" placeholder="" name="sku"
                        value="{{ isset($product) ? $product->sku : '' }}">
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
                        name="qty" value="{{ isset($product) ? $product->qty : '' }}">
                    @error('qty')
                        <small class="text-danger">{{ $errors->first('qty') }}</small>
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
                        name="tag" value="{{ isset($product) ? $product->tag : '' }}">
                    @error('tag')
                        <small class="text-danger">{{ $errors->first('tag') }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="editor" class="form-label">featured</label>
                    <div class="d-flex">
                        <div class="form-check ms-5">
                            <input class="form-check-input" type="radio" name="featured" value="1"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                có
                            </label>
                        </div>
                        <div class="form-check ms-5">
                            <input class="form-check-input" type="radio" name="featured" value="0"
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
                    @forelse ($product->productDetails ?? [] as $index => $item)
                        <div class="d-flex">
                            <div class="mb-3">
                                <label for="size{{ $index }}" class="form-label">Size: </label>
                                <input type="text" class="form-control" id="size{{ $index }}"
                                    placeholder="" name="size[]" value="{{ $item->size }}">
                            </div>
                            <div class="mb-3">
                                <label for="color{{ $index }}" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color{{ $index }}"
                                    placeholder="" name="color[]" value="{{ $item->color }}">
                            </div>
                            <div class="mb-3">
                                <label for="qty{{ $index }}" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" id="qty{{ $index }}"
                                    placeholder="" name="qty2[]" value="{{ $item->qty }}">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn-close removeAttributeBtn"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex">
                            <div class="mb-3">
                                <label for="size0" class="form-label">Size: </label>
                                <input type="text" class="form-control" id="size0" placeholder=""
                                    name="size[]" value="">
                            </div>
                            <div class="mb-3">
                                <label for="color0" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color0" placeholder=""
                                    name="color[]" value="">
                            </div>
                            <div class="mb-3">
                                <label for="qty0" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" id="qty0" placeholder=""
                                    name="qty2[]" value="">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn-close removeAttributeBtn"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endforelse



                </div>
            </div>

            <script>
                // Sử dụng jQuery để thêm event listener cho nút "Thêm thuộc tính"
                $(document).ready(function() {
                    $('#addAttributeBtn').click(function() {
                        // Sao chép phần tử div chứa các input
                        var attributeDivClone = $('#attributeContainer').children().first().clone();
                        // Thay đổi tên của các trường input trong phần tử div sao chép để chúng phản ánh một mảng mới
                        $(attributeDivClone).find('input').each(function() {
                            var originalName = $(this).attr('name');
                            var newName = originalName.replace(/\[\d+\]/, '[' + $('#attributeContainer')
                                .children().length + ']');
                            $(this).attr('name', newName);
                        });
                        // Thêm nút "Xóa" vào phần tử clone
                        $(attributeDivClone).find('.removeAttributeBtn').click(function() {
                            $(this).closest('.d-flex').remove(); // Xóa phần tử cha chứa nút "Xóa"
                        });
                        // Thêm phần tử div được sao chép vào cuối của container
                        $('#attributeContainer').append(attributeDivClone);
                    });
                    // Thêm sự kiện click cho nút "Xóa" của phần tử ban đầu
                    $('.removeAttributeBtn').click(function() {
                        $(this).closest('.d-flex').remove(); // Xóa phần tử cha chứa nút "Xóa"
                    });
                });
            </script>
        </div>
    </div>
    <button type="submit" class="btn btn-outline-primary mt-3">Lưu dữ liệu</button>

</form>

<style>
    /* Đặt chiều cao mặc định cho CKEditor là 300px */
    .ck-editor__editable {
        min-height: 300px;
    }

    /* Ẩn nút "Xóa" ở phần tử gốc */
    #attributeContainer>.d-flex:first-child .removeAttributeBtn {
        display: none;
    }
</style>
