<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<!-- Favicon -->
		<link rel="icon" href="assets/img/brand/new-favicon-45x45.ico" type="image/x-icon"/>

		<!-- Title -->
		<title><?php echo e(config('app.name', 'Laravel')); ?></title>

		<!-- Bootstrap css-->
		<link href="<?php echo e(global_asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="<?php echo e(global_asset('assets/plugins/web-fonts/icons.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(global_asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(global_asset('assets/plugins/web-fonts/plugin.css')); ?>" rel="stylesheet"/>

		<!-- Style css-->
		<link href="<?php echo e(global_asset('assets/css/style.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(global_asset('assets/css/boxed.css')); ?>" rel="stylesheet" />
		<link href="<?php echo e(global_asset('assets/css/dark-boxed.css')); ?>" rel="stylesheet" />
		<link href="<?php echo e(global_asset('assets/css/skins.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(global_asset('assets/css/dark-style.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(global_asset('assets/css/colors/default.css')); ?>" rel="stylesheet">

		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo e(global_asset('assets/css/colors/color.css')); ?>">

		<!-- Select2 css-->
		<link href="<?php echo e(global_asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">

		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="<?php echo e(global_asset('assets/plugins/multipleselect/multiple-select.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(global_asset('assets/custom/tenant/app.css')); ?>">

		
		<link href="<?php echo e(global_asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')); ?>" rel="stylesheet" />
		<link href="<?php echo e(global_asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css')); ?>"  rel="stylesheet">
		<link href="<?php echo e(global_asset('assets/plugins/datatable/css/responsive.bootstrap5.css')); ?>" rel="stylesheet" />

		
		<link href="<?php echo e(global_asset('assets/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet"/>

		
		<link href="<?php echo e(global_asset('assets/plugins/sweet-alert/sweetalert.css')); ?>" rel="stylesheet">

		
		<link href="<?php echo e(global_asset('assets/plugins/treeview/treeview.css')); ?>" rel="stylesheet">

		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

		
		<link href="<?php echo e(global_asset('assets/plugins/darggable/jquery-ui-darggable.css')); ?>" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />




        <!-- Scripts -->
		<?php echo app('Illuminate\Foundation\Vite')([]); ?>
		<style>
			/* Customized the Default Primary */
			.bg-primary, .btn-primary, .table-primary, #back-to-top, .page-item.active .page-link {
				background-color: #51B3DE !important;
				color: #fff !important;
				border-color: #51B3DE !important;
			}
			/* Custom Select */
			.select2-selection {
				border: 1px solid #E5E8EB !important;
				border-radius: 0px !important;
				min-height: 40px !important;
				height: auto !important;
				font-size: 16px !important;
				color: #353535 !important;
				background-color: #E5E8EB !important;
			}

			.select2-selection__choice{
				color: white !important;
				background-color: #51B3DE !important;
			}

			.select2-selection__choice__remove{
				border: none!important;
				border-radius: 0!important;
				padding: 0 2px!important;
			}

			.select2-selection__choice__remove:hover{
				background-color: transparent!important;
				color: #ef5454 !important;
			}

			/* Custom Btn */
			.btn-c{
				font-size: 18px !important;
				border-radius: 0px !important;
			}

			.switch-c {
				transform: scale(2);
			}

			/* Custom Datatable Filter */
			.dataTables_filter input{
				border: 1px solid gray !important;
				border-radius: 0px !important;
				color: #353535 !important;
			}

			/* Custom Length Datatable */
			.dataTables_length select{
				border: 1px solid gray !important;
				border-radius: 0px !important;
				color: #353535 !important;
			}

			/* Custom Color Thead of all Tables */
			.table-bordered > thead > tr > th{
				color: white !important;
			}

			.imagePreview{
				width: 150px;
				height: 150px;
				border: 2px dotted black;
				border-radius: 5px;
			}

			.image-container {
				position: relative;
				display: inline-block;
				cursor: pointer;
			}

			.icon-button-top {
				position: absolute;
				top: 0;
				right: 0;
				border: 1px solid #ccc;
				border-radius: 50%;
				transform: translate(50%, -50%); /* Move the button up and to the right */
				box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Cute shadow for the bottom icon */
				background-color: white;
				padding: 5px;
				justify-content: center;
				display: flex;
				color: gray;
			}

			.icon-button-bottom{
				position: absolute;
				bottom: 0;
				right: 0;
				border: 1px solid #ccc;
				border-radius: 50%;
				transform: translate(50%, 50%); /* Move the button up and to the right */
				box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Cute shadow for the bottom icon */
				background-color: white;
				padding: 5px 6.5px;
				justify-content: center;
				display: flex;
				color: #c1c1c1;
			}

			.sortable {
				list-style: none;
				padding: 0;
			}
			.sortable li {
				position: relative;
				padding: 5px;
				border: 1px solid #ccc;
				margin: 5px 0;
			}

			/* .table {
				border: 0.5px solid grey;
			}
			.table-bordered > tbody > tr > th,
			.table-bordered > tfoot > tr > th,
			.table-bordered > thead > tr > td,
			.table-bordered > tbody > tr > td,
			.table-bordered > tfoot > tr > td {
				border: 0.1px solid grey;
			} */
		</style>
	</head>

	<body class="horizontalmenu bg-light">

		<!-- Loader -->
		<div id="global-loader">
			<img src="<?php echo e(global_asset('assets/img/loader.svg')); ?>" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">

			<?php echo $__env->make('tenant.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<!-- Main Content-->
			<div class="main-content pt-0">



                <?php echo $__env->yieldContent('content'); ?>
			</div>
			<!-- End Main Content-->

			<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © <?php echo e(date('Y')); ?> <a href="#">Monty's Locksmith</a>. Powered by <a target="_blank" href="https://montyslocksmith.ca">Monty's Locksmith</a> All rights reserved.</span>
						</div>
					</div>
				</div>
			</div>
			<!--End Footer-->

		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

		<!-- Jquery js-->
		<script src="<?php echo e(global_asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>

		<!-- Bootstrap js-->
		<script src="<?php echo e(global_asset('assets/plugins/bootstrap/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

		<!-- Internal Chart.Bundle js-->
		<script src="<?php echo e(global_asset('assets/plugins/chart.js/Chart.bundle.min.js')); ?>"></script>

		<!-- Peity js-->
		<script src="<?php echo e(global_asset('assets/plugins/peity/jquery.peity.min.js')); ?>"></script>

		<!-- Select2 js-->
		<script src="<?php echo e(global_asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/js/select2.js')); ?>"></script>

		<!-- Perfect-scrollbar js -->
		

		<!-- Sidemenu js -->
		

		<!-- Sidebar js -->
		<script src="<?php echo e(global_asset('assets/plugins/sidebar/sidebar.js')); ?>"></script>

		<!-- Internal Morris js -->
		<script src="<?php echo e(global_asset('assets/plugins/raphael/raphael.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/morris.js/morris.min.js')); ?>"></script>

		<!-- Circle Progress js-->
		
		

		<!-- Internal Dashboard js-->
		

		<!-- Sticky js -->
		<script src="<?php echo e(global_asset('assets/js/sticky.js')); ?>"></script>

		<!-- Custom js -->
		<script src="<?php echo e(global_asset('assets/js/custom.js')); ?>"></script>

		
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/pdfmake/pdfmake.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/pdfmake/vfs_fonts.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/dataTables.responsive.min.js')); ?>"></script>
		<script src="<?php echo e(global_asset('assets/plugins/datatable/responsive.bootstrap5.min.js')); ?>"></script>

		
		<script src="<?php echo e(global_asset('assets/plugins/notify/js/notifIt.js')); ?>"></script>

		
		<script src="<?php echo e(global_asset('assets/plugins/sweet-alert/sweetalert.min.js')); ?>"></script>

		
		<script src="<?php echo e(global_asset('assets/plugins/treeview/treeview.js')); ?>"></script>

		
		<script src="<?php echo e(global_asset('assets/plugins/darggable/jquery-ui-darggable.min.js')); ?>"></script>
		
		

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

		<script>
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
			});

			$(document).ready(function(){

				$.extend(true, $.fn.dataTable.defaults, {
					pageLength: 50,
					lengthMenu: [
						[50, 100, 500, -1],
						[50, 100, 500, 'All']
					],
					language: {
                        search: "", searchPlaceholder: "Search...",
                    },
				});

				var open_url = '<?php echo e(Request::path()); ?>'
				var open_urlREC = $('a[href*="/'+open_url+'"]').attr("cstmname")
				var open_urlParREC = $('a[href*="/'+open_url+'"]').attr("cstmParname")
				if (open_urlParREC != 'false') {
					$('.open_urlPar').html(open_urlParREC+' > ');
				}else{
					$('.open_urlPar').html('');
				}
				if(open_urlREC == 'Quote Generator'){
					$('.open-urlGPar').css('visibility', 'hidden')
				}
				$('.open-url').html(open_urlREC);
			});
		</script>
		<?php echo $__env->yieldPushContent('script'); ?>
	</body>
</html>
<?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/layouts/main.blade.php ENDPATH**/ ?>