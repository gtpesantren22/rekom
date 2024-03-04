</body>

<script src="<?= base_url('assets/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>js/popper.js"></script>
<script src="<?= base_url('assets/') ?>datatables/datatables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>js/main.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.mask.min.js"></script>

<script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js"></script>
<script src="<?= base_url() ?>assets/iziToast/my-notif.js"></script>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable();

        // Format mata uang.
        $('.uang').mask('000.000.000.000', {
            reverse: true
        });

    })
</script>

</html>