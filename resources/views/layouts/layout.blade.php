<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Admin Panel {{isset($title) ? '| '.$title : '' }}</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('assets/admin/img/favicon.png') }}" type="image/x-icon" />


<!-- BEGIN Form element PLUGIN CSS -->
<link href="{{ asset('assets/admin/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ asset('assets/admin/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/plugins/ios-switch/ios7-switch.css') }}" rel="stylesheet" type="text/css" media="screen">
<link href="{{ asset('assets/admin/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ asset('assets/admin/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<!-- END Form element PLUGIN CSS -->
<!-- BEGIN datatable PLUGIN CSS -->
  <link href="{{ asset('assets/admin/plugins/jquery-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/admin/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<!-- END datatable PLUGIN CSS -->
<link href="{{ asset('assets/admin/plugins/jquery-metrojs/MetroJs.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/shape-hover/css/demo.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/shape-hover/css/component.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/owl-carousel/owl.carousel.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/owl-carousel/owl.theme.css') }}" />
<link href="{{ asset('assets/admin/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ asset('assets/admin/plugins/jquery-slider/css/jquery.sidr.light.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jquery-ricksaw-chart/css/rickshaw.css') }}" type="text/css" media="screen" >
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/Mapplic/mapplic/mapplic.css') }}" type="text/css" media="screen" >
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="{{ asset('assets/admin/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/boostrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/animate.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/responsive.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/custom-icon-set.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/magic_space.css') }}" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->


<!-- Start My plugin validation -->
<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/validation/toastr.css') }}">
<!-- end My plugin validation -->

<!-- start My plugin loader -->
<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/loader/css/main.css') }}">
<!-- end My plugin loader -->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/prettyPhoto/prettyPhoto.css') }}">
<script src="{{ asset('assets/admin/myplugin/prettyPhoto/jquery.prettyPhoto.js') }}" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/validation/jquery-validate/css/jquery.validate.css') }}">

<!-- sweetalert -->
<link href="{{ asset('assets/admin/myplugin/sweetalert/npm/sweetalert.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<script src="{{ asset('assets/admin/myplugin/sweetalert/npm/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/sweetalert/dist/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/admin/myplugin/validation/jquery-validate/js/jquery.validate.js') }}"></script>

<!-- fileuploader -->
    <link rel="stylesheet" href="{{ asset('assets/admin/myplugin/fileuploader/css/jquery.fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/myplugin/fileuploader/css/jquery.fileuploader-theme-dragdrop.css') }}">
    <script src="{{ asset('assets/admin/myplugin/fileuploader/js/jquery.fileuploader.js') }}"></script>
    @stack('custom-css')
<?php
if (@$uri == "dashboard") {
?>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/series-label.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
<?php
}
?>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
<!-- BEGIN BODY -->
<body class="error-body no-top">
<div class="loading-wrapper">
    <div class="loading"></div>
</div>

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
          <div class="iconset top-menu-toggle-white"></div>
          </a> </li>
      </ul>
      <a href="{{route('home')}}"><img src="{{ asset('assets/admin/img/logo.png') }}" class="logo" alt="" data-src="{{ asset('assets/admin/img/logo.png') }}" data-src-retina="{{ asset('assets/admin/img/logo.png') }}" width="150" height="35"></a>
     
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown" id="header_task_bar"> <a href="{{route('home')}}" class="dropdown-toggle active" data-toggle="">
          <div class="iconset top-home"></div>
          </a> </li>
        <li class="dropdown" id="portrait-chat-toggler" style="display:none"> <a href="#sidr" class="chat-menu-toggle">
          <div class="iconset top-chat-white "></div>
          </a> </li>
      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav" >
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <style type="text/css">
          .header .chat-toggler{
            top: 12px;
             margin-right: 0px; 
            min-width:auto;
          }
        </style>
 
      </div>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
@include('includes.sidebar')
            @yield('content')

</div>

<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/breakpoints.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-block-ui/jqueryblockui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-lazyload/jquery.lazyload.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('assets/admin/plugins/jquery-slider/jquery.sidr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-ricksaw-chart/js/raphael-min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-ricksaw-chart/js/d3.v2.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-ricksaw-chart/js/rickshaw.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-sparkline/jquery-sparkline.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/skycons/skycons.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/Mapplic/js/jquery.easing.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/Mapplic/js/jquery.mousewheel.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/Mapplic/js/hammer.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/Mapplic/mapplic/mapplic.js') }}" type="text/javascript"></script>
    
<script src="{{ asset('assets/admin/plugins/jquery-flot/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-metrojs/MetroJs.min.js') }}" type="text/javascript" ></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN Form element PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-autonumeric/autoNumeric.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<!-- END Form element PAGE LEVEL PLUGINS -->

<!-- BEGIN datatable PAGE LEVEL JS -->
<script src="{{ asset('assets/admin/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>    
<script src="{{ asset('assets/admin/plugins/jquery-block-ui/jqueryblockui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('assets/admin/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript" ></script>
<script type="text/javascript" src="{{ asset('assets/admin/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/datatables.js') }}" type="text/javascript"></script>
<!-- END datatable PAGE LEVEL PLUGINS -->

<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ asset('assets/admin/js/core.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/chat.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/myplugin/validation/custom.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/validation/jquery.browser.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/validation/jquery.form.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/validation/toastr.js') }}"></script> 
<!-- end My plugin validation -->

<!-- start My plugin loader -->
<script src="{{ asset('assets/admin/myplugin/loader/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/loader/js/loader.js') }}"></script>
<!-- end My plugin loader -->
 <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

@if (@$ckeditor == "yes")
<script type="text/javascript">
  CKEDITOR.replace('myeditor');
  
</script>
@endif

<script type="text/javascript">
$(document).ready(function () {
   
      $(function () {
    // $(".allow_decimal").keydown(function (event) {
    $(document).on('keydown', ".allow_decimal", function(event) {



        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

        } else {
            event.preventDefault();
        }

        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault(); 
        //if a decimal has been added, disable the "."-button

    });
    
    $(".txtboxToFilterCustom").on('keyup keydown keypress', function (e) {
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 110) {
	        // let it happen, don't do anything
	        // console.log("if---"+event.keyCode);
	    }
	    else {
	    	// console.log("else---"+event.keyCode);
	        // Ensure that it is a number and stop the keypress
	        if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) ) {
	        	// console.log("else---if---"+event.keyCode);
	            event.preventDefault();
	        }
	    }
	});
});

    $(".live-tile,.flip-list").liveTile();

    // $('#example3').dataTable();
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').html("<img src='"+e.target.result+"' width='200px'/>"); 
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img_src").change(function(){
        if($(this).val() != ""){
            readURL(this);
        }else{
            $('#preview').html(" ");
        }
    });

    function readURL2(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview2').html("<img src='"+e.target.result+"' width='200px'/>"); 
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img_src2").change(function(){
        if($(this).val() != ""){
            readURL2(this);
        }else{
            $('#preview2').html(" ");
        }
    });

    // $('#example3').dataTable();
});

function printErrorMsg(msg,container) {
      $(container).html('<ul style="list-style:none" class="pl-0"></ul>');
      $(container).css('display','block');
      if(typeof msg === 'string' || msg instanceof String){
        $(container).find("ul").append('<li>'+msg+'</li>');
        return;
      }
      $.each( msg, function( key, value ) {
         $(container).find("ul").append('<li>'+value+'</li>');
      });
}
</script>
 @yield('footer')
</body>
</html>