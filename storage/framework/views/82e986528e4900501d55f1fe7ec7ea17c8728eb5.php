<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" type="image/png" href="<?php echo e(asset('/images/logo/'.$general_settings->site_logo)); ?>"/>
    <title><?php echo e($general_settings->site_title ?? "NO Title"); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Bootstrap CSS-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/bootstrap-datepicker.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/bootstrap-datepicker.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/jquery-clockpicker/bootstrap-clockpicker.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/jquery-clockpicker/bootstrap-clockpicker.min.css')); ?>"></noscript>

    <!-- Boostrap Tag Inputs-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/Tag_input/tagsinput.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/Tag_input/tagsinput.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/bootstrap-select.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/bootstrap/css/bootstrap-select.min.css')); ?>"></noscript>

    <!-- Font Awesome CSS-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/font-awesome/css/font-awesome.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/font-awesome/css/font-awesome.min.css')); ?>"></noscript>

    <!-- Dripicons icon font-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/dripicons/webfont.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/dripicons/webfont.css')); ?>"></noscript>

    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">

    <!-- jQuery Circle-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('css/grasp_mobile_progress_circle-1.0.0.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('css/grasp_mobile_progress_circle-1.0.0.min.css')); ?>"></noscript>

    <!-- Custom Scrollbar-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')); ?>"></noscript>

    <!-- date range stylesheet-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/daterange/css/daterangepicker.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('vendor/daterange/css/daterangepicker.min.css')); ?>"></noscript>

    <!-- table sorter stylesheet-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/dataTables.bootstrap4.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/dataTables.bootstrap4.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/buttons.bootstrap4.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/buttons.bootstrap4.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/select.bootstrap4.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/select.bootstrap4.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/dataTables.checkboxes.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/dataTables.checkboxes.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/datatables.flexheader.boostrap.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/datatables.flexheader.boostrap.min.css')); ?>"></noscript>


    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/select2/dist/css/select2.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/select2/dist/css/select2.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/RangeSlider/ion.rangeSlider.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/RangeSlider/ion.rangeSlider.min.css')); ?>"></noscript>

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/datatable.responsive.boostrap.min.css')); ?>">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/datatable/datatable.responsive.boostrap.min.css')); ?>"></noscript>
    <!-- theme stylesheet-->

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('css/style.default.css')); ?>" id="theme-stylesheet" >
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(asset('css/style.default.css')); ?>" id="theme-stylesheet" ></noscript>
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" id="theme-custom" type="text/css">


    <?php if(env('RTL_LAYOUT')!=NULL): ?>
        <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/bootstrap/css/bootstrap-rtl.min.css')); ?>">
        <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('vendor/bootstrap/css/bootstrap-rtl.min.css')); ?>"></noscript>

        <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('css/custom-rtl.css')); ?>">
        <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"  href="<?php echo e(asset('css/custom-rtl.css')); ?>"></noscript>
    <?php endif; ?>


    <?php if((request()->is('admin/dashboard*')) || (request()->is('calendar*')) ): ?>
        <?php echo $__env->make('calendarable.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <script type="text/javascript" src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/jquery/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/jquery/bootstrap-datepicker.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('vendor/jquery-clockpicker/bootstrap-clockpicker.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/popper.js/umd/popper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/bootstrap/js/bootstrap-select.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('js/grasp_mobile_progress_circle-1.0.0.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('vendor/chart.js/Chart.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/charts-custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/front.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/daterange/js/moment.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/daterange/js/knockout-3.4.2.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/daterange/js/daterangepicker.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>

    <!-- JS for Boostrap Tag Inputs-->

    <script type="text/javascript" src="<?php echo e(asset('vendor/Tag_input/tagsinput.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('vendor/RangeSlider/ion.rangeSlider.min.js')); ?>"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/pdfmake.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/vfs_fonts.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/dataTables.buttons.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/buttons.bootstrap4.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/buttons.colVis.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/buttons.html5.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/buttons.print.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/dataTables.select.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/sum().js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/dataTables.checkboxes.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/datatable.fixedheader.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/datatable.responsive.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/select2/dist/js/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('vendor/datatable/datatable.responsive.boostrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.validate.min.js') ?>"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="<?php echo asset('../js/custom.js') ?>"></script>
    <?php if((request()->is('admin/dashboard*')) || (request()->is('calendar*')) ): ?>
        <?php echo $__env->make('calendarable.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</head>


<body>
<div id="loader"></div>
<!-- navbar-->
<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="dripicons-menu"> </i></a>
                <span class="brand-big" id="site_logo_main">
                    <?php if($general_settings->site_logo): ?>
                        <img src="<?php echo e(asset('/images/logo/'.$general_settings->site_logo)); ?>" width="50">
                        &nbsp; &nbsp;
                    <?php endif; ?>
                        <h1 class="d-inline" id="site_title_main"><?php echo e($general_settings->site_title ?? "No title"); ?></h1>
                </span>


                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item">
                            <?php if(!empty(auth()->user()->profile_photo)): ?>
                                <img class="profile-photo sm mr-1"
                                     src="<?php echo e(asset('uploads/profile_photos/')); ?>/<?php echo e(auth()->user()->profile_photo); ?>">
                            <?php else: ?>
                                <img class="profile-photo sm mr-1"
                                     src="<?php echo e(asset('uploads/profile_photos/avatar.jpg')); ?>">
                            <?php endif; ?>
                            <span> <?php echo e(auth()->user()->username); ?></span>
                        </a>
                        <ul class="right-sidebar">
                            <li>
                                <a href="<?php echo e(route('profile')); ?>">
                                    <i class="dripicons-user"></i>
                                    <?php echo e(trans('Profile')); ?>

                                </a>
                            </li>
                            <?php if(auth()->user()->role_users_id == 1): ?>
                                <li id="empty_database">
                                    <a href="#">
                                        <i class="dripicons-stack"></i>
                                        <?php echo e(__('Empty Database')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth()->user()->role_users_id == 1): ?>
                                <li id="export_database">
                                    <a href="<?php echo e(route('export_database')); ?>">
                                        <i class="dripicons-cloud-download"></i>
                                        <?php echo e(__('Export Database')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-link" type="submit"><i
                                                class="dripicons-exit"></i> <?php echo e(trans('logout')); ?></button>
                                </form>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php echo $__env->make('shared.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</header>


<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <!-- Sidebar Navigation Menus-->
        <?php echo $__env->make('vendor.translation.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>        
    </div>
</nav>

<?php
    $general_settings = \App\GeneralSetting::latest()->first();
?>

<div id="content" class="page animate-bottom d-none">
    <?php echo $__env->yieldContent('content'); ?>
    <footer class="main-footer">
        <div class="container-fluid">
            <p>&copy; <?php echo e($general_settings->site_title ?? "no title"); ?> | <?php echo e(__('Developed by')); ?> <a
                        href=<?php echo e($general_settings->footer_link); ?> class="external"><?php echo e($general_settings->footer); ?></a></p>
        </div>
    </footer>
</div>

<script type="text/javascript">
    (function ($) {

        "use strict";

        $('#empty_database').on('click', function () {
            if (confirm('<?php echo e(__('Delete Selection',['key'=>__('Empty Database')])); ?>')) {
                let url = '<?php echo e(route('empty_database')); ?>';
                document.location.href = url;
            } else {

            }
        });


        $('#notify-btn').on('click', function () {
            $.ajax({
                url: '<?php echo e(route('markAsRead')); ?>',
                dataType: "json",
                success: function (result) {
                },
            });
        })

    })(jQuery);
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH E:\laragon\www\stoov\resources\views/layout/main.blade.php ENDPATH**/ ?>