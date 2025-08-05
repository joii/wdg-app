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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-4">
                                        <button type="button" class="btn btn-light waves-effect waves-light">ออกรายงาน</button>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
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
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
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

                                                <th>ชื่อ-นามสกุล</th>
                                                <th>เลขประจำตัวประชาชน</th>
                                                {{-- <th>ที่อยู่</th> --}}
                                                <th>เบอร์โทร</th>


                                            <th style="width: 90px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                                <td>{{ $item->id_card }}</td>
                                                {{-- <td>{{ $item->address }}</td> --}}
                                                <td>{{ $item->tel }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('backend.customer.detail',$item->id) }}">รายละเอียด</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('backend.customer.detail',$item->id) }}">แก้ไข</a></li>
                                                    </ul>
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
  // Do something with inputValue, like logging it to the console
  alert(inputValue);
});
</script>
 @endsection
