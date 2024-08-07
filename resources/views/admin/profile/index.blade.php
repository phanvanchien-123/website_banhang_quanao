@extends('admin.layout.main')
@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="col-3">
                <h3>Thông tin cá nhân</h3>
            </div>
            <div class="col-9 border-end-0 rounded px-4 py-4 bg-body-tertiary shadow">
                <div class="text-center">
                    <img id="clickableImage"
                        src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : Auth::user()->defaultAvatar() }}"
                        alt="profile" height="100px" width="100px" class="border rounded-circle" style="cursor: pointer">
                </div>
                <div class="py-4">
                    <form action="{{ route('admin.profile.update') }}" method="post" class="pt-2"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="file" id="fileInput" class="d-none" name="avatar">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="Name" placeholder="" name='name'
                                        value="{{ Auth::user()->name }}">
                                    <label for="Name">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="Phone" placeholder="" name="phone"
                                        value="{{ Auth::user()->phone }}">
                                    <label for="Phone">Phone</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="Company" placeholder=""
                                        name="company_name" value="{{ Auth::user()->company_name }}">
                                    <label for="Company">Company</label>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->province_id || auth()->user()->province_id || auth()->user()->province_id)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text"
                                            value="{{ auth()->user()->getAddressAttribute() }}" aria-label="Disabled input example"
                                            disabled readonly>
                                        <label for="Name">Địa chỉ</label>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed text-primary ms-1" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    thay đổi
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mt-3">
                                                        <div class="col-4">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="province"
                                                                    name="province_id" onchange="loadDistricts()">
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
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="district"
                                                                    name="district_id" onchange="loadWards()">
                                                                    <option value="">--Chọn quận/huyện--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="ward"
                                                                    name="ward_id">
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
                                    <select class="form-select" aria-label="Default select example" id="province" name="province_id" onchange="loadDistricts()">
                                        <option value="">--Chọn tỉnh/thành--</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="district" name="district_id" onchange="loadWards()">
                                        <option value="">--Chọn quận/huyện--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="ward" name="ward_id">
                                        <option value="">--Chọn xã/phường--</option>    
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- <div class="row">
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="province" name="province_id" onchange="loadDistricts()">
                                        <option value="">--Chọn tỉnh/thành--</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="district" name="district_id" onchange="loadWards()">
                                        <option value="">--Chọn quận/huyện--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example" id="ward" name="ward_id">
                                        <option value="">--Chọn xã/phường--</option>    
                                    </select>
                                </div>
                            </div>
                        </div> --}}




                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="row py-3">
            <div class="col-3">
                <h3>Thay đổi mật khẩu</h3>
            </div>
            <div class="col-9 border-end-0 rounded px-4 py-4 bg-body-tertiary shadow">
                <form action="{{ route('admin.profile.changePassword') }}" class="pt-2">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="oldPassWord" name="oldPassWord" placeholder="">
                        <label for="oldPassWord">Mật khẩu cũ</label>
                        @error('oldPassWord')
                            <small class="text-danger">{{ $errors->first('oldPassWord') }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="newPassWord" name="newPassWord" placeholder="">
                        <label for="newPassWord">Mật khẩu mới</label>
                        @error('newPassWord')
                            <small class="text-danger">{{ $errors->first('newPassWord') }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmPassWord" name="confirmPassWord"
                            placeholder="">
                        <label for="confirmPassWord">Xác nhận mật khẩu</label>
                        @error('confirmPassWord')
                            <small class="text-danger">{{ $errors->first('confirmPassWord') }}</small>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var districts = @json($districts);
        var wards = @json($wards);
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var clickableImage = document.getElementById('clickableImage');
            var fileInput = document.getElementById('fileInput');

            clickableImage.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        clickableImage.src = e.target.result;
                    }

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>

    <script>
        var districts = @json($districts);
        var wards = @json($wards);

        function loadDistricts() {
            var provinceId = $('#province').val();
            var districtSelect = $('#district');
            districtSelect.empty().append('<option value="">--Chọn quận/huyện--</option>');

            districts.forEach(function(district) {
                if (district.province_id == provinceId) {
                    var option = $('<option>', {
                        value: district.id,
                        text: district.name
                    });
                    districtSelect.append(option);
                }
            });
        }

        function loadWards() {
            var districtId = $('#district').val();
            var wardSelect = $('#ward');
            wardSelect.empty().append('<option value="">--Chọn xã/phường--</option>');

            wards.forEach(function(ward) {
                if (ward.district_id == districtId) {
                    var option = $('<option>', {
                        value: ward.id,
                        text: ward.name
                    });
                    wardSelect.append(option);
                }
            });
        }
    </script> --}}
    <script src="{{ asset('theme_admin/theme/js/profile.js') }}"></script>

@endsection
