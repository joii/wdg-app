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
                    <form class="row g-3 form-register" method="post" action="{{ route('member.bank_account.store') }}" enctype="multipart/form-data">
                        @csrf
                         <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">เลขบัญชี<span class="text-danger">*</span></label>
                                <select name="bank_name" id="bank_name" class="form-select" required>
                                    <option value="" selected>-- เลือกธนาคาร --</option>
                                    <option value="BBL">ธนาคารกรุงเทพ (BBL)</option>
                                    <option value="KBANK">ธนาคารกสิกรไทย (KBANK)</option>
                                    <option value="KTB">ธนาคารกรุงไทย (KTB)</option>
                                    <option value="BAY">ธนาคารกรุงศรีอยุธยา (BAY)</option>
                                    <option value="SCB">ธนาคารไทยพาณิชย์ (SCB)</option>
                                    <option value="CIMBT">ธนาคารซีไอเอ็มบี ไทย (CIMB Thai)</option>
                                    <option value="TISCO">ธนาคารทิสโก้ (TISCO)</option>
                                    <option value="KKP">ธนาคารเกียรตินาคินภัทร (KKP)</option>
                                    <option value="TMBThanachart">ธนาคารทหารไทยธนชาต (TTB)</option>
                                    <option value="UOB">ธนาคารยูโอบี (UOB)</option>
                                    <option value="GSB">ธนาคารออมสิน (GSB)</option>
                                    <option value="BAAC">ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร (BAAC)</option>
                                    <option value="SME">ธนาคารเพื่อการพัฒนาวิสาหกิจขนาดกลางและขนาดย่อม (SME Bank)</option>
                                    <option value="EXIM">ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย (EXIM Bank)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">เลขบัญชี (เฉพาะตัวเลขเท่านั้น)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="bank_account_number" required >
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">ชื่อบัญชี<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="account_holder_name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <div class="form-group mb-3">
                                    <label for="book_bank" class="form-label">หน้าปกบัญชี</label>
                                    <input class="form-control" type="file" name="book_bank"  id="book_bank" required>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div>
                                <h5 class="font-size-14 mb-3">ตั้งค่าใช้งาน</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="use_status" id="use_status1" checked  value="default">
                                    <label class="form-check-label" for="use_status1">
                                        เลขบัญชีหลัก
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="use_status" id="use_status2" value="general">
                                    <label class="form-check-label" for="use_status2">
                                        เลขบัญชีทั่วไป
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-12 pt-2 pb-4">
                            <input type="hidden" name="member_id" value="{{ Auth::guard('member')->user()->id }}">
                            <button class="btn btn-green-dark w-100" type="submit">
                               บันทึกข้อมูล
                            </button>
                        </div>




                    </form><!--row-->
                </div><!--boxed-->

            </div>
        </div><!--row-->
    </div>
 </div>

@endsection
