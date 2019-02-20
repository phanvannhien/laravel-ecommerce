@extends('layouts.app')


@section('main')
    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <h1>{{ $blog->blog_title }}</h1>
                    <p class="text-black-50"><i class="far fa-calendar-check"></i> {{ $blog->created_at }}</p>

                    <div class="bg-white border p-3 mb-4">
                        <h3>
                            {{ $blog->blog_excerpt }}
                        </h3>
                    </div>

                    <img src="{{ $blog->blog_thumbnail }}" class="img-thumbnail mb-4" alt="">

                    <div class="blog-content">
                        {!! $blog->blog_content !!}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

