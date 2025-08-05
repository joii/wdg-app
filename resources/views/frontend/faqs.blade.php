@extends('frontend.master')
@section('content')
<!-- ========== Banner Area Start ========== -->
<!-- Banner Area End -->

<div class="section">
    <div class="container">
        <div class="row gy-4">
            <div class=" col-md-12" data-aos="fade-in">

                    <h3 class="pb-4 text-center">คำถามที่พบบ่อย</h3>

                    @foreach ($faq_categories as $category)
                     <div class="card card-faq" style="min-height: 1rem;">
                    <h4 class="faq-title">{{$category->category_name}}</h4>
                    <div class="accordion accordion-faq">
                        @foreach ($faqs as $key=>$item)
                        @if($item->category_id == $category->id)
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
                        @endif
                        @endforeach

                    </div><!--accordion-->
                     </div><!--card-->
                    <p style="height: 50px;">&nbsp;</p>
                    @endforeach


            </div>

        </div><!--row-->
    </div>
</div>
@endsection
