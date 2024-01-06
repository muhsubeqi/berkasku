@extends('layouts.admin.template')
@section('title', 'Add Photo')
@push('css')
    {{-- dropzone --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Photo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Photo</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <form action="{{ route('admin.galery.store') }}" method="POST" enctype="multipart/form-data"
                            id="form-add">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Foto</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select class="form-control" name="category" id="category">
                                        {{-- @foreach ($categories as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" name="tahun" class="form-control" id="tahun"
                                        placeholder="Masukkan Tahun">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload File</label>
                                    <div id="container-dropzone">
                                        <div class="needsclick dropzone" id="image-dropzone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="form-submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    {{-- dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        var uploadedImageMap = {};
        var nFileUpload = 1;
        var myDropzone = null;
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            createDropZoneAdd();
        });
    </script>
    <script>
        function createDropZoneAdd() {
            uploadedImageMap = {};
            nFileUpload = 1;
            myDropzone = new Dropzone($('#image-dropzone').get(0), {
                url: "{{ route('admin.galery.imageUpload') }}",
                maxFilesize: 200, // MB
                addRemoveLinks: true,
                timeout: 180000,
                // autoProcessQueue: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                renameFilename: function(file) {
                    // var timestamp = new Date().getTime();
                    return `(${nFileUpload++}) ${file}`;
                },
                success: function(file, response) {
                    $('#form-add').append('<input type="hidden" name="photo[]" class="photo" value="' +
                        response.name +
                        '">')
                    uploadedImageMap[file.upload.filename] = response.name;
                    savePhotoSisa(response.name);
                    $('#form-submit').prop("disabled", false);
                    console.log(response);
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedImageMap[file.upload.filename]
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        type: "post",
                        url: "{{ route('admin.galery.imageDelete') }}",
                        data: {
                            photo: name
                        },
                        success: function(response) {
                            console.log(response);
                            $('#form-add').find('input[name="photo[]"][value="' + name + '"]')
                                .remove();
                            deletePhotoSisa(response.name);
                            console.log(response);
                        }
                    });
                },
                uploadprogress: function(file, progress, bytesSent) {
                    if (file.previewElement) {
                        var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
                        progressElement.style.width = progress + "%";
                    }
                    $('#form-submit').prop("disabled", true);
                }
            });
            myDropzone.on("addedfile", function(file) {
                file.previewElement.querySelector('[data-dz-name]').textContent = file.upload.filename;
            });
        }
    </script>
@endpush
