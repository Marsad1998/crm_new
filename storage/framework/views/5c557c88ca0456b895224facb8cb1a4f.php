<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>


	<link href="<?php echo e(global_asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet"/>
	<link href="<?php echo e(global_asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')); ?>" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo e(global_asset('assets/logins/css/util.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(global_asset('assets/logins/css/main.css')); ?>">
	
	<style>
		@media (max-width: 992px) {
			.login100-pic {
				padding-top: 25px;
			}
		}
	</style>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>    
    
	<script src="<?php echo e(global_asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(global_asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

	<script src="<?php echo e(global_asset('assets/logins/vendor/jquery/tilt.jquery.min.js')); ?>"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="<?php echo e(global_asset('assets/logins/js/main.js')); ?>"></script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\upwork\crm_new\resources\views/auth/guest.blade.php ENDPATH**/ ?>