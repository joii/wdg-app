@extends('frontend.master')
@section('content')

 <div class="section section-form">
    <div class="container">

        <div class="row card-contract-list">
            <div class="card">
                <div class="boxed" style="--width:400px">
                    <div class="d-block py-2 mt-2">
                        <h3 class="mb-2">ข้อมูลสมาชิก</h3>
                        <p class="text-note"></p>
                    </div>
                    <form class="row g-3 form-register" method="post" action="{{ route('member.member_profile.update') }}">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <label class="firstname">ชื่อ(ตามบัตรประชาชน)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname" value="{{ $profileData->firstname }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="lastname">นามสกุล(ตามบัตรประชาชน)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname" value="{{ $profileData->lastname }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="phone">เบอร์โทรติดต่อ <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="phone" value="{{ $profileData->phone }}" disabled >
                            </div>
                        </div>

                         <div class="col-12">
                            <div class="form-group">
                                <label class="registered_phone">เบอร์โทรที่ใช้ทำสัญญา <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name=registered_phone" value="{{ $profileData->registered_phone }}" disabled >
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="email">อีเมล์</label>
                                <input type="text" class="form-control" name="email" value="{{ $profileData->email !=''?$profileData->email:'' }}">
                            </div>
                        </div>



                        <div class="col-12 pt-4 pb-4">
                            <button class="btn btn-green-dark w-100" type="submit">
                                แก้ไขข้อมูล
                            </button>
                        </div>




                    </form><!--row-->
                </div><!--boxed-->
                <hr/>


            </div>
        </div><!--row-->
        <div class="container pt-4">
            <div class="info-row pt-lg-3 pt-sm-2 pt-0">
                 <h3 class="mb-2">ข้อมูลบัญชีธนาคาร</h3>
                 <p class="text-note"><a href="{{ route('member.bank_account.create') }}">เพิ่มบัญชีธนาคาร</a></p>
            </div>
                <div class="row card-contract-list">
                    @if(count($bankAccountData )==0)
                    <p>ยังไม่มีข้อมูลบัญชีธนาคาร กรุณาเพิ่มบัญชีธนาคารของคุณ</p>
                    @else
                        @foreach ($bankAccountData  as $item )
                        <div class="col-lg-4 col-sm-6 pb-2">
                            <div class="card card-contract aos-init aos-animate" data-aos="fade-in">
                                <div class="card-header">
                                    <img class="icons file" src="{{ asset('frontend/assets/img/icons/icon-file.svg') }}" alt="">
                                    <div>
                                        <h3>ธนาคาร: {{ $item->bank_name }}</h3>
                                        <h3>เลขบัญชี: {{ $item->bank_account_number }}</h3>
                                        <p>ชื่อบัญชี : {{ $item->account_holder_name }}</p>
                                        <p>สถานะ : {{ $item->use_status=="default"?"บัญชีหลัก":"บัญชีทั่วไป" }}</p>
                                    </div>
                                </div>
                                <div class="info-row">
                                <p></p>
                                <p class="price pt-1" ><a href="{{ route('member.bank_account.edit',$item->id) }}">แก้ไขข้อมูล</a></p>
                                 </div>
                            </div><!--card-->
                        </div>
                        @endforeach
                    @endif

                </div><!--card-contract-list-->
        </div>
    </div>
 </div>

@endsection
