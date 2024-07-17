<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <title>Thông báo đơn hàng | Shop Quần Áo Thời Trang </title>
</head>

<body
    style="background-color: #e7eff8; font-family: trebuchet,sans-serif; margin-top: 0; box-sizing: border-box; line-height: 1.5;">
<div class="container-fluid">
    <div class="container" style="background-color: #e7eff8; width: 600px; margin: auto;">
        <div class="col-12 mx-auto" style="width: 580px;  margin: 0 auto;">

            <div class="row">
                <div class="container-fluid">
                    <div class="row" style="background-color: #e7eff8; height: 10px;">

                    </div>
                </div>
            </div>

            <div class="row"
                 style="height: 100px; padding: 10px 20px; line-height: 90px; background-color: white; box-sizing: border-box;">
                {{--<h1 class="pl-3"
                    style="color: orange; line-height: 00px; float: left; padding-left: 20px; padding-top: 5px;">
                    <img src="{{$message->embed(asset('front/img/logo.png'))}}"
                         height="40" alt="logo">
                </h1>--}}
                <h1 class="pl-2"
                    style="color: orange; line-height: 30px; float: left; padding-left: 20px; font-size: 40px; font-weight: 500;">
                  Shop Bán Hàng Quần Áo Thời Trang 
                </h1>
            </div>

            <div class="row" style="background-color: #00509d; height: 200px; padding: 35px; color: white;">
                <div class="container-fluid">
                    <h3 class="m-0 p-0 mt-4" style="margin-top: 0; font-size: 28px; font-weight: 500;">
                        <strong style="font-size: 32px;">Thông báo đơn hàng</strong>
                        <br>
                        Cảm ơn quý khách  rất nhiều
                    </h3>
                    <div class="row mt-5" style="margin-top: 35px; display: flex;">
                        <div class="col-6"
                             style="margin-bottom: 25px; flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                            Tên Khách hàng : <b>{{ $order->user->name}}</b>
                            <br>
                            <span>
                              Email :   <a style="color: white !important;" href="mailto:{{ $order->email }}" target="_blank">{{ $order->email }}</a>
                            </span>
                            <br>
                            Số Điện thoại : <span>{{ $order->phone }}</span>
                        </div>
                        <div class="col-6" style="flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                            <b>Ngày đặt hàng:</b> {{ date('d/m/yy H:i', strtotime($order->created_at)) }}
                            <br>
                            <b>Địa chỉ:</b> {{ $order->address }}
                            <b>Địa chỉ nhà:</b> {{ $order->home_address }}

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2 p-4" style="background-color: white; margin-top: 15px; padding: 20px;">
                <table>
                    <tr>
                        <td>
                            <img
                                src="https://ci6.googleusercontent.com/proxy/8eUxMUXMkvgUKX8veBCRQM5N7-jXP0Wx8KjQLaGDch2DnV_5HYw9PMgJXsoqgSR_jonTY9jAftWPKNsN5W9cUUneQ9hz7IhxH4rIXNzHMm0ijbsNjHB9m7g6XfJJ=s0-d-e1-ft#https://www.bambooairways.com/reservation/common/hosted-images/tickets.jpg"
                                alt="">
                        </td>

                        @if($order->payment_type == "0")
                            <td class="pl-3" style=" padding-left:15px;">
                                <span class="d-inline"
                                      style="color:#424853; font-family:trebuchet,sans-serif; font-size:16px; font-weight:normal; line-height:22px;">
                                      Bạn sẽ thanh toán khi giao hàng. Chúng tôi vừa bàn giao đơn đặt hàng của bạn cho một đối tác vận chuyển.
                                </span>
                            </td>
                        @endif

                        @if($order->payment_type == "1")
                            <td class="pl-3" style=" padding-left:15px;">
                                <span class="d-inline"
                                      style="color:#424853; font-family:trebuchet,sans-serif; font-size:16px; font-weight:normal; line-height:22px;">
                                      Đơn đặt hàng của bạn đã được thanh toán trực tuyến. Chúng tôi vừa bàn giao đơn đặt hàng của bạn cho một đối tác vận chuyển.
                                </span>
                            </td>
                            <td class="pl-3" style=" padding-left:10px;">
                                <img src="https://vnpay.vn/wp-content/uploads/2020/07/Logo-VNPAYQR-update.png"
                                     width="130px" style="margin-top: 10px;" alt="">
                            </td>
                        @endif

                    </tr>
                </table>
            </div>

            <div class="row mt-2" style="margin-top: 15px;">
                <div class="container-fluid">
                    <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                        <b>Chi tiết đơn hàng</b>
                    </div>
                    <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px 10px 20px;">
                        <table class="table table-sm table-hover"
                               style="text-align: left;  width: 100%; margin-bottom: 5px; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th colspan="">Product</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                <tr>
                                    
                                    <td>
                                        <h5><a href="">{{ $item->products->name }}<br>SIZE: {{ $item->size }}<br>Color: {{ $item->color }}</a></h5>
                                        <span class="product-qty">x{{ $item->qty}}</span>
                                    </td>
                                    <td>{{number_format(($item->qty) *($item->amount),3)}} VND</td>
                                   
                                  

                                </tr>
                                
                                @endforeach
                                <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal" colspan="2">{{ number_format(array_sum(array_column($order->orderDetails->toArray(),'total')),3)}}VND</td>
                                </tr>
                                <tr>
                                    <th>Mã giảm giá </th>
                                    <td colspan="2"><em>
                                    @if ($order->coupon == null)
                                        không áp mã giảm giá 
                                    @else
                                        - {{ number_format($order->coupon->discount_value,3)}} VND
                                    @endif
                                    </em></td>
                                </tr>
                                
                                <tr>
                                    <th>Total</th>
                                    <td colspan="2" class="product-subtotal">
                                        <span id="totalAmount" class="font-xl text-brand fw-900">{{ number_format($order->total, 3) }} VND</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            

           

            <div class="row">
                <div class="container-fluid">
                    <div class="row" style="background-color: #e7eff8; height: 10px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
