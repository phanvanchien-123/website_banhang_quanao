@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center pb-4">
        <h2>Bài viết</h2>
    </div>
    <div class="input-group flex-nowrap my-3">
        <div class="d-flex w-100">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary rounded-0"><i
                    class="bi bi-arrow-clockwise "></i></a>
            <form action="" class="ps-2 d-flex">
                <input type="text" class="form-control rounded-0" placeholder="Search" name="search"
                    value="{{ Request::get('search') }}">
                <button type="submit" class="btn btn-primary ms-2 rounded-0"> tìm kiếm</button>
            </form>
            <a href="{{ route('admin.blog.create') }}" class="text-decoration-none ms-auto text-success"><i
                    class="bi bi-plus-square h4"></i> Thêm
                mới</a>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avata</th>
                    <th scope="col">tiêu đề <a
                            href="?sort=title&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Ngày tạo <a
                            href="?sort=created_at&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs ?? [] as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="" width="60px" height="60px">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $item->id) }}"><i
                                    class="bi bi-pencil-square text-warning"></i></a> |
                            <a href="#"
                                onclick="confirmDelete(event, '{{ route('admin.blog.delete', $item->id) }}')">
                                <i class="bi bi-trash2-fill text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->withQueryString()->links('Client.pagination.default') }}
    </div>

    {{-- <script>
        function confirmDelete(event, itemId) {
            event.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success ms-4",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `{{ route('admin.blog.delete', '') }}/${itemId}`;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script> --}}
@endsection
