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
                        <form class="forms-sample" method="POST" action="{{ route('user.profile.save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="full_name">Tên đầy đủ</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name"  value="{{ $user->full_name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gender">Giới tính</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option {{ $user->gender == 0 ? 'selected' : '' }} value="0">Nữ</option>
                                            <option {{ $user->gender == 1 ? 'selected' : '' }} value="1">Nam</option>
                                            <option {{ $user->gender == 2 ? 'selected' : '' }} value="2">Khác</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="user_name">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" readonly value="{{ $user->user_name }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"  value="{{ $user->phone }}">
                            </div>

                            <?php
                            $carbon = new \Carbon\Carbon($user->dob);
                            ?>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="full_name">Ngày sinh</label>
                                        <select class="dob day form-control" name="day" id="">
                                            <option value="">Ngày Sinh</option>
                                            @for( $i = 1; $i <= 31 ; $i++ )
                                                <option {{ $carbon->day == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="full_name">Tháng sinh</label>
                                        <select class="dob month form-control" name="month" id="">
                                            <option value="">Tháng Sinh</option>
                                            @for( $i = 1; $i <= 12 ; $i++ )
                                                <option {{ $carbon->month == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="col-sm-2">
                                        <label for="full_name">Năm sinh</label>
                                        <select class="dob year form-control" name="year" id="">
                                            <option value="">Năm Sinh</option>
                                            @for( $i = 1900 ; $i <= 2000 ; $i++ )
                                                <option {{ $carbon->year == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="office_address">Thành phố</label>
                                        <select id="sl-cities" name="matp" class="form-control select2" id="">
                                            @foreach( \App\Models\Cities::select('matp','name')->get() as $tp )
                                                <option {{ $user->matp == $tp->matp ? 'selected' : '' }} value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="office_address">Quận/ Huyện</label>
                                        <select id="sl-district" name="maqh" class="form-control select2" id="">
                                            @foreach( \App\Models\District::where('matp', $user->matp )->orderBy('name')->select('maqh','name')->get() as $qh )
                                                <option {{ $user->maqh == $qh->maqh ? 'selected' : '' }} value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="office_address">Phường xã</label>
                                    <select id="sl-ward" name="xaid" class="form-control select2" id="">
                                        @foreach( \App\Models\Wards::where('maqh', $user->maqh )->orderBy('name')->select('xaid','name')->get() as $xa )
                                            <option {{ $user->xaid == $xa->xaid ? 'selected' : '' }} value="{{ $xa->xaid }}">{{ $xa->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address"  value="{{ $user->address }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
