<form action="">
    @csrf
    <p class="clearfix">

        <a href="{{ route('user.edit', $user->id ) }}" class="btn btn-sm btn-warning">
            <i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>

        <a  href="{{ route('user.index') }}" class="btn btn-sm btn-info pull-right">
            <i class="fa fa-backward"></i> Quay lại
        </a>
    </p>
</form>