@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">สมาชิกเว็บไซต์</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">สมัครสมาชิกเว็บไซต์</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->

            <!-- start content -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                         <div class="card-body">
                        <form id="myForm" action="{{ route('backend.member.store') }}" method="post"  >
                            @csrf
                             <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ชื่อ<span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="firstname"  id="firstname" required>
                                        </div>
                                    </div>
                               </div>
                               <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="lastname" class="form-label">นามสกุล<span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="lastname"  id="lastname" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="email">อีเมล์(ถ้ามี)</label>
                                            <input class="form-control" type="email" name="email"  id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="phone" class="form-label">เบอร์โทรติดต่อ(กรอกตัวเลขเท่านั้น) <span class="text-danger ">*</span></label>
                                            <input class="form-control" type="number" name="phone"  id="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="registered_phone" class="form-label">เบอร์โทรที่ลงทะเบียนไว้</label>
                                            <input class="form-control" type="number" name="registered_phone"  id="registered_phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label">รหัสผ่าน</label>
                                            <input class="form-control" type="password" name="password"  id="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <h5 class="font-size-14 mb-3">สถานะ</h5>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="status" id="status1" checked="" value="1">
                                            <label class="form-check-label" for="status1">
                                                ยืนยันตัวตนแล้ว
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="0">
                                            <label class="form-check-label" for="status2">
                                                ยังไม่ได้ยืนยันตัวตน
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                        </div>
                            </form>
                    </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->


                </div>
                <!-- end col -->


            </div>
            <!-- end row -->

            <!-- end content -->
    </div>
 </div>
 <script>
    $('#date_filter_submit').click(function() {
  var inputValue = $('input[name="date_filter"]').val();
  // Do something with inputValue, like logging it to the console
  alert(inputValue);
});
</script>
 @endsection
