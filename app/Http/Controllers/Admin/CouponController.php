<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id'); // Mặc định sắp xếp theo tên sản phẩm
        $order = $request->get('order', 'asc'); 

        $coupons = Coupon::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $coupons->where('code', 'like', '%' . $name . '%');
        }

        $coupons->orderBy($sort, $order);

        $coupons = $coupons->paginate(10);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount_value' => 'required|numeric',
            'discount_type' => 'required|in:fixed,percent',
            'minimum_order_value' => 'nullable|numeric',
            'usage_limit' => 'nullable|integer',
            'expires_at' => 'nullable|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount_value' => 'required|numeric',
            'discount_type' => 'required|in:fixed,percent',
            'minimum_order_value' => 'nullable|numeric',
            'usage_limit' => 'nullable|integer',
            'expires_at' => 'nullable|date',
        ]);

        $coupon->update($request->all());

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon updated successfully.');
    }

    public function delete(Coupon $coupon, $id )
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon deleted successfully.');
    }
}

