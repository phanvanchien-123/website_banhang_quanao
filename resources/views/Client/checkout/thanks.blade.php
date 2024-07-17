@extends('layouts.master')
@section('content')
  <h2>Chào {{Auth::user()->name}} .<br>

    Cảm ơn bạn đã mua sắm tại cửa hàng chúng tôi ! Chúng tôi rất vui mừng khi bạn đã chọn sản phẩm của chúng tôi. <br>
    
    Chúng tôi muốn thông báo rằng đơn hàng của bạn đang chờ được xác nhận và chúng tôi đang tiến hành xử lý. Vui lòng kiểm tra email của bạn để xem chi tiết về đơn hàng và thông tin theo dõi.</h2>  
@endsection