@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">สิทธิ์การใช้งาน/กลุ่มผู้ใช้งาน</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.authen.permission.all_permission') }}">สิทธิ์การใช้งาน/กลุ่มผู้ใช้งาน</a></li>
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
                        <h4 class="card-title">สิทธิ์การใช้งาน/กลุ่มผู้ใช้งาน</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.authen.role.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">ชื่อสิทธิ์การใช้งาน</label>
                                            <input class="form-control" type="text" name="name"  id="name">
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
