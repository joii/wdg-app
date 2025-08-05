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
                        <h4 class="card-title">สิทธิ์การเข้าถึง</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.authen.permission.update') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                        <label for="group_name" class="form-label">หมวดหมู่ <span class="text-danger ">*</span></label>
                                        <select class="form-select" id="group_name" name="group_name"  required="">
                                            <option value="" selected>กรุณาระบุ</option>
                                            <option value="setup_all"{{ $permission->group_name=='setup_all'?'selected':'' }} >All Setup</option>
                                            <option value="meta_tags" {{ $permission->group_name=='meta_tags'?'selected':'' }} >Setup->Meta Tags</option>
                                            <option value="gtm" {{ $permission->group_name=='gtm'?'selected':'' }}>Setup->Meta Tags->Google Tag manager</option>
                                            <option value="ga" {{ $permission->group_name=='ga'?'selected':'' }}>Setup->Meta Tags->Google Analytics</option>
                                            <option value="facebook_pixel" {{ $permission->group_name=='facebook_pixel'?'selected':'' }}>Setup->Meta Tags->Facebook Pixel</option>
                                            <option value="og_meta_tag" {{ $permission->group_name=='og_meta_tags'?'selected':'' }}>Setup->Meta Tags->Open Graph Meta Tags</option>
                                            <option value="interest_rate" {{ $permission->group_name=='interest_rate'?'selected':'' }}>Setup->Interest Rate</option>
                                            <option value="bank_account" {{ $permission->group_name=='bank_account'?'selected':'' }} >Setup->Bank Account</option>
                                            <option value="member" {{ $permission->group_name=='member'?'selected':'' }}>Web Member</option>
                                            <option value="authentication_all" {{ $permission->group_name=='authentication_all'?'selected':'' }}>>Authentication</option>
                                            <option value="permission" {{ $permission->group_name=='permission'?'selected':'' }}>Role & Permission->Permission</option>
                                            <option value="role" {{ $permission->group_name=='role'?'selected':'' }}>Role & Permission->Permission</option>
                                            <option value="web_content_all" {{ $permission->group_name=='web_content_all'?'selected':'' }}>Web Content</option>
                                            <option value="promotion" {{ $permission->group_name=='promotion'?'selected':'' }}>Web Content->Promotion</option>
                                            <option value="branch" {{ $permission->group_name=='branch'?'selected':'' }}>Web Content->Branches</option>
                                            <option value="faq_category" {{ $permission->group_name=='faq_category'?'selected':'' }}>Web Content->FAQs Category</option>
                                            <option value="faqs" {{ $permission->group_name=='faqs'?'selected':'' }}>Web Content->FAQs</option>
                                            <option value="contact_us" {{ $permission->group_name=='contact_us'?'selected':'' }}>Web Content->Contact Us</option>
                                            <option value="gold_price" {{ $permission->group_name=='gold_price'?'selected':'' }} >Web Content->Gold Price</option>
                                            <option value="banner" {{ $permission->group_name=='banner'?'selected':'' }}>Web Content->Banner</option>
                                            <option value="policy" {{ $permission->group_name=='policy'?'selected':'' }}>Web Content->Policy</option>
                                            <option value="report_all" {{ $permission->group_name=='report_all'?'selected':'' }}>Report</option>
                                            <option value="overview_report" {{ $permission->group_name=='overview_report'?'selected':'' }}>Report->Overview</option>
                                            <option value="pawn_report" {{ $permission->group_name=='pawn_report'?'selected':'' }}>Report->Pawn</option>
                                            <option value="transaction_all" {{ $permission->group_name=='transaction_all'?'selected':'' }}>All Transaction</option>
                                            <option value="send_interest_report" {{ $permission->group_name=='send_interest_report'?'selected':'' }}>Report->Interest</option>
                                            <option value="outstanding_interest_report" {{ $permission->group_name=='outstanding_interest_report'?'selected':'' }}>Report->Outstanding Interest</option>
                                            <option value="increase_principle_report" {{ $permission->group_name=='increase_principle_report'?'selected':'' }}>Report->Increase Principle</option>
                                            <option value="decrease_principle_report"  {{ $permission->group_name=='decrease_principle_report'?'selected':'' }}>Report->Decrease Principle</option>
                                            <option value="redemption_principle_report"  {{ $permission->group_name=='redemption_principle_report'?'selected':'' }}>Report->Redemption</option>
                                            <option value="pawn_transaction"  {{ $permission->group_name=='pawn_transaction'?'selected':'' }}>Transaction->Pawn</option>
                                            <option value="interest_transaction" {{ $permission->group_name=='interest_transaction'?'selected':'' }}>Transaction->Interest</option>
                                            <option value="outstanding_interest_transaction" {{ $permission->group_name=='outstanding_interest_transaction'?'selected':'' }}>Transaction->Outstanding Interest</option>
                                            <option value="increase_transaction" {{ $permission->group_name=='increase_transaction'?'selected':'' }}>Transaction->Increase Principle</option>
                                            <option value="decrease_transaction" {{ $permission->group_name=='decrease_transaction'?'selected':'' }}>Transaction->Decrease Principle</option>
                                            <option value="redemption_transaction" {{ $permission->group_name=='redemption_transaction'?'selected':'' }}>Transaction->Redemption</option>
                                            <option value="customer" {{ $permission->group_name=='customer'?'selected':'' }}>Customer</option>
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
                                            <input class="form-control" type="text" name="name"  id="name" value="{{ $permission->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-4">
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                                <a href="{{ route('backend.authen.permission.destroy',$permission->id) }}" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn btn-danger waves-effect waves-light">ลบข้อมูล</a>
                        </div>
                            </form>
                    </div>

                </div>
                <!-- end card -->
            </div> <!-- end col -->
    </div>
</div>



@endsection
