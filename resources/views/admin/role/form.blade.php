<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Tên role</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="admin, user,..."
            name="name" value="{{ isset($role) ? $role->name : '' }}">
        @error('name')
            <small class="text-danger">{{ $errors->first('name') }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Display name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="admin, user,..."
            name="display_name" value="{{ isset($role) ? $role->display_name : '' }}">
        @error('display_name')
            <small class="text-danger">{{ $errors->first('display_name') }}</small>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="group"><b>group:</b></label>
        <select class="form-control " aria-label="Default select example" name="group" >
            <option value="user" {{ isset($role) ? ($role->group == 'user' ? 'selected' : '') : '' }}>User</option>
            <option value="admin" {{ isset($role) ? ($role->group == 'admin' ? 'selected' : '') : '' }}>Admin</option>
        </select>
    </div>
    <div class="form-group mb-3 ">
        <label class="h5" for=""><b>permissions:</b></label>
        <div class="row ms-5" >

            @foreach ($permissions as $group_name => $permission)
                <div class="col-5">
                    {{-- {{ dd($item) }} --}}
                    <h6 class="fw-bolder">{{ $group_name }} </h6>

                    @foreach ($permission as $item)
                        <div class="form-check">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{  $item->id }}"
                                 id="{{  $item->display_name }}" name="permission_ids[]"
                                 {{ isset($role) ?  ($role->permissions->contains('name',$item->name)? 'checked' : '') : ''}}>
                                <label class="form-check-label"
                                    for="{{  $item->display_name}}">{{ $item->display_name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>


    <script>
        function previewImages(event) {
            const input = event.target;
            const imageWrapper = document.getElementById('imageWrapper');

            // Xóa các ảnh hiển thị trước đó
            imageWrapper.innerHTML = '';

            if (input.files && input.files.length > 0) {
                // Hiển thị phần tử chứa ảnh
                imageWrapper.style.display = 'flex';

                // Duyệt qua từng tệp hình ảnh và hiển thị
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Uploaded Image';
                        img.className = 'm-3';
                        img.width = '120';
                        img.height = '120';
                        imageWrapper.appendChild(img);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            } else {
                // Nếu không có tệp hình ảnh nào được chọn, ẩn phần tử chứa ảnh
                imageWrapper.style.display = 'none';
            }
        }
    </script>
</form>
