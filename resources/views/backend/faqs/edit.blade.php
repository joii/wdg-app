@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">คำถามที่พบบ่อย</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('backend.faqs.index') }}">คำถามที่พบบ่อยร</a></li>
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
                        <h4 class="card-title">คำถามที่พบบ่อย</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.faqs.update') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="category_id" class="form-label">หมวดหมู่ <span class="text-danger ">*</span></label>
                                            <select class="form-select" id="category_id" name="category_id"  required="">
                                                <option value="" selected>กรุณาระบุ</option>
                                                @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"  {{ $item->id==$data->category_id?'selected':'' }}>{{ $item->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="question" class="form-label">คำถาม<span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="question"  id="question" value="{{ $data->question }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="answer" class="form-label">คำตอบ <span class="text-danger ">*</span></label>
                                            <textarea class="form-control" id="answer"  name="answer" rows="3">{!! $data->answer !!}"</textarea>
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
                            <input type="hidden" name="id" value="{{ $data->id}}" />
                            <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                            <a href="{{ route('backend.branch.destroy',$data->id) }}" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn btn-danger waves-effect waves-light">ลบข้อมูล</a>
                        </div>
                            </form>
                    </div>

                </div>
                <!-- end card -->
        </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- end container-fluid -->
</div>
@endsection