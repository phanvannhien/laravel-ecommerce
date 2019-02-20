<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ url('images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('members/login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('members/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('members/login/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('members/login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('members/login/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="animsition container-login100"
     data-animsition-in-class="fade-in"
     data-animsition-in-duration="1000"
     data-animsition-out-class="fade-out"
     data-animsition-out-duration="800"
     style="background-image: url('{{ url('members/login/images/bg-01.jpg') }} ');">
    @yield('main')
</div>



<script src="{{ url('members/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ url('members/login/vendor/animsition/js/animsition.min.js')}}"></script>
<script src="{{ url('members/login/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{ url('members/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ url('members/login/js/main.js')}}"></script>


<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script>

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '{{ Config::get('services.facebook')['facebook_app_id'] }}',
            cookie     : true,
            xfbml      : true,
            version    : 'v2.12'
        });

        FB.AppEvents.logPageView();
    };

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {

        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            loginFacebook();
        }
    }

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }


    function loginFacebook() {
        FB.logout(function(response) {
            // Person is now logged out
        });
        FB.api('/me?fields=id,name,email', function(response) {

            if (response){
                response.provider = 'facebook';

                if( !response.email ){
                    toastr.error('Please approved for your email');
                    return false;
                }else{
                    $.ajax({
                        url: '<?php echo route('ajax.social.login') ?>',
                        method: 'post',
                        dataType: 'json',
                        data: {
                            social_data: response
                        },
                        beforeSend: function(){
                            $('body').addClass('loading');
                        },
                        success: function( response_data ){
                            $('body').removeClass('loading');
                            console.log( response_data );
                            if( response_data.success ){
                                window.location.reload();
                            }
                        }

                    })
                }


            }

        });
    }

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function(){
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: '876424026322-3jiq23ovkl75ekp2nkrtjevk9hc2035q.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('social-login-google'));
        });
    };

    function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
                var profile = googleUser.getBasicProfile();
                $.ajax({
                    url: '<?php echo route('ajax.social.login') ?>',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        social_data: {
                            id: profile.getId(),
                            name: profile.getName(),
                            email: profile.getEmail(),
                            provider: 'google'
                        }
                    },
                    beforeSend: function(){
                        $('body').addClass('loading');
                    },
                    success: function( response_data ){
                        console.log( response_data );
                        if( response_data.success ){
                            window.location.reload();
                        }
                    }

                })
            }, function(error) {
                alert(JSON.stringify(error, undefined, 2));
            });
    }

    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        $.ajax({
            url: '<?php echo route('ajax.social.login') ?>',
            method: 'post',
            dataType: 'json',
            data: {
                social_data: {
                    id: profile.getId(),
                    name: profile.getName(),
                    email: profile.getEmail(),
                    provider: 'google'
                }
            },
            success: function( response_data ){
                console.log( response_data );
                if( response_data.success ){
                    window.location.reload();
                }
            }

        })

        //console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        //console.log('Name: ' + profile.getName());
        //console.log('Image URL: ' + profile.getImageUrl());
        //console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }

    //startApp();


</script>


</body>
</html>