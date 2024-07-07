<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="mb-3">
                <div class="h5 pb-2 mb-4 text-success border-bottom border-success">
                    <label for="title" class="form-label">Tiêu đề</label>
                </div>
                <input type="text" class="form-control" id="title" placeholder="" name="title"
                    value="{{ isset($blog) ? $blog->title : '' }}">
                @error('title')
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">

            <div class="mb-3 ">
                <label for="editor" class="form-label">Nội dung</label>

                <textarea class="form-control" id="editor" rows="30" name="content" value="">{{ isset($blog) ? $blog->content : '' }}</textarea>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const editorTextarea = document.querySelector('#editor');
                        editorTextarea.style.height = '500px';
                        ClassicEditor
                            .create(document.querySelector('#editor'))
                            .catch(error => {
                                console.error(error);
                            });
                    });
                </script>
                @error('content')
                <small class="text-danger">{{ $errors->first('content') }}</small>
            @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                {{-- <div class="h5 pb-2 mb-4 text-success border-bottom border-success"> --}}
                <label for="subtitle" class="form-label">Phụ đề</label>
                {{-- </div> --}}
                <input type="text" class="form-control" id="subtitle" placeholder="" name="subtitle"
                    value="{{ isset($blog) ? $blog->subtitle : '' }}">
                @error('subtitle')
                    <small class="text-danger">{{ $errors->first('subtitle') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="avatar" class="form-label">Hình ảnh</label>
                    <div id="avatarWrapper" class="border-bottom d-flex"
                        style="display: {{ isset($blog) ? 'flex' : 'none' }};">
                        @if (isset($blog->image))
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="m-3"
                                width="120px" height="120px">
                        @endif
                    </div>
                    <input type="file" class="form-control" id="avatar" name="image"
                        onchange="previewAvatar(event)">
                </div>
                @error('image')
                    <small class="text-danger">{{ $errors->first('image') }}</small>
                @enderror
            </div>
        </div>
    </div>




    <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>


</form>

<style>
    /* Đặt chiều cao mặc định cho CKEditor là 300px */
    .ck-editor__editable {
        min-height: 300px;
    }

    /* Ẩn nút "Xóa" ở phần tử gốc */
    #attributeContainer>.d-flex:first-child .removeAttributeBtn {
        display: none;
    }
</style>

