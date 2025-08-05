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
                <div class="boxed" style="--width:370px">

                    <div class="d-block py-md-2 mt-md-2 pt-5">
                        <h3 class="mb-md-3 mb-4">แจ้งชำระเงิน</h3>
                    </div>
                    <div class="row gy-3">
                        <form action="{{ route('customer.interest.payment.store') }}" method="post" enctype="multipart/form-data">
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
                                <p>{{ number_format($interest_amount) }} บาท</p>
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
                                <input type="hidden" name="pawn_id" value="{{ $pawn_data->id }}">
                                <input type="hidden" name="interest_amount" value="{{ $interest_amount }}">
                                <input type="hidden" name="total_pawn_amount" value="0">
                                <input type="hidden" name="pawn_barcode" value="{{ $pawn_data->pawn_barcode }}">
                                <input type="hidden" name="branch_id" value="1">
                                {{-- <input type="hidden" name="transaction_type" value="add"> --}}
                                <input type="hidden" name="payment_method" value="bank transfer">
                                <input type="hidden" name="payment_status" value="pending">
                                <input type="hidden" name="payment_date" value="{{ date('Y-m-d H:i:s') }}">
                                <input type="hidden" name="customer_name" value="{{ $pawn_data->customer_name }}">
                                <input type="hidden" name="customer_address" value="{{ $pawn_data->customer_address }}">
                                <input type="hidden" name="customer_phone" value="{{ $pawn_data->customer_phone }}">
                                 <div class="buttons interest">
                                    <input type="submit" value="แจ้งชำระเงิน" class="btn  btn-block">
                                </div>
                            </div>


                        </form>
                    </div><!--row-->

                    <div class="d-block py-md-2 mt-md-2">
                        <h3 class="mb-md-3 mb-4">ช่องทางชำระเงิน</h3>
                    </div>
                    <div class="row gy-3">
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
                    </div><!--row-->
                </div><!--boxed-->

                <div class="p-sm-5 m-md-5"></div>
            </div>
        </div><!--container-->
    </div><!--section-->

    <div id="qrPaymentModal" class="modal fade modal-qr-payment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            <div class="modal-body">
                <div class="hgroup">
                    <h3>QR PAYMENT</h3>
                    <p>Please scan QR code with your mobile <br>by using Mobile Banking Application</p>
                </div>

                <div class="qrcode">
                    <img src="{{ asset('frontend/assets/img/thumb/qrcode.jpg')}}" alt="">
                    <p>202408271524690</p>
                </div>

                <table class="table-data">
                    <tr>
                        <th>วันที่</th>
                        <td>{{ \Carbon\Carbon::now()->thaidate('l j F Y') }}</td>
                    </tr>

                    <tr>
                        <th>สัญญาเลขที่</th>
                        <td>{{ (Str::substr($year, 2, 2))  }}{{ $pawn_data->pawn_id }}</td>
                    </tr>

                    <tr>
                        <th>ยอดชำระ</th>
                        <td><span class="fw-600" style="color: #007B5C;">{{ number_format($interest_amount) }}</span> บาท</td>
                    </tr>
                </table>

                <hr>

                <p class="text-center">
                    ท่านสามารถใช้ QR นี้ชำระเงินได้จนถึง<br>
                    เวลา 22:45 ของวันนี้
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
