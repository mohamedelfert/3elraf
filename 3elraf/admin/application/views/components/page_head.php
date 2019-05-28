<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title><?= $site_name; ?></title>

        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/londinium-theme.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/css/my_style.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <?php if(isset($mapJs)){?>
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery-gmaps-latlon-picker.css'); ?>"/>
        <?php }?>

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
        <script type="text/javascript" src="<?= base_url('assets/js/application.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/our_script.js'); ?>"></script>
    </head>
    <body>

        <!-- Navbar -->
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?=base_url();?>">
                    <img src="<?= base_url('assets/front/images/logo.png');?>" alt="bookStore" width="65%" style="float: left;">
                </a>
                <a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
                <button data-target="#navbar-icons" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navbar</span>
                    <i class="icon-grid3"></i>
                </button>
                <button class="navbar-toggle offcanvas" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="icon-paragraph-justify2"></i>
                </button>
            </div>

            <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
                <li class="user dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><?= $this->session->userdata('bookStoreAdminName'); ?></span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">
                        <?php if($this->session->userdata('bookStoreAdminLoggedInType') == 1){?>
                        <li><a href="<?= site_url('users/updateMyDetails'); ?>"><i class="icon-cog"></i> Settings</a></li>
                        <?php } ?>
                        <li><a href="<?= site_url('users/logout'); ?>"><i class="icon-exit"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>