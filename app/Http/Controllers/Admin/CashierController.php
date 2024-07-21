<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;

class CashierController extends Controller
{
    //
    public function index(){
        return view('admin.cashier.index');
        
    }

    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->query('q') . '%')->get();
        return response()->json($products);
    }

    public function getProductDetails($id)
    {
        $productDetails = ProductDetail::where('product_id', $id)->get();
        return response()->json($productDetails);
    }

    public function createOrder(Request $request) {
        $validatedData = $request->validate([
            'data.customerName' => 'required|string|max:255',
            'data.customerPhone' => 'required|string|max:20',
            'data.customerAddress' => 'required|string|max:255',
        ]);
    
        $total = 0;
        $billItems = $request->input('data.billItems');
    
        // Tạo đơn hàng trước để lấy order_id
        $order = new Order();
        $order->phone = $request->input('data.customerPhone');
        $order->user_id = 999999999; // ID của người dùng
        $order->home_address = $request->input('data.customerAddress');
        $order->address = $request->input('data.customerAddress');
        $order->email = 'example@example.com'; // Địa chỉ email mặc định hoặc từ yêu cầu
        $order->total = 0; // Đặt tạm thời, sẽ được cập nhật sau
        $order->payment_type = '0'; // Kiểu thanh toán
        $order->status = 7; // Trạng thái đơn hàng
        $order->save();
    
        foreach ($billItems as $item) {
            $total += floatval($item['totalPrice']) * intval($item['quantity']);
    
            $detail = new Order_Details();  
            $detail->product_id = $item['productId'];
            $detail->order_id = $order->id; // Sử dụng order_id từ đơn hàng vừa tạo
            $detail->qty = intval($item['quantity']);
            $detail->size = $item['size'];
            $detail->color = $item['color'];
            $detail->amount = floatval($item['unitPrice']); // Đơn giá của sản phẩm
            $detail->total = floatval($item['totalPrice']);
            $detail->save();
        }
    
        // Cập nhật tổng số tiền của đơn hàng
        $order->total = $total;
        $order->save();

        $this->processOrderDetails($order);
    
        return response()->json([
            'status' => 'success',
            'order_id' => $order->id // Trả về order_id hoặc thông tin khác nếu cần
        ]);
    }

    protected function processOrderDetails($order)
    {
        $orderDetails = $order->orderDetails;

        foreach ($orderDetails as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $productDetail = ProductDetail::where('product_id', $orderDetail->product_id)
                                          ->where('size', $orderDetail->size)
                                          ->where('color', $orderDetail->color)
                                          ->first();

            // Trừ số lượng từ bảng sản phẩm và chi tiết sản phẩm
            $product->qty -= $orderDetail->qty;
            $productDetail->qty -= $orderDetail->qty;

            $product->save();
            $productDetail->save();
        }
    }

    public function createInvoice(Request $request)
    {
        // Prepare invoice data
        $invoiceData = $request->only([
            'customerName',
            'customerPhone',
            'customerAddress',
            'receiver',
            'deliverer',
            'creator',
            'currentDate',
            'billItems'
        ]);

        return response()->json([
            'invoiceNumber' => 'INV2024001', // Example invoice number
            'invoiceData' => $invoiceData
        ]);
    }

    public function printInvoice(Request $request)
    {
        $invoiceData = $request->input('invoiceData');
        $total = 0;
        foreach ($invoiceData['billItems'] as $item) {
            $total += floatval($item['totalPrice']);
        }

        return view('admin.cashier.bill', compact('invoiceData','total'));
    }


}
