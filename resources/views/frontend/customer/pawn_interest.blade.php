@extends('frontend.master')
@section('content')
    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
               <div class="boxed" style="--width:500px">
                    <div class="d-block py-md-2 mt-md-2">
                        <h3 class="mb-4">ต่อดอก</h3>

                        <p class="title-icon py-1">
                            <img class="icons file" src="{{ asset('frontend/assets/img/icons/icon-file.svg') }}" alt="">
                            สัญญาเลขที่: {{ (Str::substr($pawn_data->pawn_date, 0, 4))+543 }}{{ $pawn_data->pawn_id }}
                        </p>
                    </div>
                      <div class="row gy-4 form">

                      <form method="POST" action="{{  route('customer.interest.pay_interest') }} ">
                        @csrf
                          <div class="col-12">
                            <div class="card card-border p-3 p-sm-4">

                                <table class="table-data">

                                    <tr>
                                        <th>วันที่ :</th>
                                        <td>{{ \Carbon\Carbon::now()->thaidate('j F Y') }}</td>
                                    </tr>
                                   <tr>
                                        <th style="width: 50%;">สถานที่ทำรายการ :</th>
                                        <td>สาขา 1 พนัสนิคมตลาดใหม่</td>
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
                                        <th>ผู้ทำรายการ : </th>
                                        <td>{{ $pawn_data->customer_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>สินค้า :</th>
                                        <td>
                                            {{-- {{ Str::substr($data->type_full,3) }} --}}
                                            @php
                                                $type = Str::substr($pawn_data->type_full,1,1);
                                            @endphp

                                            @switch($type )
                                                @case(1)
                                                      คอ,แหวน,มือ ,ฯลฯ น้ำหนัก {{ $pawn_data->total_weight }} กรัม
                                                    @break
                                                @case(2)
                                                      คอ,แหวน,มือ ,ฯลฯ น้ำหนัก {{ $pawn_data->total_weight }} กรัม
                                                    @break
                                                @case(3)
                                                      {{ Str::substr($pawn_data->type_full,3) }}
                                                    @break

                                                @default

                                            @endswitch

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>น้ำหนัก : </th>
                                        <td>{{ $pawn_data->total_weight }} กรัม</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><div class="p-2"></div></td>
                                    </tr>

                                    <tr>
                                        <th>วันที่ขายฝาก :</th>
                                        <td>{{ \Carbon\Carbon::parse($pawn_data->pawn_date)->thaidate('j F Y') }}</td>
                                    </tr>

                                    <tr>
                                        <th>เงินต้น :</th>
                                        <td>{{ number_format($pawn_data->total_pawn_amount_first) }} บาท</td>
                                    </tr>

                                    <tr>
                                        <th>อัตราดอกเบี้ย :</th>
                                        <td>ร้อยละ {{ $pawn_data->percent_interest }}</td>
                                    </tr>

                                    <tr>
                                        <th>ระยะเวลากำหนด :</th>
                                        <td>
                                           2 เดือน
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>ระยะเวลาค้างชำระ :</th>
                                        <td>
                                            @php
                                            use Carbon\Carbon;
                                            $now = Carbon::now();
                                            $start = Carbon::parse($pawn_data->pawn_date);
                                            $end = Carbon::parse($now);
                                            $diffInDays = $start->diffInDays($end);
                                            $months = floor($diffInDays / 30);
                                            $days = $diffInDays % 30;
                                            @endphp
                                            {{ $months }} เดือน {{ $days }} วัน
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th>ดอกเบี้ยค้างชำระ :</th>
                                        <td>
                                           616 บาท
                                        </td>
                                    </tr> --}}


                                    <tr>
                                        <td colspan="2"><div class="p-2"></div></td>
                                    </tr>

                                    <tr class="total">
                                        <th>ฝากดอก:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ระยะเวลาฝาก :</th>
                                        <td>

                                            <select class="form-select selected valid" name="interest_amount" aria-invalid="false" style="width:90px;" onchange="RollupInterest(this.value)">
                                                <option value="-">ระบุ</option>
                                                @foreach ($interest_data as $item)
                                                     <option value="{{ $item->interest }},{{ $item->number_of_month }}">{{ $item->number_of_month }} เดือน</option>
                                                @endforeach


                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>ดอกเบี้ยที่ต้องการชำระ :</th>
                                        <td>
                                           <span id="rollup_interest">-</span> บาท
                                        </td>
                                    </tr>
                                </table>
                            </div><!--card-->
                        </div>

                        <div class="col-12 py-sm-4 mb-sm-5 pt-4">
                            <input type="hidden" name="pawn_id" value="{{ $pawn_data->id }}">
                            <input type="hidden" name="pawn_id" value="{{ $pawn_data->id }}">
                            <input type="hidden" name="pawn_barcode" value="{{ $pawn_data->pawn_barcode }}">
                            <input type="hidden" name="branch_id" value="1">
                            <input type="hidden" name="transaction_type" value="intr">
                            <input type="hidden" name="payment_method" value="bank transfer">
                            <input type="hidden" name="payment_status" value="pending">
                            <input type="hidden" name="payment_date" value="{{ date('Y-m-d H:i:s') }}">
                            <input type="hidden" name="customer_name" value="{{ $pawn_data->customer_name }}">
                            <input type="hidden" name="customer_address" value="{{ $pawn_data->customer_address }}">
                            <input type="hidden" name="customer_phone" value="{{ $pawn_data->customer_phone }}">
                            <input type="submit" class="btn btn-green-dark w-100 mx-auto"  value="ชำระดอกเบี้ย" style="max-width:370px">

                        </div>
                      </form>

                    </div><!--row-->
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
