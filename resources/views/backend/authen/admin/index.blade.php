@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ผู้ดูแลระบบ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">ผู้ดูแลระบบ</li>
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
                                <a href="{{ route('backend.authen.admin.create') }}" class="btn btn-success" >เพิ่มข้อมูล</a>
                            </div>

                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>อีเมล์</th>
                                        <th>เบอร์โทร</th>
                                        <th>ระดับสิทธ์</th>
                                        <th></th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach ($admins as $item)
                                    <tr>
                                        <td>{!! $item->name !!}</td>
                                        <td>{!! $item->email !!}</td>
                                        <td>{!! $item->phone !!}</td>
                                        <td>
                                            @foreach ($item->roles as $role)
                                                <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <th><a href="{{ route('backend.authen.admin.edit',$item->id) }}" class="btn btn-outline-danger">แก้ไข</a></th>
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
