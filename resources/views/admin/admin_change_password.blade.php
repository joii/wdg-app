@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">เปลี่ยนรหัสผ่าน</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ข้อมูลผู้ดูแลระบบ</li>
                            <li class="breadcrumb-item active">เปลี่ยนรหัสผ่าน</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-9 col-lg-8">
<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-sm order-2 order-sm-1">
            <div class="d-flex align-items-start mt-3 mt-sm-0">

                <div class="flex-grow-1">
    <div>
        <h5 class="font-size-16 mb-1">{{ $profile_data->name }}</h5>
        <p class="text-muted font-size-13">{{ $profile_data->email }}</p>

        <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profile_data->phone }}</div>
            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profile_data->address }}</div>
        </div>
    </div>
                </div>
            </div>
        </div>

    </div>


                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->


<div class="card-body p-4">
<form action="{{ route('admin.password.update') }}" method="post" enctype="multipart/form-data">
    @csrf

<div class="row">
    <div class="col-lg-6">
        <div>
            <div class="mb-3">
                <label for="example-text-input" class="form-label">รหัสผ่านปัจจุบัน</label>
                <input class="form-control @error('old_password') is-invalid @enderror" type="password" name="old_password" id="old_password" required>
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="example-text-input" class="form-label">รหัสผ่านใหม่</label>
                <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" id="new_password" required>
                @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="example-text-input" class="form-label">ยืนยันรหัสผ่าน</label>
                <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
        </div>
    </div>


</div>
</form>
</div>










                <!-- end tab content -->
            </div>
            <!-- end col -->


            <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>




@endsection
