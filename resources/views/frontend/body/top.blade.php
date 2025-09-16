 @php

    $id = Auth::guard('member')->id();
    $profileData = App\Models\Member::find($id);
    $pawnData = App\Models\PawnData::where('member_id', $id)->get();
@endphp
<style>
a.profile{
    cursor: pointer;
}

a.profile:hover{
    text-decoration: underline;
}

.btn-outline {
  border: 1px solid #fff;
  background-color: transparent;
  padding: 4px 8px;
  cursor: pointer;
  border-radius: 10px;
  color:#fff;
  text-decoration: none !important;
  margin-right: 5px;
}

</style>
<header class="header">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{  asset('frontend/assets/img/logo.svg')}}" alt="Wisdom Gold">
        </a>

        <ul class="nav nav-menu">
            <li><a href="{{ route('homepage') }}">หน้าหลัก</a></li>
            <li><a href="{{ route('frontend.promotions') }}">โปรโมชั่น</a></li>
            <li><a href="/estimate_price/simulator">ประเมินราคา</a></li>
            {{-- <li><a href="#">ฝากขายทอง</a></li> --}}
            <li><a href="{{ route('frontend.branch_list') }}">สาขาที่ให้บริการ</a></li>
            <li><a href="/faqs">คำถามที่พบบ่อย</a></li>
            <li><a href="/contactus">ติดต่อเรา</a></li>
        </ul>
         @if (!Auth::guard('member')->user())
     <a href="{{ route('member.login') }}"><img src="{{ asset('frontend/assets/img/icons/icon-login.svg') }}"  class="login-icon"  title="ล็อกอิน"></a>
 @endif

        @if (Auth::guard('member')->user())
        <div class="user-infos">
            {{-- <a href="#" class="card-link"></a> --}}
            {{-- <div class="avatar">
                <span class="badge"></span>
                <a href="{{ route('member.member_dashboard') }}">
                    <img src="{{  asset('frontend/assets/img/thumb/avatar.png')}}" alt="">
                </a>
            </div> --}}
            <div class="info">
                <h3>ยินดีต้อนรับ
                    <a href="{{ route('member.member_profile') }}" class="profile">{{ $profileData->firstname }} {{ $profileData->lastname }}</a>
                </h3>
                {{-- <p>คุณมีสัญญาทั้งหมด  รายการ</p> --}}
                <p>
                    <a href="{{ route('member.member_dashboard') }}">ธุรกรรมของคุณ</a> |
                    <a href="{{ route('customer.transaction_history') }}">ทำรายการ</a> |
                    <a href="{{ route('member.logout') }}">ออกจากระบบ</a>
                </p>

            </div>
        </div>
         @else
        <a class="btn login" href="{{ route('member.login') }}">เข้าสู่ระบบ</a>
        @endif
    </div>
</header>



<button class="btn btn-menu navbar-toggle" type="button">
    <span class="group">
        <span></span>
        <span></span>
        <span></span>
    </span>
</button>

<div class="navbar-slider">
    <ul class="nav nav-slider">
        <li><a href="/">หน้าหลัก</a></li>
        <li><a href="{{ route('frontend.promotions') }}">โปรโมชั่น</a></li>
        <li><a href="/estimate_price/simulator">ประเมินราคา</a></li>
        {{-- <li><a href="#">ฝากขายทอง</a></li> --}}
        <li><a href="{{ route('frontend.branch_list') }}">สาขาที่ให้บริการ</a></li>
        <li><a href="/faqs">คำถามที่พบบ่อย</a></li>
        <li><a href="/contactus">ติดต่อเรา</a></li>
         @if (!Auth::guard('member')->user())
        <li><a href="{{ route('member.login') }}">เข้าสู่ระบบ</a></li>
        @endif
    </ul>
</div>
 @if (Auth::guard('member')->user())
<div class="section section-user-info">
    <div class="container">
        <div class="user-infos">
            {{-- <a href="#" class="card-link"></a> --}}
            <div class="avatar">
                {{-- <span class="badge"></span> --}}
                <a href="{{ route('member.member_dashboard') }}">
                    <img src="{{  asset('frontend/assets/img/thumb/avatar.png')}}" alt="">
                </a>
            </div>

            <div class="info">
                 <h3>ยินดีต้อนรับ
                    <a href="{{ route('member.member_profile') }}" class="profile">{{ $profileData->firstname }} {{ $profileData->lastname }}</a>
                </h3>
                {{-- <p>คุณมีสัญญาทั้งหมด  รายการ</p> --}}
                 <p class="pt-2">
                    <a href="{{ route('member.member_dashboard') }}" class="btn-outline">ธุรกรรมของคุณ</a>
                    <a href="{{ route('customer.transaction_history') }}" class="btn-outline">ทำรายการ</a>
                    <a href="{{ route('member.logout') }}" class="btn-outline">ออกจากระบบ</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endif
