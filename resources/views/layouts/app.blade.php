<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('libs/owl2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('libs/owl2/assets/owl.theme.default.min.css') }}">
    @yield('header')
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
        var ajax = {
            district : '{{ route('ajax.district') }}',
            ward: '{{ route('ajax.ward') }}',
            add_favorite: '{{ route('ajax.add_favorite') }}',
            add_friend: '{{ route('ajax.add_friend') }}',
        }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132922098-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-132922098-1');
    </script>


</head>
<body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '{{ config('services.facebook')['facebook_app_id'] }}',
                cookie     : true,
                xfbml      : true,
                version    : 'v3.2'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>
    <div id="app">
        @include('partials.header')
        <main>
        @yield('main')
        </main>
        @include('partials.footer')
    </div>
    @if( Auth::check() )
        @include('members.partials.slide_nav')
    @endif
    @if( Auth::check() )
        <div id="chat-room" data-user="{{ Auth::user() }}"></div>
    @else
        
    @endif

    <div id="loading" class="d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ url('libs/owl2/owl.carousel.min.js') }}"></script>

    @yield('footer')

    @if( !Auth::check() )
        @include('popup.login')
        @include('popup.register')

        <script>

            function statusChangeCallback(response) {

                // The response object is returned with a status field that lets the
                // app know the current login status of the person.
                // Full docs on the response object can be found in the documentation
                // for FB.getLoginStatus().
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

            // Google login
            var googleUser = {};
            var startApp = function() {
                gapi.load('auth2', function(){
                    // Retrieve the singleton for the GoogleAuth library and set up the client.
                    auth2 = gapi.auth2.init({
                        client_id: '{{ config('services.google')['client_id'] }}',
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

            startApp();
        </script>

    @endif

</body>
</html>

