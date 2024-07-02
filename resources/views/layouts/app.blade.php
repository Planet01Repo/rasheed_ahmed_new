<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Admin Panel {{isset($title) ? $tilte : '' }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('assets/admin/img/favicon.png') }}" type="image/x-icon" />
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="{{ asset('assets/admin/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ asset('assets/admin/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/boostrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/animate.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->
<!-- BEGIN CSS TEMPLATE -->
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/responsive.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/css/custom-icon-set.css') }}" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->

<!-- Start My plugin validation -->
<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/validation/toastr.css') }}">
<!-- end My plugin validation -->

<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/validation/jquery-validate/css/jquery.validate.css') }}">
<script type="text/javascript" src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

<script src="{{ asset('assets/admin/myplugin/validation/jquery-validate/js/jquery.validate.js') }}"></script>

<!-- start My plugin loader -->
<link rel="stylesheet" href="{{ asset('assets/admin/myplugin/loader/css/main.css') }}">
<!-- end My plugin loader -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="error-body no-top">
<div class="loading-wrapper">
    <div class="loading"></div>
</div>

@yield('content')

<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->

<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/login.js') }}" type="text/javascript"></script>
<!-- BEGIN CORE TEMPLATE JS -->
<!-- END CORE TEMPLATE JS -->
<script src="{{ asset('assets/admin/myplugin/validation/custom.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/validation/jquery.browser.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/validation/jquery.form.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/validation/toastr.js') }}"></script>
<!-- end My plugin validation -->

<!-- start My plugin loader -->
<script src="{{ asset('assets/admin/myplugin/loader/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
<script src="{{ asset('assets/admin/myplugin/loader/js/loader.js') }}"></script>
<!-- end My plugin loader -->


</body>
</html>
       