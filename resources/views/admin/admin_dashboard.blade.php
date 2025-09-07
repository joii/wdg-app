<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Wisdom Gold</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Wisdom Gold " name="ห้างทองกาญจนาภิเษก" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

        <!-- plugin css -->
        <link href="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/preloader.min.css')}}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

        @if (request()->routeIs('backend.branch.*','backend.interest_rate.*','backend.bank_account.*'))
        <!-- DataTables -->
        <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        @endif

        @if (request()->routeIs('backend.pawn_transaction.*','backend.online_transaction.*','backend.reports.*','backend.customer.*','backend.member.*','backend.pawn_add.*'))
        <!-- flatpickr css -->
        <link href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css">
        @endif

        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Toastr Css-->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ========== Header Start ========== -->
           @include('admin.body.header')
            <!-- Header End -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.body.sidebar')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

             @yield('admin')

            <!-- End Page-content -->
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

         <!-- ========== Footer Start ========== -->
         @include('admin.body.footer')
         <!-- Footer End -->


        <!-- Right Sidebar -->
        @include('admin.body.rightside')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{ asset('backend/assets/libs/pace-js/pace.min.js')}}"></script>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        @if (request()->routeIs('admin.*'))
        <!-- apexcharts -->
        <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/pages/dashboard.init.js')}}"></script>

        @endif

        {{-- @if (request()->routeIs('backend.branch.index','backend.interest_rate.index','backend.bank_account.index','backend.faq_category.index','backend.faqs.index','backend.banner.index','backend.gold_price.index','backend.pawn_transaction.index','backend.reports.*','backend.customer.*','backend.pawn_add.*','backend.authen.permission.index')) --}}
        <!-- Required datatable js -->
        <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
          <!-- Datatable init js -->
          <script src="{{ asset('backend/assets/js/pages/datatables.init.js')}}"></script>

        {{-- @endif --}}

        @if (request()->routeIs('backend.branch.create'))
         <script src="{{ asset('backend/assets/js/pages/branch_create.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.bank_account.create'))
        <script src="{{ asset('backend/assets/js/pages/bank_account_create.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.interest_rate.create'))
        <script src="{{ asset('backend/assets/js/pages/interest_rate_create.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.faq_category.create'))
        <script src="{{ asset('backend/assets/js/pages/faq_category_create.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.faqs.create'))
        <script src="{{ asset('backend/assets/js/pages/faqs_create.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.pawn_transaction.*','backend.online_transaction.*','backend.reports.*','backend.pawn_add.*',))
        <!-- flatpickr js -->
        <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/pages/invoices-list.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.customer.*','backend.member.*'))
        <!-- flatpickr js -->
        <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/pages/customer.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.*'))
            <!-- apexcharts js -->
            <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.overview_report'))
        <!-- overview_report init -->
        <script src="{{ asset('backend/assets/js/pages/report_overview.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.pawn_report','backend.reports.pawn_custom_report'))
        <!-- overview_report init -->
        <script src="{{ asset('backend/assets/js/pages/report_pawn.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.interest_report','backend.reports.interest_custom_report'))
        <!-- overview_report init -->
        <script src="{{ asset('backend/assets/js/pages/report_send_interest.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.outstanding_interest_report','backend.reports.outstanding_interest_custom_report'))
        <!-- overview_report init -->
        <script src="{{ asset('backend/assets/js/pages/report_outstanding_interest.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.increase_principle_report','backend.reports.increase_custom_report'))
        <!-- overview_report init -->
        <script src="{{ asset('backend/assets/js/pages/report_increase_principle.init.js')}}"></script>
        @endif

        @if (request()->routeIs('backend.reports.decrease_principle_report','backend.reports.decrease_custom_report'))
        <!-- overview_report init -->
        <script src="{{ asset('backend/assets/js/pages/report_decrease_principle.init.js')}}"></script>
        @endif


      <!-- dashboard init -->
        <script src="{{ asset('backend/assets/js/app.js')}}"></script>
        <script src="{{ asset('backend/assets/js/validate.min.js')}}"></script>


        <script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
               case 'info':
               toastr.info(" {{ Session::get('message') }} ");
               break;

               case 'success':
               toastr.success(" {{ Session::get('message') }} ");
               break;

               case 'warning':
               toastr.warning(" {{ Session::get('message') }} ");
               break;

               case 'error':
               toastr.error(" {{ Session::get('message') }} ");
               break;
            }
            @endif
           </script>


    </body>

</html>
