@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายงาน</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">รายงานโดยสรุป</li>
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
                        <h4 class="card-title mb-0">รายงานโดยสรุป</h4>
                    </div>
                    <div class="card-body">
                        <div id="column_chart" data-colors='["#16604A", "#A81818", "#bf9b30","#ffbf00"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
                <script>
                    /* Pass data to JavaScript to generate bar graph*/
                   window.appData = @json($data);
                </script>
            </div>
        </div>
        <!-- end row -->

        <!-- end content -->
    </div><!-- end container-fluid -->
</div><!-- end page-content -->
@endsection

