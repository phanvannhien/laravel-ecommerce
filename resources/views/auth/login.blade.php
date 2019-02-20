@extends('layouts.app_auth')

@section('main')
	<div class="animsition container-login100"
		 data-animsition-in-class="fade-in"
		 data-animsition-in-duration="1000"
		 data-animsition-out-class="fade-out"
		 data-animsition-out-duration="800"
		 style="background-image: url('{{ url('members/login/images/bg-01.jpg') }} ');">
		<div class="wrap-login100 p-l-30 p-r-30 p-t-50 p-b-30">
			<form action="{{ route('login') }}" method="post" class="login100-form validate-form">
				@csrf
				<span class="login100-form-title p-b-37">
					@lang('user.login')
				</span>
				@include('members.partials.messages')

				<div class="wrap-input100 validate-input m-b-20" data-validate="@lang('user.phone')">
					<input autocomplete="off" class="input100"
						   value="{{ old('phone') }}"
						   type="tel" name="phone" placeholder="@lang('user.phone')">
					<span class="focus-input100"></span>

				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "@lang('user.password')">
					<input autocomplete="off"
						   value="{{ old('password') }}"
						   class="input100" type="password" name="password" placeholder="@lang('user.password')">
					<span class="focus-input100"></span>

				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						@lang('user.login')
					</button>
				</div>

				<div class="text-center p-t-30 p-b-20">
					<span class="txt1">
						@lang('Or login with')
					</span>
				</div>

				<div class="flex-c p-b-30">
					<a id="social-login-facebook"  href="javascript:;" onclick="FB.login(function(response) {if (response.status === 'connected') { loginFacebook();} },  {scope: 'public_profile,email',return_scopes: true, auth_type: 'rerequest',enable_profile_selector: true });"
					   class="login100-social-item">
						<i class="fa fa-facebook-f"></i>
					</a>

					<a href="javascript:;" id="social-login-google"
					   class="login100-social-item">
						<img src="{{ url('members/login/images/icons/icon-google.png')}}" alt="GOOGLE">
					</a>
				</div>

				<div class="text-center">
					<a href="{{ route('register') }}" class="txt2 hov1">
						@lang('user.register')
					</a>
				</div>
			</form>


		</div>
	</div>
@stop