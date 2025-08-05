@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ราคาทองวันนี้</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('backend.gold_price.index') }}">ราคาทอง</a></li>
                            <li class="breadcrumb-item active">ราคาทองวันนี้</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->

            <!-- start content -->
                        <div class="row">
                            <div class="col-12">
                                <h1>ราคาทองวันนี้</h1>

                                 @if($raw["status"]=="success")
                                 <p><strong>ราคาทอง (GBP/oz):</strong></p>
                                 <ul>
                                     <li>ขายออก: {{ $gold['buy'] }}</li>
                                     <li>รับซื้อ: {{ $gold['sell'] }}</li>
                                     {{-- <li>Change: {{ $change['compare_yesterday'] }}</li> --}}
                                 </ul>
                                 @else
                                 <p>ไม่พบข้อมูลราคาทอง</p>
                                 @endif
                            </div> <!-- end col -->

            </div>
            <!-- end content -->
    </div>
 </div>
 @endsection