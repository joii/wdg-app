@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
           <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายการส่งดอก</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">รายการส่งดอก</li>
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
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-4">
                                        <a href="{{ route('backend.reports.interest_report') }}">
                                        <button type="button" class="btn btn-light waves-effect waves-light">ออกรายงาน</button>
                                        </a>
                                    </div>
                                </div>
                                 <div class="col-sm-auto">
                                    <div class="d-flex align-items-center gap-1 mb-4">
                                        <form action="{{ route('backend.online_transaction.interest_custom') }}" method="POST" id="custom_transaction">
                                            @csrf
                                            <div class="input-group datepicker-range">
                                                <input type="text" class="form-control flatpickr-input" data-input aria-describedby="date1" name="date_filter" id="date_filter"">
                                                <button class="input-group-text" id="date1" data-toggle type="button"><i class="bx bx-calendar-event"></i></button>
                                            </div>
                                        </form>
                                        <div class="dropdown">
                                            <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#" id="date_filter_submit" >Action</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="table-responsive">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">

                                                <th>ลำดับ</th>
                                                <th>เลขที่สัญญา</th>
                                                <th>วันที่ทำสัญญา</th>
                                                <th>รหัสบาร์โค้ด</th>
                                                <th>สินค้า</th>
                                                <th>มูลค่า</th>
                                                <th>ดอกเบี้ย</th>
                                                <th>ลูกค้า</th>
                                                <th>สถานะ</th>

                                            <th style="width: 90px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pawn_data as $item)
                                        <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->transaction_date)->thaidate('y') }}{{sprintf('%05d', $item->id) }}</td>
                                                <td> {{ \Carbon\Carbon::parse($item->transaction_date)->thaidate('j F Y') }}</td>
                                                <td>{{ $item->pawn_barcode }}</td>
                                                <td>{{ $item->type_full }}</td>
                                                <td>{{ $item->total_pawn_amount }}</td>
                                                <td>{{ $item->payment_amount }}</td>
                                                <td>{{ $item->customer_name }}</td>
                                                <td> <div class="dot {{ $item->status=='pending'?'danger':'success' }}" ></div></td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                         <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('backend.online_transaction.accrued_interest.contract',$item->pawn_barcode) }}" target="_blank">หนังสือสัญญา</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('backend.online_transaction.accrued_interest.print',$item->pawn_barcode) }}" target="_blank">พิมพ์</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('backend.online_transaction.accrued_interest.edit',$item->token_id) }}">แก้ไข</a></li>
                                                    </ul>                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                            <!-- end table responsive -->
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
        $('#custom_transaction').submit();
    });
</script>
 @endsection
