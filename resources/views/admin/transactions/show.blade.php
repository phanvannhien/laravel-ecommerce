@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Giao dịch: #{{ $transaction->transaction_id }}</h1>
    </section>
    <section class="content">
    <!-- Main content -->
    <form action="{{ route('admin.transaction.store', $transaction->transaction_id) }}" method="post">
        @csrf

        <p class="clearfix">

            <a href="{{ route('admin.transaction') }}" class="pull-right btn btn-info">Quay lại</a>
            @if( $transaction->status == 'waiting')
                <button type="submit" name="set_status" value="done" class="btn btn-success">XÁC NHẬN</button>
                <button type="submit" name="set_status" value="cancel" class="btn btn-danger">HUỶ GIAO DỊCH</button>
            @endif

            

        </p>



        <div class="row">
            <div class="col-sm-8">

                <div class="box">
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                <span class="pull-right">
                                    Trạng thái: {!! $transaction->getStatusText() !!}
                                </span>
                                <dt>Lệnh thực hiện</dt>
                                    <dd>{!! $transaction->getUserAction() !!}</dd>
                                <dt>Từ thành viên</dt>
                                    <dd><a href="{{ route('user.show',['user_id' => $transaction->user->id ]) }}">
                                        {{ $transaction->user->user_name }}</a></dd>
                                <dt>Đến Thành viên</dt>
                                    <dd class="text-danger">
                                        @if( $transaction->user_id == $transaction->to_user_id )
                                            Ví
                                        @else
                                            <a href="{{ route('user.show', $transaction->toUser->user_id ) }}">{{ $transaction->toUser->user_name }}</a>
                                        @endif
                                    </dd>
                                <dt>Số tiền</dt>
                                    <dd class="text-danger">{!! $transaction->getMoneyText() !!}</dd>
                                <dt>Ngày đặt lệnh</dt>
                                <dd class="">{{ $transaction->created_at }}</dd>


                            </dl>

                            <p>Loại giao dịch: {{ $transaction->getPaymentMethod() }} công ty</p>
                            @php
                                if( $transaction->transaction_type == 'bank_transfer' && $transaction->user_action == 'NAPTIEN'  ){
                                    $info = \App\PaymentBank::findOrFail($transaction->transaction_type_id);

                                }

                            @endphp

                            @if( $transaction->transaction_type == 'bank_transfer' && $transaction->user_action == 'NAPTIEN' )
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên ngân hàng</th>
                                        <th>Số tài khoản</th>
                                        <th>Chủ tài khoản</th>
                                        <th>Địa chỉ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $info->payment_bank_name }}
                                        </td>
                                        <td>
                                            {{ $info->payment_bank_acc_number }}
                                        </td>
                                        <td>
                                            {{ $info->payment_bank_acc_name }}
                                        </td>
                                        <td>
                                            {{ $info->payment_bank_acc_address }}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>

            </div>

        </div>

    </form>
    </section>

    <!-- /.content -->

@stop
