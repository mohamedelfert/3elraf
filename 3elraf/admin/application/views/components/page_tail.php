<?php
if (isset($managerPrivileges)) {
    ?>
    <script src="<?= base_url('assets/js/managerPrivileges.js') ?>"></script>
<?php }
if (isset($mapJs)) {
    ?>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDInWRq5xhaCQnQEZifc7lgvWTvKL2gxDo&sensor=false"></script>
    <script src="<?= base_url('assets/js/jquery-gmaps-latlon-picker.js') ?>"></script>
<?php } ?>

<!-- CSS and JS for our code -->
<div class="footer clearfix hidden-print">
    <div class="pull-left">
        &copy; <?php echo date('Y') . ' ' . $site_name; ?>
    </div>
</div>
<!-- /footer -->


</div>
<!-- /page content -->


</div>
<!-- /page container -->

</body>
</html>                

