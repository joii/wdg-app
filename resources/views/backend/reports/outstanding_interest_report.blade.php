@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายงานรายการดอกเบี้ยค้างชำระ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">รายงานรายการดอกเบี้ยค้างชำระ</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->


        <!-- start content -->


        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">สรุปยอดเงินรายการดอกเบี้ยค้างชำระปี {{ now()->year+543 }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="column_chart" data-colors='["#A81818"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">จำนวนการทำธุรกรรมรายการดอกเบี้ยค้างชำระปี {{ now()->year+543 }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="column_chart2" data-colors='["#A81818"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
            </div>
        </div>
        <!-- end row -->
         <script>
            /* Pass data to JavaScript to generate bar graph*/
            window.appData = @json($data);
        </script>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">รายการดอกเบี้ยค้างชำระ<br>
                             <p class="card-title-desc">รายการต่อดอก {{ \Carbon\Carbon::parse($startOfLastWeek)->thaidate('j F Y') }} ถึงวันที่ {{ \Carbon\Carbon::parse($endOfLastWeek)->thaidate('j F Y') }}
                            </p>
                        </h4>

                        <div class="d-flex align-items-center gap-1 mb-4">
                           <form action="{{ route('backend.reports.outstanding_interest_custom_report') }}" method="POST" id="custom_report">
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
                                    <li><a class="dropdown-item" href="#" id="date_filter_submit" onclick="$('#custom_report').submit()">Action</a></li>
                                </ul>
                            </div>
                        </div>
                      </div>

                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>เลขที่สัญญา</th>
                                <th>รหัสบาร์โค้ด</th>
                                <th>วันที่ทำรายการ</th>
                                <th>ดอกเบี้ยที่ชำระ</th>
                                <th>ลูกค้า</th>
                                <th>เบอร์ติดต่อ</th>
                                <th style="width: 90px;"></th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach ($transactions as $item)
                              <tr>
                                <td>{{ \Carbon\Carbon::parse($item->transaction_date)->thaidate('y') }}{{sprintf('%05d', $item->id) }}</td>
                                <td> {{ \Carbon\Carbon::parse($item->transaction_date)->thaidate('j F Y') }}</td>
                                <td>{{ $item->transaction_date }}</td>
                                <td>{{ $item->interest }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_phone }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('backend.online_transaction.accrued_interest.contract',$item->pawn_barcode) }}" target="_blank">หนังสือสัญญา</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>


                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- end content -->
    </div><!-- end container-fluid -->
</div><!-- end page-content -->

@endsection

