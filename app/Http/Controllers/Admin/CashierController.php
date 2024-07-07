<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
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

    public function createOrder(Request $request){

        $validatedData = $request->validate([
            'data.customerName' => 'required|string|max:255',
            'data.customerPhone' => 'required|string|max:20',
            'data.customerAddress' => 'required|string|max:255',
        ]);

        $total = 0;
        foreach ($request->input('data.billItems') as $item) {
            $total += floatval($item['totalPrice']);
        }

        $order = new Order();
        $order->first_name = $request->input('data.customerName');
        $order->last_name = 'x';
        $order->phone = $request->input('data.customerPhone');
        $order->user_id = 999999999;
        $order->country = 'VN';
        $order->street_address = 'x';
        $order->town_city = 'x';
        $order->email = 'x';
        $order->total = $total;
        $order->payment_type = '0';
        $order->status = 7;

        $order->save();

        return response()->json([
            'status' => 'success', // Example invoice number
        ]);

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
