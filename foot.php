   
<script src="template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="template/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="template/plugins/select2/select2.full.min.js"></script>
<script src="template/plugins/moment.min.js"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
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
        
    });
</script>