@extends('frontend.master')
@section('content')
 <div class="section section-banner d-none d-md-block">
        <div class="container">
            <a href="#" target="_blank">
                <img src="img/thumb/photo-1920x863--3.jpg" alt="">
            </a>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row gy-4 gx-lg-5">

                <div class="col-xl-8 col-md-6" data-aos="fade-in">
                    <div class="card" style="min-height: 100%;">
                        <div class="boxed" style="--width:410px">
                            <h3 class="card-title">ประเมินราคา</h3>

                            <div class="card-estimate">
                                <div class="row">
                                    <div class="col-7">
                                        <p>ราคาทองคำแท่งรับซื้อ</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="fs-19">{{ number_format($goldPrices[0]->buy_gold_bar) }}</p>
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
                                            <a href="#" class="fs-19" data-bs-toggle="dropdown" data-bs-display="static">
                                                <span class="text" >2 สลึง</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li onclick="setWeight(1)">1 บาท</li>
                                                <li onclick="setWeight(0.75)">3 สลึง</li>
                                                <li onclick="setWeight(0.5)">2 สลึง</li>
                                                <li onclick="setWeight(0.25)">1 สลึง</li>
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
                                <div>
                                    <p id="cal_title"></p>
                                    <h3 id="cal_weight"></h3>
                                </div>
                                <h2 data-aos><span class="highlight d-inline-block" id="cal_estimate"></span></h2>
                            </div>

                             {{-- <div class="card-estimate-price">
                                <div>
                                    <p id="cal_title">ราคาฝากขายทอง</p>
                                    <h3 id="cal_weight">น้ำหนัก 2 สลึง</h3>
                                </div>
                                <h2 data-aos><span class="highlight d-inline-block" id="cal_estimate">34600</span></h2>
                            </div> --}}

                        </div><!--boxed-->
                    </div><!--card-->
                </div>

                <div class="col-xl-4 col-md-6" data-aos="fade-in">
                    <div class="info-row py-3 mb-1">
                        <h3>ราคาทองคำแท่งวันนี้</h3>

                        <div class="gold-status-today up">
                            <div class="title">
                                <p>วันนี้</p>
                            </div>
                            <div>
                                <div class="gold-status">
                                    @if ($goldPrices[0]->change_compare_yesterday =='+')
                                         <span class="icons"></span>
                                    @else
                                         <span class="icons danger"></span>
                                    @endif

                                    <p>{{ $goldPrices[0]->change_compare_yesterday }} {{ $diff }}</p>
                                </div>
                            </div>
                        </div><!--gold-status-today-->

                        <!-- <div class="gold-status-today down">
                            <div class="title">
                                <p>วันนี้</p>
                            </div>
                            <div>
                                <div class="gold-status">
                                    <span class="icons"></span>
                                    <p>-50</p>
                                </div>
                            </div>
                        </div>  -->
                    </div><!--info-row-->

                    <div class="progress gold-price buy">
                        <div class="progress-bar">
                            รับซื้อ
                        </div>
                        <p class="price">{{ number_format($goldPrices[0]->buy_gold_bar) }}</p>
                    </div>

                    <div class="progress gold-price sell" data-aos>
                        <div class="progress-bar">
                            ขายออก
                        </div>
                        <p class="price">{{ number_format($goldPrices[0]->sell_gold_bar) }}</p>
                    </div>

                </div>

            </div><!--row-->
        </div><!--container-->
    </div><!--section-->

@endsection
