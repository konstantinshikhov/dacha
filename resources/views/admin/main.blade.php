<!doctype html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Ogorod | AdminLTE 2 @if(!empty($modelName))| {{ $modelName }} @endif</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/Ionicons/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/datatables.net-bs/css/dataTables.bootstrap4.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/select2/dist/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/admin-lte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins.-->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/admin-lte/dist/css/skins/skin-blue.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminlte/asset/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
      @component('admin.header')
      @endcomponent

      @component('admin.leftSidebar')
        @if(!empty($activeMenu))
          @slot('activeMenu') {{ $activeMenu }} @endslot
        @endif
      @endcomponent

      @component('admin.content')
        @if(!empty($modelName))
          @slot('modelName') {{ $modelName }} @endslot
        @endif
      @endcomponent

      {{-- @component('admin.footer')
      @endcomponent --}}

      {{-- @component('admin.rightSidebar')
      @endcomponent --}}
    </div>

    @section('script')
    <!-- jQuery 3 -->
    <script src="{{ asset('adminlte/asset/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('adminlte/asset/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/asset/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- DataTabels -->
    <script src="{{ asset('adminlte/asset/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminlte/asset/datatables.net-bs/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminlte/asset/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/asset/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('adminlte/asset/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    @show

  </body>
</html>