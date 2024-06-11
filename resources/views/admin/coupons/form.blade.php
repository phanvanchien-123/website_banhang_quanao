<form action="{{ $action_url }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code"
                    value="{{ isset($coupon) ? $coupon->code : '' }}">
                @error('code')
                    <small class="text-danger">{{ $errors->first('code') }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="discount_value" class="form-label">Discount Value:</label>
                <input type="text" class="form-control" id="discount_value" name="discount_value"
                    value="{{ isset($coupon) ? $coupon->discount_value : '' }}">
                @error('discount_value')
                    <small class="text-danger">{{ $errors->first('discount_value') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="minimum_order_value" class="form-label">Minimum Order Value:</label>
                <input type="text" class="form-control" id="minimum_order_value" name="minimum_order_value"
                    value="{{ isset($coupon) ? $coupon->minimum_order_value : '' }}">
                @error('minimum_order_value')
                    <small class="text-danger">{{ $errors->first('minimum_order_value') }}</small>
                @enderror
            </div>

        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="discount_type" class="form-label">Discount Type</label></br>
                <select class="form-select w-50" aria-label="Default select example" id="discount_type"
                    name="discount_type">
                    <option selected value="">Chọn Discount Type</option>
                    <option value="fixed"
                        {{ isset($coupon) ? ($coupon->discount_type == 'fixed' ? 'selected' : '') : '' }}>
                        Fixed
                    </option>
                    <option value="percent"
                        {{ isset($coupon) ? ($coupon->discount_type == 'percent' ? 'selected' : '') : '' }}>
                        Percent</option>

                </select>
                @error('discount_type')
                    <small class="text-danger">{{ $errors->first('discount_type') }}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label for="usage_limit" class="form-label">Usage Limit:</label>
                <input type="text" class="form-control" id="usage_limit" name="usage_limit"
                    value="{{ isset($coupon) ? $coupon->usage_limit : '' }}">
                @error('usage_limit')
                    <small class="text-danger">{{ $errors->first('usage_limit') }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="expires_at" class="form-label">Expires At:</label>
                <input type="date" class="form-control" id="expires_at" name="expires_at"
                    value="{{ isset($coupon) ? \Carbon\Carbon::createFromTimestamp(strtotime($coupon->expires_at))->format('Y-m-d') : '' }}">
                @error('expires_at')
                    <small class="text-danger">{{ $errors->first('expires_at') }}</small>
                @enderror
            </div>
        </div>
    </div>





    <button type="submit" class="btn btn-outline-primary mt-3">Lưu dữ liệu</button>

</form>
