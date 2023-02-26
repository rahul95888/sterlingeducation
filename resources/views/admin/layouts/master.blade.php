<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title', config('app.name'))</title>
    @include('admin.layouts.partials.meta_tags')
    @include('admin.layouts.partials.styles')
	@yield('styles')
	<style>
		.toast:not(.showing):not(.show) {
			opacity: 1 !important;
		}
		thead{
			/*#3eab12*/
			background-color: #008cff;
			color: white;
		}
		.sidebar-wrapper .metismenu a{
			padding: 5px 15px !important;
		}
		.page-content {
			padding: 0 15px 0 15px !important;
		}
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		@include("admin.layouts.partials.header")
		<!--end header -->
		<!--navigation-->
		@include("admin.layouts.partials.navbar")
		<!--end navigation-->
		<!--start page wrapper -->
		@yield("admin-content")
		<!--end page wrapper -->
        @include("admin.layouts.partials.footer")
	</div>
	<!--end wrapper-->
    @include('admin.layouts.partials.scripts')

	@yield("scripts")
<script>
	$(document).ready(function(){
		function isFloat(evt) {
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			} else {
				//if dot sign entered more than once then don't allow to enter dot sign again. 46 is the code for dot sign
				let parts = evt.srcElement.value.split('.');
				if (parts.length > 1 && charCode == 46) {
					return false;
				}
				return true;

			}
		}
	});
</script>
</body>

</html>
