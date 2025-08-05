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
                        <h4 class="card-title">ผู้ดูแลระบบ</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.authen.admin.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="example-text-input" class="form-label">ชื่อ</label>
                                    <input class="form-control" type="text" name="name"  id="example-text-input">
                                </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="example-text-input" class="form-label">อีเมล์</label>
                                    <input class="form-control" type="email" name="email"  id="example-text-input">
                                </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">เบอร์โทร</label>
                                        <input class="form-control" type="text" name="phone"  id="example-text-input">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">รหัสผ่าน</label>
                                        <input class="form-control" type="password" name="password"  id="example-text-input">
                                    </div>
                                </div>


                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="example-text-input" class="form-label">ระดับสิทธิ์</label>
                                        <select name="roles" class="form-select">
                                            <option>ระบุ</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
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
