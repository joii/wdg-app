@extends('admin.admin_dashboard')
@section('admin')
 <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
 <style>
.form-check-label{
    text-transform: capitalize;
}
.txt-capital{
    text-transform: capitalize;
}
</style>
<div class="page-content">
    <div class="container-fluid">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">กำหนดระดับสิทธิ์ (Role-Based Access Control)</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ภาพรวม</a></li>
                            <li class="breadcrumb-item active">กำหนดระดับสิทธิ์ (RBAC)</li>
                        </ol>
                    </div>

                </div>
            </div>
            </div>
            <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">กำหนดระดับสิทธิ์ (Role-Based Access Control)</h4>

                    </div>
                    <div class="card-body">
                        <form id="myForm" action="{{ route('backend.authen.rbac.store') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <div class="form-group mb-3">
                                        <label for="role_id" class="form-label">ระดับสิทธิ์ <span class="text-danger ">*</span></label>
                                        <select class="form-select" id="role_id" name="role_id"  required="">
                                            <option value="" selected>กรุณาระบุ</option>
                                            @foreach ( $role as $item)
                                                <option value="{{ $item->id }}" >{{ ucfirst($item->name) }}</option>
                                            @endforeach


                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                       <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="formCheck1">
                                            <label class="form-check-label" for="formCheck1">
                                              ทุกสิทธิ์การเข้าถึง
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @foreach ($permission_groups as $group)
                            <div class="row">
                            <div class="col-3">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $group->group_name }}
                                    </label>
                                </div>
                            </div>


                            <div class="col-9">

                                @php
                                $permissions = App\Models\Admin::getpermissionByGroupName($group->group_name);
                                @endphp

                                    @foreach ($permissions as $permission)
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="permission[]" value="{{ $permission->id }}" type="checkbox" id="flexCheckDefault{{ $permission->id }}">
                                        <label class="form-check-label" for="flexCheckDefault{{ $permission->id }}">
                                        {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                <br>
                                </div>

                            </div>
                            {{-- //end row --}}

                        @endforeach


                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึกข้อมูล</button>
                        </div>
                            </form>
                    </div>

                </div>
                <!-- end card -->
            </div> <!-- end col -->
    </div>
</div>

<script>
    $('#formCheck1').click(function() {
        if($(this).is(':checked')){
            $('input[type="checkbox"]').prop('checked', true);
        }else{
            $('input[type="checkbox"]').prop('checked', false);
        }
    });
</script>
@endsection
