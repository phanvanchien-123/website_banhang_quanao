<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Tên thương hiệu</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name"
            value="{{ isset($supplier) ? $supplier->name : '' }}">
        @error('name')
            <small class="text-danger">{{ $errors->first('name') }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="avatar" class="form-label">Hình ảnh</label>
        <div class="border rounded">
            <div id="avatarWrapper" class="border-bottom d-flex" style="display: none;">
                @if (isset($supplier->avatar))
                    <img src="{{ asset('storage/' . $supplier->avatar) }}" alt="" class="m-3" width="120px"
                        height="120px">
                @endif
            </div>
            <input type="file" class="form-control" id="avatar" placeholder="" name="avatar" value=""
                onchange="previewAvatar(event)">
        </div>
        @error('avatar')
            <small class="text-danger">{{ $errors->first('avatar') }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="address"
            value="{{ isset($supplier) ? $supplier->address : '' }}">
        @error('address')
            <small class="text-danger">{{ $errors->first('address') }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="" name="email"
            value="{{ isset($supplier) ? $supplier->email : '' }}">
        @error('email')
            <small class="text-danger">{{ $errors->first('email') }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Phone</label>
        <input type="bumber" class="form-control" id="exampleFormControlInput1" placeholder="" name="phone"
            value="{{ isset($supplier) ? $supplier->phone : '' }}">
        @error('phone')
            <small class="text-danger">{{ $errors->first('phone') }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>

</form>
