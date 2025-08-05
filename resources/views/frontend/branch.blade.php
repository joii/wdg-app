@extends('frontend.master')
@section('content')
 <div class="section section-map">
        <div class="container">
            {{-- <div class="form-group search">
                <input type="text" class="form-control" placeholder="ค้นหาสาขา">
                <button class="btn" type="button">
                    <img class="icons svg-js" src="img/icons/icon-search.svg" alt="">
                </button>
            </div> --}}
            <div class="map-boxed">
    <iframe src="https://www.google.com/maps/d/embed?mid=1wVlEMSMH95Leh3sWPAQKOBe1oWbvZQ0&ehbc=2E312F" width="640" height="480"></iframe>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <h2 class="h3">สาขาที่ให้บริการ</h2>
            <div class="row card-branch-list pt-3">
            @foreach($data as $branch)
                <div class="col-lg-4 col-sm-6">
                    <div class="card-branch">
                        <h3>{{ $branch->name }}</h3>
                        <p>ที่ตั้ง : {{ $branch->location }}</p>
                        <p>เบอร์โทร. {{ $branch->phone }}</p>
                    </div>
                </div>
            @endforeach
            </div><!--row-->
        </div><!--container-->
    </div><!--section-->

@endsection
