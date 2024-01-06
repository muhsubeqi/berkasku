@extends('layouts.admin.template')
@section('title', 'Admin | Dashboard')
@section('css')
    <style>
        .todo-list li {
            animation: fadeIn 1s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">/ Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('failed') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                {{-- <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>
                                    {{ $jumlahPengguna }}
                                </h4>
                                <p>Jumlah Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>
                                    Rp.
                                </h4>

                                <p>Pemasukan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4>Rp.</h4>

                                <p>Pengeluaran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>Rp.</h4>

                                <p>Saldo</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div> --}}
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Info</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="info-box">
                                        <span class="info-box-icon"><img src="{{ asset('/lte4/dist/img/avatar5.png') }}"
                                                class="rounded-circle" width="200" alt=""></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Selamat Datang di Simber, Simber adalah sistem
                                                penyimpanan berkas yang teristegrasi dengan google drive</span>
                                            <span class="info-box-text">anda masuk dengan email
                                                <b>{{ Auth::user()->email }}</b></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    To Do List
                                </h3>

                                <div class="card-tools">
                                    <div id="show_paginator" class="small"></div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list" id="todo-list">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($daftarTugas as $dt)
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <!-- checkbox -->
                                            <div class="icheck-primary d-inline ml-2">
                                                <input type="checkbox" value="" name="todo{{ $i }}"
                                                    data-id="{{ $dt->id }}" onchange="editCheck(event)"
                                                    id="todoCheck{{ $i }}"
                                                    {{ $dt->status == 'done' ? 'checked' : '' }}>
                                                <label for="todoCheck{{ $i++ }}"></label>
                                            </div>
                                            <!-- todo text -->
                                            <span class="text">{{ $dt->tugas }}</span>
                                            <!-- Emphasis label -->
                                            <small class="badge badge-{{ $dt->peringatan }}"><i
                                                    class="far fa-clock"></i>{{ $dt->deadline_baru }}</small>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#modal-edit-item"
                                                    data-id="{{ $dt->id }}" data-tugas="{{ $dt->tugas }}"
                                                    data-deadline="{{ $dt->deadline }}"></i>
                                                <i class="fas fa-trash-o"></i>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#modal-tambah-item"><i class="fas fa-plus"></i>
                                    Tambah item</button>

                                <!-- modal form tambah -->
                                <div class="modal fade" id="modal-tambah-item">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Item</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('operasi.daftarTugas.tambah') }}" method="POST"
                                                id="formTambahDaftarTugas">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="tugas">Tugas</label>
                                                        <input type="text" class="form-control" id="tugas"
                                                            aria-describedby="tugasHelp" placeholder="Masukkan tugas"
                                                            name="tugas" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deadline</label>
                                                        <div class="input-group date" id="reservationdatetime"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#reservationdatetime" name="deadline"
                                                                placeholder="Masukkan deadline" required />
                                                            <div class="input-group-append"
                                                                data-target="#reservationdatetime"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <!-- modal edit -->
                                <div class="modal fade" id="modal-edit-item" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalEdit" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-edit-title">Title
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEditDaftarTugas">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="modal-edit-tugas" class="col-form-label">Tugas</label>
                                                        <input type="text" class="form-control" id="modal-edit-tugas"
                                                            name="tugas" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" id="modal-edit-id" required>
                                                        <label>Deadline</label>
                                                        <div class="input-group date" id="reservationdatetime2"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#reservationdatetime2"
                                                                id="modal-edit-deadline" name="deadline" required>
                                                            <div class="input-group-append"
                                                                data-target="#reservationdatetime2"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger mr-auto"
                                                        id="modal-edit-hapus">Hapus</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-12 connectedSortable">

                        <!-- Calendar -->
                        <div class="card bg-gradient-success">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                                data-target="#modal-tambah-kalender">Add new event</a>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="card-refresh"
                                        data-source="{{ route('admin.dashboard') }}" data-source-selector="#calender"
                                        data-load-on-init="false" id="calender_refresh">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>

                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <button type="button" class="btn btn-success btn-sm" id="calender_maximize_temp">
                                        <i class="fas fa-expand"></i>
                                    </button>

                                    <button hidden type="button" class="btn btn-tool" data-card-widget="maximize"
                                        id="calender_maximize">
                                        <i class="fas fa-expand"></i>
                                    </button>

                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>

                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%;"></div>

                                <!-- modal tambah kalender-->
                                <div class="modal fade" id="modal-tambah-kalender" style="color:black" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCalender" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-kalender-header">Tambah Event
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formTambahKalender" method="post"
                                                action="{{ route('operasi.kalender.tambah') }}">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="modal-kalender-title"
                                                            class="col-form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            id="modal-kalender-title" name="title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mulai</label>
                                                        <div class="input-group date" id="reservationdate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#reservationdate" id="modal-kalender-start"
                                                                name="start" required>
                                                            <div class="input-group-append" data-target="#reservationdate"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Selesai</label>
                                                        <div class="input-group date" id="reservationdate2"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#reservationdate2" id="modal-kalender-end"
                                                                name="end" required>
                                                            <div class="input-group-append"
                                                                data-target="#reservationdate2"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Warna</label>
                                                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                                            <ul class="fc-color-picker" id="color-chooser">
                                                                <li><a class="text-primary" href="#"><i
                                                                            class="fas fa-square"></i></a></li>
                                                                <li><a class="text-warning" href="#"><i
                                                                            class="fas fa-square"></i></a></li>
                                                                <li><a class="text-success" href="#"><i
                                                                            class="fas fa-square"></i></a></li>
                                                                <li><a class="text-danger" href="#"><i
                                                                            class="fas fa-square"></i></a></li>
                                                                <li><a class="text-secondary" href="#"><i
                                                                            class="fas fa-square"></i></a></li>
                                                            </ul>
                                                            <input type="text" class="form-control"
                                                                style="color:rgba(0,0,0,0)" id="modal-kalender-warna"
                                                                name="warna" required readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')

    <script>
        // Make the dashboard widgets sortable Using jquery UI
        var currentPagePagination = 1;

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('.connectedSortable').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.card-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex: 999999
        })
        $('.connectedSortable .card-header').css('cursor', 'move')

        // jQuery UI sortable for the todo list
        $('.todo-list').sortable({
            placeholder: 'sort-highlight',
            handle: '.handle',
            forcePlaceholderSize: true,
            zIndex: 999999
        })

        //Date and time picker
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });
        $('#reservationdatetime2').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'yyyy-M-DD'
        });
        $('#reservationdate2').datetimepicker({
            format: 'yyyy-M-DD'
        });

        // datepicker tahun akademik
        $('#tahun_akademik_1').datepicker({
            minViewMode: 2,
            format: 'yyyy'
        });

        $('#tahun_akademik_1').change(function() {
            $('#tahun_akademik_1').datepicker('hide');
            $('#tahun_akademik_2').val(parseInt($('#tahun_akademik_1').val()) + 1);
        });

        $('#tahun_akademik_1_btn').click(function(e) {
            $('#tahun_akademik_1').datepicker('show');
        });

        $('#tahun_akademik_2').datepicker({
            minViewMode: 2,
            format: 'yyyy'
        });

        $('#tahun_akademik_2').change(function() {
            $('#tahun_akademik_2').datepicker('hide');
            $('#tahun_akademik_1').val(parseInt($('#tahun_akademik_2').val()) - 1);
        });

        $('#tahun_akademik_2_btn').click(function(e) {
            $('#tahun_akademik_2').datepicker('show');
        });

        // paginator
        $('#show_paginator').bootpag({
            total: {{ $jumlahHalaman }}, // total pages
            page: 1, // default page
            maxVisible: 5, // visible pagination
            leaps: true // next/prev leaps through maxVisible
        }).on("page", function(event, num) {
            gantiHalaman(num);
        });

        $("#formTambahDaftarTugas").submit(function(e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            var url = "{{ route('operasi.daftarTugas.tambah') }}"
            $.ajax({
                type: "post",
                url: url,
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.message == 200) {
                        $('#modal-tambah-item').modal('toggle')
                        swalToast(response.message, response.data);
                        refreshPagination(1);
                    }
                }
            });
        });

        $('#modal-edit-item').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var tugas = button.data('tugas');
            var deadline = button.data('deadline');

            $('#modal-edit-title').html("Edit");
            $('#modal-edit-id').val(id);
            $('#modal-edit-tugas').val(tugas);
            $('#modal-edit-deadline').val(deadline);
        })

        $('#formEditDaftarTugas').submit(function(e) {
            e.preventDefault();
            var id = $(this).serializeArray()[2].value;
            var url = "{{ route('operasi.daftarTugas.edit') }}";

            var data = $(this).serialize();
            $.ajax({
                type: "post",
                url: url,
                data: data,
                success: function(response) {
                    $('#modal-edit-item').modal('toggle')
                    swalToast(response.message, response.data);
                    refreshPagination(currentPagePagination);
                }
            });
        });

        $('#modal-edit-hapus').click(function(e) {
            e.preventDefault();
            var data = $('#formEditDaftarTugas').serialize();
            var id = $('#formEditDaftarTugas').serializeArray()[2].value;
            var url = "{{ route('operasi.daftarTugas.show') }}/" + id + "/hapus"

            $.ajax({
                type: "post",
                url: url,
                data: data,
                success: function(response) {
                    $('#modal-edit-item').modal('toggle')
                    swalToast(response.message, response.data);
                    refreshPagination(currentPagePagination);
                }
            });
        });

        function refreshPagination(halamanTujuan) {
            $.ajax({
                type: "get",
                url: "{{ route('operasi.daftarTugas.jumlahHalaman') }}",
                dataType: "json",
                success: function(response) {
                    $('#show_paginator').bootpag({
                        total: response.data, // total pages
                        page: halamanTujuan, // default page
                        maxVisible: 5, // visible pagination
                        leaps: true // next/prev leaps through maxVisible
                    });
                    gantiHalaman(halamanTujuan);
                }
            });
        }

        //swaltoast
        function swalToast(message, data) {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            if (message == 200) {
                Toast.fire({
                    icon: 'success',
                    title: data
                });
            } else {
                Toast.fire({
                    icon: 'danger',
                    title: data
                });
            }
        }

        // refresh halaman to do list
        function gantiHalaman(halaman) {
            var offset = (5 * halaman) - 5;
            var url = "{{ route('operasi.daftarTugas.show') }}" + "/" + offset;
            currentPagePagination = halaman;
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(response) {
                    $("#todo-list").empty();
                    var data = response.data;
                    var i = 1;
                    data.forEach(dat => {
                        var checked = "";
                        if (dat.status == "done") {
                            checked = "checked"
                        }
                        var div = '<li class="anim-fade ' + dat.status + '">' +
                            '<span class="handle">' +
                            '<i class="fas fa-ellipsis-v"></i>' +
                            '<i class="fas fa-ellipsis-v"></i>' +
                            '</span>' +
                            '<div class="icheck-primary d-inline ml-2">' +
                            '<input type="checkbox" value="" name="todo' + i + '" id="todoCheck' + i +
                            '" data-id="' + dat.id + '" onchange="editCheck(event)" ' + checked + ' >' +
                            '<label for="todoCheck' + i++ + '"></label>' +
                            '</div>' +
                            '<span class="text">' + dat.tugas + '</span>' +
                            '<small class="badge badge-' + dat.peringatan + '"><i' +
                            'class="far fa-clock"></i>' + dat.deadline_baru + '</small>' +
                            '<div class="tools">' +
                            '<i class="fas fa-edit" data-toggle="modal" data-target="#modal-edit-item" data-id="' +
                            dat.id + '" data-tugas="' + dat.tugas + '" data-deadline="' + dat.deadline +
                            '"></i>' +
                            '<i class="fas fa-trash-o"></i>' +
                            '</div>' +
                            '</li>';
                        $('#todo-list').append(div);
                    });
                }
            });
        }

        function editCheck(event) {
            var cek = $(event.currentTarget).is(':checked');
            var id = $(event.currentTarget).attr('data-id');
            if (cek) {
                ajaxEdit(id, "done");
            } else {
                ajaxEdit(id, "aktif");
            }
        }

        function ajaxEdit(id, status) {
            var url = "{{ route('operasi.daftarTugas.show') }}" + "/" + id + "/edit" + "/" + status
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(response) {
                    var message = response.message;
                    var data = response.data;
                    swalToast(message, data);
                }
            });
        }
    </script>
    <script>
        var calendar;
        $(function() {
            /* initialize the calendar
             -----------------------------------------------------------------*/

            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var calendarEl = document.getElementById('calendar');

            // initiate first data calender 
            var events = [];
            @foreach ($kalender as $k)
                var data = {
                    "id": "{{ $k->id }}",
                    "title": "{{ $k->title }}",
                    "start": new Date("{{ $k->start }}"),
                    "end": new Date("{{ $k->end }}"),
                    "backgroundColor": "{{ $k->warna }}",
                    "borderColor": "{{ $k->warna }}",
                    "allDay": false
                };
                if (Date.parse(data.start) == Date.parse(data.end)) {
                    data.allDay = true
                }
                events.push(data);
            @endforeach
            calendar = new Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                height: 700,

                //Random default events
                events: events,
                editable: true,
                selectable: true,
                select: function(start, end, allDay) {
                    $('#modal-kalender-start').val(start.startStr);
                    $('#modal-kalender-end').val(start.startStr);
                    $('#modal-kalender-warna').css('background-color', 'rgb(0, 86, 179)');
                    $('#modal-kalender-warna').val('rgb(0, 86, 179)');

                    $('#modal-tambah-kalender').modal('toggle')
                },
                eventDrop: function(info) {
                    var id = info.event.id;
                    var start = changeFormatDate(info.event.start);
                    var end = info.event.end;
                    if (end == null) {
                        end = start;
                    } else {
                        end = changeFormatDate(end);
                    }
                    var data = {
                        "start": start,
                        "end": end,
                        "title": info.event.title,
                        "warna": info.event.backgroundColor,
                        "_token": "{{ csrf_token() }}"
                    };
                    var url = "{{ route('operasi.kalender') }}/" + id + "/edit";
                    $.ajax({
                        type: "post",
                        url: url,
                        data: data,
                        success: function(response) {
                            // console.log(response)
                            swalToast(response.message, response.data);
                        }
                    });
                },
                eventClick: function(info) {
                    Swal.fire({
                        title: 'Yakin hapus data ?',
                        showCancelButton: true,
                        confirmButtonText: 'Iya',
                        cancelButtonText: 'Batal',
                        customClass: {
                            actions: 'my-actions',
                            cancelButton: 'order-1 right-gap',
                            confirmButton: 'order-2',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = info.event.id;
                            var url = "{{ route('operasi.kalender') }}/" + id + "/hapus";
                            var data = {
                                "_token": "{{ csrf_token() }}",
                                "_method": "delete"
                            }
                            $.ajax({
                                type: "post",
                                url: url,
                                data: data,
                                success: function(response) {
                                    swalToast(response.message, response.data);
                                    var event = calendar.getEventById(info.event
                                        .id);
                                    event.remove();
                                }
                            });
                        }
                    })
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

        });
        $('#formTambahKalender').submit(function(e) {
            e.preventDefault();
            var url = "{{ route('operasi.kalender.tambah') }}";
            var data = $(this).serialize();
            $.ajax({
                type: "post",
                url: url,
                data: data,
                success: function(response) {
                    var kalender = response.kalender;
                    $('#modal-tambah-kalender').modal('toggle')
                    swalToast(response.message, response.data);
                    var event = {
                        id: kalender.id,
                        title: kalender.title,
                        start: new Date(kalender.start),
                        end: new Date(kalender.end),
                        backgroundColor: kalender.warna,
                        backgroundBorder: kalender.warna,
                        allDay: false,
                    }
                    if (Date.parse(kalender.start) == Date.parse(kalender.end)) {
                        event.allDay = true
                    }
                    calendar.addEvent(event);

                    $('#modal-kalender-start').val('');
                    $('#modal-kalender-end').val('');
                    $('#modal-kalender-title').val('');
                }
            });
        });

        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#modal-kalender-warna').css('background-color', currColor);
            $('#modal-kalender-warna').val(currColor);

        })

        $('#calender_refresh').click(function() {
            calendar.render();
        });

        $('#calender_maximize_temp').click(function() {
            document.querySelector('#calender_maximize').click();
            refreshCalenderWithDelay();
        });

        $('#navbar_burger').click(function() {
            refreshCalenderWithDelay();
        });

        function refreshCalenderWithDelay() {
            setTimeout(() => {
                document.querySelector('#calender_refresh').click();
            }, 500);
        }

        function changeFormatDate(date) {
            var formatDate = [{
                year: 'numeric'
            }, {
                month: 'numeric'
            }, {
                day: 'numeric'
            }];

            function format(m) {
                let f = new Intl.DateTimeFormat('en', m);
                return f.format(date);
            }
            return formatDate.map(format).join('-');
        }
    </script>
@endsection
