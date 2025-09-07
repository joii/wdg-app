<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale = 1.0,
maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes"/>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

 <!-- ========== Meta Tags Area Start ========== -->
@include('frontend.body.meta')
<!-- Meta Tags Area End -->


<link href="{{ asset('frontend/assets/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/aos.css" rel="stylesheet')}}">
<link href="{{ asset('frontend/assets/css/jquery.fancybox.css')}}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/swiper.css')}}" rel="stylesheet">
<link href="{{ asset('frontend/assets/css/global.css')}}" rel="stylesheet">


</head>
<body>
    @include('frontend.body.meta_in_body')
    <div class="page">
        <div class="preload">
            <span class="loader"></span>
        </div>

        <!-- ========== Top Area Start ========== -->
        @include('frontend.body.top')
        <!-- Top Area End -->

        <!-- ========== Content Area Start ========== -->
        @yield('content')
        <!-- Content Area End -->

        <!-- ========== Footer Area Start ========== -->
        @include('frontend.body.footer')
        <!-- Footer Area End -->

    </div><!--page-->

    <script src="{{ asset('frontend/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/swiper.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/aos.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.validate.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js')}}"></script>


    @if (request()->routeIs('member.register'))
    <script src="{{ asset('frontend/assets/js/pages/register.js')}}"></script>
    @endif

    @if (request()->routeIs('member.login'))
    <script src="{{ asset('frontend/assets/js/pages/login.js')}}"></script>
    @endif

    @if (request()->routeIs('customer.pawn_add'))
    <script src="{{ asset('frontend/assets/js/pages/pawn_add.js')}}"></script>
    @endif

     @if (request()->routeIs('customer.pawn_decrease'))
    <script src="{{ asset('frontend/assets/js/pages/pawn_add.js')}}"></script>
    @endif


   @if (request()->routeIs('customer.pawn_interest'))
    <script>
    function RollupInterest(val){
        var amount = val.split(",");
        $('#rollup_interest').html(amount[0]);
        $('#total_interest').html(amount[0]);
    }
    </script>
    @endif
   @if (request()->routeIs('simulator.index'))
    <script>
        //ตั้งค่าน้ำหนักทอง
        function setWeight(weight)
        {
            $('#weight_tot').val(weight);
        }

        function calculate()
        {
            //console.log($('#weight_tot').val());

            if($('#weight_tot').val() == null || $('#weight_tot').val() == ''){
                var w = 1;
            }else{
                var w = $('#weight_tot').val();
            }
            var price = {{ $goldPrices[0]->buy_gold_bar }};
            var percentage = 0.965;
            var cal_percentage = 0.89;
            var w_txt = w*4;

           // var total_amount = Number(w * price * percentage * cal_percentage).toFixed(2);
           var number = (w * price * percentage * cal_percentage);
            var total_amount = number.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
            });


            $('#cal_title').html('ราคาประเมิน<br>');
            $('#cal_weight').html('น้ำหนัก<br>'+ w_txt +' สลึง<br>');
            $('#cal_estimate').html(total_amount.toLocaleString());

        }

    </script>
      @endif

       @if (request()->routeIs('homepage'))
    <script>
        //ตั้งค่าน้ำหนักทอง
        function setWeight(weight)
        {
                $('#weight_tot').val(weight);
        }

        function calculate()
        {
            //console.log($('#weight_tot').val());
            if($('#weight_tot').val() == null || $('#weight_tot').val() == ''){
                var w = 1;
            }else{
                var w = $('#weight_tot').val();
            }
            var price = {{ $goldPrices[0]->sell_gold_bar }};
            var percentage = 0.965;
            var cal_percentage = 0.89;
            var w_txt=1;
            if(w !="1"){
                var w_txt = w*4;
            }

            if(w ==0.125){
                var w_txt = '1/2';
            }


           // var total_amount = Number(w * price * percentage * cal_percentage).toFixed(2);
           var number = Math.ceil(w * price * percentage * cal_percentage);
            // var total_amount = number.toLocaleString('en-US', {
            // minimumFractionDigits:  0,
            // maximumFractionDigits: 0
            // });

            total_amount = number;

            switch (w) {
                case '1': unit = 'บาท'; break;
                case '0.75': unit = 'สลึง'; break;
                case '0.5': unit = 'สลึง'; break;
                case '0.25': unit = 'สลึง'; break;
                case '0.125': unit = 'สลึง'; break;
                default: unit = 'บาท'; break;
            }
            $('#cal_title').html('ราคาประเมิน<br>');
            $('#cal_weight').html('น้ำหนัก<br>'+ w_txt + ' ' +unit +'<br>');
            $('#cal_estimate').html(total_amount.toLocaleString());

        }

    </script>
      @endif
</body>
</html>
