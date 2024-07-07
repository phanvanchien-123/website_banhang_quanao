<form method="POST" action="{{ $action_url }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tên tài khoản</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="name"
                    value="{{ isset($user) ? $user->name : '' }}">
                @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email"
                    value="{{ isset($user) ? $user->email : '' }}">
                @error('email')
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sdt" class="form-label">Số điện thoại</label>
                <input type="number" class="form-control" id="sdt" placeholder="" name="phone"
                    value="{{ isset($user) ? $user->phone : '' }}">
                @error('name')
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            @if ((auth()->user()->province_id || auth()->user()->province_id || auth()->user()->province_id) && isset($user))
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text"
                                value="{{ auth()->user()->getAddressFrom($user->id) }}"
                                aria-label="Disabled input example" disabled readonly>
                            <label for="Name">Địa chỉ</label>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed text-primary ms-1" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        thay đổi
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="province" name="province_id" onchange="loadDistricts()">
                                                        <option value="">--Chọn tỉnh/thành--</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">
                                                                {{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="district" name="district_id" onchange="loadWards()">
                                                        <option value="">--Chọn quận/huyện--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="ward" name="ward_id">
                                                        <option value="">--Chọn xã/phường--</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="province"
                                name="province_id" onchange="loadDistricts()">
                                <option value="">--Chọn tỉnh/thành--</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="district"
                                name="district_id" onchange="loadWards()">
                                <option value="">--Chọn quận/huyện--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="ward"
                                name="ward_id">
                                <option value="">--Chọn xã/phường--</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div class="form-group mb-3">
                <label for="name"><b>role:</b></label>
                <div class="row">
                    @foreach ($roles as $group_name => $roles)
                        <div class="col-5">
                            <h6 class="fw-bolder">{{ $group_name }}</h6>

                            @foreach ($roles as $item)
                                <div class="form-check">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                            name="role_ids[]" id="{{ $item->display_name }}"
                                            {{ in_array($item->id, $roleActive) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="{{ $item->display_name }}">{{ $item->display_name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="avatar" class="form-label">Hình ảnh</label>
                    <div id="avatarWrapper" class="border-bottom d-flex"
                        style="display: {{ isset($user) ? 'flex' : 'none' }};">
                        @if (isset($user->avatar))
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="m-3"
                                width="120px" height="120px">
                        @endif
                    </div>
                    <input type="file" class="form-control" id="avatar" name="avatar"
                        onchange="previewAvatar(event)">
                </div>
            </div>
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
    <script>
        var districts = @json($districts);
        var wards = @json($wards);
    </script>
</form>
