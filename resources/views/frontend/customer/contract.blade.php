@extends('frontend.master')
@section('content')
    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
                <div class="boxed" style="--width:500px">
                    <div class="d-block py-2 mt-2">
                        <h3 class="mb-2">สัญญาขายฝากทอง</h3>
                        <p class="text-note">เพื่อประโยชน์สูงสุดของคุณกรุณาระบุข้อมูลที่เป็นจริงและถูกต้อง</p>
                    </div>
                    <form class="row gy-4 form" method="post" action="consignment-contract-detail.html">
                        <div class="col-12">
                            <h4 class="mb-3">1. รายละเอียดรายการ</h4>

                            <div class="card card-border p-3 p-sm-4">
                                <table class="table-data">
                                    <tr>
                                        <th style="width: 50%;">สถานที่ทำรายการ :</th>
                                        <td>สาขา 1 พนัสนิคมตลาดใหม่</td>
                                    </tr>

                                    <tr>
                                        <th>วันที่ทำรายการ :</th>
                                        <td>{{ \Carbon\Carbon::parse($data->pawn_date)->thaidate('l j F Y') }}</td>
                                    </tr>

                                    <tr>
                                        <th>รหัสลูกค้า :</th>
                                        <td>{{ $data->pawn_card_no }}</td>
                                    </tr>

                                    <tr>
                                        <th>ชื่อผู้กู้ :</th>
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
                                        <th style="width: 50%;">ผู้ทำรายการ : </th>
                                        <td>{{ $data->customer_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>สินค้า : </th>
                                        <td>
                                            {{-- {{ Str::substr($pawn_data->type_full,3) }} --}}
                                            @php
                                                $type = Str::substr($data->type_full,1,1);
                                            @endphp

                                            @switch($type )
                                                @case(1)
                                                      คอ,แหวน,มือ ,ฯลฯ น้ำหนัก {{ $data->total_weight }} กรัม
                                                    @break
                                                @case(2)
                                                      คอ,แหวน,มือ ,ฯลฯ น้ำหนัก {{ $data->total_weight }} กรัม
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
                                <table class="table table-interest">
                                    <tr>
                                        <th class="text-center">ครั้งที่</th>
                                        <th>วันครบกำหนดชำระ</th>
                                        <th class="text-center">ยอดชำระ</th>
                                        <th>สถานะ</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>29 มกราคม 2568</td>
                                        <td class="text-center">70</td>
                                        <td>รอการชำระ</td>
                                    </tr>

                                </table>
                            </div><!--card-->
                        </div>

                         <div class="col-12">
                            <div class="buttons interest">
                                <a class="btn btn-gold" href="interest-rate.html">ต่อดอก</a>
                                <a class="btn" href="effective-rate.html">ลดเงินต้น</a>
                                <a class="btn btn-black" href="{{ route('customer.pawn_add',$data->pawn_barcode) }}">เพิ่มเงินต้น</a>
                            </div>
                        </div>



                    </form><!--row-->
                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
