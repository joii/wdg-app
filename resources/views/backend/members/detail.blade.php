@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">สมาชิกเว็บไซต์</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">สมาชิกเว็บไซต์</li>
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
                                                <h5 class="font-size-16 mb-1">ข้อมูลสมาชิกเว็บไซต์</h5>
                                                <hr/>
                                                <p>
                                                    <strong>ชื่อ:</strong> {{ $data->firstname }}<br/>
                                                     <strong>นามสกุล:</strong> {{ $data->lastname }}<br/>
                                                    <strong>เบอร์โทร:</strong> {{ $data->phone }}<br/>
                                                </p>


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
