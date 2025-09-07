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

                {{-- <form class="row g-3 form-login" method="post" action="{{ route('member.login.attempt') }}">
                    @csrf
                    <div class="col-12">
                        <div class="form-group">
                            <label class="title">เบอร์โทร</label>
                            <input type="text" class="form-control" name="user">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="d-flex">
                                <label class="title">รหัสผ่าน</label>
                                <a class="ms-auto fs-12 link-primary" href="#">ลืมรหัสผ่าน</a>
                            </div>
                            <div class="group">
                                <span class="icons right icon-eye"></span>
                                <input type="password" class="form-control pw" value="" name="password">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check remember">
                            <input class="form-check-input circle" id="check1" type="checkbox" value="">
                            <label class="form-check-label" for="check1">
                                บันทึกข้อมูลการล็อคอิน
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-green-dark w-100" type="submit">
                            เข้าสู่ระบบ
                        </button>
                    </div>

                    {{-- <div class="col-12">
                        <div class="text-line">
                            <span>ลงทะเบียนด้วย</span>
                        </div>

                        <a class="btn btn-outline-black facebook" href="#">
                            <img class="icons svg-js" src="{{ asset('frontend/assets/img/icons/icon-facebook-circle.svg') }}" alt="">
                            Facebook
                        </a>
                    </div>

                    <div class="col-12">
                        <p class="mt-2 text-center" style="color: #191D23;">ลงทะเบียนสมาชิก? <a class="link-primary link" href="{{ route('member.register') }}">คลิกที่นี่</a></p>
                    </div>

                </form><!--row--> --}}
                <div class="col-12">
                      <!-- request.html -->

                      @if ($errors->any())
                            <div style="color:red;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                          <form class="row g-3 " method="post" action="{{ route('otp.request') }}">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="title">เบอร์โทร</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <button class="btn btn-green-dark w-100" type="submit" >
                                    ขอ OTP
                                </button>
                            </div>
                        </form>
                         <div class="col-12">
                        <p class="mt-2 text-center" style="color: #191D23;">ลงทะเบียนสมาชิก? <a class="link-primary link" href="{{ route('member.register') }}">คลิกที่นี่</a></p>
                    </div>





                    </div>
            </div><!--boxed-->
        </div>
    </div><!--container-->
</div><!--section-->
@endsection
