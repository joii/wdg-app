@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">แบนเนอร์</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.banner.index') }}">แบนเนอร์</a></li>
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
                        <h4 class="card-title">แบนเนอร์</h4>
                        <p class="card-title-desc">รูปแบนเนอร์โฆษณา แสดงผลที่หน้า Homepage</p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.banner.update') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">ชื่อรูป (สำหรับ SEO)</label>
                                            <input class="form-control" type="text" name="title"  id="title" value="{{ $data->title }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="alt" class="form-label">ALT (สำหรับ SEO)</label>
                                            <input class="form-control" type="text" name="alt"  id="alt" value="{{ $data->alt }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="image_path" class="form-label">รูปแบนเนอร์ขนาด 1920x863px</label>
                                            <p><img src="{{ asset($data->image_path)}}" width="200" /></p>
                                            <input class="form-control" type="file" name="image_path"  id="image_path">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <h5 class="font-size-14 mb-3">สถานะ</h5>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="status" id="status1" {{ $data->status=='active'? 'checked':''}}  value="active">
                                            <label class="form-check-label" for="status1">
                                                เปิดใช้งาน
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status2" {{ $data->status=='inactive'? 'checked':''}} value="inactive">
                                            <label class="form-check-label" for="status2">
                                                ปิดการใช้งาน
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <input type="hidden" name="old_image" value="{{ $data->image_path}}" />
                            <input type="hidden" name="id" value="{{ $data->id}}" />
                            <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                            <a href="{{ route('backend.banner.destroy',$data->id) }}" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn btn-danger waves-effect waves-light">ลบข้อมูล</a>
                        </div>
                            </form>
                    </div>

                </div>
                <!-- end card -->
            </div> <!-- end col -->
    </div>
</div>



@endsection