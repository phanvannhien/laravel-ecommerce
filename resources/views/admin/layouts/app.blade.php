@include('admin.partials.header')
@include('admin.partials.header_nav')
@include('admin.partials.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div style="padding: 10px;">
        @include('admin.partials.messages')
    </div>

    @yield('content')
</div>

<!-- /.content-wrapper -->
@include('admin.partials.main_footer')
@include('admin.partials.footer')