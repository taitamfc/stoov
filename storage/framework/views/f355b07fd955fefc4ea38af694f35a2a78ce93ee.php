<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-' . $general_setting->theme) ?>" type="text/css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<?php
$general_settings = \App\GeneralSetting::latest()->first();
?>

<body>
    <div class="page login-page">
        <div class="container">
            <div class="form-outer text-center d-flex align-items-center">
                <div class="form-inner">
                    <div class="logo-img">
                        <?php if($general_settings->site_logo): ?>
                        <img src="<?php echo e(asset('/images/logo/'.$general_settings->site_logo)); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="text">
                        <p> <strong>Dit is de website van Stichting Opleidings- en Ontwikkelingsfonds voor de Vlakglasbranche.</strong></p>
                        <p>Log in met uw gebruikersnaam en wachtwoord welke u van ons heeft ontvangen.</p>
                    </div>
                    <?php echo $__env->make('shared.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('shared.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form method="POST" action="<?php echo e(route('login')); ?>" id="login-form">
                        <?php echo csrf_field(); ?>
                        <div class="form-group-material">


                            <input id="username" type="text" class="input-material <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(old('username')); ?>" required autofocus>
                            <label for="username" class="label-material"><?php echo e(__('Username')); ?></label>

                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group-material">


                            <input id="password" type="password" class="input-material <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                            <label for="password" class="label-material"><?php echo e(__('Password')); ?></label>

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <br>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                <?php echo e(__('Login')); ?>

                            </button>
                        </div>
                    </form>
                    <!-- This three buttons for demo only-->
                    
                    <?php if(Route::has('password.request')): ?>
                    <a class="forgot-pass" href="<?php echo e(route('password.request')); ?>">
                        <?php echo e(__('Forgot Your Password?')); ?>

                    </a>
                    <?php endif; ?>
                    <br><br>
                    <div class="text d-flex align-items-center justify-content-center row ">
                        <p class="col-4" style="text-align: left;">Postbus 340<br>2700 AH Zoetermeer</p>
                        <p class="col-4">Zilverstraat 69<br>2718 RP Zoetermeer</p>
                        <p class="col-4" style="text-align: right;">
                            T: <a href="tel:0885678888">088-5678888 </a><br>
                            W: <a href="https://stoov.nl/" target="_blank">www.stoov.nl </a><br>
                            E: <a href="mailto:info@stoov.nl">info@stoov.nl</a>
                        </p>

                    </div>
                </div>


                <div class="copyrights text-center">
                    <p><?php echo e(__('Developed by')); ?> <a href=<?php echo e($general_settings->footer_link); ?> class="external"><?php echo e($general_settings->footer); ?></a></p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
</body>

</html>

<script type="text/javascript">
    (function($) {

        "use strict";

        $('.admin-btn').on('click', function() {
            $("input[name='username']").focus().val('admin');
            $("input[name='password']").focus().val('admin');
        });

        $('.staff-btn').on('click', function() {
            $("input[name='username']").focus().val('staff');
            $("input[name='password']").focus().val('staff');
        });
        $('.client-btn').on('click', function() {
            $("input[name='username']").focus().val('client');
            $("input[name='password']").focus().val('client');
        });

        // ------------------------------------------------------- //
        // Material Inputs
        // ------------------------------------------------------ //

        let materialInputs = $('input.input-material');

        // activate labels for prefilled values
        materialInputs.filter(function() {
            return $(this).val() !== "";
        }).siblings('.label-material').addClass('active');

        // move label on focus
        materialInputs.on('focus', function() {
            $(this).siblings('.label-material').addClass('active');
        });

        // remove/keep label on blur
        materialInputs.on('blur', function() {
            $(this).siblings('.label-material').removeClass('active');

            if ($(this).val() !== '') {
                $(this).siblings('.label-material').addClass('active');
            } else {
                $(this).siblings('.label-material').removeClass('active');
            }
        });
    })(jQuery);
</script><?php /**PATH E:\laragon\www\stoov\resources\views/auth/login.blade.php ENDPATH**/ ?>