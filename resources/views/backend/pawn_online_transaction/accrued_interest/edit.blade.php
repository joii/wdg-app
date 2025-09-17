@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายละเอียดรายการส่งดอก</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.pawn_transaction.index') }}">รายการขายฝาก</a></li>
                            <li class="breadcrumb-item active">รายละเอียดรายการส่งดอก</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->

            <!-- start content -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('backend.online_transaction.interest.update') }}" method="POST">
                            @csrf
                            <div class="invoice-title">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="mb-4">
                                            <span class="logo-txt">ห้างทองกาญจนาภิเษก</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="mb-4">
                                            <label for="pawn_id" class="form-label form-edit">สัญญาเลขที่</label>
                                            <h4 class="float-end font-size-16"> <input class="form-control" type="text" name="pawn_id"  id="pawn_id" value="68{{  $transaction_data->pawn_id }}" disabled></h4>
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
                                        <label for="pawn_barcode" class="form-label form-edit">เลขที่บาร์โค้ด:</label>
                                        <input class="form-control" type="text" name="pawn_barcode"  id="pawn_barcode" value="{{ $data->pawn_barcode }}" disabled>
                                    </div>
                                    <div >
                                        <label for="pawn_card_no" class="form-label form-edit">เลขที่บาร์โค้ด:</label>
                                        <input class="form-control" type="text" name="pawn_card_no"  id="pawn_card_no" value="{{ $data->pawn_card_no }}" disabled>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <label for="pawn_date" class="form-label form-edit">วันที่ทำสัญญา:</label>
                                        <input class="form-control" type="text" name="pawn_date"  id="pawn_date" value="{{ \Carbon\Carbon::parse($data->pawn_date)->timezone('UTC')->thaidate('Y-m-d') }}" disabled>
                                    </div>

                                    <div >
                                        <label for="pawn_date_cal_interest" class="form-label form-edit">วันที่ต่อสัญญา:</label>
                                        <input class="form-control" type="text" name="pawn_date_cal_interest"  id="pawn_date_cal_interest" value="{{ \Carbon\Carbon::parse($data->pawn_date_cal_interest)->timezone('UTC')->thaidate('Y-m-d') }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4">


                                    <div >
                                        <label for="branch_id" class="form-label form-edit">สาขาที่ทำสัญญา:</label>
                                        <input class="form-control" type="text" name="branch_id"  id="branch_id" value="{{ $data->branch_id }}" disabled>
                                    </div>
                                    <div class="pt-4">
                                        @if($transaction_data->is_erased == 'TRUE' || $transaction_data->is_erased == TRUE || $transaction_data->is_erased == 1)
                                           <h2 class="text-danger">ยกเลิกสัญญาแล้ว</h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <h5 class="font-size-15">ข้อมูลลูกค้า:</h5>
                                    <div>
                                        <label for="customer_name" class="form-label form-edit">ชื่อผู้ฝากขาย:</label>
                                        <input class="form-control" type="text" name="customer_name"  id="customer_name" value="{{ $data->customer_name }}" >
                                    </div>
                                    <div>
                                        <label for="customer_address" class="form-label form-edit">ข้อมูลติดต่อ:</label>
                                        <input class="form-control" type="text" name="customer_address"  id="customer_address" value="{{ $data->customer_address }}" >
                                    </div>
                                    <div>
                                        <label for="customer_phone" class="form-label form-edit">เบอร์โทร:</label>
                                        <input class="form-control" type="text" name="customer_phone"  id="customer_phone" value="{{ $data->customer_phone }}" >
                                    </div>
                                    <div>
                                        <label for="id_card" class="form-label form-edit">เลขประจำตัวประชาชน:</label>
                                        <input class="form-control" type="text" name="id_card"  id="id_card" value="{{ $data->id_card }}" >
                                    </div>

                                </div>
                                <div class="col-sm-6 mb-4">

                                    <h5 class="font-size-15">รายละเอียดสัญญา:</h5>

                                        <div>
                                            <label for="remarks" class="form-label form-edit">ชื่อสินค้า:</label>
                                            <input class="form-control" type="text" name="remarks"  id="remarks" value="{{ $data->type_full }}" disabled >
                                        </div>
                                        <div>
                                            <label for="total_weight" class="form-label form-edit">น้ำหนัก:</label>
                                            <input class="form-control" type="text" name="total_weight"  id="total_weight" value="{{ $data->total_weight }}" disabled >
                                        </div>
                                        <div>
                                            <label for="total_pawn_amount" class="form-label form-edit">ราคาประเมิน:</label>
                                            <input class="form-control" type="text" name="total_pawn_amount"  id="total_pawn_amount" value="{{ $data->total_pawn_amount }}" disabled >
                                        </div>
                                        <div>
                                            <label for="total_pawn_amount_first" class="form-label form-edit">จำนวนเงินขายฝากมูลค่า:</label>
                                            <input class="form-control" type="text" name="total_pawn_amount_first"  id="total_pawn_amount_first" value="{{ $data->total_pawn_amount_first }}" disabled >
                                        </div>
                                        <div>
                                            <label for="percent_interest" class="form-label form-edit">ดอกเบี้ย:</label>
                                            <input class="form-control" type="text" name="percent_interest"  id="percent_interest" value="{{ $transaction_data->payment_amount }}" disabled >
                                        </div>
                                        <div>
                                            <label for="percent_interest" class="form-label form-edit">เอกสารการชำระเงิน:</label>
                                            <a href="{{ asset($transaction_data->payment_slip) }}" target="_blank">ดูเอกสาร</a>
                                        </div>

                                        <div>
                                            <label for="remarks" class="form-label form-edit">หมายเหตุ:</label>
                                            <input class="form-control" type="text" name="remarks"  id="remarks" value="{{ $transaction_data->remarks }}" >
                                        </div>

                                        <div>
                                            <label for="total_pawn_amount_first" class="form-label form-edit">สถานะ:</label>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="status" id="status1" {{ $transaction_data->status=='pending'? 'checked':''}}  value="pending">
                                                <label class="form-check-label" for="status1">
                                                    รอการตรวจสอบ
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2" {{ $transaction_data->status=='paid'? 'checked':''}} value="paid">
                                                <label class="form-check-label" for="status2">
                                                    ได้รับเงินแล้ว
                                                </label>
                                            </div>
                                        </div>


                                 </div>

                            </div>


                             <div class="mt-4">
                                <input type="hidden" name="id" value="{{ $transaction_data->id}}" />
                                <input type="hidden" name="token_id" value="{{ $transaction_data->token_id}}" />
                                 @if($transaction_data->is_erased == 'TRUE' || $transaction_data->is_erased == TRUE || $transaction_data->is_erased == 1)
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="if(confirm('ยืนยันการลบ?')) {  document.getElementById('form_cancel').submit(); }">ยกเลิกสัญญา</button>
                                 @endif
                            </div>

                            </form>

                             <div>
                             <form action="{{ route('backend.online_transaction.cancel') }}" method="POST" id="form_cancel">
                                @csrf
                                 <input type="hidden" name="id" value="{{ $transaction_data->id}}" />
                                <input type="hidden" name="token_id" value="{{ $transaction_data->token_id}}" />

                            </form>
                            </div>


                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
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
