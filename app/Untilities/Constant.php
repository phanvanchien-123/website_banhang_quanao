<?php
namespace App\Untilities;

class Constant{

    // Các hằng số , role dùng chung toàn bộ hệ thống 

    //Order
     const order_status_ReceiveOrders = 1;
     const order_status_Unconfirmed = 2;
     const order_status_Confiemed = 3;
   //   const order_status_Paid =4;
     const order_status_Processing = 5;
     const order_status_Shipping = 6;
     const order_status_Finish = 7;
     const order_status_Cancel=0;

     public static $order_status = [
        self::order_status_ReceiveOrders => 'Chờ Xác nhận đơn hàng ', //Nhận đơn đặt hàng
        self::order_status_Unconfirmed =>'Chưa được xác nhận', // Chưa được xác nhận
        self::order_status_Confiemed=>'xác nhận', //xác nhận
      //   self::order_status_Paid=>'Đã Trả Tiền ', //Trả
        self::order_status_Processing=>'Xử lý', //Xử lý
        self::order_status_Shipping=>' Đang chuyển hàng', // Đang chuyển hàng
        self::order_status_Finish=>'Hoàn thành', // Hoàn thành
        self::order_status_Cancel=>'Hủy bỏ', // Hủy bỏ
     ];

}
