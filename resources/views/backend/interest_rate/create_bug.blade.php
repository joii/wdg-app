@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">อัตราดอกเบี้ย</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('backend.interest_rate.index') }}">อัตราดอกเบี้ย</a></li>
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
                        <h4 class="card-title">อัตราดอกเบี้ย</h4>
                        <p class="card-title-desc">อัตราดอกเบี้ยของแต่ละสาขา
                        </p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.interest_rate.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="branch_id" class="form-label">สาขา <span class="text-danger ">*</span></label>
                                            <select class="form-select" id="branch_id" name="branch_id"  required="">
                                                <option value="" selected>กรุณาระบุ</option>
                                                @foreach ($branches as $item)
                                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
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
                                            <label for="interest_rate" class="form-label">อัตราดอกเบี้ย <span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="interest_rate"  id="interest_rate">
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
        </div> <!-- end row -->
    </div><!-- end container-fluid -->
</div>
@endsection