<!-- BEGIN VENDOR JS-->
<script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('app-assets/js/plugins.js')}}"></script>
<script src="{{asset('app-assets/js/search.js')}}"></script>
<script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/data-tables.js')}}"></script>
<script src="{{asset('app-assets/vendors/notify/notify.min.js')}}"></script>
<!-- END PAGE LEVEL JS-->

<script>
//initialize all modals
$('.modal').modal({
    dismissible: true
});
</script>

@yield('content-js')

@yield('content-modal')