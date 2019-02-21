<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin/dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('admin/dist/css/skins/_all-skins.min.css') }}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/select2/dist/css/select2.min.css') }}">

    <link href="{{ url('admin/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ url('admin/plugins/iCheck/all.css') }}">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/dist/custom.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script>
        var ajax = {
            district : '{{ route('ajax.district') }}',
            ward: '{{ route('ajax.ward') }}',
            add_favorite: '{{ route('ajax.add_favorite') }}',
            add_friend: '{{ route('ajax.add_friend') }}',
        }
    </script>
</head>
<body class="skin-blue sidebar-mini">
<div id="app" class="wrapper">