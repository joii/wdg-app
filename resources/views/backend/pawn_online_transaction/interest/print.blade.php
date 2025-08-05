@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                     <h4 class="mb-sm-0 font-size-18">รายการขายฝาก(ต่อดอก)</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">รายการขายฝาก(ต่อดอก)</li>
                        </ol>
                    </div>




                </div>
            </div>
            </div>
            <!-- end page title -->

            <!-- start content -->
<div class="row">
    <div class="col-md-3 col-sm-12" style="width:300px !important;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <strong>ห้างทองกาญจนาภิเษก</strong>
                        <p class="mb-1 text-print">64/6-7 ม.4 ต.ดอนหัวฬ่อ อ.เมืองชลบุรี จ.ชลบุรี 20000</p>
                        <p>092 979 7777</p>
                        <div>
                            <strong>เลขที่บัตร:</strong> {{ $data->pawn_card_no }}</br>
                            <strong>เลขที่บาร์โค้ด:</strong>{{ $data->pawn_barcode }}</br>
                            <strong>วันที่ฝากดอก:</strong> {{ \Carbon\Carbon::parse($interest_data->pawn_cal_interest_date)->addDays(60)->thaidate('j F Y') }}<br/>
                            <strong>จำนวนเงินเพิ่มต้น:</strong>{{ number_format($transaction_data->payment_amount) }} บาท<br/>
                            <strong>สินค้า:</strong> {{ $data->type_full }}<br/>
                            <strong>น้ำหนัก:</strong> {{ $data->total_weight }} กรัม<br/>
                            <hr/>

                        </div>

                    </div>
                     <div class="col-sm-12">
                        <div>
                             <strong>จำนวนเงินขายฝาก:</strong>{{ number_format($transaction_data->amount) }} บาท<br/>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div>
                            <strong>ติดต่อส่งดอก</strong><br/>
                             {{ \Carbon\Carbon::parse($transaction_data->transaction_date)->thaidate('j F Y') }}</br>
                            <span class="text-print-small">
                            *ฝากดอก,ไถ่ถอน รับเฉพาะเงินสด<br/>
                            </span>

                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="signated">&nbsp;</div>
                      <div class="text-center mt-2">
                      ลงชื่อ
                      <span>{{ $data->customer_name }}</span><br/>
                      <span>โทร {{ $data->customer_phone }}</span>
                      </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-12">
                        <strong>คะแนนสะสม :</strong> - คะแนน<br/>
                        <strong>ผู้ทำรายการ :</strong> 23<br/>
                    </div>
                </div>


            </div>
            <!-- end card body -->

        </div>
        <!-- end card -->
        <div class="d-print-none mt-3">
            <div class="float-first">
                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
<br/></br>
            </div>
        </div>
    </div>
</div>
    </div>

@endsection
