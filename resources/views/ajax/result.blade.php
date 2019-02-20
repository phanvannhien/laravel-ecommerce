<h3 class="text-center mb-5 a-title">Kết quả Mẹ gửi điều ước - Bé rước niềm vui</h3>
<ul class="nav justify-content-center mb-4" id="p-tabs" role="tablist">

    <li class="">
        <a class="nav-link active"
            id="dot1-tab" data-toggle="tab"
            href="#dot1"
            role="tab" aria-controls="dot1"
            aria-selected="true">Đợt 1</a>
    </li>
    <li>
        <a class="nav-link"
        id="dot1-tab" data-toggle="tab"
        href="#dot2"
        role="tab" aria-controls="dot2"
        aria-selected="true">Đợt 2</a>
    </li>
</ul>
<div class="tab-content" id="p-tabs-content">
    <div class="tab-pane fade show active" id="dot1" role="tabpanel"
            aria-labelledby="dot1-tab">
        @if( $users1 )
            <div class="table-responsive">

            <table class="table table-tripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Bố/ Mẹ</th>
                        <th>Số điện thoại</th>
                        <th>Tên bé</th>
                        <th>Tuổi bé</th>
                        <th>Quà được nhận</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users1 as $user )
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ substr_replace($user->phone,'xxx',6,3) }}</td>
                            <td>{{ $user->child_name }}</td>
                            <td>{{ $user->child_old }}</td>
                            <td>
                                @if( $user->gift_id1 != '' )
                                {{  $user->gift1->title }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        @else
            <h3 class="text-center">Công bố kết quả đợt 1 vào ngày {{ \Carbon\Carbon::createFromTimeString(App\Helpers\Configuration::get('result_date_1'))->format('d/m/Y') }}.</h3>
        @endif
        
    </div>

    <div class="tab-pane fade" id="dot2" role="tabpanel"
            aria-labelledby="dot2-tab">
        @if( $users2 )
            <table class="table table-tripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Bố/ Mẹ</th>
                        <th>Số điện thoại</th>
                        <th>Tên bé</th>
                        <th>Tuổi bé</th>
                        <th>Quà được nhận</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users2 as $user )
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ substr_replace($user->phone,'xxx',6,3) }}</td>
                            <td>{{ $user->child_name }}</td>
                            <td>{{ $user->child_old }}</td>
                            <td>
                                @if( $user->gift_id2 != '' )
                                    {{  $user->gift2->title }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">Công bố kết quả đợt 2 vào ngày {{ \Carbon\Carbon::createFromTimeString(App\Helpers\Configuration::get('result_date_2'))->format('d/m/Y') }}.</h3>
        @endif
        
    </div>
    
</div>
