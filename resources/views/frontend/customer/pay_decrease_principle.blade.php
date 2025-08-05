@extends('frontend.master')
@section('content')
<style>
  .file-upload {
    position: relative;
    overflow: hidden;
    display: inline-block;
  }

  .file-upload-button {
    border: 2px solid #D9A940;
    color: white;
    background-color: #D9A940;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
  }

  .file-upload-button:hover {
    background-color: #D9A940;
  }

  .file-upload input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    cursor: pointer;
    height: 100%;
    width: 100%;
  }

  .file-name {
    margin-left: 10px;
    font-style: italic;
    color: #333;
  }
</style>
    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
               <div class="boxed" style="--width:500px">
                    <div class="d-block py-md-2 mt-md-2">
                        <h3 class="mb-4">ดอกเบี้ยค้างชำระ</h3>

                        <p class="title-icon py-1">
                            <img class="icons file" src="{{ asset('frontend/assets/img/icons/icon-file.svg') }}" alt="">

                            @php
                                $year = (Str::substr($pawn_data->pawn_date, 0, 4))+543;
                            @endphp
                            สัญญาเลขที่: {{ (Str::substr($year, 2, 2))  }}{{ $pawn_data->pawn_id }}
                        </p>
                    </div>
                     <div class="row gy-4 form">

                        <form method="POST" action="{{ route('customer.decrease_principle') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <strong>ข้อมูลการชำระเงิน</strong>
                                <p>ธนาคารไทยพานิช </br>
                                   เลขที่บัญชี 202408271524690<br/>
                                   ชื่อบัญชี ห้างทองกาญจนาภิเษก ชลบุรี<br/>

                                </p>
                                <strong>สัญญาเลขที่</strong>
                                <p>
                              @php
                                $year = (Str::substr($pawn_data->pawn_date, 0, 4))+543;
                            @endphp
                            สัญญาเลขที่: {{ (Str::substr($year, 2, 2))  }}{{ $pawn_data->pawn_id }}
                             </p>
                                 <strong>ยอดชำระ</strong>
                                <p>{{ number_format($add_amount+$pawn_send_data->interest) }} บาท</p>
                            </div>
                            <div class="col-12">
                                <div class="file-upload">
                                <div class="file-upload-button">เลือกไฟล์</div>
                                <input type="file" id="fileInput" name="fileInput" onchange="showFileName(event)">
                                </div>
                                <span class="file-name" id="fileName" ></span>

                                <script>
                                function showFileName(event) {
                                    const fileInput = event.target;
                                    const fileNameSpan = document.getElementById("fileName");
                                    if (fileInput.files.length > 0) {
                                    fileNameSpan.textContent = fileInput.files[0].name;
                                    } else {
                                    fileNameSpan.textContent = "ยังไม่มีไฟล์";
                                    }
                                }
                                </script>
                            </div>
                             <div class="col-12 py-sm-4 mb-sm-5">
                                <input type="hidden" name="pawn_id" value="{{ $pawn_data->id }}">
                                <input type="hidden" name="interest" value="{{ $pawn_send_data->interest }}">
                                <input type="hidden" name="total_pawn_amount" value="{{ $pawn_send_data->total_pawn_amount }}">
                                <input type="hidden" name="pawn_cal_interest_date" value="{{ $pawn_send_data->pawn_cal_interest_date }}">
                                <input type="hidden" name="pawn_expire_date" value="{{ $pawn_send_data->pawn_expire_date }}">
                                <input type="hidden" name="pawn_id" value="{{ $pawn_send_data->pawn_id }}">
                                <input type="hidden" name="pawn_barcode" value="{{ $pawn_send_data->pawn_barcode }}">
                                <input type="hidden" name="pawn_send_interest_id" value="{{ $pawn_send_data->id }}">
                                <input type="hidden" name="pawn_barcode" value="{{ $pawn_data->pawn_barcode }}">
                                <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                                 <input type="hidden" name="add_amount" value="{{ $add_amount }}">
                                  <input type="hidden" name="payment_method" value="bank transfer">
                                <input type="hidden" name="payment_status" value="pending">
                                <input type="hidden" name="payment_date" value="{{ date('Y-m-d H:i:s') }}">
                                <input type="hidden" name="customer_name" value="{{ $pawn_data->customer_name }}">
                                <input type="hidden" name="customer_address" value="{{ $pawn_data->customer_address }}">
                                <input type="hidden" name="customer_phone" value="{{ $pawn_data->customer_phone }}">
                                <input type="submit" class="btn btn-green-dark w-100 mx-auto" style="max-width:370px" value="ยืนยันการทำธุรกรรม">

                                </input>
                        </div>
                        </form>

<div class="d-block py-md-2 mt-md-2">
                        <h3 class="mb-md-3 mb-4">ช่องทางชำระเงิน</h3>
                    </div>
                    <div class="row gy-3" style="padding-bottom: 50px;">
                        <div class="col-12">
                            <a href="#qrPaymentModal" data-bs-toggle="modal" class="btn btn-outline payment">
                                <img class="icons" src="{{ asset('frontend/assets/img/icons/icon-qrcode.png') }}" alt="">
                                ชำระผ่าน QR Code
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="#" class="btn btn-outline payment">
                                <img class="icons" src="{{ asset('frontend/assets/img/icons/icon-kbank.png') }}" alt="">
                                ชำระผ่าน Internet Banking
                            </a>
                        </div>
                    </div>

                    </div><!--row-->
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
