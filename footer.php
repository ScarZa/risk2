<?php $conn_DB->close_PDO();?>    
    <!-- DataTables -->
    <script src="template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="template/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="template/plugins/select2/select2.full.min.js"></script>
    <script src="template/plugins/moment.min.js"></script>
    
    <!--<script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>-->
    
    <!-- Bootstrap 3.3.5 -->
    <script src="template/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="template/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="template/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="template/plugins/knob/jquery.knob.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="template/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="template/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="template/dist/js/pages/dashboard.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="template/dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      //$(function () {
        $("#dbtable1").DataTable();
        $('#dbtable2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $('#dbtable3').DataTable({
          "paging": false,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        $(".select2").select2();
      //});
    </script>
  </body>
</html>
