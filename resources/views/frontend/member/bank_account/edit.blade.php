@extends('frontend.master')
@section('content')

 <div class="section section-form">
    <div class="container">
        <div class="row card-contract-list">
            <div class="card">
                <div class="boxed" style="--width:400px">
                    <div class="d-block py-2 mt-2">
                       <h3 class="mb-2">ข้อมูลบัญชีธนาคาร</h3>
                        <p class="text-note"></p>
                    </div>
                    <form class="row g-3 form-register" method="post" action="{{ route('member.bank_account.update') }}" enctype="multipart/form-data">
                        @csrf
                         <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">เลขบัญชี<span class="text-danger">*</span></label>
                                <select name="bank_name" id="bank_name" class="form-select" required>
                                    <option value="" selected>-- เลือกธนาคาร --</option>
                                    <option value="BBL" {{ $data->bank_name =="BBL"?'selected':'' }}>ธนาคารกรุงเทพ (BBL)</option>
                                    <option value="KBANK" {{ $data->bank_name =="KBANK"?'selected':'' }}>ธนาคารกสิกรไทย (KBANK)</option>
                                    <option value="KTB" {{ $data->bank_name =="KTB"?'selected':'' }}>ธนาคารกรุงไทย (KTB)</option>
                                    <option value="BAY" {{ $data->bank_name =="BAY"?'selected':'' }}>ธนาคารกรุงศรีอยุธยา (BAY)</option>
                                    <option value="SCB" {{ $data->bank_name =="SCB"?'selected':'' }}>ธนาคารไทยพาณิชย์ (SCB)</option>
                                    <option value="CIMBT" {{ $data->bank_name =="CIMBT"?'selected':'' }}>ธนาคารซีไอเอ็มบี ไทย (CIMB Thai)</option>
                                    <option value="TISCO" {{ $data->bank_name =="TISCO"?'selected':'' }}>ธนาคารทิสโก้ (TISCO)</option>
                                    <option value="KKP" {{ $data->bank_name =="KKP"?'selected':'' }}>ธนาคารเกียรตินาคินภัทร (KKP)</option>
                                    <option value="TMBThanachart" {{ $data->bank_name =="TMBThanachart"?'selected':'' }}>ธนาคารทหารไทยธนชาต (TTB)</option>
                                    <option value="UOB" {{ $data->bank_name =="UOB"?'selected':'' }}>ธนาคารยูโอบี (UOB)</option>
                                    <option value="GSB" {{ $data->bank_name =="GSB"?'selected':'' }}>ธนาคารออมสิน (GSB)</option>
                                    <option value="BAAC" {{ $data->bank_name =="BAAC"?'selected':'' }}>ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร (BAAC)</option>
                                    <option value="SME" {{ $data->bank_name =="SME"?'selected':'' }}>ธนาคารเพื่อการพัฒนาวิสาหกิจขนาดกลางและขนาดย่อม (SME Bank)</option>
                                    <option value="EXIM" {{ $data->bank_name =="EXIM"?'selected':'' }}>ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย (EXIM Bank)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">เลขบัญชี (เฉพาะตัวเลขเท่านั้น)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="bank_account_number" value="{{ $data->bank_account_number }}" required >
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">ชื่อบัญชี<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="account_holder_name" value="{{ $data->account_holder_name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <div class="form-group mb-3">
                                    <label for="book_bank" class="form-label">หน้าปกบัญชี</label>
                                    @if($data->book_bank)
                                     <p><img src="{{ asset($data->book_bank) }}" alt="Image" class="img-fluid"></p>
                                    @endif
                                    <input class="form-control" type="file" name="book_bank"  id="book_bank" >
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <h5 class="font-size-14 mb-3">ตั้งค่าใช้งาน</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="use_status" id="use_status1" {{ $data->use_status=='default'?'checked':'' }}  value="default">
                                    <label class="form-check-label" for="use_status1">
                                        เลขบัญชีหลัก
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="use_status" id="use_status2" {{ $data->use_status=='general'?'checked':'' }} value="general">
                                    <label class="form-check-label" for="use_status2">
                                        เลขบัญชีทั่วไป
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div>
                                <h5 class="font-size-14 mb-3">สถานะการใช้งาน</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="status" id="status1" {{ $data->status=='active'?'checked':'' }}  value="active">
                                    <label class="form-check-label" for="status1">
                                        เปิดใช้งาน
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status2" {{ $data->status=='inactive'?'checked':'' }} value="inactive">
                                    <label class="form-check-label" for="status2">
                                        ปิดใช้งาน
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 pt-2 pb-4">
                            <input type="hidden" name="member_id" value="{{ Auth::guard('member')->user()->id }}">
                            <input type="hidden" name="old_book_bank" value="{{ $data->book_bank }}">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button class="btn btn-green-dark w-100" type="submit">
                               บันทึกข้อมูล
                            </button>
                        </div>






                    </form><!--row-->

                     <div class="col-12 pt-2 pb-4">
                          <form  method="post" action="{{ route('member.bank_account.destroy', $data->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button class="btn btn-red w-100" type="submit" onsubmit="return confirm('ยืนยันการลบข้อมูล')">
                               ลบข้อมูล
                            </button>
                          </form>
                        </div>

                         <div class="col-12 pb-4 text-center">
                            <a href="{{ route('member.member_profile') }}" >ย้อนกลับ</a>
                         </div>
                </div><!--boxed-->

            </div>
        </div><!--row-->
    </div>
 </div>

@endsection
