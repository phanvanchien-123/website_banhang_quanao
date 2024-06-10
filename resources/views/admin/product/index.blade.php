@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Sản phẩm</h2>
        <a href="{{ route('admin.product.create') }}" class="text-decoration-none"><i class="bi bi-plus-square"></i> Thêm mới</a>
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
                    <a href="{{ route('admin.product.edit',$item->id) }}"><i class="bi bi-pencil-square"></i></a> |
                    <a href="{{ route('admin.product.delete',$item->id) }}"><i class="bi bi-trash2-fill"></i></a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        </table>
        {{$products->withQueryString()->links('Client.pagination.default')}}
    </div>

@endsection