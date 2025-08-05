@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">สิทธิ์การเข้าถึง</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.authen.permission.all_permission') }}">สิทธิ์การเข้าถึง</a></li>
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
                        <h4 class="card-title">สิทธิ์การเข้าถึง</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.authen.permission.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                        <label for="group_name" class="form-label">หมวดหมู่ <span class="text-danger ">*</span></label>
                                        <select class="form-select" id="group_name" name="group_name"  required="">
                                            <option value="" selected>กรุณาระบุ</option>
                                            {{-- <option value="" selected>กรุณาระบุ</option>
                                            <option value="owner" >Owner</option>
                                            <option value="admin" >Admin</option>
                                            <option value="editor" >Editors / Supervisor</option>
                                            <option value="operator" >Operator</option>
                                            <option value="moderator" >Moderator / Analyze</option> --}}
                                            <option value="setup_all" >All Setup</option>
                                            <option value="meta_tags" >Setup->Meta Tags</option>
                                            <option value="gtm" >Setup->Meta Tags->Google Tag manager</option>
                                            <option value="ga" >Setup->Meta Tags->Google Analytics</option>
                                            <option value="facebook_pixel" >Setup->Meta Tags->Facebook Pixel</option>
                                            <option value="og_meta_tag" >Setup->Meta Tags->Open Graph Meta Tags</option>
                                            <option value="interest_rate" >Setup->Interest Rate</option>
                                            <option value="bank_account" >Setup->Bank Account</option>
                                            <option value="member" >Web Member</option>
                                            <option value="authentication_all" >Authentication</option>
                                            <option value="permission" >Role & Permission->Permission</option>
                                            <option value="role" >Role & Permission->Permission</option>
                                            <option value="web_content_all" >Web Content</option>
                                            <option value="promotion" >Web Content->Promotion</option>
                                            <option value="branch" >Web Content->Branches</option>
                                            <option value="faq_category" >Web Content->FAQs Category</option>
                                            <option value="faqs" >Web Content->FAQs</option>
                                            <option value="contact_us" >Web Content->Contact Us</option>
                                            <option value="gold_price" >Web Content->Gold Price</option>
                                             <option value="banner" >Web Content->Banner</option>
                                            <option value="policy" >Web Content->Policy</option>
                                            <option value="report_all" >Report</option>
                                            <option value="overview_report" >Report->Overview</option>
                                            <option value="transaction_all" >All Transaction</option>
                                            <option value="pawn_report" >Report->Pawn</option>
                                            <option value="send_interest_report" >Report->Interest</option>
                                            <option value="outstanding_interest_report" >Report->Outstanding Interest</option>
                                            <option value="increase_principle_report" >Report->Increase Principle</option>
                                            <option value="decrease_principle_report" >Report->Decrease Principle</option>
                                            <option value="redemption_principle_report" >Report->Redemption</option>
                                            <option value="pawn_transaction" >Transaction->Pawn</option>
                                            <option value="interest_transaction" >Transaction->Interest</option>
                                            <option value="outstanding_interest_transaction" >Transaction->Outstanding Interest</option>
                                            <option value="increase_transaction" >Transaction->Increase Principle</option>
                                            <option value="decrease_transaction" >Transaction->Decrease Principle</option>
                                            <option value="redemption_transaction" >Transaction->Redemption</option>
                                            <option value="customer" >Customer</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
