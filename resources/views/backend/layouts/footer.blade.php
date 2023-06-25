
   <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('backend/bootstrap-4.6.2/js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('backend/bootstrap-4.6.2/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/bootstrap-4.6.2/js/bootstrap.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js')}}/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>


    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>

    <script src="{{asset('backend/js/public.js')}}"></script>

    <!-- Summnernote -->
    <script src="{{asset('backend/summernote/summnernote.js')}}"></script>

    <!-- Bootstrap switch button -->
    <script src="{{asset('backend/switch-button-bootstrap/src/bootstrap-switch-button.js')}}"></script>
   <!--Sweet Alert -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   {{-- jQuery Multifield Plugin --}}
<script src="{{asset('backend/js/jquery.multifield.min.js')}}"></script>


   
 @yield('scripts') 

 <script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
 </script>
@yield('footer')