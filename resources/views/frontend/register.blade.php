@extends('frontend.master')
@section('content')
  <div class="section section-step">
        <div class="container">
            <ul class="nav nav-step">
                <li class="active">
                    <a class="step" href="#">
                        <span class="number">1</span>
                        สมัคร
                    </a>
                </li>

                <li>
                    <a class="step" href="#">
                        <span class="number">2</span>
                        ตรวจสอบ
                    </a>
                </li>

                <li>
                    <a class="step" href="#">
                        <span class="number">3</span>
                        ยืนยัน
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
                <div class="boxed" style="--width:400px">
                    <div class="d-block py-2 mt-2">
                        <h3 class="mb-2">ลงทะเบียน</h3>
                        <p class="text-note">เพื่อประโยชน์สูงสุดของคุณกรุณาระบุข้อมูลที่เป็นจริงและถูกต้อง</p>
                    </div>
                    <form class="row g-3 form-register" method="post" action="{{ route('member.register.submit') }}">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">ชื่อ(ตามบัตรประชาชน)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">นามสกุล(ตามบัตรประชาชน)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname" >
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">เบอร์โทรติดต่อ(กรอกตัวเลขเท่านั้น) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="phone" >
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">อีเมล์</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">รหัสผ่าน<span class="text-danger">*</span></label>
                                <div class="group">
                                    <span class="icons icon-eye right"></span>
                                    <input type="password" class="form-control pw" name="password" id="password1" placeholder="รหัสผ่านความยาวอย่างน้อย 8 ตัวอักษร" >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                                <div class="group">
                                    <span class="icons icon-eye right"></span>
                                    <input type="password" class="form-control pw" name="password2" id="password2" >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="title">คุณรู้จักเราได้อย่างไร</label>
                                <select class="form-select">
                                    <option value="เพื่อนแนะนำ">เพื่อนแนะนำ</option>
                                    <option value="รู้จักทางเฟสบุ๊ก">รู้จักทางเฟสบุ๊ก</option>
                                    <option value="ผ่านหน้าร้าน">ผ่านหน้าร้าน</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check remember my-3">
                                <input class="form-check-input circle" id="conditions" type="checkbox" name="conditions" value="">
                                <label class="form-check-label" for="conditions">
                                    ข้าพเจ้าได้อ่านและยอมรับเงื่อนไขของทางเว็บไซต์
                                </label>
                            </div>
                        </div>

                        <div class="col-12 pt-4">
                            <button class="btn btn-green-dark w-100" type="submit">
                                ลงทะเบียน
                            </button>
                        </div>

                        <div class="col-12 mb-3">
                            <p class="mt-2 text-center" style="color: #191D23;">ลงทะเบียนไว้แล้ว <a class="link-primary link" href="login.html">ล็อคอินเข้าสู่ระบบ</a></p>
                        </div>
                    </form><!--row-->
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
