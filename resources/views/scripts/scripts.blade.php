@push('css')

    <!-- Custom fonts for this template -->
    <link href="{{asset('libs/fontawesome/css/all.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('libs/sbadmin/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('libs/loader/loader.css')}}" />

@endpush()

@push('scripts')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('libs/sbadmin/js/sb-admin-2.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('libs/datatables/dataTables.bootstrap4.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('libs/sbadmin/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('libs/loader/loader.js')}}"></script>

@endpush()
