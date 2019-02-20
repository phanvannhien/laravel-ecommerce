@extends('layouts.app')

@section('main')
<div class="py-4">
    <div id="search-area" class="mb-4">
        <div class="container">
            @include('partials.search')
        </div>
    </div>
    <div class="container">
        <div class="block">
            <div class="block-head">
                <h3>Tin mới</h3>
            </div>
            <div class="block-body">
                {!! App\Helpers\Render::renderPost( $lastest ) !!}
            </div>
        </div>

    </div>
</div>

@stop