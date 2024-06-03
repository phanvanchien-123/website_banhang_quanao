document.addEventListener('DOMContentLoaded', function() {
    // Tìm phần tử textarea với id="editor"
    const editorTextarea = document.querySelector('#editor');
    // Tăng chiều cao của textarea lên 500px
    editorTextarea.style.height = '500px';
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
});