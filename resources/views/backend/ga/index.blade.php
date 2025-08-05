@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Google Analytic</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">Google Analytic</li>
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
                        <h4 class="card-title">Google Analytic<</h4>
                        <p class="card-title-desc">Google analytics เครื่องมือที่ใช้ในการวิเคราะห์ และเก็บข้อมูลสถิติของเว็บไซต์ เพื่อให้คุณสามารถนำข้อมูลเหล่านี้มาใช้วิเคราะห์ และวางกลยุทธ์ในการทำการตลาด
                            <a href="https://analytics.google.com/" target="_blank">คลิก</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation " novalidate="" action="{{ route('backend.ga.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="mb-3">
                                        <label class="form-label" for="gtag">gtag code</label>
                                        <textarea class="form-control" id="gtag"  name="gtag" rows="8">{!! $gtag->gtag !!}</textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="invalidCheck" required="">
                                            <label class="form-check-label" for="invalidCheck">ยืนยันการตั้งค่า</label>
                                            <div class="invalid-feedback">
                                                กรุณายืนยันการตั้งค่า
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div>
</div>
@endsection