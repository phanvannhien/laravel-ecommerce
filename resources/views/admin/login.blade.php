<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin/dist/css/AdminLTE.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#">
            TP
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
    <form class="form" method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('ĐĂNG NHẬP') }}">
        @csrf
        <div class="form-group">

            <input id="user_name" type="text" class="form-control input-lg {{ $errors->has('user_name') ? ' is-invalid' : '' }}"
                   name="user_name" value="{{ old('user_name') }}" required autofocus placeholder="Tên đăng nhập">

            @if ($errors->has('user_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('user_name') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">

            <input id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" required placeholder="Password">

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
            @endif

        </div>

        <div class="form-group">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

        </div>

        <div class="form-group mb-0">

            <button type="submit" class="btn btn-lg btn-block btn-success">
                {{ __('Login') }}
            </button>

        </div>
    </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ url('admin/bower_components/jquery/dist/jquery.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>


</body>
</html>
