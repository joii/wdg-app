@extends('frontend.master')
@section('content')
<!-- ========== Banner Area Start ========== -->
@include('frontend.body.banner')
<!-- Banner Area End -->
<div class="section">
    <div class="container">
        <div class="row gy-4">
            @foreach ($data as $item)
            <div class=" col-md-3 col-sm-6" data-aos="fade-in">

                <div class="card">
                    <img src="{{ asset($item->thumbnail_path)}}" class="card-img-top" alt="{{ $item->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{!! $item->title !!}</h5>
                        <p class="card-text">{!! $item->description !!}</p>
                        <a href="{{ route('frontend.promotion.detail',[$item->id,$item->slug]) }}" class="btn btn-primary">รายละเอียด</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div><!--row-->
    </div>
</div>
@endsection
