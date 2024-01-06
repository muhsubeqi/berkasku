@extends('layouts.admin.template')
@section('title', 'Admin | Data Kategori')
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex flex-row">
                        <h1>Data </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">/ Data
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Dokumen</h3>
                            </div>
                            <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data"
                                id="form_upload">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="sub_kategori_id">Kategori</label><br>
                                        <span class="badge badge-secondary">{{ $kategori->nama_kategori }}</span> /
                                        <span class="badge badge-secondary">{{ $subKategori->nama_sub_kategori }}</span>
                                        <input type="hidden" name="sub_kategori_id" value="{{ $subKategori->id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_sub_kategori">Nama Sub Sub Kategori</label>
                                        <input type="input" name="sub_sub_kategori" class="form-control"
                                            id="sub_sub_kategori" placeholder="Masukkan Nama Kategori"
                                            value="{{ old('sub_sub_kategori') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Dokumen</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            placeholder="Masukkan Nama Dokumen">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload File</label>
                                        <div class="needsclick dropzone" id="image-dropzone">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="form_submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{!! Session::get('success') !!}",
                    timer: 3000
                })
            @endif
            @if (Session::has('failed'))
                Swal.fire({
                    icon: 'error',
                    title: 'Success',
                    text: "{!! Session::get('failed') !!}",
                    timer: 3000
                })
            @endif
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $(function() {
                bsCustomFileInput.init();
            });

        });
    </script>

    <script>
        var uploadedImageMap = {};
        var nFileUpload = 1;
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone($('#image-dropzone').get(0), {
            url: "{{ route('admin.dokumen.imageUpload') }}",
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
                $('form').append('<input type="hidden" name="dokumen[]" value="' + response.name + '">')
                uploadedImageMap[file.upload.filename] = response.name;
                saveDokumenSisa(response.name);
                $('#form_submit').prop("disabled", false);
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
                    url: "{{ route('admin.dokumen.imageDelete') }}",
                    data: {
                        dokumen: name
                    },
                    success: function(response) {
                        console.log(response);
                        $('form').find('input[name="dokumen[]"][value="' + name + '"]').remove();
                        deleteDokumenSisa(response.name);
                    }
                });
            },
            uploadprogress: function(file, progress, bytesSent) {
                if (file.previewElement) {
                    var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
                    progressElement.style.width = progress + "%";
                }
                $('#form_submit').prop("disabled", true);
            }
        });
        myDropzone.on("addedfile", function(file) {
            file.previewElement.querySelector('[data-dz-name]').textContent = file.upload.filename;
        });

        $('#form_upload').submit(function(e) {
            e.preventDefault();
            // myDropzone.processQueue();
            forgetDokumenSisa();
            document.getElementById('form_upload').submit();
        });


        // Dropzone.options.imageDropzone = {
        //     url: "{{ route('admin.dokumen.imageUpload') }}",
        //     maxFilesize: 100, // MB
        //     addRemoveLinks: true,
        //     timeout: 180000,
        //     headers: {
        //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //     },
        //     success: function(file, response) {
        //         $('form').append('<input type="hidden" name="dokumen[]" value="' + response.name + '">')
        //         uploadedImageMap[file.name] = response.name
        //     },
        //     removedfile: function(file) {
        //         file.previewElement.remove()
        //         var name = ''
        //         if (typeof file.file_name !== 'undefined') {
        //             name = file.file_name
        //         } else {
        //             name = uploadedImageMap[file.name]
        //         }
        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //             },
        //             type: "post",
        //             url: "{{ route('admin.dokumen.imageDelete') }}",
        //             data: {
        //                 dokumen: name
        //             },
        //             success: function(response) {
        //                 $('form').find('input[name="dokumen[]"][value="' + name + '"]').remove()
        //             }
        //         });
        //     },
        // }
    </script>
@endsection
