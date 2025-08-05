@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">รายการขายฝากหน้าร้าน</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">รายการขายฝากหน้าร้าน</li>
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
                                    <div class="card-header" style="text-align: right;">
                                      <a href="{{ route('backend.branch.create') }}" class="btn btn-success" >เพิ่มข้อมูล</a>
                                    </div>

                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>เลขที่สัญญาขายฝาก</th>
                                                <th>วันที่ทำสัญญา</th>
                                                <th>รหัสบาร์โค้ด</th>
                                                <th>สินค้า</th>
                                                <th>น้ำหนัก</th>
                                                <th>ยอดขายฝาก</th>
                                                <th>ลูกค้า</th>
                                                <th></th>

                                            </tr>
                                            </thead>


                                            <tbody>

                                            <tr>
                                                <td>68300870</td>
                                                <td>-</td>
                                                <td>AHEWGJ971</td>
                                                <td>แหวนบริษัท B</td>
                                                <td>7.5</td>
                                                <td>12000</td>
                                                <td>น.ส. อนุสรา  ภูชื่นแสง</td>
                                                <th><a href="#" class="btn btn-outline-danger">รายละเดียด</a></th>
                                            </tr>

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
