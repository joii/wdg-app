@extends('frontend.master')
@section('content')
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

                        <form method="POST" action="{{ route('customer.outstanding-interest.comfirm_payment') }}">
                            @csrf
                            <div class="col-12">
                                <div class="card card-border p-3 p-sm-4">

                                    <table class="table-data">

                                        <tr>
                                            <th>วันที่ :</th>
                                            <td>{{ \Carbon\Carbon::now()->thaidate('l j F Y') }}</td>
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
                                            {{-- {{ Str::substr($pawn_data->type_full,3) }} --}}
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
                                            <th>วันที่เริ่มคิดดอกเบี้ย :</th>
                                            <td>{{ \Carbon\Carbon::parse($pawn_send_data->pawn_cal_interest_date)->thaidate('j F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>วันครบกำหนดชำระดอกเบี้ย :</th>
                                            <td>{{ \Carbon\Carbon::parse($pawn_send_data->pawn_expire_date)->thaidate('j F Y') }}</td>
                                        </tr>

                                        <tr>
                                            <th>เงินต้น :</th>
                                            <td>{{ number_format($pawn_send_data->total_pawn_amount) }} บาท</td>
                                        </tr>

                                        <tr>
                                            <th>ยอดใช้ไป :</th>
                                            <td>{{ number_format($pawn_data->total_pawn_amount_first) }} บาท</td>
                                        </tr>

                                        <tr>
                                            <th>อัตราดอกเบี้ย :</th>
                                            <td>ร้อยละ {{ $pawn_data->percent_interest }}</td>
                                        </tr>

                                        <tr>
                                            <th>ระยะเวลากำหนด :</th>
                                            <td>
                                            {{ number_format($pawn_send_data->period) }} เดือน
                                            </td>
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
                                            <th>ดอกเบี้ยค้างชำระ :</th>
                                            <td>
                                            {{ number_format($pawn_send_data->interest) }} บาท
                                            </td>
                                        </tr>


                                    </table>
                                </div><!--card-->
                            </div>
                             <div class="col-12 py-sm-4 mb-sm-5">
                                <input type="hidden" name="pawn_id" value="{{ $pawn_data->id }}">
                                <input type="hidden" name="interest" value="{{ $pawn_send_data->interest }}">
                                <input type="hidden" name="pawn_barcode" value="{{ $pawn_data->pawn_barcode }}">
                                <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                                 <input type="hidden" name="add_amount" value="{{ $add_amount }}">
                                <input type="submit" class="btn btn-green-dark w-100 mx-auto" style="max-width:370px" value="  ชำระดอกเบี้ย  {{ number_format($pawn_send_data->interest) }}  บาท">

                                </input>
                        </div>
                        </form>



                    </div><!--row-->
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
