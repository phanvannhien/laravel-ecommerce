<div id="popup-voucher" class="mk-modal modal  with-caythong">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a class="close1" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </a>
            <div class="mk-modal-h header1"></div>
            <div class="mk-modal-c">
                <h4 class="a-title text-center">Chúc mừng!</h4>
                <h5 class="a-title text-center">Bạn đã trúng voucher <span id="voucher-value"></span></h5>
                <p class="text-center">Vui lòng điền thông tin dưới đây để nhận mã.</p>
                
                <div id="alert"></div>
                <form action="frm–get-voucher">
                    <div class="form-group">
                        <input type="text" name="full_name" class="form-control" placeholder="Tên của bạn">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <p class="text-center">
                        <button id="submit-get-vc" class="btn-main" type="button">NHẬN MÃ</button>
                    </p>
                </form>
                <p class="text-center">Thời gian còn lại để nhận mã voucher là:</p>
                <div id="clock-voucher" class="clock my-3 count-down-timer d-flex align-items-center justify-content-center">
                    <div>
                        <span class="hours">00</span>
                        <div class="smalltext">giờ</div>
                    </div>
                    <div>
                        <span class="minutes">00</span>
                        <div class="smalltext">phút</div>
                    </div>
                    <div>
                        <span class="seconds">00</span>
                        <div class="smalltext">giây</div>
                    </div>
                </div>
            </div>
            <div class="caythong">
                <img src="{{ url('images/xmas-tree.png') }}" alt="">
            </div>
        </div>
    </div>
</div>

<script>
       
        $('#popup-voucher .modal-dialog').attr('class', 'modal-dialog modal-md');
        $('#popup-voucher').modal();
        //clearInterval(timeinterval);
        //initializeClock('clock-voucher',start_time,end_time);
</script>