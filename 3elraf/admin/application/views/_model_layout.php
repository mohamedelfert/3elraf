<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title><?= $site_name; ?></title>

        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/londinium-theme.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

        <script type="text/javascript" src="<?= base_url('assets/js/plugins/charts/sparkline.min.js'); ?>"></script>

        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/uniform.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/select2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/inputmask.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/autosize.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/inputlimit.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/listbox.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/multiselect.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/validate.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/tags.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/switch.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/uploader/plupload.full.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/uploader/plupload.queue.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/wysihtml5/wysihtml5.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/forms/wysihtml5/toolbar.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/daterangepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/fancybox.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/moment.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/jgrowl.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/datatables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/colorpicker.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/fullcalendar.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/plugins/interface/timepicker.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/application.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/our_script.js'); ?>"></script>



    </head>

    <body class="full-width page-condensed">

        <!-- Navbar -->
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right">
                    <span class="sr-only">Toggle navbar</span>
                    <i class="icon-grid3"></i>
                </button>
                <a class="navbar-brand" href="<?=base_url();?>" style="width: 80%">
                    <img src="<?= base_url('assets/front/images/logo.png');?>" alt="bookStore" width="65%" style="float: left;">
                </a>
            </div>


        </div>
        <!-- /navbar -->


        <div class="sub_view">
            <?php $this->load->view($sub_view); ?>
        </div>


        <!-- Footer -->
        <div class="footer clearfix">
            <div class="pull-left">
                &copy; <?php echo date('Y') . ' ' . $site_name; ?>
            </div>
            <div class="pull-right icons-group">
                <a href="#"><i class="icon-screen2"></i></a>
                <a href="#"><i class="icon-balance"></i></a>
                <a href="#"><i class="icon-cog3"></i></a>
            </div>
        </div>
        <!-- /footer -->


    </body>
</html>    