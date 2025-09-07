<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">เมนู</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" title="Dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">ภาพรวม</span>
                    </a>
                </li>
                 @if (Auth::guard('admin')->user()->can('setting.all'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="mdi mdi-cog-outline"></i>
                        <span data-key="t-apps">ตั้งค่า</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li>
                            @if (Auth::guard('admin')->user()->can('metatags.index'))
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-meta-tags">Meta Tags</span>
                            </a>
                            @endif
                            <ul class="sub-menu" aria-expanded="false">
                                @if (Auth::guard('admin')->user()->can('metatags.index'))
                                <li><a href="{{ route('backend.metatags.index') }}" data-key="t-html-tags" title="HTML Meta"  @if(request()->routeIs('backend.metatags.*')) class="active" @endif>HTML Meta</a></li>
                                @endif
                                @if (Auth::guard('admin')->user()->can('gtm.index'))
                                <li><a href="{{ route('backend.gtm.index') }}" data-key="t-gtm" title="GTM">Google Tag Manager</a></li>
                                @endif
                                @if (Auth::guard('admin')->user()->can('ga.index'))
                                <li><a href="{{ route('backend.ga.index') }}" data-key="t-ga" title="GA">Google Analytics</a></li>
                                @endif
                                {{-- @if (Auth::guard('admin')->user()->can('facebook_pixel.index'))
                                <li><a href="{{ route('backend.facebook_pixel.index') }}" data-key="t-facebook-meta" title="Facebook Pixel">Facebook Pixel</a></li>
                                 @endif --}}
                                 {{-- @if (Auth::guard('admin')->user()->can('og_meta_tag.index'))
                                <li><a href="{{ route('backend.og_meta_tag.index') }}" data-key="t-og-meta" title="Open Graph Meta Tags">Open Graph Meta Tags</a></li>
                                 @endif --}}
                            </ul>
                        </li>
                        @if (Auth::guard('admin')->user()->can('interest_rate.index'))
                        <li>
                            <a href="{{ route('backend.interest_rate.index') }}" title="Interest Rate"  @if(request()->routeIs('backend.interest_rate.*')) class="active" @endif>
                                <span data-key="t-interest-rate">อัตราดอกเบี้ย</span>
                            </a>
                        </li>
                         @endif
                         @if (Auth::guard('admin')->user()->can('bank_account.index'))
                        <li>
                            <a href="{{ route('backend.bank_account.index') }}" title="Bank Account" @if(request()->routeIs('backend.bank_account.*')) class="active" @endif>
                                <span data-key="t-bank-account">บัญชีธนาคาร</span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>
                @endif
                 @if (Auth::guard('admin')->user()->can('authentication.all'))
                 <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="mdi mdi-cog-outline"></i>
                        <span data-key="t-apps">ผู้ดูแลระบบ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-permission">สิทธิ์การใช้งาน</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('backend.authen.permission.all_permission') }}" data-key="t-permission" >สิทธิ์การเข้าถึง (Permission)</a></li>
                                <li><a href="{{ route('backend.authen.permission.create') }}" data-key="t-permission" >เพิ่มสิทธิ์การเข้าถึง</a></li>
                                <li><a href="{{ route('backend.authen.role.all_role') }}" data-key="t-permission" >กลุ่มผู้ใช้งาน(Role)</a></li>
                                <li><a href="{{ route('backend.authen.role.create') }}" data-key="t-permission" >เพิ่มกลุ่มผู้ใช้งาน</a></li>
                                <li><a href="{{ route('backend.authen.rbac.all_rbac') }}" data-key="t-permission" >ระดับสิทธิ์(RBAC)</a></li>
                                <li><a href="{{ route('backend.authen.rbac.create') }}" data-key="t-permission" >กำหนดระดับสิทธิ์</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('backend.authen.admin.index') }}" title="Bank Account" >
                                <span data-key="t-admin">ผู้ดูแลระบบ</span>
                            </a>
                        </li>


                    </ul>
                </li>
                @endif
                @if (Auth::guard('admin')->user()->can('member.index'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="far fa-address-book"></i>
                        <span data-key="t-authentication">สมาชิกเว็บไซต์</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('backend.member.index') }}" data-key="t-web-member" title="รายชื่อสมาชิก">รายชื่อสมาชิก</a></li>
                        <li><a href="{{ route('backend.member.latest') }}" data-key="t-new-member" title="GTM">สมาชิกใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></a></li>
                        <li><a href="{{ route('backend.member.register') }}" data-key="t-member-register" title="GA">สมัครสมาชิก</a></li>
                    </ul>
                </li>
                @endif
                 @if (Auth::guard('admin')->user()->can('webcontent.all'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-file-code"></i>
                        <span data-key="t-pages">ข้อมูลบนเว็บไซต์</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="#" data-key="t-promotion-page">เกี่ยวกับเรา</a></li> --}}
                        <li><a href="{{ route('backend.promotion.index') }}" data-key="t-promotion-page" @if(request()->routeIs('backend.promotion.*')) class="active" @endif>โปรโมชัน</a></li>
                        <li><a href="{{ route('backend.branch.index') }}" data-key="t-branch" @if(request()->routeIs('backend.branch.*')) class="active" @endif>สาขา</a></li>
                        <li><a href="{{ route('backend.faq_category.index') }}" data-key="t-faqs" @if(request()->routeIs('backend.faq_category.*')) class="active" @endif>หมวดหมู่คำถามที่พบบ่อย</a></li>
                        <li><a href="{{ route('backend.faqs.index') }}" data-key="t-faqs" @if(request()->routeIs('backend.faqs.*')) class="active" @endif>คำถามที่พบบ่อย</a></li>
                        <li><a href="#" data-key="t-contact">ติดต่อเรา</a></li>
                        <li><a href="{{ route('backend.banner.index') }}" data-key="t-banner" @if(request()->routeIs('backend.banner.*')) class="active" @endif>แบนเนอร์</a></li>
                        <li><a href="{{ route('backend.gold_price.index') }}" data-key="t-price">ราคาทอง</a></li>
                        {{-- <li><a href="#" data-key="t-policy">เงื่อนไขและนโยบาย</a></li> --}}

                    </ul>
                </li>
                @endif
                 @if (Auth::guard('admin')->user()->can('report.all'))
                <li class="menu-title mt-2" data-key="t-components">รายงายทั้งหมด</li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                        <span data-key="t-charts">รายงาน</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" >
                        <li><a href="{{  route('backend.reports.overview_report') }}" data-key="t-apex-charts">ภาพรวม</a></li>
                        <li><a href="{{  route('backend.reports.pawn_report') }}" data-key="t-apex-charts">รายการขายฝาก</a></li>
                        <li><a href="{{  route('backend.reports.interest_report') }}" data-key="t-apex-charts">รายการต่อดอก</a></li>
                        <li><a href="{{  route('backend.reports.outstanding_interest_report') }}" data-key="t-apex-charts">รายการส่งดอกเบี้ยค้างชำระ</a></li>
                        <li><a href="{{  route('backend.reports.increase_principle_report') }}" data-key="t-apex-charts">รายการเพิ่มเงินต้น</a></li>
                        <li><a href="{{  route('backend.reports.decrease_principle_report') }}" data-key="t-apex-charts">รายการลดเงินต้น</a></li>

                    </ul>
                </li>
                @endif
                 @if (Auth::guard('admin')->user()->can('transaction.all'))

                <li class="menu-title mt-2" data-key="t-components">ธุรกรรมทั้งหมด</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-file-contract "></i>
                        <span data-key="t-horizontal">รายการขายฝาก</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route('backend.pawn_transaction.index') }}">รายการขายฝาก</a></li> --}}
                        <li><a href="{{ route('backend.pawn_transaction.index') }}">รายการหน้่าร้าน</a></li>
                        <li><a href="{{ route('backend.pawn_transaction.latest')}}">รายการขายใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></a></li>
                        {{-- <li><a href="#settle_pawn">รายการที่ปิดไปแล้ว</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span data-key="t-horizontal">รายการต่อดอก</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('backend.online_transaction.interest_list') }}">รายการต่อดอก</a></li>
                        {{-- <li><a href="#">รายการต่อดอกใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></a></li> --}}
                        {{-- <li><a href="#">รายการหน้าร้าน</a></li> --}}
                        {{-- <li><a href="#settle">รายการที่ปิดไปแล้ว</a></li> --}}
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-sort-up"></i>
                        <span data-key="t-horizontal">รายการเพิ่มเงินต้น</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('backend.online_transaction.increase_principle_list')  }}">รายการเพิ่มเงินต้น</a></li>
                        {{-- <li><a href="#">รายการเพิ่มเงินต้นใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></a></li> --}}
                        {{-- <li><a href="#">รายการเพิ่มเงินต้นหน้าร้าน</a></li> --}}
                        {{-- <li><a href="#">รายการที่ปิดไปแล้ว</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-sort-down"></i>
                        <span data-key="t-horizontal">รายการลดเงินต้น</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('backend.online_transaction.decrease_principle_list')  }}"">รายการลดเงินต้น</a></li>
                        {{-- <li><a href="#">รายการลดเงินต้นใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></li> --}}
                        {{-- <li><a href="#">รายการลดเงินต้นหน้่าร้าน</a></li> --}}
                        {{-- <li><a href="#">รายการที่ปิดไปแล้ว</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span data-key="t-horizontal">รายการส่งดอก</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('backend.online_transaction.accrued_interest_list') }}">รายการส่งดอก</a></li>
                        {{-- <li><a href="#">รายการต่อดอกใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></a></li> --}}
                        {{-- <li><a href="#">รายการหน้าร้าน</a></li> --}}
                        {{-- <li><a href="#settle">รายการที่ปิดไปแล้ว</a></li> --}}
                    </ul>

                </li>
                <li>
                    <a href="#redeem">
                        <i class="mdi mdi-file-cancel-outline font-size-24"></i>
                        <span data-key="t-authentication">ไถ่ถอน</span>
                    </a>
                </li>
                 @endif

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class=" far fa-address-card"></i>
                        <span data-key="t-authentication">ลูกค้าขายฝากทอง</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('backend.customer.index') }}">ลูกค้าขายฝากทอง</a></li>
                        <li><a href="{{ route('backend.customer.latest') }}">ลูกค้าใหม่ <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span></a></a></li>
                        {{-- <li><a href="#">ลูกค้าหน้่าร้าน</a></li> --}}

                    </ul>
                </li>
            </ul>
            <div class="border-0 text-center mx-8 mb-0 mt-5">


                    <div class="mt-4">
                        <a href="https://docs.google.com/document/d/1Huj_c2roLMUY4j31m446CD3HMVvDFxyp_XS8gAyQMMI/edit?usp=sharing" class="btn btn-primary mt-2" style="width:80%" target="_blank">คู่มือการใช้</a>
                    </div>

            </div>


        </div>
        <!-- Sidebar -->
    </div>
</div>
