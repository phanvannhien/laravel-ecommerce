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
                        <form class="forms-sample" method="POST" action="{{ route('user.password.save') }}">
                            @csrf
                            <div class="form-group required">
                                <label for="InputPasswordCurrent">Mật khẩu cũ <sup class="text-danger"> * </sup> </label>
                                <input type="password" value="{{ old('old_pass') }}" name="old_pass" class="form-control"
                                       id="InputPasswordCurrent" placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu mới <sup class="text-danger">*</sup></label>
                                <input name="password"  value="{{ old('password') }}"  type="password" class="form-control"
                                       placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="">Nhắc lại Mật khẩu <sup class="text-danger">*</sup></label>
                                <input  value="{{ old('password_confirmation') }}"  name="password_confirmation" type="password"
                                        class="form-control" placeholder="******">
                            </div>

                            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
