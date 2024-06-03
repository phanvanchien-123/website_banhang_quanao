@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Sản phẩm</h2>
        <a href="{{ route('admin.product.create') }}">Thêm mới</a>
    </div>
    <div class="input-group flex-nowrap my-3">
        <span class="input-group-text" id="addon-wrapping">@</span>
        <div class="d-flex w-100">
            <form action="" class="w-100">
                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ Request::get('search') }}">
            </form>
            {{-- <a href="" type="button" class="btn btn-outline-secondary ms-3">Search</a> --}}
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Avata</th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Danh mục</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Ngày tạo</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products ?? [] as $item)
                    <tr>
                  <th scope="row">{{ $item->id }}</th>
                  <td><img src="{{ asset('storage/' . $item->avatar) }}" alt="" width="60px" height="60px"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->productCategory->name ?? '' }}</td>
                  <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.product.edit',$item->id) }}">edit</a> |
                    <a href="{{ route('admin.product.delete',$item->id) }}">delete</a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        </table>
        {{$products->withQueryString()->links('Client.pagination.default')}}
    </div>


{{-- <input type="file" id="imageInput" accept="image/*" multiple>
<div id="imageContainer"></div>

<script>
    const imageInput = document.getElementById('imageInput');
    const imageContainer = document.getElementById('imageContainer');

    imageInput.addEventListener('change', function() {
        const files = this.files;
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function() {
                    const imageWrapper = document.createElement('div');
                    imageWrapper.className = 'imageWrapper';

                    const img = document.createElement('img');
                    img.className = 'uploadedImage';
                    img.src = reader.result;

                    const deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.className = 'btn-close';
                    deleteButton.setAttribute('aria-label', 'Close');
                    // Không có ký hiệu 'x' ở đây
                    deleteButton.innerHTML = '';
                    deleteButton.addEventListener('click', function() {
                        imageContainer.removeChild(imageWrapper);
                        // Xóa file tương ứng khi click vào nút đóng
                        let fileList = Array.from(imageInput.files);
                        fileList.splice(i, 1);
                        imageInput.files = new FileList({
                            length: fileList.length,
                            item: function(index) {
                                return fileList[index];
                            }
                        });
                    });

                    imageWrapper.appendChild(img);
                    imageWrapper.appendChild(deleteButton); // Thêm nút xóa vào phần tử bao bọc hình ảnh
                    imageContainer.appendChild(imageWrapper);
                }
                reader.readAsDataURL(file);
            }
        }
    });
</script> --}}

@endsection