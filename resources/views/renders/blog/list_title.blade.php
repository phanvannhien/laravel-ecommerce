<ul>
    @foreach( $posts as $post )
        <li>
            <a href="{{ route('blog.detail') }}" title="{{ $blog->blog_title }}">{{ $blog->blog_title }}</a>
        </li>
    @endforeach
</ul>