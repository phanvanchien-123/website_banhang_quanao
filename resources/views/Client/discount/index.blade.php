@extends('layouts.master')
@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .discount-item {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.discount-item:hover {
    transform: translateY(-5px);
}

.discount-item h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.discount-item p {
    margin-bottom: 10px;
    color: #555;
}

.copy-button {
    background-color: #d78650;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.2s ease-in-out;
}

.copy-button:hover {
    background-color: #d78650;
}
.copy-button1 {
    background-color: #e5650f;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.2s ease-in-out;
}

.copy-button1:hover {
    background-color: #d9610b;
}

</style>

{{-- <div class="container mt-5">
    <h1 class="mb-4">Lấy Mã Giảm Giá Của Cửa Hàng Tại Đây </h1>
    <div class="row">
        <!-- Discount Item -->
        @foreach ($coupons as $item)
        <div class="col-md-4">
           
            <div class="discount-item">
                <h2>Code: <strong>{{$item->code}}</strong></h2>
                <p>Kiểu giảm giá : {{$item->discount_type}}</p>
                <p>Giá Trị Giảm Giá : {{$item->discount_value}} </p>
                <p>Giảm Cho Đơn Hàng từ : {{$item->minimum_order_value}}</p>
                @if ($item ->usage_limit-$item->used_count > 0)
                <p>Số Lượt mã Còn Lại :  {{$item ->usage_limit-$item->used_count}}</p>
                @else
                <ins><span class="text-brand"> Đã Hết Lượt Sử Dụng  </span></ins> 
                @endif
              
                <button class="copy-button" data-code="SUMMER20">Copy Code</button>
            </div>  
          
            
        </div>
        @endforeach
        
        <!-- More discount items can be added here -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="copyModal" tabindex="-1" aria-labelledby="copyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="copyModalLabel">Discount Code Copied</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                The discount code <strong id="modal-code"></strong> has been copied to your clipboard.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script>
    document.querySelectorAll('.copy-button').forEach(button => {
        button.addEventListener('click', () => {
            const code = button.getAttribute('data-code');
            navigator.clipboard.writeText(code).then(() => {
                document.getElementById('modal-code').textContent = code;
                $('#copyModal').modal('show');
            });
        });
    });


    document.querySelector('.close').addEventListener('click', () => {
        $('#copyModal').modal('hide');
    });

    document.querySelector('.btn-secondary').addEventListener('click', () => {
        $('#copyModal').modal('hide');
    });
</script> --}}
<div class="container mt-5">
    <h1 class="mb-4">Lấy Mã Giảm Giá Của Cửa Hàng Tại Đây</h1>
    <div class="row">
        <!-- Discount Item -->
        {{-- <div class="col-md-4">
            <div class="discount-item">
                <h2>Code: <strong>SUMMER20</strong></h2>
                <p>Type: Percent</p>
                <p>Value: 20%</p>
                <p>Expires At: 2024-12-31</p>
                <p>Usage: 50% of codes have been used</p> <!-- Usage information -->
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                </div>
                <button class="copy-button" data-code="SUMMER20">Copy Code</button>
            </div>
        </div> --}}
        @foreach ($coupons as $item)
        <div class="col-md-4">
           
            <div class="discount-item">
                <h2>Code: <strong>{{$item->code}}</strong></h2>
                <p>Kiểu giảm giá : {{ $item->discount_type == 'fixed' ? 'Tiền mặt' : $item->discount_type }}</p>

                <p>Giá Trị Giảm Giá : {{number_format($item->discount_value,3)}} VND </p>
                <p>Giảm Cho Đơn Hàng từ : {{number_format($item->minimum_order_value,3)}} VND </p>
                <p>Ngày hết hạn: {{ \Carbon\Carbon::parse($item->expires_at)->format('d-m-Y') }}</p>

                @php
    $isAvailable = $item->usage_limit - $item->used_count > 0 && now()->lt($item->expires_at);
@endphp

@if ($isAvailable)
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{ $item->used_count }}%;" aria-valuenow="{{ $item->used_count }}" aria-valuemin="0" aria-valuemax="100">{{ $item->used_count }}%</div>
    </div>
    <button class="copy-button1" data-code="{{ $item->code }}">Copy Code</button>
@else
    <div>Đã Hết Lượt Sử Dụng hoặc Hết Hạn</div>
    <button class="copy-button">Copy Code</button>
@endif
<br>

            </div>  
          
            
        </div>
        @endforeach
        <!-- More discount items can be added here -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="copyModal" tabindex="-1" aria-labelledby="copyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="copyModalLabel">Discount Code Copied</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Mã giảm giá <strong id="modal-code"></strong> đã được lấy thành công
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script>
    document.querySelectorAll('.copy-button1').forEach(button => {
        button.addEventListener('click', () => {
            const code = button.getAttribute('data-code');
            navigator.clipboard.writeText(code).then(() => {
                document.getElementById('modal-code').textContent = code;
                $('#copyModal').modal('show');
            });
        });
    });


    document.querySelector('.close').addEventListener('click', () => {
        $('#copyModal').modal('hide');
    });

    document.querySelector('.btn-secondary').addEventListener('click', () => {
        $('#copyModal').modal('hide');
    });
</script>
    
@endsection

