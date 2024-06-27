<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 ">
        <div class="h5 pb-2 mb-4 text-success border-bottom border-success">
            <label for="editor" class="form-label">Title</label>
        </div>

        <textarea class="form-control" id="editor" rows="30" name="title">{{ isset($slide) ? $slide->title : '' }}</textarea>
        <script src="{{ asset('theme_admin/theme/js/styleCKedit.js') }}"></script>
    </div>
    <div class="mb-3">
        <label for="path" class="form-label">Hình ảnh</label>
        <div class="border rounded">
            <div id="avatarWrapper" class="border-bottom d-flex" style="display: none;">
                @if (isset($slide->path))
                    <img src="{{ asset('storage/' . $slide->path) }}" alt="" class="m-3" width="120px"
                        height="120px">
                @endif
            </div>
            <input type="file" class="form-control" id="path" placeholder="" name="path" value=""
                onchange="previewpath(event)">
        </div>
        @error('path')
            <small class="text-danger">{{ $errors->first('path') }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>

</form>
