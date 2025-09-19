@extends('frontend.master')
@section('content')
@php
 // check if product type is 3
 if(Str::substr($pawn_data->type_full,3) =='[3]') {
    $product_type = "3";
 }
@endphp
    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
               <div class="boxed" style="--width:500px">
                    <div class="d-block py-md-2 mt-md-2">
                        <h3 class="mb-4">ลดเงินต้น</h3>

                        <p class="title-icon py-1">
                            <img class="icons file" src="{{ asset('frontend/assets/img/icons/icon-file.svg') }}" alt="">
                            @php
                                $year = Str::substr($pawn_data->pawn_date, 0, 4)+543;
                            @endphp

                            สัญญาเลขที่: {{ Str::substr($year, 2, 2)}}{{ sprintf('%05d', $pawn_data->pawn_id) }}
                        </p>
                    </div>
                    <div class="row gy-4 form">

                        <div class="col-12">
                            <div class="card card-border p-3 p-sm-4">

                                <table class="table-data">
                                    <tr>
                                        <th>วันที่ :</th>
                                        <td>{{ \Carbon\Carbon::now()->thaidate('j F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;">สถานที่ทำรายการ :</th>
                                        <td>สาขา {{ $pawn_data->branch_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>รหัสบาร์โค้ด :</th>
                                        <td>{{ $pawn_data->pawn_barcode }}</td>
                                    </tr>

                                    <tr>
                                        <th>หมายเลขขายฝาก :</th>
                                        <td>{{ $pawn_data->pawn_card_no }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><div class="p-2"></div></td>
                                    </tr>
                                    <tr>
                                        <th>วันที่ขายฝาก :</th>
                                        <td>{{ \Carbon\Carbon::parse($pawn_data->pawn_date)->thaidate('l j F Y') }}</td>
                                    </tr>

                                    {{-- <tr>
                                        <th>วงเงินที่ได้รับการอนุมัติ :</th>
                                        <td>{{ number_format($pawn_data->total_pawn_amount) }} บาท</td>
                                    </tr> --}}
                                     <tr>
                                        <th>จำนวนเงินขายฝาก :</th>
                                        <td>{{ number_format($pawn_data->total_pawn_amount_first) }} บาท</td>
                                    </tr>
                                    <tr>
                                        <th>อัตราดอกเบี้ย :</th>
                                        <td>ร้อยละ {{ $pawn_data->percent_interest }}</td>
                                    </tr>

                                    {{-- <tr>
                                        <th>ระยะเวลากำหนด :</th>
                                        <td>
                                           {{ $pawn_data->period }} เดือน
                                        </td>
                                    </tr> --}}

                                      <tr>
                                        <th>วันที่ครบกำหนดชำระ :</th>
                                        <td>{{ \Carbon\Carbon::parse($pawn_data->pawn_date)->addDays($pawn_data->period*30)->thaidate('j F Y') }}</td>
                                    </tr>

                                    <tr>
                                        <th>ระยะเวลาค้างชำระ :</th>
                                        <td>
                                            @php
                                            use Carbon\Carbon;
                                            $now = Carbon::now();
                                            $start = Carbon::parse($pawn_send_data->pawn_cal_interest_date);
                                            $end = Carbon::parse($pawn_send_data->pawn_expire_date);
                                            $diffInDays = $start->diffInDays($end);
                                            $months = floor($diffInDays / 30);
                                            $days = $diffInDays % 30;
                                            @endphp
                                            {{ $months }} เดือน {{ $days }} วัน
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><div class="p-2"></div></td>
                                    </tr>


                                    <tr class="total">
                                        <th>ดอกเบี้ยค้างชำระ :</th>
                                        <td>
                                           {{ number_format($pawn_send_data->interest) }} บาท
                                        </td>
                                    </tr>






                                </table>
                            </div><!--card-->



                            <div class="form-group mt-4">
                                <label class="title">ระบุจำนวนเงินที่ต้องการชำระ (ขั้นต่ำ 100 บาท)</label>
                                <input type="text" class="form-control style-2" id="amount_request" name="amount_request">
                                 <p id="message"></p>

                            </div>
                             <script>
                               document.getElementById('amount_request').onchange = function() {
                                // Get the value from the input and convert it to a number
                                let inputValue = Number(document.getElementById('amount_request').value);

                                // Get the message paragraph element
                                let messageElement = document.getElementById('message');
                                let submit_btn = document.getElementById('submit_btn');

                                // Check if the value is greater than 100
                                if (inputValue <= 100) {
                                    messageElement.textContent = "ระบุจำนวนเงินที่ต้องการชำระขั้นต่ำ 100 บาท";
                                    messageElement.style.color = "red";
                                    //submit_btn.hide();
                                } else {
                                    messageElement.textContent = "";
                                    messageElement.style.color = "green";
                                    //submit_btn.show();

                                }
                            };

                            function checkValue() {

                                // Get the message paragraph element
                                let messageElement = document.getElementById('message');
                                let submit_btn = document.getElementById('submit_btn');

                                // Check if the value is greater than 100
                                if (inputValue <= 100) {
                                    messageElement.textContent = "ระบุจำนวนเงินที่ต้องการชำระขั้นต่ำ 100 บาท";
                                    messageElement.style.color = "red";
                                    //submit_btn.hide();

                                    return false;
                                } else {
                                    messageElement.textContent = "";
                                    messageElement.style.color = "green";
                                    //submit_btn.show();

                                    return true;

                                }
                            }
                            </script>

                        </div>

                        <div class="col-12 pt-2 mb-sm-5">
                            <div class="col-12 py-sm-4 mb-sm-5">
                                {{-- @if ($count_send_data >0 ) --}}
                                 <form action="{{ route('customer.decrease_principle.confirm_decrease_principle') }}" method="post" id="pay_outstanding">
                                    @csrf
                                    <input type="hidden" name="barcode" value="{{ $pawn_data->pawn_barcode }}">
                                    <input type="hidden" name="add_amount" id="add_amount" value="">
                                    <button class="btn btn-red w-100 mx-auto" type="submit" id="submit_btn" onsubmit="return checkValue();">
                                        ยื่นคำขอลดเงินต้น
                                    </button>
                                  </form>

                                  {{-- @elseif ($product_type !=3)

                                   <form action="{{ route('customer.decrease_principle')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="barcode" value="{{ $pawn_data->pawn_barcode }}">
                                    <input type="hidden" name="add_amount" id="add_amount" value="">
                                    <button class="btn  mx-1 w-135" type="submit">
                                        ยื่นคำขอ
                                    </button>
                                  </form> --}}

                                  {{-- @endif --}}

                            </div>
                        </div>


                    </div><!--row-->
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
