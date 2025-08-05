@extends('frontend.master')
@section('content')

 <div class="section section-form">
        @if($count>0 || $confirm_data==1)
        <div class="container">

            <div class="info-row pt-lg-3 pt-sm-2 pt-0">
                <h2 class="h3 my-auto">รายการสัญญาของคุณ</h2>

                <div class="form-select dropdown sort">
                    <a href="#" class="fs-19" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <span class="text">เรียงตาม</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>ทั้งหมด</li>
                        <li>มากไปน้อย</li>
                        <li>น้อยไปมาก</li>
                    </ul>
                </div>
            </div>
            <div class="row card-contract-list">
            @foreach ($data as $item )
                <div class="col-lg-4 col-sm-6">
                    <a href="{{ route('customer.consignment_detail', $item->pawn_barcode) }}">
                    <div class="card card-contract aos-init aos-animate" data-aos="fade-in">
                        <div class="card-header"
                            <img class="icons file" src="{{ asset('frontend/assets/img/icons/icon-file.svg') }}" alt="">
                             <div>
                                 <h3>
                                @php
                                $year = (Str::substr($item->pawn_date, 0, 4))+543;
                                  @endphp
                                สัญญาเลขที่: {{ (Str::substr($year, 2, 2))  }}{{ $item->pawn_id }}</h3>
                               <h3>เลขที่บาร์โค้ด: {{ $item->pawn_barcode }}</h3>
                               <p>วันที่ทำสัญญา :  {{ \Carbon\Carbon::parse($item->pawn_date)->thaidate('j F y') }}</p>
                                <p>ครบกำหนด :  {{ \Carbon\Carbon::parse($item->expire_date)->thaidate('j F y') }}</p>

                            </div>

                        </div>
                        <div class="card-body">
                            <div class="info-row">
                                <p>สินค้า:
                                    {{-- {{ Str::substr($item->type_full ,3)}} --}}
                                     @php
                                                $type = Str::substr($item->type_full,1,1);
                                            @endphp

                                            @switch($type )
                                                @case(1)
                                                      คอ,แหวน,มือ ,ฯลฯ
                                                    @break
                                                @case(2)
                                                      คอ,แหวน,มือ ,ฯลฯ
                                                    @break
                                                @case(3)
                                                      {{ Str::substr($item->type_full,3) }}
                                                    @break

                                                @default

                                            @endswitch
                                </p>
                                <p class="price">น้ำหนัก: {{ $item->total_weight }} กรัม</p>
                            </div>
                            <div class="info-row">
                                <p></p>
                                <p class="price">มูลค่ารวม: {{ number_format($item->total_pawn_amount) }} บาท</p>
                            </div>
                        </div>
                    </div><!--card-->
                    </a>
                </div>

            @endforeach
            </div><!--row-->


            {{-- <ul class="pagination">
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
            </ul> --}}

            @if($confirm_data==0)
            <div class="row justify-content-md-center pt-5">
                <div class="col-md-3 col-sm-6 ">
                     <form  method="post" action="{{ route('member.customer_confirmation') }}" >
                        @csrf
                        <input type="hidden" name="key" value="{{$key }}">
                        <button class="btn btn-green-dark w-100 " type="submit" id="customer_confirm">
                            ยืนยันธุรกรรมของคุณ
                        </button>
                     </form>
                </div>
            </div>
            @endif


        </div>
        @else

        <div class="container">
             <div class="card">
            <div class="boxed" style="--width:400px">
                <div class="d-block py-md-2 mt-md-2">
                    <h3 class="mb-2">ตรวจสอบประวัติ</h3>
                    <p class="text-note">กรุณากรอกข้อมูลเบอร์โทรเพื่อค้นหาการทำธุรกรรมของคุณ :</p>
                </div>
                @php
                     $id = Auth::guard('member')->id();
                     $profileData = App\Models\Member::find($id);
                @endphp

                <form class="row g-3 form-check-profile" method="post" action="{{ route('member.check_pawn_transaction') }}">
                    @csrf
                    <div class="col-12">
                        <div class="form-group">
                            <label class="title">เบอร์โทรที่เคยใช้ทำสัญญา</label>
                            <input type="text" class="form-control" name="key" value="{{ $profileData->phone }}">
                        </div>
                    </div>

                    <div class="col-12">

                        <button class="btn btn-green-dark w-100" type="submit">
                            ตรวจสอบ
                        </button>

                       @isset($is_customer)
                            @if($is_customer ==0)
                            <p class="pt-2">คุณยังไม่เคยทำธุรกรรมด้วยเบอร์โทรนี้</p>
                        @endif
                       @endisset



                    </div>

                </form><!--row-->
            </div><!--boxed-->
        </div>

        </div>
        @endif


 </div>

@endsection
