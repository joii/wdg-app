@php
     // Meta Tags
    $meta_tags = \App\Models\MetaTag::first();
    // Facebook Pixel
    $facebookPixel = \App\Models\FacebookPixel::where('status','active')->first();
    // // Google Analytics
    $googleAnalytics = \App\Models\GoogleAnalytic::first();
    // // Google Tag Manager
    $googleTagManager = \App\Models\GoogleTagManager::first();
@endphp

<title>{{ $meta_tags->meta_title !=''?$meta_tags->meta_title:'จำหน่ายทองรูปพรรณ ทองแท่ง สร้อยทอง แหวนทอง สร้อยข้อมือทอง โดยห้างทองกาญจนาภิเษก : Wisdom Gold' }}</title>
<meta name="description" content="{{ $meta_tags->meta_description !=''?$meta_tags->meta_description:'Wisdom Gold จำหน่ายทองรูปพรรณ โดยอยู่ภายใต้การดูแลของ ”ห้างทองกาญจนาภิเษก” ได้ดำเนินกิจการมายาวนานต่อเนื่องมากกว่า 23 ปี เป็นที่ยอมรับด้านคุณภาพสินค้าที่ได้มาตรฐานจากเยาวราชพร้อมให้บริการและสร้างความเชื่อมั่นให้กับลูกค้าด้วยดีโดยตลอดมาให้ความสำคัญลูกค้าเป็นลำดับแรกเสมอและพร้อมปรับพัฒนาให้เท่าทันโลกยุคดิจิทัล'}}">
<meta name="keywords" content="{{$meta_tags->meta_keyword!=''?$meta_tags->meta_keyword:'ขายฝากทอง,จำนำทอง' }}">
<meta name="robots" content="{{$meta_tags->meta_robots }}">
<meta name="googlebot" content="{{$meta_tags->googlebot!=''?$meta_tags->googlebot:'' }}">
<meta name="author" content="{{$meta_tags->author!=''?$meta_tags->author:'ห้างทองกาญจนาภิเษก ชลบุรี' }}">
<link rel="canonical" href="{{$meta_tags->canonical!=''?$meta_tags->canonical:'https://app.wisdom-gold.com' }}" />
@yield('google_analytics', false)
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', "{{ $facebookPixel->pixel_id }}");
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id={{ $facebookPixel->pixel_id }}&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<!-- Google Analytics -->
{!! $googleAnalytics->gtag !!}
<!-- End Google Analytics -->
<!-- Google Tag Manager -->
{!!  $googleTagManager->gtm_first_block !!}
<!-- End Google Tag Manager -->


