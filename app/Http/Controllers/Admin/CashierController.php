<?php

namespace App\Http\Controllers\Admin;

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

    public function createInvoice(Request $request)
    {
        // Validate request data (customer name, phone, address, etc.)

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

        // Process further as needed (e.g., save to database, generate invoice number, etc.)

        // Example: return response with invoice data (e.g., invoice number, etc.)
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
