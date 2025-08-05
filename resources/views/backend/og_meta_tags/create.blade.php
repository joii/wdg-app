@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Open Graph Meta Tags</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.og_meta_tag.index') }}">Open Graph Meta Tags</a></li>
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
                        <h4 class="card-title">Open Graph Meta Tags</h4>
                        <p class="card-title-desc">ชุดโค้ดในส่วนของ Metadata ถูกสร้างขึ้นครั้งแรกโดย Facebook โดยจุดประสงค์เพื่อให้การแสดงผลหน้าเว็บเพจบนหน้าโซเชียลมีเดีย
                        </p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.og_meta_tag.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">ชื่อ<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name"  id="name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="url" class="form-label">URL ของหน้าเว็บเพจ<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="url"  id="url" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="type" class="form-label">ประเภทของหน้าเว็บเพจ เช่น article (บทความ), video (วิดีโอ), book (หนังสือ) ฯลฯ เป็นต้น</label>
                                            <input class="form-control" type="text" name="type"  id="type" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">แท็กที่ใช้แสดงชื่อ title ของหน้าเว็บเพจ<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title"  id="title" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">แท็กที่ใช้แสดงคำอธิบาย (description) ของหน้าเว็บเพจ<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="description"  id="description" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">ภาพหน้าปกของบทความหรือหน้าเว็บเพจ ขนาด 1200 x 630 pixels <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="image"  id="image" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="app_id" class="form-label">APP ID สำหรับดูข้อมูลเชิงลึก</label>
                                            <input class="form-control" type="text" name="app_id"  id="app_id">
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