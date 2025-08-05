@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">โปรโมชัน</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.promotion.index') }}">โปรโมชัน</a></li>
                            <li class="breadcrumb-item active">แก้ไขข้อมูล</li>
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
                        <h4 class="card-title">โปรโมชัน</h4>
                        <p class="card-title-desc">กรอกรายละเอียดโปรโมชันให้ครบถ้วน</p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.promotion.update') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                             <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">ชื่อโปรโมชัน<span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="title"  id="title" required value="{{ $data->title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">คำบรรยายอย่างย่อ</label>
                                            <input class="form-control" type="text" name="description"  id="description" value="{{ $data->description }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="detail" class="form-label">รายละเอียดโปรโมชัน <span class="text-danger ">*</span></label>
                                            <textarea class="form-control" id="detail"  name="detail" rows="3">{{ $data->detail }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="link_url" class="form-label">ลิงค์ (กรณีที่ลิงค์ไปยังเว็บอื่น)</label>
                                            <input class="form-control" type="text" name="link_url"  id="link_url" value="{{ $data->link_url }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="start_date" class="form-label">วันที่เริ่มใช้งาน <span class="text-danger ">*</span></label>
                                            <input class="form-control" type="date" name="start_date"  id="start_date" required value="{{ $data->start_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="end_date" class="form-label">วันที่สิ้นสุดใช้งาน <span class="text-danger ">*</span></label>
                                            <input class="form-control" type="date" name="end_date"  id="end_date" required value="{{ $data->end_date }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="thumbnail_path" class="form-label">รูป thumbnail ขนาด 1000x1000px <span class="text-danger ">*</span></label>
                                            <p><img src="{{ asset($data->thumbnail_path)}}" width="200" /></p>
                                            <input class="form-control" type="file" name="thumbnail_path"  id="thumbnail_path">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="image_path" class="form-label">รูปโปรโมชัน ขนาด 1200x800px <span class="text-danger ">*</span></label>
                                            <p><img src="{{ asset($data->image_path)}}" width="200" /></p>
                                            <input class="form-control" type="file" name="image_path"  id="image_path" >
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="slug" class="form-label">Slug<span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="slug"  id="slug" required value="{{ $data->slug }}">
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
                                <input type="hidden" name="old_thumbnail" value="{{ $data->thumbnail_path}}" />
                                <input type="hidden" name="id" value="{{ $data->id}}" />
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                                <a href="{{ route('backend.promotion.destroy',$data->id) }}" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn btn-danger waves-effect waves-light">ลบข้อมูล</a>
                        </div>
                            </form>
                    </div>

                </div>
                <!-- end card -->
            </div> <!-- end col -->
    </div>
</div>



@endsection
