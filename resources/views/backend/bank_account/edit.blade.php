@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">บัญชีธนาคาร</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('backend.bank_account.index') }}">บัญชีธนาคาร</a></li>
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
                        <h4 class="card-title">บัญชีธนาคาร</h4>
                        <p class="card-title-desc">บัญชีธนาคารและข้อมูลการเชื่อมต่อ QR API
                        </p>
                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.bank_account.update') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="branch_id" class="form-label">สาขา <span class="text-danger ">*</span></label>
                                            <select class="form-select" id="branch_id" name="branch_id"  required="">
                                                <option value="" selected>กรุณาระบุ</option>
                                                @foreach ($branches as $item)
                                                <option value="{{ $item->id }}" {{ $item->id==$data->branch_id?'selected':'' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="bank_account_name" class="form-label">ชื่อบัญชี <span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="bank_account_name"  id="bank_account_name" value="{{ $data->bank_account_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="bank_account_no" class="form-label">เลขที่บัญชี <span class="text-danger ">*</span></label>
                                            <input class="form-control" type="text" name="bank_account_no"  id="bank_account_no" value="{{ $data->bank_account_no }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                            <label for="api_key" class="form-label">api_key</label>
                                            <input class="form-control" type="text" name="api_key"  id="api_key" value="{{ $data->api_key }}">
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
                                <input type="hidden" name="id" value="{{ $data->id}}" />
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                                <a href="{{ route('backend.bank_account.destroy',$data->id) }}" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn btn-danger waves-effect waves-light">ลบข้อมูล</a>
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