function previewAvatar(event) {
    const input = event.target;
    const avatarWrapper = document.getElementById('avatarWrapper');

    // Xóa ảnh hiển thị trước đó
    avatarWrapper.innerHTML = '';

    if (input.files && input.files[0]) {
        // Hiển thị phần tử chứa ảnh
        avatarWrapper.style.display = 'flex';

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Uploaded Image';
            img.className = 'm-3';
            img.width = '120';
            img.height = '120';
            avatarWrapper.appendChild(img);
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        // Nếu không có tệp hình ảnh nào được chọn, ẩn phần tử chứa ảnh
        avatarWrapper.style.display = 'none';
    }
}

function previewImages(event) {
    const input = event.target;
    const albumWrapper = document.getElementById('albumWrapper');

    // Xóa các ảnh hiển thị trước đó
    albumWrapper.innerHTML = '';

    if (input.files && input.files.length > 0) {
        // Hiển thị phần tử chứa ảnh
        albumWrapper.style.display = 'flex';

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
                albumWrapper.appendChild(img);
            }
            reader.readAsDataURL(input.files[i]);
        }
    } else {
        // Nếu không có tệp hình ảnh nào được chọn, ẩn phần tử chứa ảnh
        albumWrapper.style.display = 'none';
    }
}
