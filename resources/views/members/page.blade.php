@extends('layouts.app')
@section('main')
    @include('members.partials.top')
    <div id="user-page-container">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-stretch">
                @include('members.partials.sidebar')
                <div id="primary" class="col-md-9">
                    <div id="primary-inner" class="py-4">
                        @include('partials.messages')
                        @include('members.partials.toolbars')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection