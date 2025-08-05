@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">สาขา</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">สาขา</li>
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
                                        <th>ชื่อสาขา</th>
                                        <th>ที่ตั้ง</th>
                                        <th>ละติจูด</th>
                                        <th>ลองจิจูด</th>
                                        <th>เบอร์โทร</th>
                                        <th>สถานะ</th>
                                        <th></th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{!! $item->name !!}</td>
                                        <td>{!! $item->location !!}</td>
                                        <td>{!! $item->latitude !!}</td>
                                        <td>{!! $item->longitude !!}</td>
                                        <td>{!! $item->phone !!}</td>
                                        <td>{!! $item->status =='active'?'เปิดใช้งาน':'ปิดการใช้งาน' !!}</td>
                                        <th><a href="{{ route('backend.branch.edit',$item->id) }}" class="btn btn-outline-danger">แก้ไข</a></th>
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