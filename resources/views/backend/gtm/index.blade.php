@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Google Tag Manager</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">Google Tag Manager</li>
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
                        <h4 class="card-title">Google Tag Manager</h4>
                        <p class="card-title-desc">Google Tag Manager คือ เครื่องมือที่ใช้ในการจัดการและติด Tag หรือ Code ต่างๆที่เราต้องการ Track ในเว็บไซต์หรือเฉพาะหน้าใดหน้าหนึ่งของเว็บไซต์นั้น.
                            <a href="https://support.google.com/tagmanager/answer/14847097?hl=en&ref_topic=15191151&sjid=16528059062928743967-NC" target="_blank">คลิก</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation " novalidate="" action="{{ route('backend.gtm.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="gtm_first_block">GTM First Block</label>
                                        <textarea class="form-control" id="gtm_first_block"  name="gtm_first_block" rows="8">{!! $gtm->gtm_first_block !!}</textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="gtm_second_block">GTM Second Block</label>
                                        <textarea class="form-control" id="gtm_second_block"  name="gtm_second_block" rows="8">{!! $gtm->gtm_second_block !!}</textarea>
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