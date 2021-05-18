<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    $(document).ready(function() {
        $('#table2').DataTable();
    });
    $('.datepicker').datepicker();
</script>
<script src="<?= base_url('assets/') ?>js/scripts.js"></script>
<script type="text/javascript" src="<?= base_url('assets/') ?>DataTables/datatables.min.js"></script>
</body>

</html>q