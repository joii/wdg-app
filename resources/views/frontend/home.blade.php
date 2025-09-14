@extends('frontend.master')
@section('content')
<!-- ========== Banner Area Start ========== -->
@include('frontend.body.banner')
<!-- Banner Area End -->
<div class="section">
    <div class="container">
        <div class="row gy-4">
            <div class="col-xl-4 " data-aos="fade-in">
                <div class="info-row py-3 mb-1">
                    <h3>ราคาทองคำแท่งวันนี้</h3>
                    @php
                        if(is_numeric($goldPrices[0]->change_compare_yesterday)) {
                            $diff = $goldPrices[0]->change_compare_yesterday*1;
                        }else{
                            $diff = 0;
                        }
                    @endphp

                    <div class="gold-status-today {{ $diff >0?'up':'down' }}">
                        <div class="title">
                            <p>วันนี้</p>
                        </div>
                        <div>
                            <div class="gold-status">
                                    @if ($diff >0)
                                         <span class="icons"></span>
                                    @else
                                         <span class="icons danger"></span>
                                    @endif

                                    <p>{{ $diff }} </p>
                            </div>
                        </div>
                    </div><!--gold-status-today-->

                    {{-- <div class="gold-status-today down">
                        <div class="title">
                            <p>วันนี้</p>
                        </div>
                        <div>
                            <div class="gold-status">
                                <span class="icons"></span>
                                <p>-50</p>
                            </div>
                        </div>
                    </div> --}}
                </div><!--info-row-->

                <div class="progress gold-price buy">
                    <div class="progress-bar">
                        รับซื้อ
                    </div>
                    <p class="price">{{ number_format($goldPrices[0]->sell_gold_bar) }}</p>
                </div>

                <div class="progress gold-price sell" data-aos>
                    <div class="progress-bar">
                        ขายออก
                    </div>
                    <p class="price">{{ number_format($goldPrices[0]->buy_gold_bar) }}</p>
                </div>

                 @if (!Auth::guard('member')->user())
                <div class="card" style="min-height: 190px; background-color:#F1E2B6;color:#8f650b;">
                  <div class="card-body">
  สนใจสมัครสมาชิกกับ Wisdom Gold ครบ จบทุกบริการเรื่องทองคำ <a href="{{ route('member.register') }}"><strong>คลิกที่นี่</strong></a> หรือ หากท่านเป็นสมาชิกแล้วคลิกเข้าสู่ระบบด้านล่างได้เลย
                <p></p>
                    <div class="py-sm-3 py-2">
                                <a class="btn login h-50 w-100" href="{{ route('member.login') }}" >เข้าสู่ระบบ</a>
                     </div>
                  </div>
                </div>
                @endif

            </div>

            <div class="col-xl-4 col-md-6" data-aos="fade-in">
                <div class="card" style="min-height: 100%;">
                    <h3 class="card-title">ประเมินราคา</h3>

                    <div class="card-estimate">
                        <div class="row">
                            <div class="col-7">
                                <p>ราคาทองคำแท่งรับซื้อ</p>
                            </div>
                            <div class="col-5">
                                <p class="fs-19">{{ number_format($goldPrices[0]->sell_gold_bar) }}</p>
                            </div>
                        </div><!--row-->
                    </div><!--card-estimate-->

                    <div class="card-estimate">
                        <div class="row">
                            <div class="col-7">
                                <p>น้ำหนักทอง</p>
                            </div>
                            <div class="col-5">
                                <div class="form-select dropdown">
                                    <a href="#" class="fs-19" data-bs-toggle="dropdown" data-bs-display="static" >
                                        <span class="text">1 บาท</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li onclick="setWeight(1)" >1 บาท</li>
                                        <li onclick="setWeight(0.75)">3 สลึง</li>
                                        <li onclick="setWeight(0.5)">2 สลึง</li>
                                        <li onclick="setWeight(0.25)">1 สลึง</li>
                                        <li onclick="setWeight(0.125)">1/2 สลึง</li>
                                    </ul>
                                    <input type="hidden" id="weight_tot" >
                                </div>
                            </div>
                        </div><!--row-->
                    </div><!--card-estimate-->

                     <div class="py-sm-3 py-2">
                                <button class="btn h-50 w-100" type="button" onclick="calculate()">ประเมิน</button>
                     </div>

                    <div class="card-estimate-price">
                        <div class="card-estimate-price">
                                <div>
                                    <p id="cal_title"></p>
                                    <h3 id="cal_weight"></h3>
                                </div>
                                <h2 data-aos><span class="highlight d-inline-block" id="cal_estimate"></span></h2>
                            </div>
                    </div>

                    {{-- <div class="py-sm-3 py-2">
                        <button class="btn btn-gold h-50 w-100" type="button">ฝากขายทอง</button>
                    </div> --}}
                </div><!--card-->
            </div>

            <div class="col-xl-4 col-md-6" data-aos="fade-in">
                <div class="card card-faq">
                    <h3 class="card-title">ขั้นตอนการจำนำและคำถามที่พบบ่อย</h3>

                    <h4 class="faq-title">{{ $faqCategory_name }}</h4>

                    <div class="accordion accordion-faq">
                        @foreach ($faqs as $key=>$item)
                        <div class="accordion-item">
                            <h3 class="accordion-header" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key+1 }}">
                                {!! $item->question !!}
                                <span class="icons"></span>
                            </h3>
                            <div id="collapse{{ $key+1 }}" class="accordion-collapse collapse" data-bs-parent=".accordion">
                                <div class="accordion-body article">
                                    <p> {!! $item->answer !!}</p>
                                </div>
                            </div>
                        </div><!--accordion-item-->
                        @endforeach



                    </div><!--accordion-->
                </div><!--card-->
            </div>
        </div><!--row-->
    </div>
</div>
@endsection
