<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>

    <link rel="icon" href="#">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/lte4/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/lte4/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Daterange picker bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/fullcalendar/main.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/lte4/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- Css CROP --}}
    <link rel="stylesheet" href="{{ asset('/lte4/ijaboCropTool/ijaboCropTool.min.css') }}">
    {{-- dropzone --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <!-- autocomplete -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('/lte4/dist/css/autocomplete-ui.css') }}">
    <!-- Mycss -->
    <link rel="stylesheet" href="{{ asset('/lte4/dist/css/mycss.css') }}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('/lte4/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('layouts.master.navbar')

        @include('layouts.master.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        @include('layouts.master.footer')

        {{-- @include('layouts.master.control-sidebar') --}}
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/lte4/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/lte4/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/lte4/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/lte4/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/lte4/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- momen js -->
    <script src="{{ asset('/lte4/plugins/moment/moment.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/lte4/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/lte4/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/lte4/dist/js/demo.js') }}"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/lte4/plugins/sparklines/sparkline.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/lte4/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- JQVMap -->
    {{-- <script src="{{ asset('/lte4/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <!-- Bootpag -->
    <script type="text/javascript" src="{{ asset('/lte4/dist/js/jquery.bootpag.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('/lte4/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- daterange picker -->
    <script src="{{ asset('/lte4/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Datepicker bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('/lte4/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('/lte4/plugins/fullcalendar/main.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/lte4/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('/lte4/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/lte4/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('/lte4/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    {{-- Script Css Crop --}}
    <script src="{{ asset('/lte4/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    {{-- Input file --}}
    <script src="{{ asset('/lte4/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    {{-- dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <!-- autocomplete -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- myscript -->
    <script src="{{ asset('/lte4/dist/js/myscript.js') }}"></script>

    @yield('script')

    <script>
        $(document).ready(function() {
            deleteGdrive();

            // autocomplete nav search
            $("#nav-search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.searching.autocomplete') }}",
                        data: {
                            q: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                position: {
                    my: "right top+20",
                    at: "right bottom"
                },
                select: function(event, ui) {
                    const pick = ui.item.value;
                    location.href = pick;
                }
            });
        });

        function deleteGdrive() {
            var dokumenSisa = getDokumenSisa();
            if (dokumenSisa != null) {
                dokumenSisa.forEach(val => {
                    var name = val;
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
                            deleteDokumenSisa(response.name);
                        }
                    });
                });
            }
        }
    </script>
</body>

</html>
