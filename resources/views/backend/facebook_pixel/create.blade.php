@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Facebook Pixel</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.facebook_pixel.index') }}">Facebook Pixel</a></li>
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
                        <h4 class="card-title">Facebook Pixel</h4>
                        <p class="card-title-desc">โค้ด JavaScript สำหรับติดตามพฤติกรรมผู้ใช้ในเว็บไซต์เพื่อวิเคราะห์ Conversion, สร้างกลุ่มเป้าหมาย, ปรับปรุงประสิทธิภาพโฆษณา
                        </p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.facebook_pixel.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="pixel_name" class="form-label">Facebook Name (ชื่อที่ใช้เรียกภายในระบบ เช่น "Pixel ร้าน A") <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="pixel_name"  id="pixel_name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="pixel_id" class="form-label">Pixel ID จาก Facebook (เช่น 123456789012345) <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="pixel_id"  id="pixel_id" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="domain_scope" class="form-label">Domain Scope (กำหนดว่า Pixel นี้ใช้กับหน้าเว็บไหน เช่น homepage, product, all หรือระบุ path เฉพาะ) <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="domain_scope"  id="domain_scope" placeholder="all" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="event_script" class="form-label">Event Script (Script เสริมที่ต้องแทรกเพิ่ม เช่น track("Purchase"))</label>
                                            <input class="form-control" type="text" name="event_script"  id="event_script">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="note" class="form-label">บันทึกเพิ่มเติม</label>
                                            <input class="form-control" type="text" name="note"  id="note">
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