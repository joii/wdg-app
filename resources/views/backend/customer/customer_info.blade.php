@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ลูกค้าขายฝากทอง</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">ลูกค้าขายฝากทอง</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->

            <!-- start content -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">

                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1">ข้อมูลลูกค้า</h5>
                                                <hr/>
                                                @if ($data !=null)
                                                <p>
                                                    <strong>ชื่อ-สกุล:</strong> {{ $data->name }}<br/>
                                                    <strong>เลขประจำตัวประชาชน:</strong> {{ $data->id_card }}<br/>
                                                    <strong>ที่อยู่:</strong> {{ $data->address }}<br/>
                                                    <strong>เบอร์โทร:</strong> {{ $data->tel }}<br/>
                                                </p>

                                                @else
                                                  <p>ไม่พบข้อมูลลูกค้า</p>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">

                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1">รายการขายฝาก</h5>
                                                <hr/>
                                                @if (count($pawn_data) > 0)
                                                <div class="table-responsive">
                                                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                        <thead>
                                                            <tr class="bg-transparent">

                                                                    <th>เลขที่สัญญา</th>
                                                                    <th>วันที่ทำสัญญา</th>
                                                                    <th>รหัสบาร์โค้ด</th>
                                                                    <th>สินค้า</th>
                                                                    <th>น้ำหนัก</th>
                                                                    <th>มูลค่า</th>


                                                                <th style="width: 90px;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pawn_data as $item)
                                                            <tr>
                                                                <td>{{ $item->pawn_id }}</td>
                                                                    <td> {{ \Carbon\Carbon::parse($item->pawn_date)->thaidate('j F Y') }}</td>
                                                                    <td>{{ $item->pawn_barcode }}</td>
                                                                    <td>{{ $item->remarks }}</td>
                                                                    <td>{{ $item->total_weight }}</td>
                                                                    <td>{{ $item->total_pawn_amount }}</td>


                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item" href="{{ route('backend.pawn_transaction.contract',$item->id) }}">หนังสือสัญญา</a></li>
                                                                            <li><a class="dropdown-item"  href="{{ route('backend.pawn_transaction.detail',$item->id) }}">รายละเอียด</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach



                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- end table responsive -->

                                                @endif


                                            </div>
                                        </div>
                                    </div>
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
