@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ข้อมูลผู้ดูแลระบบ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active">ข้อมูลผู้ดูแลระบบ</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12 col-lg-12">
            <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm order-2 order-sm-1">
                        <div class="d-flex align-items-start mt-3 mt-sm-0">

                            <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-16 mb-1">{{ $profileData->name }}</h5>
                                <p class="text-muted font-size-13">{{ $profileData->email }}</p>

                                <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                    <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profileData->phone }}</div>

                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
            </div><!-- end card -->


            <div class="card-body p-4">
            <form action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">ชื่อ</label>
                            <input class="form-control" type="text" name="name" value="{{ $profileData->name }}" id="example-text-input">
                        </div>

                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">อีเมล์</label>
                            <input class="form-control" name="email" type="email" value="{{ $profileData->email }}" id="example-text-input">
                        </div>

                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">เบอร์โทร</label>
                            <input class="form-control" name="phone" type="text" value="{{ $profileData->phone }}" id="example-text-input">
                        </div>

                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
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
