<form action="{{ route('admin.coupon.store') }}" method="POST">
    @csrf
    <label for="code">Code:</label>
    <input type="text" id="code" name="code" required>
    
    <label for="discount_value">Discount Value:</label>
    <input type="number" id="discount_value" name="discount_value" required>
    
    <label for="discount_type">Discount Type:</label>
    <select id="discount_type" name="discount_type" required>
        <option value="fixed">Fixed</option>
        <option value="percent">Percent</option>
    </select>
    
    <label for="minimum_order_value">Minimum Order Value:</label>
    <input type="number" id="minimum_order_value" name="minimum_order_value">
    
    <label for="usage_limit">Usage Limit:</label>
    <input type="number" id="usage_limit" name="usage_limit">
    
    <label for="expires_at">Expires At:</label>
    <input type="date" id="expires_at" name="expires_at">
    
    <button type="submit">Create</button>
</form>