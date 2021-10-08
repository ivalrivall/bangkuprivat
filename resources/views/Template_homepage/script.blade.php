<!-- jQuery -->
<script src="{{ url('/TemplateHome/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/TemplateHome/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<!-- <script src="{{ url('/TemplateHome/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/TemplateHome/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/TemplateHome/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/TemplateHome/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> -->

<!-- REVISI DATATABLE NYA NIH -->
  <!-- Bootstrap core JavaScript-->
  <script src="{{url('/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{url('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Page level plugins -->
  <script src="{{url('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <!-- Page level custom scripts -->
  <script src="{{url('/js/demo/datatables-demo.js')}}"></script>
  <!-- Page level plugins -->
  <script src="{{url('/vendor/chart.js/Chart.min.js')}}"></script>
<!-- SAMPE SINI REVISI DATATABLE -->

<!-- AdminLTE App -->
<script src="{{ url('/TemplateHome/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/TemplateHome/dist/js/demo.js') }}"></script>
<!-- page script -->
<!-- <script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script> -->

{{-- Show & Hide Password --}}
<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
<!-- Script  Footer Home-->
<link href="{{ url('css/stylesfooter.css') }}" rel="stylesheet" />
