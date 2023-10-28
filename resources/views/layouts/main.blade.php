<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
			
		<!-- Favicon -->
		<link rel="icon" href="assets/img/brand/new-favicon-45x45.ico" type="image/x-icon"/>
		
		<!-- Title -->
		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Bootstrap css-->
		<link href="{{ global_asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="{{ global_asset('assets/plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
		<link href="{{ global_asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ global_asset('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>

		<!-- Style css-->
		<link href="{{ global_asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ global_asset('assets/css/boxed.css') }}" rel="stylesheet" />
		<link href="{{ global_asset('assets/css/dark-boxed.css') }}" rel="stylesheet" />
		<link href="{{ global_asset('assets/css/skins.css') }}" rel="stylesheet">
		<link href="{{ global_asset('assets/css/dark-style.css') }}" rel="stylesheet">
		<link href="{{ global_asset('assets/css/colors/default.css') }}" rel="stylesheet">

		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ global_asset('assets/css/colors/color.css') }}">

		<!-- Select2 css-->
		<link href="{{ global_asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="{{ global_asset('assets/plugins/multipleselect/multiple-select.css') }}">
		<link rel="stylesheet" href="{{ global_asset('assets/custom/app.css') }}">

		{{-- Datatable --}}
		<link href="{{ global_asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
		<link href="{{ global_asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}"  rel="stylesheet">
		<link href="{{ global_asset('assets/plugins/datatable/css/responsive.bootstrap5.css') }}" rel="stylesheet" />

		{{-- Notifications --}}
		<link href="{{ global_asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>

		{{-- Sweet Alert --}}
		<link href="{{ global_asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
		
		{{-- Tree View --}}
		<link href="{{ global_asset('assets/plugins/treeview/treeview.css') }}" rel="stylesheet">
		
		{{-- Animate css --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

		{{-- draggable --}}
		<link href="{{ global_asset('assets/plugins/darggable/jquery-ui-darggable.css') }}" rel="stylesheet">

		<!-- Scripts -->
		@vite([])
		<style>
			.bg-primary, .btn-primary, .table-primary, #back-to-top, .page-item.active .page-link {
				background-color: #51B3DE !important;
				color: #fff !important;
				border-color: #51B3DE !important;
			}
			.form-control-c{
				border: 1px solid gray !important;
				border-radius: 0px !important;
				height: 40px !important;
				font-size: 16px !important;
				color: #353535 !important;
			}
			.select2-selection {
				border: 1px solid gray !important;
				border-radius: 0px !important;
				height: 40px !important;
				font-size: 16px !important;
				color: #353535 !important;
			}
			.btn-c{
				font-size: 18px !important;
				border-radius: 0px !important;
			}
			.dataTables_filter input{
				border: 1px solid gray !important;
				border-radius: 0px !important;
				color: #353535 !important;
			}

			.dataTables_length select{
				border: 1px solid gray !important;
				border-radius: 0px !important;
				color: #353535 !important;
			}

			.table-bordered > thead > tr > th{
				color: white !important;
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
			<img src="{{ global_asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">

			@include('tenant.navbar')

			<!-- Main Content-->
			<div class="main-content pt-0">
				<div class="container-fluid padding-top-10">
					# <span class="open_urlPar"></span><span class="open-url text-capitalize"></span>
				</div>
                @yield('content')
			</div>
			<!-- End Main Content-->

			<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © {{ date('Y') }} <a href="#">Monty's Locksmith</a>. Powered by <a target="_blank" href="https://montyslocksmith.ca">Monty's Locksmith</a> All rights reserved.</span>
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
		<script src="{{ global_asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap js-->
		<script src="{{ global_asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- Internal Chart.Bundle js-->
		<script src="{{ global_asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

		<!-- Peity js-->
		<script src="{{ global_asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

		<!-- Select2 js-->
		<script src="{{ global_asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		<script src="{{ global_asset('assets/js/select2.js') }}"></script>

		<!-- Perfect-scrollbar js -->
		<script src="{{ global_asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

		<!-- Sidemenu js -->
		<script src="{{ global_asset('assets/plugins/sidemenu/sidemenu.js') }}" id="leftmenu"></script>

		<!-- Sidebar js -->
		<script src="{{ global_asset('assets/plugins/sidebar/sidebar.js') }}"></script>

		<!-- Internal Morris js -->
		<script src="{{ global_asset('assets/plugins/raphael/raphael.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/morris.js/morris.min.js') }}"></script>

		<!-- Circle Progress js-->
		<script src="{{ global_asset('assets/js/circle-progress.min.js') }}"></script>
		<script src="{{ global_asset('assets/js/chart-circle.js') }}"></script>

		<!-- Internal Dashboard js-->
		<script src="{{ global_asset('assets/js/index.js') }}"></script>

		<!-- Sticky js -->
		<script src="{{ global_asset('assets/js/sticky.js') }}"></script>

		<!-- Custom js -->
		<script src="{{ global_asset('assets/js/custom.js') }}"></script>

		{{-- Datatable --}}
		<script src="{{ global_asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="{{ global_asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

		{{-- Notification --}}
		<script src="{{ global_asset('assets/plugins/notify/js/notifIt.js') }}"></script>

		{{-- Sweet Alert --}}
		<script src="{{ global_asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
		
		{{-- Treeview --}}
		<script src="{{ global_asset('assets/plugins/treeview/treeview.js') }}"></script>

		{{-- Draggable --}}
		<script src="{{ global_asset('assets/plugins/darggable/jquery-ui-darggable.min.js') }}"></script>
		{{-- <script src="{{ global_asset('assets/plugins/jquery-sortable/source/js/jquery-sortable.js') }}"></script> --}}
		{{-- <script src="{{ global_asset('assets/plugins/jquery-sortable/source/js/jquery-sortable.min.js') }}"></script> --}}

		<script>
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
			});

			$(document).ready(function(){
	
				var open_url = '{{Request::path()}}'
				var open_urlREC = $('a[href*="/'+open_url+'"]').attr("cstmname")
				var open_urlParREC = $('a[href*="/'+open_url+'"]').attr("cstmParname")
				if (open_urlParREC != 'false') {
					$('.open_urlPar').html(open_urlParREC+' > ');
				}else{
					$('.open_urlPar').html('');
				}
				$('.open-url').html(open_urlREC);
			});
		</script>
		@stack('script')
	</body>
</html>