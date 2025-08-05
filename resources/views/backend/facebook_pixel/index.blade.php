@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Facebook Pixel</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">Facebook Pixel</li>
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
                                      <a href="{{ route('backend.facebook_pixel.create') }}" class="btn btn-success" >เพิ่มข้อมูล</a>
                                    </div>

                                    <div class="card-body">

                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Pixel Name</th>
                                                <th>Pixel ID</th>
                                                <th>Domain Scope</th>
                                                <th>Event Script</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach ($pixels as $item)
                                            <tr>
                                                <td>{!! $item->pixel_name !!}</td>
                                                <td>{!! $item->pixel_id !!}</td>
                                                <td>{!! $item->domain_scope !!}</td>
                                                <td>{!! $item->event_script !!}</td>
                                                <td>{!! $item->status =='active'?'เปิดใช้งาน':'ปิดการใช้งาน' !!}</td>
                                                <th><a href="{{ route('backend.facebook_pixel.edit',$item->id) }}" class="btn btn-outline-danger">แก้ไข</a></th>
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