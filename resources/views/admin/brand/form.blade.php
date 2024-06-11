<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Tên thương hiệu</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name"
            value="{{ isset($brand) ? $brand->name : '' }}">
        @error('name')
            <small class="text-danger">{{ $errors->first('name') }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="avatar" class="form-label">Hình ảnh</label>
        <div class="border rounded">
            <div id="avatarWrapper" class="border-bottom d-flex" style="display: none;">
                @if (isset($brand->avatar))
                    <img src="{{ asset('storage/' . $brand->avatar) }}" alt="" class="m-3" width="120px"
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
        <label for="exampleFormControlTextarea1" class="form-label">mô tả</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description"> {{ isset($brand) ? $brand->description : '' }}</textarea>
    </div>
    <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>

</form>
