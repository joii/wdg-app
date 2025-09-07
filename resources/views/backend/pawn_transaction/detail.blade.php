@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายละเอียดรายการขายฝาก</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.pawn_transaction.index') }}">รายการขายฝาก</a></li>
                            <li class="breadcrumb-item active">รายละเอียดรายการขายฝาก</li>
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
                            <div class="invoice-title">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="mb-4">
                                            <span class="logo-txt">ห้างทองกาญจนาภิเษก</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="mb-4">
                                            <h4 class="float-end font-size-16">สัญญาเลขที่ 68{{  $data->pawn_id }}</h4>
                                        </div>
                                    </div>
                                </div>


                                <p class="mb-1">64/6-7 ม.4 ต.ดอนหัวฬ่อ อ.เมืองชลบุรี จ.ชลบุรี 20000</p>
                                {{-- <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> abc@123.com</p> --}}
                                <p>092 979 7777</p>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h5 class="font-size-15">เลขที่บาร์โค้ด:</h5>
                                        <p>{{ $data->pawn_barcode }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15">เลขที่บัตร:</h5>
                                        <p class="mb-1">{{ $data->pawn_card_no }}</p>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <div>
                                            <h5 class="font-size-15">วันที่ทำสัญญาขายฝาก/วันที่ต่อสัญญา:</h5>
                                            <p>
                                                {{ \Carbon\Carbon::parse($data->pawn_date)->thaidate('l j F Y') }}/{{ \Carbon\Carbon::parse($data->pawn_date_cal_interest)->thaidate('j F Y') }}
                                            </p>
                                        </div>

                                        <div class="mt-4">
                                            <h5 class="font-size-15">สาขาที่ทำสัญญา:</h5>
                                            <p class="mb-1">สาขา 1</p>

                                        </div>
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
                                            <strong>เลขประจำตัวประชาชน:</strong> {{ $data->id_card }}
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
                                                <strong>ราคาประเมิน:</strong> {{ number_format($data->total_pawn_amount) }} บาท<br/>
                                                <strong>จำนวนเงินขายฝากมูลค่า:</strong>{{ number_format($data->total_pawn_amount_first) }} บาท<br/>
                                                <strong>อัตราดอกเบี้ย:</strong> ร้อยละ {{ $data->percent_interest }}<br/>
                                            </p>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="py-2 mt-3">
                                <h5 class="font-size-15">รายการชำระดอกทั้งหมด</h5>
                            </div>
                            <div class="p-4 border rounded">
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">จำนวนเดือน</th>
                                                <th>วันที่ครบกำหนดชำระ</th>
                                                <th>ยอดชำระ(บาท)</th>
                                                <th class="text-end" style="width: 120px;">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($pawn_interest_data as $key =>$item )

                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>  {{-- {{ \Carbon\Carbon::parse($data->pawn_date)->thaidate('j F Y') }} --}}
                                                     {{ \Carbon\Carbon::parse($item->pawn_expire_date)->thaidate('j F Y') }}
                                                </td>
                                                <td>{{ $item->interest }}</td>
                                                <td class="text-end"><a class="btn btn-danger btn-rounded waves-effect waves-light">รอการชำระ</a></td>
                                            </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-print-none mt-3">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                    <a href="{{ route('backend.online_transaction.interest_by_customer',[$data->id_card ==NULL?'-':$data->id_card,$data->customer_phone]) }}" class="btn btn-success waves-effect waves-light" target="_blank">ต่อดอก</a>
                                    <a href="{{ route('backend.online_transaction.accrued_by_customer',[$data->id_card ==NULL?'-':$data->id_card,$data->customer_phone]) }}" class="btn btn-danger waves-effect waves-light" target="_blank">ส่งดอก</a>
                                    <a href="{{ route('backend.online_transaction.decrease_by_customer',[$data->id_card ==NULL?'-':$data->id_card,$data->customer_phone]) }}" class="btn btn-primary waves-effect waves-light" target="_blank">ลดเงินต้น</a>
                                    <a href="{{ route('backend.online_transaction.increase_by_customer',[$data->id_card ==NULL?'-':$data->id_card,$data->customer_phone]) }}" class="btn btn-warning waves-effect waves-light" target="_blank">เพิ่มเงินต้น</a>
                                </div>
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
