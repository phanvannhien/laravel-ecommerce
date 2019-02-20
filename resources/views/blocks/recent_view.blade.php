<div class="row">
    @foreach( $recents as $recent )
        <?php $post = $recent->product ?>
        <div class="col-md-6">
            @include('blocks.post_item')
        </div>
    @endforeach
</div>
