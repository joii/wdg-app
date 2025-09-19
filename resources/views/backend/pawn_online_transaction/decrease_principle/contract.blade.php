@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">หนังสือสัญญาลดเงินต้น</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.online_transaction.increase_principle_list') }}">รายการขายฝาก</a></li>
                            <li class="breadcrumb-item active">หนังสือสัญญาลดเงินต้น</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->

            <!-- start content -->


            <div class="row">
                <div class="col-lg-12">
                    @if ($data != null && $transaction_data !=null)
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title mt-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div>
                                            <h4 class="font-size-16">ห้างทองกาญจนาภิเษก</h4>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="mb-4">
                                            <h4 class="float-end font-size-16">สัญญาเลขที่ {{ \Carbon\Carbon::parse($data->transaction_date)->thaidate('y') }}{{sprintf('%05d', $data->pawn_id) }}</h4>
                                        </div>
                                    </div>
                                </div>


                                <p class="mb-1">64/6-7 ม.4 ต.ดอนหัวฬ่อ อ.เมืองชลบุรี จ.ชลบุรี 20000</p>
                                {{-- <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> abc@123.com</p> --}}
                                <p>092 979 7777</p>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <h5 class="font-size-15">เลขที่บาร์โค้ด:</h5>
                                        <p>{{ $data->pawn_barcode }}</p>
                                    </div>
                                    <div>
                                        <h5 class="font-size-15">เลขที่บัตร:</h5>
                                        <p>{{ $data->pawn_card_no }}</p>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <h5 class="font-size-15">วันที่ทำสัญญา:</h5>
                                        <p>
                                            {{ \Carbon\Carbon::parse($data->transaction_date)->thaidate('l j F Y') }}
                                        </p>
                                    </div>
                                   <div>
                                        <h5 class="font-size-15">ระยะเวลากำหนด:</h5>
                                        <p>
                                            {{-- {{ \Carbon\Carbon::parse($data->pawn_date_cal_interest)->thaidate('l j F Y') }} --}}
                                            {{ $data->period }} เดือน
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                    <div>
                                        <h5 class="font-size-15">สาขาที่ทำสัญญา:</h5>
                                          <p>สาขา {{ $data->branch_id }}</p>

                                    </div>
                                     <div >
                                        @if($transaction_data->is_erased == 1)
                                           <h2 class="text-danger">ยกเลิกสัญญาแล้ว</h2>
                                           <p> ยกเลิกวัน{{ \Carbon\Carbon::parse($data->erased_date)->thaidate('l j F Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h5 class="font-size-15">ข้อมูลผู้ฝากขาย:</h5>
                                        <p>
                                           <strong>ชื่อผู้ฝากขาย:</strong> {{ $data->customer_name }}<br/>
                                            <strong>ข้อมูลติดต่อ:</strong> {{ $data->customer_address }}<br/>
                                            <strong>เบอร์โทร:</strong> {{ $data->customer_phone }}<br/>
                                            {{-- <strong>เลขประจำตัวประชาชน:</strong> {{ $data->id_card }} --}}
                                        </p>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <div>
                                            <h5 class="font-size-15">รายละเอียดสัญญา:</h5>
                                            <p>
                                                <strong>ชื่อสินค้า:</strong> {{ $data->remarks }}<br/>
                                                <strong>น้ำหนัก:</strong> {{ $data->total_weight }}<br/>
                                                <strong>วงเงินเดิม:</strong>{{ number_format($data->total_pawn_amount) }} บาท<br/>
                                                <strong>อัตราดอกเบี้ย:</strong>ร้อยละ {{ number_format($data->percent_interest) }}<br/>
                                                <hr/>
                                                <strong>ยอดที่รับชำระ:</strong>{{ number_format($transaction_data->payment_amount) }} บาท<br/>
                                                <strong>หักดอกเบี้ยค้างชำระ:</strong> {{ number_format($transaction_data->interest) }} บาท<br/>
                                                <strong>ยอดลดเงินต้น/ส่งเงินต้น:</strong> {{ number_format($transaction_data->amount) }} บาท<br/>
                                                {{-- <strong>กำหนดส่งดอก/ไถ่ถอน:</strong> {{ \Carbon\Carbon::parse($data->pawn_date)->addDays(60)->thaidate('j F Y') }}<br/> --}}
                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h5 class="font-size-15">ลงชื่อ:</h5>
                                        <p>{{ $data->customer_name }}</p>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <div>
                                            <h5 class="font-size-15">ผู้ทำรายการ:</h5>
                                            <p>
                                               {{ $transaction_data->approved_by }}
                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                     @else
                      <p>ไม่พบข้อมูลหนังสือสัญญาลดเงินต้น</p>
                     @endif
                </div>
                <!-- end col -->
                 <div class="d-print-none mt-3 mb-3">
                    <div class="float-end">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>

                    </div>
                 </div>
            </div>
            <!-- end row -->

            <!-- end content -->
    </div>
 </div>
 <script>
    $('#date_filter_submit').click(function() {
  var inputValue = $('input[name="date_filter"]').val();
  // Do something with inputValue, like logging it to the console
  alert(inputValue);
});
</script>
 @endsection
