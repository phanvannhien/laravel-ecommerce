@extends('layouts.app')

@section('main')
    <div id="top-user">
        <div class="container">
            <div id="user-wall-avatar">
                <img class="rounded-circle img-thumbnail mx-auto d-block" src="{{ $user->getAvatar() }}" alt="">
                <a class=""><i class="fas fa-camera"></i></a>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            @include('members.partials.sidebar_out')
            <div id="primary" class="col-md-9">
                <div id="primary-inner" class="py-4">
                    @include('partials.messages')
                    <h1 class="mb-4 text-uppercase">Bài đăng của: {{ $user->user_name }}</h1>
                    @include('blocks.post_list')


                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(function(){


        });


    </script>
@endsection