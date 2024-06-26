@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Phản hồi</h2>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Người đăng</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Đánh giá sao</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments ?? [] as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{$item->user->name}}</td>
                        <td  class="text-wrap w-50">{{ $item->messages }}</td>
                        <td>
                            <div class="">
                                {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                <span class="label-text">in fashion</span> --}}
                                <ul class="rating my-2 d-inline-block">
                                    @for($i =1 ;$i<=5;$i++) @if($i <=$item->rating)
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        @else
                                        <li>
                                            <i class="fas fa-star "></i>
                                        </li>
                                        @endif
                                        @endfor
                                        
                                </ul>
                            </div>
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->created_at}}</td>
                        <td>
                            <select class="form-select w-50" aria-label="Default select example"
                                data-comment-id="{{ $item->id }}">
                                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Hiện</option>
                                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElements = document.querySelectorAll('.form-select');

            selectElements.forEach(select => {
                select.addEventListener('change', function() {
                    const commentId = this.dataset.commentId; // Lấy comment ID từ data attribute
                    const status = this.value;

                    fetch(`cmt/${commentId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Status updated successfully');
                            } else {
                                console.error('Failed to update status');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
