@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายงานรายการต่อดอก</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">รายงานรายการต่อดอก</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->


        <!-- start content -->


        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">สรุปภาพรวมรายการต่อดอกปี {{ now()->year+543 }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="column_chart" data-colors='["#A81818"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
                <script>
                    /* Pass data to JavaScript to generate bar graph*/
                   window.appData = @json($data);
                </script>
            </div>
        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">รายการต่อดอก<br>
                            <p class="card-title-desc">รายการต่อดอกถึงวันที่ {{ now()->day }} {{ config('constants.month_th')[now()->month-1] }} {{ now()->year + 543 }} เวลา {{ now()->format('H:i') }}
                            </p>
                        </h4>

                        <div class="d-flex align-items-center gap-1 mb-4">
                            <div class="input-group datepicker-range">
                                <input type="text" class="form-control flatpickr-input" data-input aria-describedby="date1" name="date_filter">
                                <button class="input-group-text" id="date1" data-toggle><i class="bx bx-calendar-event"></i></button>
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" id="date_filter_submit">Action</a></li>
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
                                <th>วันที่ครบกำหนด</th>
                                <th>วันที่ทำรายการ</th>
                                <th>สินค้า/น้ำหนัก</th>
                                <th>ดอกเบี้ยที่ชำระ</th>
                                <th>ลูกค้า</th>
                            </tr>
                            </thead>


                            <tbody>
                            <tr>
                                <td>68300870</td>
                                <td>AHEWGJ971</td>
                                <td>1 พ.ค. 2568</td>
                                <td>1 พ.ค. 2568</td>
                                <td>แหวนบริษัท B หนัก 7.5</td>
                                <td>150</td>
                                <td>น.ส. อนุสรา  ภูชื่นแสง</td>
                            </tr>

                            <tr>
                                <td>68300871</td>
                                <td>AHEWGJ972</td>
                                <td>12 พ.ค. 2568</td>
                                <td>10 พ.ค. 2568</td>
                                <td>คาร์เทียร์ หนัก 15.17</td>
                                <td>500</td>
                                <td>นาย เมธา โภควรรณวิทย์</td>
                            </tr>
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
<script>
    $('#date_filter_submit').click(function() {
  var inputValue = $('input[name="date_filter"]').val();
  // Do something with inputValue, like logging it to the console
  alert(inputValue);
});

$('#datatable-buttons_filter').label('ค้นหา:');
</script>
@endsection

