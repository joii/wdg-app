@extends('frontend.master')
@section('content')
    <div class="section section-form pt-0">
        <div class="container">
            <div class="card">
                <div class="boxed" style="--width:500px">
                    <div class="d-block py-2 mt-2">
                        <h3 class="mb-2">สัญญาขายฝากทอง</h3>
                        <p class="text-note"></p>
                    </div>

                        <div class="col-12">
                            <h4 class="mb-3 mt-2">รายการเพิ่มต้น</h4>

                            <div class="card card-border p-3 p-sm-4">
                                @if ($data_list->count()>0)
                                <table class="table table-interest">
                                    <tr>
                                        <th class="text-center">ครั้งที่</th>
                                        <th>วันที่ทำรายการ</th>
                                        <th>วันครบกำหนดชำระ</th>
                                        <th class="text-center">ระยะเวลา</th>
                                        <th class="text-center">ยอดชำระ</th>
                                        <th>สถานะ</th>
                                    </tr>

                                    @foreach ($data_list as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->pawn_date_cal_interest)->thaidate('j F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->pawn_expire_date)->thaidate('j F Y') }}</td>
                                        <td class="text-center">{{ $data->period }}</td>
                                         <td class="text-center">{{ $data->pawn_add }}</td>
                                        <td>-</td>
                                    </tr>
                                    @endforeach

                                </table>
                                @else
                                     <p>ไม่พบข้อมูลการ</p>
                                @endif

                            </div><!--card-->
                        </div>

                         <div class="col-12">
                            <div class="buttons interest">
                                <a class="btn btn-gold" href="interest-rate.html">ต่อดอก</a>
                                <a class="btn" href="effective-rate.html">ลดเงินต้น</a>
                                <a class="btn btn-black" href="principle.html">เพิ่มเงินต้น</a>
                            </div>
                        </div>

                </div><!--boxed-->
            </div>
        </div><!--container-->
    </div><!--section-->

@endsection
