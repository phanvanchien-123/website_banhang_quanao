@extends('admin.layout.main')
@section('content')
    <div class="accordion">
        <div class="accordion-item rounded shadow">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#logo"
                    aria-expanded="true" aria-controls="logo">
                    Logo & title
                </button>
            </h2>
            <div id="logo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('admin.display.creatrOrUpdateLogo') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="path" class="form-label">Hình ảnh</label>
                        <div class="border rounded">
                            <div id="avatarWrapper" class="border-bottom d-flex" style="display: none;">
                                @if (isset($logo->path))
                                    <img src="{{ asset('storage/' . $logo->path) }}" alt="" class="m-3"
                                        width="120px" height="120px">
                                @endif
                            </div>
                            <input type="file" class="form-control" id="path" placeholder="" name="path"
                                onchange="previewAvatar(event)">
                        </div>
                        @error('path')
                            <small class="text-danger">{{ $errors->first('path') }}</small>
                        @enderror

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border-0" id="floatingInput" name="title"
                                value="{{ isset($logo->title) ? $logo->title : '' }}" placeholder="name@example.com">
                            <label for="floatingInput">Title</label>
                        </div>
                        <input type="hidden" name="type" value="logo">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion mt-5">
        <div class="accordion-item rounded shadow">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#slide"
                    aria-expanded="true" aria-controls="slide">
                    Slide
                </button>
            </h2>
            <div id="slide" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="d-flex justify-content-between align-items-center">
                        {{-- <h2>Thương hiệu</h2> --}}
                        <a href="{{ route('admin.slide.create') }}" class="text-decoration-none"><i
                                class="bi bi-plus-square"></i> Thêm mới</a>
                    </div>
                    <div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Avata</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides ?? [] as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td><img src="{{ asset('storage/' . $item->path) }}" alt="" width="60px"
                                                height="60px"></td>
                                        <td>{!! $item->title !!}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.slide.edit', $item->id) }}"><i
                                                    class="bi bi-pencil-square"></i></a> |
                                            <a href="{{ route('admin.slide.delete', $item->id) }}"><i
                                                    class="bi bi-trash2-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$slides->withQueryString()->links('Client.pagination.default')}} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion mt-5">
        <div class="accordion-item rounded shadow">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#footer"
                    aria-expanded="true" aria-controls="footer">
                    Footer
                </button>
            </h2>
            <div id="footer" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="pb-4">
                        <a class="btn btn-outline-primary" id="addAttributeBtn2">Thêm liên kết</a>
                    </div>
                    <form action="{{ route('admin.display.creatrOrUpdateFlink') }}" method="post">
                        @csrf
                        <div id="attributeContainer2">
                            @foreach ($footerLinks ?? [] as $index => $item)
                                <div class="row attribute-row">
                                    <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                    <div class="col-md-3 mb-3">
                                        <label for="subtitle{{ $index }}" class="form-label">Sub title:</label>
                                        <input type="text" class="form-control" id="subtitle{{ $index }}"
                                            placeholder="" name="subtitle[]" value="{{ $item->subtitle }}">
                                        @error('subtitle.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="link{{ $index }}" class="form-label">Link</label>
                                        <input type="text" class="form-control" id="link{{ $index }}"
                                            placeholder="" name="link[]" value="{{ $item->link }}">
                                        @error('link.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="title{{ $index }}" class="form-label">Title</label>
                                        <select class="form-select" aria-label="Default select example" name="title[]">
                                            <option value="1" {{ $item->title == 1 ? 'selected' : '' }}>About us
                                            </option>
                                            <option value="2" {{ $item->title == 2 ? 'selected' : '' }}>New
                                                categories</option>
                                            <option value="3" {{ $item->title == 3 ? 'selected' : '' }}>Get help
                                            </option>
                                        </select>
                                        @error('title.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <button type="button" class="btn btn-close removeAttributeBtn"
                                            data-id="{{ $item->id }}"></button>
                                    </div>
                                </div>
                                {{-- @empty
                                <div class="row attribute-row">
                                    <input type="hidden" name="ids[]" value="">
                                    <div class="col-md-3 mb-3">
                                        <label for="subtitle0" class="form-label">Sub title:</label>
                                        <input type="text" class="form-control" id="subtitle0" placeholder="" name="subtitle[]" value="">
                                        @error('subtitle.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="link0" class="form-label">Link</label>
                                        <input type="text" class="form-control" id="link0" placeholder="" name="link[]" value="">
                                        @error('link.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="title0" class="form-label">Title</label>
                                        <select class="form-select" aria-label="Default select example" name="title[]">
                                            <option value="1">About us</option>
                                            <option value="2">New categories</option>
                                            <option value="3">Get help</option>
                                        </select>
                                        @error('title.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <button type="button" class="btn btn-danger removeAttributeBtn" data-id="">Xóa</button>
                                    </div>
                                </div> --}}
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- ckeditor --}}
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

    {{-- slide --}}
    <script>
        function previewAvatar(event) {
            const avatarWrapper = event.target.closest('.border').querySelector('.avatar-wrapper');
            const files = event.target.files;
            avatarWrapper.style.display = files.length > 0 ? 'flex' : 'none';
            avatarWrapper.innerHTML = '';

            if (files.length > 0) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(files[0]);
                img.className = 'm-3';
                img.width = 120;
                img.height = 120;
                avatarWrapper.appendChild(img);
            }
        }
    </script>

    {{-- footer --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addAttributeBtn = document.getElementById('addAttributeBtn2');
            const attributeContainer = document.getElementById('attributeContainer2');

            addAttributeBtn.addEventListener('click', function() {
                const newIndex = attributeContainer.children.length;
                const newAttributeRow = document.createElement('div');
                newAttributeRow.className = 'row attribute-row';

                newAttributeRow.innerHTML = `
            <input type="hidden" name="ids[]" value="">
            <div class="col-md-3 mb-3">
                <label for="subtitle${newIndex}" class="form-label">Sub title:</label>
                <input type="text" class="form-control" id="subtitle${newIndex}" placeholder="" name="subtitle[]" value="">
            </div>
            <div class="col-md-3 mb-3">
                <label for="link${newIndex}" class="form-label">Link</label>
                <input type="text" class="form-control" id="link${newIndex}" placeholder="" name="link[]" value="">
            </div>
            <div class="col-md-3 mb-3">
                <label for="title${newIndex}" class="form-label">Title</label>
                <select class="form-select" aria-label="Default select example" name="title[]">
                    <option value="1">About us</option>
                    <option value="2">New categories</option>
                    <option value="3">Get help</option>
                </select>
            </div>
            <div class="col-md-1 mb-3">
                <button type="button" class="btn btn-close removeAttributeBtn" data-id=""></button>
            </div>
        `;

                attributeContainer.appendChild(newAttributeRow);
                attachRemoveHandler(newAttributeRow.querySelector('.removeAttributeBtn'));
            });

            function attachRemoveHandler(button) {
                button.addEventListener('click', function() {
                    const row = button.closest('.attribute-row');
                    const id = button.getAttribute('data-id');

                    if (id) {
                        fetch(`/admin/display/footerLink/delete/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        }).then(response => {
                            if (response.ok) {
                                row.remove();
                            } else {
                                alert('Failed to delete the item.');
                            }
                        });
                    } else {
                        row.remove();
                    }
                });
            }

            document.querySelectorAll('.removeAttributeBtn').forEach(attachRemoveHandler);
        });
    </script>

    <style>
        /* Ẩn nút "Xóa" ở phần tử gốc */
        #attributeContainer2>.row:first-child .removeAttributeBtn2 {
            display: none;
        }
    </style>
@endsection
