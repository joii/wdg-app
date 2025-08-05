@extends('frontend.master')
@section('content')

<div class="section">
    <div class="container">
        <div class="row gy-4">

            <div class=" col-12" data-aos="fade-in">
               <img src="{{ asset($data->image_path)}}" class="card-img-top" alt="{{ $data->title }}">
               <div class="pt-4">
               <h6 class="text-gold">{{ \Carbon\Carbon::parse($data->start_date)->thaidate('j F Y') }} ถึง {{ \Carbon\Carbon::parse($data->end_date)->thaidate('j F Y') }}</h6>
               <h4>{{ $data->title }}</h4>
               <p>{{ $data->description }}</p>
               <hr/>
               <p class="card-text">{!! $data->detail !!}</p>
               </div>

            </div>


        </div><!--row-->
    </div>
</div>
@endsection
