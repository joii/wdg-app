@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ราคาทอง</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">ราคาทอง</li>
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
                                    {{-- <div class="card-header" style="text-align: right;">
                                      <a href="{{ route('backend.branch.create') }}" class="btn btn-success" >เพิ่มข้อมูล</a>
                                    </div> --}}

                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>วันที่/เวลา</th>
                                                <th>ทองแท่ง:รับซื้อ(บาท)</th>
                                                <th>ทองแท่ง:ขายออก(บาท)	</th>
                                                <th>ทองรูปพรรณ:รับซื้อ(บาท)</th>
                                                <th>ทองรูปพรรณ:ขายออก(บาท)	</th>
                                                <th>ขึ้น/ลง</th>

                                            </tr>
                                            </thead>


                                            <tbody>
                                                @foreach ($data as $k=>$item)
                                                <tr>
                                                    <td>{{ $item->date }} {{ $item->time }}</td>
                                                    <td>{{ number_format($item->sell_gold_bar,2) }}</td>
                                                    <td>{{ number_format($item->buy_gold_bar,2) }}</td>
                                                    <td>{{ number_format($item->sell_gold,2) }}</td>
                                                    <td>{{ number_format($item->buy_gold,2) }}</td>
                                                    <td><i class="bx {{ $item->change_compare_yesterday=='+'?'bx-caret-up text-success':'bx-caret-down text-danger' }}"></i></td>
                                                </tr>
                                                @endforeach




                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->

            </div>
            <!-- end content -->
    </div>
 </div>
 @endsection
