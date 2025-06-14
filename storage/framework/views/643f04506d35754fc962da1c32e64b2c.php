<!DOCTYPE html>
<html lang="en" dir="<?php echo e(session()->get('direction') == 2 ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if(str_contains(URL::current(), 'blogdetail-')): ?>
        <meta property="og:title" content="<?php echo e(@$getblog->title); ?>" />
        <meta property="og:description" content="<?php echo e(strip_tags(substr( @$getblog->description, 0, 420))); ?>" />
        <meta property="og:image" content="<?php echo e(helper::image_path(@$getblog->image)); ?>" />
    <?php else: ?>
        <meta property="og:title" content="<?php echo e(helper::appdata('')->meta_title); ?>" />
        <meta property="og:description" content="<?php echo e(helper::appdata('')->meta_description); ?>" />
        <meta property="og:image" content="<?php echo e(helper::image_path(helper::appdata('')->og_image)); ?>" />
    <?php endif; ?>


    
    <link rel="icon" type="image" sizes="16x16" href="<?php echo e(helper::image_path(helper::appdata('')->favicon)); ?>"><!-- Favicon icon -->
    <title><?php echo e(helper::appdata('')->landing_website_title); ?></title>
    <!----------------font-awesome---------------->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/fontawesome/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/css/toastr/toastr.min.css')); ?>"><!-- Toastr CSS -->
    <!---------------owl-carousel-link-min-css------------->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/owl.theme.default.min.css')); ?>">
    <!---------------font-family-Lexend----------->
    <!-- <link rel="stylesheet" href="assets/font/css2.css"> -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/fonts.css')); ?>">
    <!--aos css link-->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/aos.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETPATHURL') . 'landing/css/responsive.css')); ?>">
    <style>
         :root {
            /* Color */
            --primary-color: <?php echo e(helper::subscriptionimage()->primary_color); ?>;
            --secondary-color: <?php echo e(helper::subscriptionimage()->secondary_color); ?>;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <?php echo $__env->make('landing.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->make('landing.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Quick call -->
    <?php if(@helper::checkaddons('quick_call')): ?>
        <?php if(@helper::appdata('')->quick_call == 1): ?>
        <?php echo $__env->make('landing.quick_call', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(@helper::checkaddons('tawk_addons')): ?>
        <!--Start of Tawk.to Script-->
        <?php if(helper::appdata('')->tawk_on_off == 1 ): ?>
            <?php echo helper::appdata('')->tawk_widget_id; ?>

        <?php endif; ?>
    <?php endif; ?>
    <?php if(@helper::checkaddons('wizz_chat')): ?>
        <?php if(helper::appdata('')->wizz_chat_on_off == 1 ): ?>
            <!-- Wizz Chat -->
            <?php echo helper::appdata('')->wizz_chat_settings; ?>

        <?php endif; ?>
    <?php endif; ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/jquery/jquery.min.js')); ?>"></script><!-- jQuery JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- Bootstrap JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/toastr/toastr.min.js')); ?>"></script><!-- Toastr JS -->
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'landing/js/aos.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'landing/js/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'landing/js/owl.carousel.min.js')); ?>"></script>
    <script>
        toastr.options = {"closeButton": true,}
        <?php if(Session::has('success')): ?>
           toastr.success("<?php echo e(session('success')); ?>");
       <?php endif; ?>
       <?php if(Session::has('error')): ?>
           toastr.error("<?php echo e(session('error')); ?>");
       <?php endif; ?>
       var layout = "<?php echo e(session()->get('direction')); ?>";
      </script>
       <script>
        function themeinfo(id, theme_id, plan_name) {

            let string = theme_id;
            let arr = string.split('|');
            $('#themeinfoLabel').text(plan_name);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "<?php echo e(URL::to('/themeimages')); ?>",
                method: 'GET',
                data: {
                    theme_id: arr
                },
                dataType: 'json',
                success: function(data) {
                    $('#theme_modalbody').html(data.output);
                    $('#themeinfo').modal('show');
                }
            })

        }
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') .'landing/js/landing.js')); ?>"></script>
   

</body><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/layout/default.blade.php ENDPATH**/ ?>