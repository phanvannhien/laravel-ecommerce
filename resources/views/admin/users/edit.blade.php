@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('app.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('admin.users.partials.nav')
        @include('admin.partials.messages')

        <form action="{{ route('user.update', $user->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            @csrf


        <div class="row">
            <div class="col-sm-9">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="user_name">@lang('user.user_name')</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" readonly value="{{ $user->user_name }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">@lang('user.phone')</label>
                            <input type="text" class="form-control" id="phone" name="phone"  value="{{ $user->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="full_name">@lang('user.full_name')</label>
                            <input type="text" class="form-control" id="full_name" name="full_name"  value="{{ $user->full_name }}">
                        </div>

                        <?php
                            $carbon = new \Carbon\Carbon($user->dob, 'Asia/Ho_Chi_Minh');
                        ?>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="">@lang('user.dob')</label>
                                    <select class="dob day form-control" name="day" id="">
                                        @for( $i = 1; $i <= 31 ; $i++ )
                                            <option {{ $carbon->day == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                </div>
                                <div class="col-sm-2">
                                    <label for="">@lang('user.month')</label>
                                    <select class="dob month form-control" name="month" id="">
                                        @for( $i = 1; $i <= 12 ; $i++ )
                                            <option {{ $carbon->month == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                </div>
                                <div class="col-sm-2">
                                    <label for="">@lang('user.year')</label>
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
                                    <label for="office_address">@lang('app.city')</label>
                                    <select id="sl-cities" name="matp" class="form-control select2" id="">
                                        @foreach( \App\Models\Cities::select('matp','name')->get() as $tp )
                                            <option {{ $user->matp == $tp->matp ? 'selected' : '' }} value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="office_address">@lang('app.district')</label>
                                    <select id="sl-district" name="maqh" class="form-control select2" id="">
                                        @foreach( \App\Models\District::where('matp', $user->matp )->orderBy('name')->select('maqh','name')->get() as $qh )
                                            <option {{ $user->maqh == $qh->maqh ? 'selected' : '' }} value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="office_address">@lang('app.ward')</label>
                                <select id="sl-ward" name="xaid" class="form-control select2" id="">
                                    @foreach( \App\Models\Wards::where('maqh', $user->maqh )->orderBy('name')->select('xaid','name')->get() as $xa )
                                        <option {{ $user->xaid == $xa->xaid ? 'selected' : '' }} value="{{ $xa->xaid }}">{{ $xa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">@lang('user.address')</label>
                            <input type="text" class="form-control" id="address" name="address"  value="{{ $user->address }}">
                        </div>
                    </div>
                </div>



            </div>

            <div class="col-md-3">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">@lang('user.status')</label>
                            <select name="status" id="" class="form-control">
                                <option {{ $user->status == 1 ? 'selected' : '' }} value="1">@lang('app.locked')</option>
                                <option {{ $user->status == 0 ? 'selected' : '' }} value="0">@lang('app.un_locked')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">@lang('user.locked')</label>
                            <select name="locked" id="" class="form-control">
                                <option {{ $user->locked == 1 ? 'selected' : '' }} value="1">@lang('app.locked')</option>
                                <option {{ $user->locked == 0 ? 'selected' : '' }} value="0">@lang('app.un_locked')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">@lang('user.group')</label>

                            <select name="role" id="" class="form-control">
                                <option value="">@lang('app.select')</option>
                                @foreach( \App\Models\Role::all() as $role )
                                <option {{ $user->hasRole($role->name) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                <i class="fa fa-save"></i> @lang('app.save')
                            </button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>
    <!-- /.content -->

@stop
