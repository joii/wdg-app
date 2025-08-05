@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">ข้อมูลระดับสิทธิ์การใช้งาน</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">ข้อมูลระดับสิทธิ์การใช้งานน</li>
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
                                <a href="{{ route('backend.authen.rbac.create') }}" class="btn btn-success" >เพิ่มข้อมูล</a>
                            </div>

                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>กลุ่มผู้ใช้งาน</th>
                                        <th>ข้อมูลระดับสิทธิ์การใช้งาน</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($roles as $key=>$item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @foreach ($item->permissions as $prem)
                                                <span class="badge bg-danger">{{ $prem->name }}</span>
                                            @endforeach

                                        </td>
                                        <th><a href="{{ route('backend.authen.rbac.edit',$item->id) }}" class="btn btn-outline-danger">แก้ไข</a></th>
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
