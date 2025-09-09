@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">สาขา</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.branch.index') }}">สาขา</a></li>
                            <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ข้อมูลสาขา</h4>
                        <p class="card-title-desc">ข้อมูลสาขา ประกอบด้วย ชื่อสาขา ที่ตั้ง เบอร์ติดต่อ ละติจูด ลองจิจูด เพื่อนำไปใช้ใน Google Map
                            <a href="https://www.google.co.th/maps/" target="_blank">คลิก</a> เพื่อหาค่าละติจูด ลองจิจูด
                        </p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.branch.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">ชื่อสาขา</label>
                                            <input class="form-control" type="text" name="name"  id="name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="location" class="form-label">ที่ตั้ง</label>
                                            <input class="form-control" type="text" name="location"  id="location">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="phone" class="form-label">เบอร์ติดต่อ</label>
                                            <input class="form-control" type="text" name="phone"  id="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="sms_phone" class="form-label">เบอร์สำหรับรับ SMS</label>
                                            <input class="form-control" type="text" name="sms_phone"  id="sms_phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="latitude" class="form-label">ละติจูด</label>
                                            <input class="form-control" type="text" name="latitude"  id="latitude">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="longitude" class="form-label">ลองจิจูด</label>
                                            <input class="form-control" type="text" name="longitude"  id="longitude">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <h5 class="font-size-14 mb-3">สถานะ</h5>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="status" id="status1" checked="" value="active">
                                            <label class="form-check-label" for="status1">
                                                เปิดใช้งาน
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="inactive">
                                            <label class="form-check-label" for="status2">
                                                ปิดการใช้งาน
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

                </div>
                <!-- end card -->
            </div> <!-- end col -->
    </div>
</div>



@endsection
