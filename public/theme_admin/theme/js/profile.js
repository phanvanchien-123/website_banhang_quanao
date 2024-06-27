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
