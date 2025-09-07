@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ภาพรวม</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">ภาพรวม</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ฝากขายทอง ( {{ number_format($pawn_total_transaction) }} รายการ)</span>
                                <h4 class="mb-3">
                                    <span>{{ number_format($pawn_total_amount) }}</span> บาท
                                </h4>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            {{-- <span class="badge {{ $pawn_difference <0?'bg-warning-subtle text-warning':'bg-success-subtle text-success' }}">{{ $pawn_total_amount }}</span> --}}
                            <span class="ms-1 text-muted font-size-13">เดือน{{ \Carbon\Carbon::parse(now()->format('F'))->thaidate('F') }}</span>
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ต่อดอก ({{ number_format($interest_total_transaction) }} รายการ)</span>
                                <h4 class="mb-3">
                                    <span>{{ number_format($interest_total_amount) }}</span>  บาท
                                </h4>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            {{-- <span class="badge {{ $interest_difference <0?'bg-warning-subtle text-warning':'bg-success-subtle text-success' }}">{{ $interest_total_amount_online }}</span> --}}
                            <span class="ms-1 text-muted font-size-13">เดือน{{ \Carbon\Carbon::parse(now()->format('F'))->thaidate('F') }}</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col-->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">เพิ่มเงินต้น  ({{ number_format($increase_total_transaction) }} รายการ)</span>
                                <h4 class="mb-3">
                                    <span>{{ number_format($increase_total_amount) }}</span> บาท
                                </h4>
                            </div>
                        </div>
                        <div class="text-nowrap">
                            {{-- <span class="badge bg-success-subtle text-success">{{ $increase_amount }}</span> --}}
                            <span class="ms-1 text-muted font-size-13">เดือน{{ \Carbon\Carbon::parse(now()->format('F'))->thaidate('F') }}</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">ลดเงินต้น ({{ number_format($decrease_total_transaction) }} รายการ)</span>
                                <h4 class="mb-3">
                                    <span>{{ number_format($decrease_total_transaction) }}</span> บาท
                                </h4>
                            </div>

                        </div>
                        <div class="text-nowrap">
                            {{-- <span class="badge bg-success-subtle text-success">{{ $decrease_amount }}</span> --}}
                            <span class="ms-1 text-muted font-size-13">เดือน{{ \Carbon\Carbon::parse(now()->format('F'))->thaidate('F') }}</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row-->



        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">รายการฝากขายล่าสุด</h4>
                        <div class="flex-shrink-0">
                            <form action="{{ route('admin.dashboard.latest') }}" method="POST" onchange="this.submit()">
                                @csrf
                                <select class="form-select form-select-sm mb-0 my-n1" name="pawn_range">
                                <option value="today" {{ isset($keyword) && $keyword=='today'?'selected':'' }}>วันนี้</option>
                                <option value="yesterday" {{ isset($keyword) && $keyword=='yesterday'?'selected':'' }}>เมื่อวาน</option>
                                <option value="week" {{ isset($keyword) && $keyword=='week'?'selected':'' }}>สัปดาห์ล่าสุด</option>
                                <option value="month" {{ isset($keyword) && $keyword=='month'?'selected':'' }}>เดือนล่าสุด</option>
                                <option value="quarter" {{ isset($keyword) && $keyword=='quarter'?'selected':'' }}>3เดือนล่าสุด</option>
                            </select>
                            </form>

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body px-0">
                        <div class="px-3" data-simplebar style="max-height: 352px;">
                            <ul class="list-unstyled activity-wid mb-0">

                                @foreach ($pawn_data as $item )
                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                        <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">{{ \Carbon\Carbon::parse($item->pawn_date)->thaidate('j F Y') }}</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68{{ $item->pawn_id }}</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : {{ $item->pawn_barcode }}</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <h6 class="mb-1">{{ $item->remarks }} หนัก {{ $item->total_weight }} กรัม</h6>
                                                <div class="font-size-13">{{ number_format($item->total_pawn_amount) }}</div>
                                                <div class="font-size-13">{{ $item->customer_name }}</div>
                                            </div>

                                            <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('backend.pawn_transaction.contract',$item->id) }}" target="_blank">หนังสือสัญญา</a>
                                                        <a class="dropdown-item" href="{{ route('backend.customer.cudtomer_info',[$item->customer_name,$item->customer_phone]) }}" target="_blank">ลูกค้า</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ route('backend.pawn_transaction.detail',$item->id) }}">รายละเอียด</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach




                            </ul>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

              <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">รายการต่อดอกที่เลยกำหนด</h4>
                        <div class="flex-shrink-0">
                            <form action="{{ route('admin.dashboard.latest') }}" method="POST" onchange="this.submit()">
                              @csrf
                             <select class="form-select form-select-sm mb-0 my-n1" name="overdue_range">
                                <option value="15" {{ isset($range) && $range=='15'?'selected':'' }}>ไม่เกิน 15 วัน</option>
                                <option value="30" {{ isset($range) && $range=='30'?'selected':'' }}>ไม่เกิน 30 วัน</option>
                                <option value="45" {{ isset($range) && $range=='45'?'selected':'' }}>ไม่เกิน 45 วัน</option>
                                <option value="60" {{ isset($range) && $range=='60'?'selected':'' }}>ไม่เกิน 60 วัน</option>
                                <option value="75" {{ isset($range) && $range=='75'?'selected':'' }}>ไม่เกิน 75 วัน</option>
                                <option value="90" {{ isset($range) && $range=='90'?'selected':'' }}>ไม่เกิน 90 วัน</option>
                                <option value="180" {{ isset($range) && $range=='180'?'selected':'' }}>มากกว่า 90 วัน/ไม่เกิน 6 เดือน</option>
                            </select>
                        </div>
                    </div><!-- end card header -->



                    <div class="card-body px-0">
                        <div class="px-3" data-simplebar style="max-height: 352px;">
                            <ul class="list-unstyled activity-wid mb-0">
                                @foreach ($overdue as $item )
                                <li class="activity-list activity-border">
                                    <div class="activity-icon avatar-md">
                                        <span class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                        <i class="fas fa-file-contract font-size-20"></i>
                                        </span>
                                    </div>
                                    <div class="timeline-list-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 overflow-hidden me-4">
                                                <h5 class="font-size-14 mb-1">วันครบกำหนดสัญญา :{{ \Carbon\Carbon::parse($item->pawn_expire_date)->thaidate('j F Y') }}</h5>
                                                <div class="font-size-13">สัญญาเลขที่ :	68{{ $item->pawn_id }}</div>
                                                <div class="font-size-13">รหัสบาร์โค้ด : {{ $item->pawn_barcode }}</div>
                                            </div>
                                            <div class="flex-shrink-2 text-end me-3">
                                                <div class="font-size-13">{{ number_format($item->total_pawn_amount) }}</div>
                                            </div>
                                             <div class="flex-shrink-0 text-end">
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-24" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('backend.pawn_transaction.contract_overdue',$item->pawn_barcode) }}" target="_blank">หนังสือสัญญา</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div><!-- end row -->

            <div class="row">
                         <div class="col-xl-4">
                <!-- card -->
                <div class="card bg-primary text-white shadow-primary card-h-100">
                    <!-- card body -->
                     <div class="card-body px-0">

                        <div class="d-flex align-items-center px-3 py-4">
                            <h5 style="color:#fff; text-align:center;">นำเข้าข้อมูล</h5>
                        </div>
                        <div class="px-3" data-simplebar style="max-height: 352px;">
                            <ul class="list-unstyled activity-wid mb-0">

                                @foreach ($import_log as $item )
                                <li>

                                    <div >
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ">
                                                <div class="font-size-14 mb-1">{{ \Carbon\Carbon::parse($item->created_at)->thaidate('j F Y') }}</div>
                                                     <div class="font-size-13">{{ $item->filename }}</div>
                                                <div class="font-size-13">{{ $item->message }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
           <!-- end col -->
        </div><!-- end row -->





    </div>
    <!-- container-fluid -->
</div>
@endsection
