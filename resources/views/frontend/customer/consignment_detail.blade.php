@extends('frontend.master')
@section('content')
@php
 // check if product type is 3
 $product_type = Str::substr($data->type_full,1,1);
@endphp
    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
                <div class="boxed" style="--width:500px">
                    <div class="d-block py-2 mt-2">
                        <h3 class="mb-2">สัญญาขายฝากทอง</h3>
                        <p class="text-note">เพื่อประโยชน์สูงสุดของคุณกรุณาระบุข้อมูลที่เป็นจริงและถูกต้อง</p>
                    </div>
                        <div class="col-12">
                            <h4 class="mb-3">1. รายละเอียดรายการ</h4>

                            <div class="card card-border p-3 p-sm-4">
                                <table class="table-data">
                                    <tr>
                                        <th style="width: 50%;">สถานที่ทำรายการ :</th>
                                        <td>สาขา {{ $data->branch_id }}</td>
                                    </tr>

                                    <tr>
                                        <th>วันที่ทำรายการ :</th>
                                        <td>{{ \Carbon\Carbon::parse($data->pawn_date)->thaidate('l j F Y') }}</td>
                                    </tr>

                                    <tr>
                                        <th>หมายเลขขายฝาก :</th>
                                        <td>{{ $data->pawn_card_no }}</td>
                                    </tr>

                                    <tr>
                                        <th>ชื่อลูกค้า :</th>
                                        <td>{{ $data->customer_name }}</td>
                                    </tr>
                                </table>
                            </div><!--card-->
                        </div>

                        <div class="col-12">
                            <h4 class="mb-3 mt-2">2. รายละเอียดสัญญา</h4>

                            <div class="card card-border p-3 p-sm-4">
                                <table class="table-data">
                                    <tr>
                                        <th>สัญญาเลขที่ : </th>
                                        <td>
                                            {{ (Str::substr($data->pawn_date, 0, 4))+543 }}{{ $data->pawn_id }}
                                        </td>
                                    </tr>
                                     <tr>
                                        <th>เลขที่บาร์โค้ด : </th>
                                        <td>{{ $data->pawn_barcode }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%;">ผู้ทำรายการ : </th>
                                        <td>{{ $data->customer_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>สินค้า : </th>
                                        <td>
                                            {{-- {{ Str::substr($data->type_full,3) }} --}}
                                            @php
                                                $type = Str::substr($data->type_full,1,1);
                                            @endphp

                                            @switch($type )
                                                @case(1)
                                                      {{ Str::substr($data->type_full,3) }} น้ำหนัก {{ $data->total_weight }} กรัม
                                                    @break
                                                @case(2)
                                                      {{ Str::substr($data->type_full,3) }}{{ $data->total_weight }} กรัม
                                                    @break
                                                @case(3)
                                                      {{ Str::substr($data->type_full,3) }}
                                                    @break

                                                @default

                                            @endswitch

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>น้ำหนัก : </th>
                                        <td>{{ $data->total_weight }} กรัม</td>
                                    </tr>

                                    <tr>
                                        <th>ราคาประเมิน :</th>
                                        <td>{{ number_format($data->total_pawn_amount) }} บาท</td>
                                    </tr>

                                    <tr>
                                        <th>จำนวนเงินขายฝาก : </th>
                                        <td>{{ number_format($data->total_pawn_amount_first) }} บาท</td>
                                    </tr>

                                    <tr>
                                        <th>อัตราดอกเบี้ย : </th>
                                        <td>ร้อยละ {{ $data->percent_interest }}</td>
                                    </tr>

                                    <tr>
                                        <th>กำหนดส่งดอก/ไถ่ถอน :</th>
                                        <td>{{ \Carbon\Carbon::parse($data->pawn_date)->addDays(60)->thaidate('j F Y') }}</td>
                                    </tr>

                                    <tr>
                                        <th>หมายเหตุ : </th>
                                        <td>-</td>
                                    </tr>
                                </table>
                            </div><!--card-->
                        </div>


                        <div class="col-12">
                            <h4 class="mb-3 mt-2">3. รายการต่อดอก</h4>

                            <div class="card card-border p-3 p-sm-4">
                                @if ($interest_data->count()>0)
                                <table class="table table-interest">
                                    <tr>
                                        <th class="text-center">จำนวนเดือน</th>
                                        <th>วันครบกำหนดชำระ</th>
                                        <th class="text-center">ยอดชำระ</th>
                                        {{-- <th>สถานะ</th> --}}
                                    </tr>

                                    @foreach ($interest_data as $key => $interest)

                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($data->pawn_expire_date)->thaidate('j F Y') }}</td> --}}
                                        {{-- {{ \Carbon\Carbon::parse($data->pawn_expire_date)->addDays(30*($key+1))->thaidate('j F Y') }} --}}
                                        <td>{{ \Carbon\Carbon::parse($interest->pawn_expire_date)->addDays(30*($key+1))->thaidate('j F Y') }}</td>
                                        <td class="text-center">{{ $interest->interest }}</td>
                                        {{-- <td>{{ รอการชำระ }}</td> --}}
                                    </tr>
                                    @endforeach

                                </table>
                                @else
                                     <p>ไม่พบข้อมูลการต่อดอก</p>
                                @endif

                            </div><!--card-->
                        </div>

                         <div class="col-12 pt-3">
                            <div class="buttons interest">
                                <a class="btn btn-gold" href="{{ route('customer.pawn_interest',$data->pawn_barcode) }}">ต่อดอก</a>
                                <a class="btn" href="{{ route('customer.pawn_decrease',$data->pawn_barcode) }}">ลดเงินต้น</a>
                                 @if ($product_type !=3)
                                <a class="btn btn-black" href="{{ route('customer.pawn_add',$data->pawn_barcode) }}">เพิ่มเงินต้น</a>
                                @endif
                            </div>
                        </div>
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
