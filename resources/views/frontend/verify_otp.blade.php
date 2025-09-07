@extends('frontend.master')
@section('content')
<div class="section section-form">
    <div class="container">
        <div class="card">
            <div class="boxed" style="--width:400px">
                <div class="d-block py-md-2 mt-md-2">
                    <h3 class="mb-2">เข้าสู่ระบบ</h3>
                    <p class="text-note">กรุณาล็อคอินเข้าสู่เพื่อทำรายการ</p>
                </div>
                <div class="col-12">

                        @if ($errors->any())
                        <div>
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <form class="row g-3 " method="post" action="{{ route('otp.verify') }}">>
                            @csrf
                              <input type="hidden" name="token" value="{{ $token }}">
                              <input type="hidden" name="phone" value="{{ $phone }}">
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label class="title">เบอร์โทร</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $phone }}">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="title">กรอกรหัส OTP</label>
                                    <input type="text" class="form-control" name="otp_code" required>
                                </div>

                            </div>
                            <div class="col-12 pt-4">
                                <button class="btn btn-green-dark w-100" type="submit">
                                   ยืนยัน
                                </button>
                            </div>
                             <p>โปรดระบุ OTP ภายใน <span id="countdown">5</span> นาที</p>
                        </form>
                      <script>
    let countdownElement = document.getElementById("countdown");
    let resendBtn = document.getElementById("resendBtn");

    let timeLeft = 300; // 5 นาที = 300 วินาที
    let timer = setInterval(updateCountdown, 1000);

    function updateCountdown(){
        if(timeLeft <= 1){
            clearInterval(timer);
            resendBtn.disabled = false;
            countdownElement.innerHTML = "00:00";
            resendBtn.innerText = "Resend OTP";
        } else {
            timeLeft -= 1;
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            countdownElement.innerHTML =
                String(minutes).padStart(2, '0') + ":" + String(seconds).padStart(2, '0');
        }
    }


</script>



                    </div>
            </div><!--boxed-->
        </div>
    </div><!--container-->
</div><!--section-->
@endsection
