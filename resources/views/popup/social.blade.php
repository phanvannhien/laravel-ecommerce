<p class="text-center">Hoặc đăng nhập với</p>
<p class="text-center">
    <a href="javascript:;" onclick="FB.login(function(response) {if (response.status === 'connected') { loginFacebook();} },  {scope: 'public_profile,email',return_scopes: true, auth_type: 'rerequest',enable_profile_selector: true });" id="social-login-facebook"
       class="btn btn-facebook btn-primary"><i class="fab fa-facebook"></i> Facebook</a>
    <a href="javascript:;" id="social-login-google"
       class="btn btn-google btn-primary"><i class="fab fa-google"></i> Google</a>
</p>
