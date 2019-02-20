<div id="user-post-related" class="owl-carousel owl-nav-middle">
    @foreach( $posts as $post )
        <div class="owl-post">
            @include('blocks.post_item_grid')
        </div>
    @endforeach
</div>

