@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ผู้ดูแลระบบ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.authen.admin.index') }}">ผู้ดูแลระบบ</a></li>
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
                        <h4 class="card-title">แก้ไขข้อมูล</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.authen.admin.update') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="example-text-input" class="form-label">ชื่อ</label>
                                    <input class="form-control" type="text" name="name" value="{{ $admin->name }}" >
                                </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="example-text-input" class="form-label">อีเมล์</label>
                                    <input class="form-control" type="email" name="email" value="{{ $admin->email }}"  >
                                </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">เบอร์โทร</label>
                                        <input class="form-control" type="text" name="phone" value="{{ $admin->phone }}"  >
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">ระดับสิทธิ์</label>
                                        <select name="roles" class="form-select">
                                            <option>ระบุ</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <h5 class="font-size-14 mb-3">สถานะ</h5>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="status" id="status1" {{ $admin->status=='active'? 'checked':''}}  value="active">
                                            <label class="form-check-label" for="status1">
                                                เปิดใช้งาน
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="status2" {{ $admin->status=='inactive'? 'checked':''}} value="inactive">
                                            <label class="form-check-label" for="status2">
                                                ปิดการใช้งาน
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="mt-4">
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                                <a href="{{ route('backend.authen.admin.destroy',$admin->id) }}" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn btn-danger waves-effect waves-light">ลบข้อมูล</a>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- end card -->
            </div> <!-- end col -->
    </div>
</div>



@endsection
